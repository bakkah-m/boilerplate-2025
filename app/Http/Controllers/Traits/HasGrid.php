<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HasGrid
{
    /**
     * The model class that the grid will use.
     *
     * Example: protected $model = User::class;
     */
    protected string $model;

    /**
     * Default grid columns allowed for sorting/filtering.
     */
    protected array $gridColumns = [];

    /**
     * Base grid handler (JSON API for your data grid)
     */
    public function grid(Request $request)
    {
        /** @var Builder $query */
        $query = $this->model::query();

        // Apply filtering
        $this->applyFilters($query, $request);

        // Apply sorting
        $this->applySorting($query, $request);

        // Paginate results
        $perPage = $request->integer('per_page', 10);
        $data = $query->paginate($perPage);

        return response()->json($data);
    }

    protected function applyFilters(Builder $query, Request $request): void
    {
        if ($filters = $request->get('filter')) {
            foreach ($filters as $field => $value) {
                if ($this->isFilterable($field) && $value !== '') {
                    $query->where($field, 'like', "%{$value}%");
                }
            }
        }
    }

    protected function applySorting(Builder $query, Request $request): void
    {
        $sort = $request->get('sort', 'id');
        $dir  = $request->get('dir', 'asc');

        if ($this->isSortable($sort)) {
            $query->orderBy($sort, $dir);
        }
    }

    protected function isFilterable(string $field): bool
    {
        return empty($this->gridColumns) || in_array($field, $this->gridColumns);
    }

    protected function isSortable(string $field): bool
    {
        return $this->isFilterable($field);
    }
}
