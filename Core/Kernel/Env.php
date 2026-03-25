<?php

declare(strict_types=1);

namespace Core\Kernel;

use Exception;

/**
 * Class Env
 * High-performance, lightweight .env parser
 */
class Env
{
    /**
     * @var array<string, string>
     */
    private static array $vars = [];

    /**
     * Parse a simple .env file without external dependencies.
     * 
     * @param string $path
     * @throws Exception
     */
    public static function load(string $path): void
    {
        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            throw new Exception("Unable to read environment file at: $path");
        }

        foreach ($lines as $line) {
            $line = trim($line);
            // Skip empty lines or strict comments
            if ($line === '' || strpos($line, '#') === 0) {
                continue;
            }

            if (strpos($line, '=') !== false) {
                [$key, $value] = explode('=', $line, 2);
                $key = trim($key);
                $value = trim(trim($value), "\"'");

                self::$vars[$key] = $value;
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value; // Also put it in SERVER superglobal for framework compatibility
            }
        }
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        if (array_key_exists($key, self::$vars)) {
            return self::$vars[$key];
        }

        $env = getenv($key);
        if ($env !== false) {
            return $env;
        }

        return $_ENV[$key] ?? $_SERVER[$key] ?? $default;
    }
}
