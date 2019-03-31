<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/14/2018
 * Time: 7:54 PM
 */

namespace Core;

use Core\Database\QueryBuilder;

require_once 'Database/MySql/MySqlQuery.php';

/**
 * Class BaseModel
 * @package Core
 */
abstract class BaseModel
{
    /**
     * @var QueryBuilder
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
        $this->database = app()->get('database');
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
     * @return $this
     */
    public function where($column, $value, $action = '=', array $columns = ['*'])
    {
        $this->data = $this->database
            ->table($this->table)
            ->select($columns)
            ->where($column, $value, $action);

        return $this;
    }

    /**
     * @param $column
     * @param $value
     * @param $action
     * @return $this
     */
    public function andWhere($column, $value, $action = '=')
    {
        $this->data = $this->database
            ->andWhere($column, $value, $action);

        return $this;
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
     * @param array $columns
     * @param $id
     * @return bool
     */
    public function update(array $columns, $id)
    {
        return $this->database->table($this->table)
            ->update($columns, $id);
    }


    /**
     * @param $value
     * @param string $key
     * @return mixed
     */
    public function delete($value, $key = 'id')
    {
        return $this->database->table($this->table)
            ->delete($value, $key);
    }

    /**
     * @return QueryBuilder
     */
    public function getDatabase(): QueryBuilder
    {
        return $this->database;
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }
}