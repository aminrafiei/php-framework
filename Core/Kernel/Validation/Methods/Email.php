<?php

namespace Core\Kernel\Validation\Methods;

use Core\Kernel\Validation\Validated;

/**
 * Created by PhpStorm.
 * User: amin
 * Date: 3/26/19
 * Time: 2:23 PM
 */
class Email implements Validated
{
    /**
     * @var string
     */
    private $attribute;

    /**
     * @param $item
     * @param $attribute
     * @return mixed
     */
    public function handle($item, $attribute): bool
    {
        $this->attribute = $attribute;

        if (filter_var($item, FILTER_VALIDATE_EMAIL)) {
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
        return !empty($message) ? $message : $this->attribute . " must be email format";
    }
}