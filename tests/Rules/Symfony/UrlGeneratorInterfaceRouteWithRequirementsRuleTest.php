<?php

declare(strict_types=1);

namespace DaDaDev\Rules\Symfony;

use DaDaDev\Symfony\Configuration;
use DaDaDev\Symfony\PhpUrlGeneratingRoutesMapFactory;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/**
 * @extends RuleTestCase<UrlGeneratorInterfaceUnknownRouteRule>
 */
final class UrlGeneratorInterfaceRouteWithRequirementsRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new UrlGeneratorInterfaceUnknownRouteRule((new PhpUrlGeneratingRoutesMapFactory(new Configuration(['urlGeneratingRulesFile' => __DIR__ . '/url_generating_routes_with_requirements.php'])))->create());
    }

    public function testGenerate(): void
    {
        if (!class_exists('Symfony\Bundle\FrameworkBundle\Controller\AbstractController')) {
            self::markTestSkipped();
        }

        $this->analyse(
            [
                __DIR__ . '/ExampleControllerWithRoutingAndRequirements.php',
            ],
            [
                [
                    'Route with name "someRoute1" has requires parameters "number, date" to be given.',
                    13,
                ],
                [
                    'Route with name "someRoute1" is missing required param date.',
                    18,
                ],
                [
                    'Route with name "someRoute1" is missing required param number.',
                    23,
                ],
            ]
        );
    }

    public static function getAdditionalConfigFiles(): array
    {
        return [
            __DIR__ . '/../../../extension.neon',
        ];
    }
}
