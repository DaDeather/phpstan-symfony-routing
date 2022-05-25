<?php

declare(strict_types=1);

namespace DaDaDev\Symfony;

class UrlGeneratingRoute implements UrlGeneratingRoutesDefinition
{
    /** @var string */
    private $name;

    /** @var string */
    private $controller;

    /** @var array<string, string> */
    private $urlRequiredParams;

    /**
     * @param array<string, string> $urlParams
     */
    public function __construct(
        string $name,
        string $controller,
        array $urlParams
    ) {
        $this->name = $name;
        $this->controller = $controller;
        $this->urlRequiredParams = $urlParams;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getController(): ?string
    {
        return $this->controller;
    }

    /** @return array<string, string> */
    public function getRequiredUrlParams(): array
    {
        return $this->urlRequiredParams;
    }
}
