<?php

declare(strict_types=1);

namespace DaDaDev\Symfony;

use PhpParser\Node\Expr;
use PHPStan\Analyser\Scope;

interface UrlGeneratingRoutesMap
{
    public function hasRouteName(string $name): bool;

    /** @return array<string, string> */
    public function getRouteRequirements(string $name): array;

    public static function getRouteNameFromNode(Expr $node, Scope $scope): ?string;
}
