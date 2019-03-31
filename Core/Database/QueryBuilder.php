<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 10:07 AM
 */

namespace Core\Database;

use PDO;

/**
 * Class QueryBuilder
 */
interface QueryBuilder
{
    /**
     * QueryBuilder constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo);

    /**
     * @param $table
     * @return $this
     */
    public function table($table);

    /**
     * @param array $attributes
     * @return $this
     */
    public function select(array $attributes = ['*']);

    /**
     * @param $column
     * @param $value
     * @param string $action
     * @return $this
     */
    public function where($column, $value, $action = '=');

    /**
     * @param $column
     * @param $value
     * @param string $action
     * @return mixed
     */
    public function andWhere($column, $value, $action = '=');

    /**
     * @param array $columns
     * @param array $values
     * @return bool
     */
    public function insert(array $columns, array $values);

    /**
     * @param $columns
     * @param $value
     * @param string $key
     * @return bool
     */
    public function update(array $columns, $value, $key = 'id');

    /**
     * @param $value
     * @param string $key
     * @return bool
     */
    public function delete($value, $key);

    /**
     * @param array $data
     * @return bool
     */
    public function set($data = []);

    /**
     * @return array
     */
    public function get();
}