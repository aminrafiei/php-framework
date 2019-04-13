<?php

namespace Core\Kernel\Validation\Methods;

use Core\Kernel\Validation\Validated;

/**
 * Created by PhpStorm.
 * User: amin
 * Date: 3/26/19
 * Time: 1:58 PM
 */
class Number implements Validated
{
    /**
     * @var string
     */
    private const MESSAGE = " must be numeric";

    /**
     * @var string
     */
    private $attribute;

    /**
     * @param $item
     * @param $attribute
     * @return bool
     */
    public function handle($item, $attribute): bool
    {
        $this->attribute = $attribute;

        if (is_numeric($item)) {
            return true;
        }

        return false;
    }

    /**
     * @param $message
     * @return string
     */
    public function message($message = ""): string
    {
        return !empty($message) ? $message : $this->attribute . self::MESSAGE;
    }
}