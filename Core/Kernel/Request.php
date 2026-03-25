<?php

declare(strict_types=1);

namespace Core\Kernel;

/**
 * Class Request
 * @package Core\Kernel
 */
class Request
{
    public const NULL = 'NOK';

    /**
     * @param array<string> $values
     * @return mixed
     */
    public function get(array $values = []): mixed
    {
        if (empty($values)) {
            return $_REQUEST;
        }

        $result = '';

        foreach ($values as $value) {
            $result .= $_REQUEST[$value] ?? self::NULL;
        }

        return $result;
    }

    /**
     * @return string
     */
    public function uri(): string
    {
        $baseUrl = config()['base_url'] ?? '';
        
        return str_replace(
            $baseUrl,
            '',
            trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '', '/')
        );
    }

    /**
     * @return string
     */
    public function method(): string
    {
        if ($this->has('_method')) {
            return (string) $_REQUEST['_method'];
        }

        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    /**
     * @param string $attribute
     * @return bool
     */
    public function has(string $attribute): bool
    {
        return !empty($_REQUEST[$attribute]);
    }

    /**
     * redirect back
     */
    public function back(): void
    {
        redirect($_SERVER['HTTP_REFERER'] ?? '/');
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name): mixed
    {
        return $this->get([$name]);
    }
}