<?php

namespace Pluma\Support\Cache\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait CachedScope
{
    /**
     * Remember the cache in given minuteds.
     *
     * @var integer
     */
    protected $rememberCacheMinutes = 1;

    /**
     * Search all given searchable columns.
     *
     * @param  Illuminate\Database\Eloquent\Builder $builder
     * @param  string $key
     * @return Illuminate\Database\Eloquent\Model
     */
    public function scopeCached(Builder $query, $key = null)
    {
        if ($key === 'refresh') {
            cache()->forget($this->getCachedKey());
            $key = null;
        }

        return cache()->remember($this->getCachedKey(), $this->rememberCacheMinutes, function () use ($query) {
            return $query->get();
        });
    }

    /**
     * Gets the cache key.
     *
     * @return string
     */
    protected function getCachedKey()
    {
        if (! isset($this->cacheKey)) {
            $this->cacheKey = "cached::".$this->getTable();
        }

        return $this->cacheKey;
    }
}
