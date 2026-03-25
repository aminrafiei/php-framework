<?php

declare(strict_types=1);

namespace Core\Kernel;

/**
 * Class Response
 * Fast and robust HTTP response abstraction
 */
class Response
{
    /**
     * @param mixed $data
     * @param int $status
     */
    public static function json($data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    /**
     * @param string $html
     * @param int $status
     */
    public static function html(string $html, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: text/html; charset=utf-8');
        echo $html;
        exit;
    }

    /**
     * @param string $uri
     * @param int $status
     */
    public static function redirect(string $uri, int $status = 302): void
    {
        http_response_code($status);
        header('Location: ' . $uri);
        exit;
    }
}
