<?php

namespace Robert\Db;

use Aigletter\Contracts\Builder\QueryBuilderInterface;
use Aigletter\Contracts\Builder\QueryInterface;

class Query implements QueryInterface
{
    protected $builder;

    /**
     * @param QueryBuilder $builder
     */
    public function __construct(QueryBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    public function toSql(): string
    {
        return $this;
    }

    public function __toString()
    {
        foreach ($this->builder->getConditions() as $key => $condition) {
            $where = $this->builder->getConditions() === [] ? '' : ' WHERE ' . $key . '=' . '"' . $condition . '"';
        }

        if ($this->builder->getOrder()) {
            $orderBy = ' ORDER BY ' . key($this->builder->getOrder()) . ' ' . current($this->builder->getOrder());
        }

        if ($this->builder->getLimit()) {
            $limit = ' LIMIT ' . $this->builder->getLimit();
        }

        $select = 'SELECT ' . implode(', ', $this->builder->getColums());
        $table = ' FROM ' . $this->builder->getTable();

        return $select . $table . $where . $orderBy . $limit;
    }

    public function build()
    {

    }

}