<?php

declare(strict_types=1);

namespace DaDaDev\Symfony;

interface UrlGeneratingRoutesMapFactory
{
    public function create(): UrlGeneratingRoutesMap;
}
