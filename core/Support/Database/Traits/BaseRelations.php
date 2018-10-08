<?php

namespace Pluma\Support\Database\Traits;

use Pluma\Support\Database\Relations\AdjacentlyRelatedTo;
use Pluma\Support\Database\Relations\BelongsToManyThrough;
use Pluma\Support\Database\Relations\HasManyThroughMany;

trait BaseRelations
{
    /**
     * Gets the Belonging resource through a pivot.
     *
     * @param  Model $related
     * @param  Model $through
     * @param  string $firstKey
     * @param  string $secondKey
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function belongsToManyThrough($related, $through, $firstKey = null, $secondKey = null)
    {
        $through = new $through;
        $related = new $related;

        $firstKey  = $firstKey ?: $this->getForeignKey();
        $secondKey = $secondKey ?: $related->getForeignKey();

        return new BelongsToManyThrough($related->newQuery(), $this, $through, $firstKey, $secondKey);
    }

    /**
     * Retrieve the Belonging resource through many model.
     *
     * @param Model  $related
     * @param Model  $through
     * @param string $firstKey
     * @param string $secondKey
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function hasManyThroughMany($related, $through, $firstKey = null, $secondKey = null)
    {
        $related = new $related;
        $through = new $through;

        $firstKey  = $firstKey ?: $this->getForeignKey();
        $secondKey = $secondKey ?: $related->getForeignKey();

        return new HasManyThroughMany($related->newQuery(), $this, $through, $firstKey, $secondKey);
    }
}
