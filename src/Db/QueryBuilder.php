<?php

namespace Robert\Db;

use Aigletter\Contracts\Builder\BuilderInterface;
use Aigletter\Contracts\Builder\QueryBuilderInterface;
use Aigletter\Contracts\Builder\QueryInterface;

class QueryBuilder implements QueryBuilderInterface
{
    protected $colums;

    protected $conditions;

    protected $table;

    protected $limit;

    protected $offset;

    protected $order;

    public function select($columns): BuilderInterface
    {
        foreach ($columns as $column) {
            $this->colums[] = $column;
        }

        return $this;
    }

    public function where($conditions): BuilderInterface
    {
        foreach ($conditions as $key => $condition) {
            $this->conditions[$key] = $condition;
        }

        return $this;
    }

    public function table($table): BuilderInterface
    {
        $this->table = $table;
        return $this;
    }

    public function limit($limit): BuilderInterface
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset($offset): BuilderInterface
    {
        $this->offset = $offset;
        return $this;
    }

    public function order($order): BuilderInterface
    {
        foreach ($order as $key => $value) {
            $this->order[$key] = $value;
        }

        return $this;
    }

    public function getColums()
    {
        return $this->colums;
    }

    public function getConditions()
    {
        return $this->conditions;
    }

    public function getTable()
    {
        return $this->table;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function build(): QueryInterface
    {
        return new Query($this);
    }

}