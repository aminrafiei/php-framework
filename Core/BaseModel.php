<?php

declare(strict_types=1);

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
    protected QueryBuilder $database;

    /**
     * @var string
     */
    protected string $table;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * BaseModel constructor.
     * @param string $table
     */
    public function __construct(string $table)
    {
        $this->database = app()->get('database');
        $this->table = $table;
    }

    /**
     * @param mixed $value
     * @param string $key
     * @param array<string> $columns
     * @return mixed
     */
    public function find($value, string $key = 'id', array $columns = ['*'])
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
        $items = $this->get();
        return !empty($items) ? array_values($items)[0] : null;
    }

    /**
     * @return array<mixed>
     */
    public function get(): array
    {
        return $this->data->get();
    }

    /**
     * @param array<string> $columns
     * @return self
     */
    public function all(array $columns = ['*']): self
    {
        $this->data = $this->database->table($this->table)
            ->select($columns);

        return $this;
    }

    /**
     * @param string $column
     * @param mixed $value
     * @param string $action
     * @param array<string> $columns
     * @return self
     */
    public function where(string $column, $value, string $action = '=', array $columns = ['*']): self
    {
        $this->data = $this->database
            ->table($this->table)
            ->select($columns)
            ->where($column, $value, $action);

        return $this;
    }

    /**
     * @param string $column
     * @param mixed $value
     * @param string $action
     * @return self
     */
    public function andWhere(string $column, $value, string $action = '='): self
    {
        $this->data = $this->database
            ->andWhere($column, $value, $action);

        return $this;
    }

    /**
     * @param array<string, mixed> $columns
     * @return bool
     */
    public function create(array $columns): bool
    {
        return $this->database->table($this->table)
            ->insert(array_keys($columns), array_values($columns));
    }

    /**
     * @param array<string, mixed> $columns
     * @param mixed $id
     * @return bool
     */
    public function update(array $columns, $id): bool
    {
        return $this->database->table($this->table)
            ->update($columns, $id);
    }

    /**
     * @param mixed $value
     * @param string $key
     * @return bool
     */
    public function delete($value, string $key = 'id'): bool
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