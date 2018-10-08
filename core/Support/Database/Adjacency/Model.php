<?php

namespace Pluma\Support\Database\Adjacency;

use Illuminate\Database\Eloquent\Builder;
use Pluma\Models\Model as BaseModel;
use Pluma\Support\Database\Adjacency\AdjacentlyRelatedTo;
use Pluma\Support\Database\Adjacency\Contracts\AdjacencyRelationModelInterface;
use Pluma\Support\Database\Adjacency\Relations\AdjacentlyRelatedToSelf;

class Model extends BaseModel implements AdjacencyRelationModelInterface
{
    use AdjacentlyRelatedToSelf;

    /**
     * The table adjacently associated with the model.
     *
     * @var string
     */
    protected $adjacentTable;

    /**
     * Retrieve the adjacent relation of the resource.
     * Uses the Closure Table Heirarchy Model.
     *
     * @param string $table
     * @param string $firstKey
     * @param string $secondKey
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function adjacentlyRelatedTo($table = null, $firstKey = null, $secondKey = null)
    {
        $table = $table ?: $this->getAdjacentTable();
        $firstKey = $firstKey ?: $this->getAncestorKey();
        $secondKey = $secondKey ?: $this->getDescendantKey();

        return new AdjacentlyRelatedTo($this->newQuery(), $this, $table, $firstKey, $secondKey);
    }

    /**
     * Get the default adjacent table name for the model.
     *
     * @return string
     */
    public function getAdjacentTable()
    {
        return $this->adjacentTable ?? $this->getTable().'tree';
    }

    /**
     * Get the default ancestor key name for the model.
     *
     * @return string
     */
    public function getAncestorKey()
    {
        return $this->ancestorKey ?? 'ancestor_id';
    }

    /**
     * Get the default descendant key name for the model.
     *
     * @return string
     */
    public function getDescendantKey()
    {
        return $this->descendantKey ?? 'descendant_id';
    }

    /**
     * Get the default descendant key name for the model.
     *
     * @return string
     */
    public function getDepthKey()
    {
        return $this->depthKey ?? 'depth';
    }

    /**
     * Get the default sort key name for the model.
     *
     * @return string
     */
    public function getSortKey()
    {
        return $this->sortKey ?? 'sort';
    }

    /**
     * Query only root resources.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @return void
     */
    public function scopeTree(Builder $builder)
    {
        $keyName = $this->getQualifiedKeyName();
        $table = $this->getAdjacentTable();
        $descendantKey = $table.'.'.$this->getDescendantKey();
        $ancestorKey = $table.'.'.$this->getAncestorKey();
        $depthKey = $table.'.'.$this->getDepthKey();

        $builder
            ->join($table, function ($query) use ($keyName, $ancestorKey, $descendantKey, $depthKey) {
                $query
                    ->on($keyName, '=', $ancestorKey)
                    ->whereNotIn($ancestorKey, function ($query) use ($descendantKey, $depthKey) {
                        $query
                            ->select($descendantKey)
                            ->from($this->getAdjacentTable())
                            ->where($depthKey, '>', 0);
                    });
            })
            ->groupBy($ancestorKey);
    }

    /**
     * Retrieves the siblings of the given root node.
     *
     * @return void
     */
    public function scopeRoots()
    {
        $query = $this->query->newQuery();
        $table = $this->table;
        $modelTable = $this->model->getTable();
        $modelKeyName = $this->model->getKeyName();
        $modelKey = $this->model->getKey();
        $ancestorKeyName = $this->model->getAncestorKey();
        $descendantKeyName = $this->model->getDescendantKey();
        $depthKey = $this->model->getDepthKey();
        $depth = $this->model->{$depthKey};

        $query
            ->select(DB::raw('m.*'))
            ->from(DB::raw("$table AS a"))
            ->join(DB::raw("$modelTable AS m"), 'm.'.$modelKeyName, '=', 'a.'.$descendantKeyName, '')
            ->where('a.'.$descendantKeyName, $modelKey)
            ->groupBy('a.'.$descendantKeyName)
            ->having('a.'.$descendantKeyName, '=', 1)->toSql();
    }
}
