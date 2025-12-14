<?php

use App\Helpers\ApiResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;


use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'abilities' => CheckAbilities::class,
            'ability'   => CheckForAnyAbility::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        #########################################################
        #### 422 - ValidationException ####
        $exceptions->render(function (ValidationException $e, $request) {
            return ApiResponse::errors(
                "Erro de validação",
                $e->errors(),
                422
            );
        });

        #########################################################
        #### 404 - NotFoundHttpException ####
        // (isso captura findOrFail no Laravel 12)
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            return ApiResponse::errors(
                "Recurso não encontrado",
                null,
                404
            );
        });

        #########################################################
        #### Exceções HTTP genéricas (401, 403, 405, etc.) ####
        $exceptions->render(function (HttpExceptionInterface $e, $request) {
            return ApiResponse::errors(
                $e->getMessage() ?: 'Erro HTTP',
                null,
                $e->getStatusCode()
            );
        });


        #########################################################
        #### 500 - QueryException (erros SQL) ####
        $exceptions->render(function (QueryException $e, $request) {
            return ApiResponse::errors(
                "Erro ao acessar o banco de dados",
                $e->getMessage(),
                500
            );
        });

        #########################################################
        #### 500 - Exception Genérica ####
        // (último fallback)
        $exceptions->render(function (\Exception $e, $request) {
            return ApiResponse::errors(
                "Erro interno no servidor",
                $e->getMessage(),
                500
            );
        });
    })->create();
