<?php

declare(strict_types=1);

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
     * @param string $table
     * @return static
     */
    public function table(string $table): self;

    /**
     * @param array<string> $attributes
     * @return static
     */
    public function select(array $attributes = ['*']): self;

    /**
     * @param string $column
     * @param mixed $value
     * @param string $action
     * @return static
     */
    public function where(string $column, $value, string $action = '='): self;

    /**
     * @param string $column
     * @param mixed $value
     * @param string $action
     * @return static
     */
    public function andWhere(string $column, $value, string $action = '='): self;

    /**
     * @param array<string> $columns
     * @param array<mixed> $values
     * @return bool
     */
    public function insert(array $columns, array $values): bool;

    /**
     * @param array<string, mixed> $columns
     * @param mixed $value
     * @param string $key
     * @return bool
     */
    public function update(array $columns, $value, string $key = 'id'): bool;

    /**
     * @param mixed $value
     * @param string $key
     * @return bool
     */
    public function delete($value, string $key): bool;

    /**
     * @param array<mixed> $data
     * @return bool
     */
    public function set(array $data = []): bool;

    /**
     * @return array<mixed>
     */
    public function get(): array;
}