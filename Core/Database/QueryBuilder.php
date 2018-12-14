<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 12/7/2018
 * Time: 10:07 AM
 */

require 'MySqlQuery.php';

/**
 * Class QueryBuilder
 */
class QueryBuilder
{

    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var string
     */
    private $table;

    /**
     * @var string
     */
    private $query;

    /**
     * @var
     */
    private $queryPre;

    /**
     * QueryBuilder constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param $table
     * @return $this
     */
    public function table($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function select(array $attributes = ['*'])
    {

        $column = join(", ", $attributes);

        $this->query = SELECT
            . $column
            . FROM
            . $this->table;

        return $this;
    }

    /**
     * @param $column
     * @param $value
     * @param string $action
     * @return $this
     */
    public function where($column, $value, $action = '=')
    {
        $this->query .= WHERE
            . $column
            . $action
            . $value;

        return $this;
    }

    /**
     * @param array $columns
     * @param array $values
     * @return bool
     */
    public function insert(array $columns, array $values)
    {
        $joinColumns = join(', ', $columns);
        $valueColumns = array_map(function ($columns) {
            return ":" . $columns;
        }, $columns);

        $joinValues = join(', ', $valueColumns);

        $this->query = INSERT
            . $this->table
            . " ($joinColumns)"
            . VALUES
            . "($joinValues)";

        return $this->set(array_combine($columns, $values));

    }

    /**
     * @param $columns
     * @param $values
     * @param $value
     * @param string $key
     * @return bool
     */
    public function update($columns, $values, $value, $key = 'id')
    {

        $data = array_map(function ($columns, $values) {

            return "$columns=$values";

        }, $columns, $values);

        $data = join(', ', $data);

        $this->query = UPDATE
            . $this->table
            . SET
            . $data
            . WHERE
            . $key . '=' . $value;

        return $this->set($this->query);

    }

    /**
     * @param array $data
     * @return bool
     */
    protected function set($data = [])
    {
        $this->queryPre = $this->pdo->prepare($this->query);
        return $this->queryPre->execute($data);
    }


    /**
     * @return array
     */
    public function get()
    {
        $this->set();
        return $this->queryPre->fetchAll(PDO::FETCH_CLASS);
    }
}