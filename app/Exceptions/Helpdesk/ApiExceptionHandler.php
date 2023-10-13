<?php

namespace App\Exceptions\Helpdesk;

use Closure;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class ApiExceptionHandler extends Handler
{
    public function render($request, Throwable $e)
    {
        $apiRoute = "api/helpdesk";
        if ((str_contains($e->getMessage(), $apiRoute) or str_contains($request->fullUrl(), $apiRoute))){
            if ($e instanceof HttpExceptionInterface) {
                $message = $e->getMessage();
                return response()->json(["message" => $message], $e->getStatusCode());
            }
            $logID = Str::ulid();
            Log::error("$logID: " . $e->getMessage() . "in" . $e->getFile() . ", line: " . $e->getLine() . ",trace: " .  $e->getTraceAsString());
            return response()->json(["message" => "Server error.", "log_id" => $logID], 500);
        }
        return parent::render($request, $e);
    }

    public function handle($request, Closure $next)
    {
        try {
            return $next($request);
        } catch (Throwable $e) {
            return $this->render($request, $e);
        }
    }
}
