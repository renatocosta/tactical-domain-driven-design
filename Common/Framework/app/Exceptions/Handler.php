<?php

namespace App\Exceptions;

use Domains\HostProperties\Domain\Model\Calendar\CalendarException;
use Domains\HostProperties\Domain\Model\Property\PropertyException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * This mapping holds exceptions we're interested in and creates a simple configuration that can guide us
     * with formatting how it is rendered.
     *
     * @var array|array[]
     */
    protected array $exceptionMap = [
        PropertyException::class => [
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => 'You provided some invalid input value',
            'adaptMessage' => true,
        ],
        CalendarException::class => [
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => 'You provided some invalid input value',
            'adaptMessage' => true,
        ],
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $response = $this->formatException($exception);

        return response()->json(['error' => $response], $response['status'] ?? 500);
    }

    /**
     * A simple implementation to help us format an exception before we render me
     *
     * @param \Throwable $exception
     *
     * @return array
     */
    protected function formatException(\Throwable $exception): array
    {

        $exceptionClass = get_class($exception);

        $definition = $this->exceptionMap[$exceptionClass] ?? [
            'code' => $exception->getStatusCode(),
            'message' => $exception->getMessage() ?? 'Something went wrong while processing your request',
            'adaptMessage' => false,
        ];

        if (!empty($definition['adaptMessage'])) {
            $definition['message'] = $exception->getMessage() ?? $definition['message'];
        }

        return [
            'status' => $definition['code'] ?? Response::HTTP_INTERNAL_SERVER_ERROR,
            'title' => $definition['title'] ?? 'Error',
            'description' => $definition['message'],
        ];
    }
}
