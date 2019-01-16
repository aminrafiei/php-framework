<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/14/2018
 * Time: 7:54 PM
 */

namespace Core;

require_once 'Database/MySqlQuery.php';

use Core\Kernel\App;

/**
 * Class BaseModel
 * @package Core
 */
abstract class BaseModel
{

    /**
     * @var
     */
    protected $attributes;

    /**
     * @var \QueryBuilder
     */
    protected $database;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var
     */
    protected $data;

    /**
     * BaseModel constructor.
     * @param $table
     */
    public function __construct($table)
    {
        $this->database = App::get('database');
        $this->table = $table;
    }

    /**
     * @param $value
     * @param string $key
     * @param array $columns
     * @return mixed
     */
    public function find($value, $key = 'id', array $columns = ['*'])
    {
        $this->data = $this->database
            ->table($this->table)
            ->select($columns)
            ->where($key, $value);

        return $this->first();

    }

    /**
     * @return mixed
     */
    public function first()
    {
        return array_values($this->get())[0];
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->data->get();
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = ['*'])
    {
        $this->data = $this->database->table($this->table)
            ->select($columns);

        return $this;
    }

    /**
     * @param $column
     * @param $value
     * @param $action
     * @param array $columns
     * @return mixed
     */
    public function where($column, $value, $action, array $columns = ['*'])
    {
        $this->data = $this->database
            ->table($this->table)
            ->select($columns)
            ->where($column, $value, $action);

        return $this;

    }


    public function save()
    {

    }


    /**
     * @param $columns
     * @return bool
     */
    public function create(array $columns)
    {
        return $this->database->table($this->table)
            ->insert(array_keys($columns), array_values($columns));
    }


    /**
     * @param $columns
     * @param $values
     */
    public function update($columns, $values)
    {

        $this->database->table($this->table)
            ->update($columns,$values,1);
    }

    /**
     *
     */
    public function delete()
    {

    }
}