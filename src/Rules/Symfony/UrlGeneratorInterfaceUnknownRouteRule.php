<?php

declare(strict_types=1);

namespace DaDaDev\Rules\Symfony;

use DaDaDev\Symfony\UrlGeneratingRoutesMap;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Type\ObjectType;
use PHPStan\Type\TypeUtils;

/**
 * @implements Rule<MethodCall>
 */
final class UrlGeneratorInterfaceUnknownRouteRule implements Rule
{
    /** @var UrlGeneratingRoutesMap */
    private $urlGeneratingRoutesMap;

    public function __construct(UrlGeneratingRoutesMap $urlGeneratingRoutesMap)
    {
        $this->urlGeneratingRoutesMap = $urlGeneratingRoutesMap;
    }

    public function getNodeType(): string
    {
        return MethodCall::class;
    }

    /**
     * @param MethodCall $node
     *
     * @return (string|\PHPStan\Rules\RuleError)[] errors
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node->name instanceof Node\Identifier) {
            return [];
        }

        if (in_array($node->name->name, ['generate', 'generateUrl'], true) === false || !isset($node->getArgs()[0])) {
            return [];
        }

        $argType = $scope->getType($node->var);
        $isControllerType = (new ObjectType('Symfony\Bundle\FrameworkBundle\Controller\Controller'))->isSuperTypeOf($argType);
        $isAbstractControllerType = (new ObjectType('Symfony\Bundle\FrameworkBundle\Controller\AbstractController'))->isSuperTypeOf($argType);
        $isUrlGeneratorInterface = (new ObjectType('Symfony\Component\Routing\Generator\UrlGeneratorInterface'))->isSuperTypeOf($argType);
        if (
            $isControllerType->no()
            && $isAbstractControllerType->no()
            && $isUrlGeneratorInterface->no()
        ) {
            return [];
        }

        $routeName = $this->urlGeneratingRoutesMap::getRouteNameFromNode($node->getArgs()[0]->value, $scope);
        if ($routeName === null) {
            return [];
        }

        if ($this->urlGeneratingRoutesMap->hasRouteName($routeName) === false) {
            return [sprintf('Route with name "%s" does not exist.', $routeName)];
        }

        $routeRequirements = $this->urlGeneratingRoutesMap->getRouteRequirements($routeName);
        if (
            $routeRequirements !== []
            && count($node->getArgs()) < 2
        ) {
            return [sprintf('Route with name "%s" has requires parameters "%s" to be given.', $routeName, implode(', ', array_keys($routeRequirements)))];
        }

        if (
            $routeRequirements !== []
            && $scope->getType($node->getArgs()[1]->value)->isArray()->yes()
        ) {
            $requiredParamsArrayType = $scope->getType($node->getArgs()[1]->value);
            $requiredParamConstantStrings = TypeUtils::getConstantStrings($requiredParamsArrayType->getIterableKeyType());

            foreach ($routeRequirements as $name => $requirement) {
                foreach ($requiredParamConstantStrings as $requiredParamConstantString) {
                    if ($name === $requiredParamConstantString->getValue()) {
                        continue 2;
                    }
                }

                return [sprintf('Route with name "%s" is missing required param %s.', $routeName, $name)];
            }
        }

        return [];
    }
}
