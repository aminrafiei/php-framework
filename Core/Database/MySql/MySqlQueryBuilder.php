<?php

declare(strict_types=1);

namespace Core\Database\MySql;

use Core\Database\QueryBuilder;
use PDO;

require_once 'MySqlQuery.php';

class MySqlQueryBuilder implements QueryBuilder
{
    /**
     * @var array<string>
     */
    protected array $attributes = ['pdo', 'table', 'query', 'queryPre'];

    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var string
     */
    private string $table = '';

    /**
     * @var string
     */
    private string $query = '';

    /**
     * @var \PDOStatement|false
     */
    private $queryPre;

    /**
     * @var array<mixed>
     */
    private array $bindings = [];

    /**
     * QueryBuilder constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param string $table
     * @return static
     */
    public function table($table): self
    {
        $this->table = $table;
        // Reset query and bindings when a new table is selected
        $this->query = '';
        $this->bindings = [];

        return $this;
    }

    /**
     * @param array<string> $attributes
     * @return static
     */
    public function select(array $attributes = ['*']): self
    {
        $column = implode(", ", $attributes);

        $this->query = "SELECT " . $column . " FROM " . $this->table;

        return $this;
    }

    /**
     * @param string $column
     * @param mixed $value
     * @param string $action
     * @return static
     */
    public function where($column, $value, $action = '='): self
    {
        $this->query .= " WHERE " . $column . " " . $action . " ?";
        $this->bindings[] = $value;

        return $this;
    }

    /**
     * @param string $column
     * @param mixed $value
     * @param string $action
     * @return static
     */
    public function andWhere($column, $value, $action = '='): self
    {
        $this->query .= " AND " . $column . " " . $action . " ?";
        $this->bindings[] = $value;

        return $this;
    }

    /**
     * @param array<string> $columns
     * @param array<mixed> $values
     * @return bool
     */
    public function insert(array $columns, array $values): bool
    {
        $joinColumns = implode(', ', $columns);
        $valuePlaceholders = implode(', ', array_fill(0, count($values), '?'));

        $this->query = "INSERT INTO " . $this->table . " ($joinColumns) VALUES ($valuePlaceholders)";
        $this->bindings = $values;

        return $this->set();
    }

    /**
     * @param array<string, mixed> $columns
     * @param mixed $value
     * @param string $key
     * @return bool
     */
    public function update(array $columns, $value, $key = 'id'): bool
    {
        $setClauses = [];
        $updateBindings = [];

        foreach ($columns as $k => $v) {
            $setClauses[] = "$k = ?";
            $updateBindings[] = $v;
        }

        $joinClauses = implode(', ', $setClauses);

        $this->query = "UPDATE " . $this->table . " SET " . $joinClauses . " WHERE " . $key . " = ?";
        
        $updateBindings[] = $value;
        $this->bindings = $updateBindings;

        return $this->set();
    }

    /**
     * @param mixed $value
     * @param string $key
     * @return bool
     */
    public function delete($value, $key): bool
    {
        $this->query = "DELETE FROM " . $this->table . " WHERE " . $key . " = ?";
        $this->bindings = [$value];

        return $this->set();
    }

    /**
     * @param array<mixed> $data
     * @return bool
     */
    public function set($data = []): bool
    {
        if (!empty($data)) {
            $this->bindings = array_merge($this->bindings, $data);
        }

        $this->queryPre = $this->pdo->prepare($this->query);
        
        return $this->queryPre->execute($this->bindings);
    }

    /**
     * @return array<mixed>
     */
    public function get(): array
    {
        $this->set();
        return $this->queryPre->fetchAll(PDO::FETCH_CLASS) ?: [];
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return in_array($name, $this->attributes) ? $this->$name : 'attribute not found!';
    }
}