<?php

declare(strict_types=1);

namespace DaDaDev\Rules\Symfony;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ExampleControllerWithRouting extends AbstractController
{
    public function generateSomeRoute1(): void
    {
        $this->generateUrl('someRoute1');
    }

    public function generateNonExistingRoute(): void
    {
        $this->generateUrl('unknown');
    }

    public function redirectToSomeRoute1(): void
    {
        $this->redirectToRoute('someRoute1');
    }

    public function redirectToNonExistingRoute(): void
    {
        $this->redirectToRoute('unknown');
    }
}
