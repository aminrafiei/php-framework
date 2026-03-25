<?php

declare(strict_types=1);

namespace Core\Kernel;

use ErrorException;
use Throwable;

/**
 * Class ExceptionHandler
 * Gracefully handles production runtime errors
 */
class ExceptionHandler
{
    public static function register(): void
    {
        set_error_handler([self::class, 'handleError']);
        set_exception_handler([self::class, 'handleException']);
    }

    /**
     * @param int $level
     * @param string $message
     * @param string $file
     * @param int $line
     * @return bool
     * @throws ErrorException
     */
    public static function handleError(int $level, string $message, string $file = '', int $line = 0): bool
    {
        if (error_reporting() & $level) {
            throw new ErrorException($message, 0, $level, $file, $line);
        }
        return false;
    }

    /**
     * @param Throwable $e
     */
    public static function handleException(Throwable $e): void
    {
        $env = Env::get('APP_ENV', 'production');
        
        $status = $e->getCode();
        if (!is_numeric($status) || $status < 400 || $status > 599) {
            $status = 500;
        }
        
        if ($env === 'production') {
            $data = [
                'error' => true,
                'message' => 'Internal Server Error',
                'status' => $status
            ];
        } else {
            $data = [
                'error' => true,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => explode("\n", $e->getTraceAsString()),
                'status' => $status
            ];
        }

        $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
        if (strpos($accept, 'application/json') !== false) {
            Response::json($data, (int)$status);
        } else {
            $html = "<h1>Error {$status}</h1><p>" . htmlspecialchars((string)$data['message']) . "</p>";
            if ($env !== 'production') {
                $html .= "<pre>" . htmlspecialchars(print_r($data['trace'], true)) . "</pre>";
            }
            Response::html($html, (int)$status);
        }
    }
}
