<?php
/**
 * Created by PhpStorm.
 * User: amin
 * Date: 1/19/19
 * Time: 1:47 PM
 */

namespace Core\Kernel\Validation;


use Core\Kernel\Validation\Methods\Email;
use Core\Kernel\Validation\Methods\Number;
use Core\Kernel\Validation\Methods\Required;

/**
 * Class Validation
 * @package Core\Kernel
 */
class Validation
{
    /**
     * @var array
     */
    protected $condition = [
        'number' => Number::class,
        'email' => Email::class,
        'required' => Required::class
    ];

    /**
     * @var
     */
    protected $items;

    /**
     * @var
     */
    protected $message = 'something went wrong';

    /**
     * @param array $items
     * @param array $rules
     * @return boolean|string
     */
    public function validate(array $items, array $rules)
    {
        $this->items = $items;

        return $this->checkRule($rules);
    }

    /**
     * @param $all_rules
     * @return bool
     */
    public function checkRule($all_rules)
    {
        foreach ($all_rules as $attribute => $rules) {
            foreach ($rules as $rule) {
                if (array_key_exists($rule, $this->condition) && !$this->handleValidation($rule, $attribute)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @param $rule
     * @param $attribute
     * @return bool
     */
    private function handleValidation($rule, $attribute)
    {
        return $this->doValidation(
            app()->make($this->condition[$rule]),
            $this->items[$attribute],
            $attribute
        );
    }

    /**
     * @param Validated $validatedRule
     * @param $item
     * @param $attribute
     * @return bool
     */
    private function doValidation(Validated $validatedRule, $item, $attribute)
    {
        if (!$validatedRule->handle($item, $attribute)) {
            flashMessage($validatedRule->message());

            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }
}