<?php

namespace Catalogue\Support\Scopes;

use Catalogue\Models\Catalogue;

trait OfCatalogue
{
    /**
     * Filter the resource where catalogue_id equals $code
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string $code
     * @param  string $column
     * @return $query
     */
    public function scopeOfCatalogue($query, $code = null, $column = "code", $useOr = true)
    {
        if (empty($code)) {
            return $query;
        }

        if ($useOr) {
            $query->orWhere('catalogue_id', Catalogue::where($column, $code)->firstOrCreate([
                $column => $code,
            ], [
                'name' => 'Package',
                'code' => 'package',
                'alias' => 'Archives',
                'icon' => 'archive',
                'description' => 'A Catalogue of eLearning Packages'
            ])->id);
        } else {
            $query->where('catalogue_id', Catalogue::where($column, $code)->firstOrCreate([
                $column => $code,
            ], [
                'name' => 'Package',
                'code' => 'package',
                'alias' => 'Archives',
                'icon' => 'archive',
                'description' => 'A Catalogue of eLearning Packages'
            ])->id);
        }

        return $query;
    }
}
