<?php

namespace Pluma\Support\Database\Adjacency;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;

class AdjacentlyRelatedTo extends Relation
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The intermediate table for the relation.
     *
     * @var string
     */
    protected $table;

    /**
     * The intermediate adjacent table for the relation.
     *
     * @var string
     */
    protected $adjacent;

    /**
     * The ancestor key for the relation.
     *
     * @var string
     */
    protected $ancestorKey;

    /**
     * The descendant key for the relation.
     *
     * @var string
     */
    protected $descendantKey;

    /**
     * The depth key for the relation.
     *
     * @var string
     */
    protected $depthKey = 'depth';

    /**
     * Create a new belongs to relationship instance.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Database\Eloquent\Model    $parent
     * @param  string  $table
     * @param  string  $ancestorKey
     * @param  string  $descendantKey
     * @return void
     */
    public function __construct(Builder $query, Model $parent, $table, $ancestorKey, $descendantKey)
    {
        $this->model = $query->getModel();
        $this->table = $table;
        $this->ancestorKey = $ancestorKey;
        $this->descendantKey = $descendantKey;
        $this->adjacent = $this->qualifyAdjacentModel($table);

        parent::__construct($query, $parent);
    }

    /**
     * Instantiate a new model instance from string.
     *
     * @param string $table
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function qualifyAdjacentModel($table) : Eloquent
    {
        $model = (new $this->model)
            ->setTable($table)
            ->fillable([
                $this->model->getAncestorKey(),
                $this->model->getDescendantKey(),
                $this->model->getDepthKey(),
            ]);

        return $model;
    }

    /**
     * Set the base constraints on the relation query.
     *
     * @return void
     */
    public function addConstraints() {}

    /**
     * Set the join clause for the relation query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder|null  $query
     * @return $this
     */
    public function performAncestorJoin($query = null)
    {
        $query = $query ?: $this->query;

        $key = $this->model->getQualifiedKeyName();

        $query
            ->join(
                $this->table, $key, '=', $this->getQualifiedAncestorKeyName()
            )
            ->where(
                $this->getQualifiedDescendantKeyName(),
                $this->model->{$this->model->getKeyName()}
            );

        return $this;
    }

    /**
     * Set the join clause for the relation query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder|null  $query
     * @return $this
     */
    public function performDescendantJoin($query = null)
    {
        $query = $query ?: $this->query;

        $key = $this->model->getQualifiedKeyName();

        $query
            ->join(
                $this->table, $key, '=', $this->getQualifiedDescendantKeyName()
            )
            ->where(
                $this->getQualifiedAncestorKeyName(),
                $this->model->{$this->model->getKeyName()}
            );

        return $this;
    }

    /**
     * Set the constraints for an eager load of the relation.
     *
     * @param  array  $models
     * @return void
     */
    public function addEagerConstraints(array $models) {}

    /**
     * Initialize the relation on a set of models.
     *
     * @param  array   $models
     * @param  string  $relation
     * @return array
     */
    public function initRelation(array $models, $relation) {}

    /**
     * Match the eagerly loaded results to their parents.
     *
     * @param  array   $models
     * @param  \Illuminate\Database\Eloquent\Collection  $results
     * @param  string  $relation
     * @return array
     */
    public function match(array $models, Collection $results, $relation) {}

    /**
     * Get the results of the relationship.
     *
     * @return mixed
     */
    public function getResults() {}

    /**
     * Get the fully qualified "ancestor key" for the relation.
     *
     * @return string
     */
    public function getQualifiedAncestorKeyName()
    {
        return $this->table.'.'.$this->ancestorKey;
    }

    /**
     * Get the fully qualified "descendant key" for the relation.
     *
     * @return string
     */
    public function getQualifiedDescendantKeyName()
    {
        return $this->table.'.'.$this->descendantKey;
    }

    /**
     * Get the fully qualified "descendant key" for the relation.
     *
     * @return string
     */
    public function getQualifiedDepthKeyName()
    {
        return $this->table.'.'.$this->depthKey;
    }

    /**
     * Retrieves the child nodes of the given resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function descendants()
    {
        $this->performDescendantJoin();

        return $this->get();
    }

    /**
     * Retrieves the immediate children of the given resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function children()
    {
        $this->performDescendantJoin();

        return $this->where($this->getQualifiedDepthKeyName(), 1)->get();
    }

    /**
     * Retrieves the parent nodes of the given resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function ancestors()
    {
        $this->performAncestorJoin();

        return $this->get();
    }

    /**
     * Retrieve the immediate parent of the given resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function parent()
    {
        $this->performAncestorJoin();

        return $this->where($this->getQualifiedDepthKeyName(), 1)->first();
    }

    /**
     * Retrieves the siblings of the given resource.
     *
     * @return mixed
     */
    public function siblings()
    {
        $query = $this->query;
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
            ->join(DB::raw("$table AS s"), 's.'.$ancestorKeyName, '=', 'a.'.$ancestorKeyName, '')
            ->join(DB::raw("$modelTable AS m"), 'm.'.$modelKeyName, '=', 's.'.$descendantKeyName, '')
            ->where('a.'.$descendantKeyName, $modelKey)
            ->where('s.'.$depthKey, $depth)
            ->where('m.'.$modelKeyName, '<>', $modelKey);

        return $this;
    }

    /**
     * Retrieve the next item on the collection.
     *
     * @return mixed
     */
    public function next()
    {
        $query = $this->query;
        $key = $this->model->getKey();
        $keyName = $this->model->getKeyName();

        $sortKey = $this->model->getSortKey();
        $sort = $this->model->{$sortKey};

        return $query->where($sortKey, '>', $sort);
    }

    /**
     * Retrieve the next item on the collection.
     *
     * @return mixed
     */
    public function previous()
    {
        $query = $this->query;
        $key = $this->model->getKey();
        $keyName = $this->model->getKeyName();

        $sortKey = $this->model->getSortKey();
        $sort = $this->model->{$sortKey};

        return $query
            ->where($sortKey, '<', $sort);
    }

    /**
     * Attach a model to the parent.
     *
     * @return mixed
     */
    public function addAsRoot()
    {
        $query = $this->buildInsertFromSelectNodeQuery(
            $this->model->getKey(),
            $this->model->getKey()
        );

        DB::insert($query);

        return $this;
    }

    /**
     * Add immediate child for the model.
     *
     * @param \Illuminate\Database\Eloquent\Model $child
     * @return  self
     */
    public function attach(Model $child)
    {
        $ancestorId = $this->model->getKey();
        $descendantId = $child->getKey();
        $query = $this->buildInsertFromSelectNodeQuery($ancestorId, $descendantId);

        DB::insert($query);

        return $this;
    }

    /**
     * Move a node to a given immediate ancestor (parent).
     *
     * @param int $parentId
     * @return self
     */
    public function move($parentId)
    {
        $key = $this->model->getKey();

        $this->deleteNodeAndAllDescendants($key);

        $query = $this->buildInsertFromSelectNodeQuery($parentId, $key);

        DB::insert($query);
    }

    /**
     * Detach models from the relationship.
     *
     * @return int
     */
    public function detach()
    {
        $key = $this->model->getKey();

        return $this->deleteNodeAndAllDescendants($key);
    }

    /**
     * Delete the node and all descendants.
     *
     * @param int $key
     * @return void
     */
    protected function deleteNodeAndAllDescendants($key)
    {
        $table = $this->model->getAdjacentTable();
        $ancestorKey = $this->model->getAncestorKey();
        $descendantKey = $this->model->getDescendantKey();

        $query = $this->buildDeleteFromJoinNodeQuery($key);
        DB::delete($query);

        return $this;
    }

    /**
     * Build Insert From Select query.
     *
     * @param int $ancestorId
     * @param int $descendantId
     * @return string
     */
    protected function buildInsertFromSelectNodeQuery($ancestorId = null, $descendantId = null) : String
    {
        $table = $this->model->getAdjacentTable();
        $ancestorKey = $this->model->getAncestorKey();
        $descendantKey = $this->model->getDescendantKey();
        $ancestorId = $ancestorId ?? $this->model->getKey();
        $descendantId = $descendantId ?? $this->model->getKey();
        $depth = $this->model->getDepthKey();

        return "
            INSERT INTO {$table} ({$ancestorKey}, {$descendantKey}, {$depth})
            SELECT t.{$ancestorKey}, {$descendantId}, t.{$depth}+t.{$depth}+1
            FROM {$table} AS t
            WHERE t.{$descendantKey} = {$ancestorId}
            UNION ALL
            SELECT {$descendantId}, {$descendantId}, 0
        ";
    }

    /**
     * Build the delete query of the adjacent table.
     *
     * @param int $key
     * @return string
     */
    protected function buildDeleteFromJoinNodeQuery($key) : String
    {
        $table = $this->model->getAdjacentTable();
        $ancestorKey = $this->model->getAncestorKey();
        $descendantKey = $this->model->getDescendantKey();

        return "
            DELETE FROM {$table}
            WHERE {$descendantKey} IN (
                SELECT {$descendantKey}
                FROM {$table}
                WHERE {$ancestorKey} = {$key}
            )
        ";
    }
}
