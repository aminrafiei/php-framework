<?php
/**
 * Created by PhpStorm.
 * User: amin
 * Date: 3/26/19
 * Time: 1:54 PM
 */

namespace Core\Kernel\Validation;


/**
 * Interface Validated
 * @package Core\Kernel\Validation
 */
interface Validated
{
    /**
     * @param $item
     * @param $attribute
     * @return bool
     */
    public function handle($item, $attribute): bool;

    /**
     * @param $message
     * @return string
     */
    public function message($message = ""): string;
}