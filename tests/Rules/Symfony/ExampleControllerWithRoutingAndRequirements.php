<?php

declare(strict_types=1);

namespace DaDaDev\Rules\Symfony;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ExampleControllerWithRoutingAndRequirements extends AbstractController
{
    public function generateSomeRoute1(): void
    {
        $this->generateUrl('someRoute1');
    }

    public function generateSomeRoute2(): void
    {
        $this->generateUrl('someRoute1', ['number' => 1]);
    }

    public function generateSomeRoute3(): void
    {
        $this->generateUrl('someRoute1', ['date' => '2022-05-25']);
    }

    public function generateSomeRoute4(): void
    {
        $this->generateUrl('someRoute1', ['number' => 1, 'date' => '2022-05-25']);
    }
}
