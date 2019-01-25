<?php
/**
 * Created by PhpStorm.
 * User: amin
 * Date: 1/19/19
 * Time: 1:47 PM
 */

namespace Core\Kernel;


/**
 * Class Validation
 * @package Core\Kernel
 */
class Validation
{
    /**
     * @var array
     */
    protected $condition = ['number', 'email', 'required'];

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

        if ($this->checkRule($rules)) {
            foreach ($rules as $key => $value) {
                foreach ($value as $item) {
                    if (!$this->$item($key)) {
                        flashMessage($this->getMessage());
                        return false;
                    };
                }
            }
            return true;
        }

        return $this->getMessage();
    }

    /**
     * @param $rules
     * @return bool
     */
    public function checkRule($rules)
    {
        foreach ($rules as $rule) {
            foreach ($rule as $item) {
                if (!array_key_exists($item, $this->condition) && !method_exists($this, $item)) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @param $key
     * @return bool|mixed
     */
    protected function number($key)
    {
        if (is_numeric($this->items[$key])) {
            return true;
        }
        $this->setMessage($key . " must be numeric");

        return false;
    }

    /**
     * @param $key
     * @return bool|mixed
     */
    protected function email($key)
    {
        if (filter_var($this->items[$key], FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        $this->setMessage($key . " must be email format");

        return false;
    }

    /**
     * @param $key
     * @return bool|mixed
     */
    protected function required($key)
    {
        if (!empty($this->items[$key])) {
            return true;
        }
        $this->setMessage($key . " required");

        return false;
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