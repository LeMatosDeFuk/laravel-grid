<?php
/**
 * Copyright (c) 2018.
 * @author Antony [leantony] Chacha
 */

namespace Leantony\Grid\Listeners;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Leantony\Grid\GridInterface;
use Leantony\Grid\GridResources;

class SortDataHandler
{
    use GridResources;

    /**
     * SortDataHandler constructor.
     * @param GridInterface $grid
     * @param Request $request
     * @param $builder
     * @param $validTableColumns
     */
    public function __construct(GridInterface $grid, Request $request, $builder, $validTableColumns, $args)
    {
        $this->grid = $grid;
        $this->request = $request;
        $this->query = $builder;
        $this->validGridColumns = $validTableColumns;
        $this->args = $args;
    }

    /**
     * The table name to be sorted
     *
     * @return \Closure
     */
    public function getSortTable()
    {
        $gridName = $this->getGrid()->getName();

        return function () use ($gridName) {
            return Str::plural(Str::slug($gridName, '_'));
        };
    }

    /**
     * Sort a query builder
     *
     * @return void
     */
    public function sort()
    {
        $columns      = $this->getGrid()->getColumns();

        if ($sort = $this->checkAndReturnSortParam()) {
            $column = $columns[$sort];
            // check for custom sort strategies and call them
            if (isset($column['sort']['query']) && is_callable($column['sort']['query'])) {
                call_user_func($column['sort']['query'], $this->getQuery(), $sort, $this->getSortDirection());
            } else {
                $this->getQuery()->orderBy($sort, $this->getSortDirection());
            }
        }
    }

    /**
     * Check and return sort parameter
     *
     * @return string|false
     */
    public function checkAndReturnSortParam()
    {
        if ($this->getRequest()->has($this->getGrid()->getGridSortParam())) {
            $value = $this->request->get($this->getGrid()->getGridSortParam());
            $validGridColumns = $this->getValidGridColumns();

            if ($this->grid->extraGridColumns) {
                foreach ($this->grid->extraGridColumns as $extraColumn) {
                    $validGridColumns[] = $extraColumn;
                }
            }

            if (in_array($value, $validGridColumns)) {
                return $value;
            }
        }

        return false;
    }

    /**
     * Get the sort direction
     *
     * @return string
     */
    public function getSortDirection()
    {
        if ($this->getRequest()->has($this->getGrid()->getGridSortDirParam())) {
            $dir = $this->getRequest()->get($this->getGrid()->getGridSortDirParam());

            if (in_array($dir, $this->getGrid()->getGridSortDirections())) {
                // store the sort direction so that we can use it later to automatically toggle
                // between either sort direction without any special javascript
                session(['__grid.current_sort_direction' => $dir]);
                return $dir;
            }
        }
        // default to the first sort option
        $dir = $this->getGrid()->getGridSortDirections()[0];
        session(['__grid.current_sort_direction' => $dir]);
        return $dir;
    }
}
