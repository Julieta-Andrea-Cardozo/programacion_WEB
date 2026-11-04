<?php

namespace App\Core;

/**
 * Controlador base: renderiza vistas y redirige. No contiene SQL.
 */
abstract class Controller
{
    protected function render(string $vista, array $variables = []): void
    {
        extract($variables, EXTR_SKIP);
        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/' . $vista . '.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }

    protected function redirigir(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}
