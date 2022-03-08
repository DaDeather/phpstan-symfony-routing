<?php

declare(strict_types=1);

namespace DaDaDev\Symfony;

interface UrlGeneratingRoutesDefinition
{
    public function getName(): string;

    public function getController(): ?string;
}
