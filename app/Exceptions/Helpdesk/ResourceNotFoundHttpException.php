<?php

namespace App\Exceptions\Helpdesk;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResourceNotFoundHttpException extends NotFoundHttpException
{
    public function __construct(
        string $message = 'Resource Not Found.', \Throwable $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct($message, $previous, $code, $headers);
    }
}
