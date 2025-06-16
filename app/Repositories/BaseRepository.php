<?php

namespace App\Repositories;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class BaseRepository implements BaseRepositoryInterface  {
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function paginate(
        array $column = ['*'],
        array $condition = [],
        int $perpage = 2,
        int $page = 1,
        array $extend = [],
        array $orderBy = ['id', 'DESC'],
        array $join = [],
        array $relations = [],
        array $rawQuery = [],
    ) {
        $query = $this->model->select($column);
        return $query
            ->keyword($condition['keyword'] ?? null, $extend['fieldSearch'])
            ->publish($condition['publish'] ?? null)
            ->customWhere($condition['where'] ?? null)
            ->customWhereIn($condition['whereIn'] ?? null)
            ->customWhereRaw($rawQuery['whereRaw'] ?? null)
            ->relation($relations ?? null)
            ->relationCount($relations ?? null)
            ->customJoin($join ?? null)
            ->extendCustomGroupBy($extend['groupBy'] ?? null)
            ->extendCustomOrderBy($orderBy ?? ['id', 'DESC'])
            ->forPage($page, $perpage)
            ->paginate($perpage)
            ->withQueryString()
            ->withPath(env('APP_URL') . ($extend['path'] ?? ''));
    }

    public function findByCondition(
        $condition, 
        $flag = false, 
        array $joins = [], 
        array $orderBy = [], 
        array $select = ['*'], 
        array $relations = [],
        $paginate = null,
        array $groupBy = [],
        ?int $limit = null
    ) {
        $query = $this->model->newQuery();
    
        $query->select($select);
    
        if (!empty($joins)) {
            foreach ($joins as $join) {
                $type = isset($join['type']) ? strtolower($join['type']) : 'inner';
                $table = $join['table'];
                $onConditions = $join['on'];
    
                $query->join($table, function ($joinQuery) use ($onConditions, $type) {
                    foreach ($onConditions as $index => $condition) {
                        if ($index === 0) {
                            $joinQuery->on($condition[0], '=', $condition[1]);
                        } else {
                            $joinQuery->where($condition[0], '=', $condition[1]);
                        }
                    }
                }, null, null, $type);
            }
        }
    
        foreach ($condition as $val) {
            if ($val[1] == 'IN') {
                $query->whereIn($val[0], $val[2]);
            } else {
                $query->where($val[0], $val[1], $val[2]);
            }
        }
    
        if (!empty($relations)) {
            $query->with($relations);
        }
    
        if (!empty($groupBy)) {
            $query->groupBy($groupBy);
        }
    
        if (!empty($orderBy)) {
            foreach ($orderBy as $column => $direction) {
                $query->orderBy($column, $direction);
            }
        }

        if ($limit !== null) {
            $query->limit($limit); 
        }
    
        if ($paginate) {
            return $query->paginate($paginate);
        }
    
        return ($flag == false) ? $query->first() : $query->get();
    }
    
    public function findById(int $modelId, array $column = ['*'], array $relation = []) {
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }

    public function findByWhereHas(array $condition = [], string $relation = '', string $alias = '') {
        return  $this->model->with('languages')->whereHas($relation, function($query) use ($condition, $alias) {
            foreach ($condition as $val) {
                $query->where($alias.'.'.$val[0], $val[1], $val[2]);
            }
        })->first();
    }

    public function all(array $relation = [], string $selectRaw = '*') {
        $query = $this->model->newQuery();
        $query->selectRaw($selectRaw);
        if (!empty($relation)) {
            $query->with($relation);
        }

        return $query->get();
    }

    public function create($payload = []) {
        $model = $this->model->create($payload);
        return $model->refresh();
    }

    public function createPivot($model, array $payload, string $relation = '') {
        return $this->model->{$relation}()->attach($model->id, $payload);
    }

    public function createBatch(array $payload = []) {
        return $this->model->insert($payload);
    }

    public function updateOrCreatePivot($model, $conditions, $attributes, $relation) {
        $existing = $model->{$relation}()->where($conditions)->first();
        
        if ($existing) {
            $model->{$relation}()->updateExistingPivot($existing->id, $attributes);
            return $existing;
        }
        
        return $model->{$relation}()->attach($model->id, $attributes);
    }

    public function updateOrCreate(array $attributes, array $values = []) {
        return $this->model->updateOrCreate($attributes, $values);
    }

    public function update(int $id = 0, array $payload = []) {
        $model = $this->findById($id);
        return $model->update($payload);
    }

    public function updateByWhere(array $condition = [], array $payload = []) {
        foreach ($condition as $val) {
            if ($val[1] == 'IN') {
                $query = $this->model->whereIn($val[0], $val[2]);
            } else {
                $query = $this->model->where($val[0], $val[1], $val[2]);
            }
        }

        return $query->update($payload);
    }
    
    public function updateAndGetData(int $id = 0, array $payload = []) {
        $model = $this->findById($id);
        $model->fill($payload);
        $model->save();
        return $model;
    }

    public function updateOrInsert(array $condition = [], array $payload = []) {
        return $this->model->updateOrInsert($condition, $payload);
    }

    public function delete(int $id = 0) {
        return $this->findById($id)->delete();
    }

    public function deleteByCondition(array $conditions = [], bool $forceDelete = false) {
        $query = $this->model->newQuery();
        
        foreach ($conditions as $condition) {
            if (count($condition) === 3) {
                $query->where($condition[0], $condition[1], $condition[2]);
            } elseif (count($condition) === 2) {
                $query->where($condition[0], '=', $condition[1]);
            }
        }
        
        return $forceDelete ? $query->forceDelete() : $query->delete();
    }
    
    public function recursveCategory(string $parameter = '', $table = '') {
        $table = $table . '_catalogues';
        $query = "
            WITH RECURSIVE category_tree AS (
                SELECT id, parent_id, deleted_at
                FROM $table
                WHERE id IN (?)
                UNION ALL
                SELECT c.id, c.parent_id, c.deleted_at
                FROM $table as c
                JOIN category_tree as ct ON ct.id = c.parent_id
            )
            SELECT id FROM category_tree WHERE deleted_at IS NULL
        ";
    
        // Thực thi truy vấn
        $result = DB::select($query, [$parameter]);
    
        // Chuyển kết quả thành mảng đơn giản
        $ids = array_map(function ($row) {
            return $row->id;
        }, $result);
    
        return $ids;
    }

    public function recursveCategoryGetParentAChild(string $parameter = '', $table = '') {
        $table = $table . '_catalogues';
    
        $query = "
            WITH RECURSIVE category_tree AS (
                -- Lấy chính các danh mục được truyền vào
                SELECT id, parent_id, deleted_at
                FROM $table
                WHERE id IN (?)
                UNION ALL
                -- Đệ quy để lấy các danh mục con
                SELECT c.id, c.parent_id, c.deleted_at
                FROM $table as c
                JOIN category_tree as ct ON ct.id = c.parent_id
                WHERE c.parent_id != 0
            ),
            parent_tree AS (
                -- Lấy danh mục cha đệ quy
                SELECT id, parent_id, deleted_at
                FROM $table
                WHERE id IN (?)
                UNION ALL
                SELECT c.id, c.parent_id, c.deleted_at
                FROM $table as c
                JOIN parent_tree as pt ON pt.parent_id = c.id
                WHERE c.parent_id != 0
            )
            -- Kết hợp cả cây con và cây cha
            SELECT DISTINCT id
            FROM (
                SELECT * FROM category_tree
                UNION
                SELECT * FROM parent_tree
            ) AS combined_tree
            WHERE deleted_at IS NULL
        ";
    
        $result = DB::select($query, [$parameter, $parameter]);
    
        $ids = array_map(function ($row) {
            return $row->id;
        }, $result);
    
        return $ids;
    }
}