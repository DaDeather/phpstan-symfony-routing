<?php

declare(strict_types=1);

namespace DaDaDev\Symfony;

final class Configuration
{
    /** @var array<string, mixed> */
    private $parameters;

    /**
     * @param array<string, mixed> $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function getUrlGeneratingRoutesFile(): ?string
    {
        if (isset($this->parameters['urlGeneratingRulesFile']) && is_string($this->parameters['urlGeneratingRulesFile'])) {
            return $this->parameters['urlGeneratingRulesFile'];
        }

        return null;
    }
}
