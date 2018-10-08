<?php

namespace Catalogue\Models;

use Catalogue\Support\Traits\HasManyLibraries;
use Catalogue\Support\Traits\MorphToCatalogable;
use Category\Models\Category;
use Frontier\Support\Traits\TypeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Library\Models\Library;

class Catalogue extends Category
{
    use SoftDeletes, MorphToCatalogable, HasManyLibraries, TypeTrait;

    protected $with = ['libraries'];

    protected $fillable = ['name', 'code', 'alias', 'description', 'icon'];

    protected $searchables = ['name', 'code', 'alias', 'description', 'icon', 'created_at', 'updated_at'];

    public static function mediabox($items = [])
    {
        $array[] = [
            'count' => Library::count(),
            'name' => 'All',
            'icon' => 'perm_media',
            'url' => route('api.library.all')
        ];

        foreach (self::all() as $i => $catalogue) {
            $array[$i+1]['id'] = $catalogue->id;
            $array[$i+1]['count'] = $catalogue->libraries->count();
            $array[$i+1]['name'] = $catalogue->name;
            $array[$i+1]['url'] = route('api.library.catalogue', [$catalogue->id]);
            $array[$i+1]['icon'] = $catalogue->icon;
            $array[$i+1]['model'] = $i == 0 ? true : false;
        }

        $array = array_merge($array, $items);

        return $array;
    }

    /**
     * Lists of catalogues.
     *
     * @param array $params
     * @return array
     */
    public static function catalogued($params = [])
    {
        $array[] = [
            'count' => Library::count(),
            'name' => __('All Media'),
            'icon' => 'perm_media',
            'url' => route('api.library.all'),
            'model' => true,
        ];

        foreach (self::orderBy('name')->get() as $i => $catalogue) {
            $array[$i+1]['id'] = $catalogue->id;
            $array[$i+1]['name'] = $catalogue->name;
            $array[$i+1]['count'] = $catalogue->libraries->count();
            $array[$i+1]['icon'] = $catalogue->icon;
            $array[$i+1]['model'] = false;
            $array[$i+1]['url'] = route(
                'api.library.all',
                array_merge($params, ['catalogue_id' => $catalogue->id])
            );
        }

        return $array;
    }

    /**
     * Setup catalogues.
     *
     * @param array $catalogues
     */
    public static function setCatalogues($catalogues, $category)
    {
        $c = [];
        foreach ($catalogues as $i => $catalogue) {
            $array[$i+1]['id'] = $catalogue->id;
            $array[$i+1]['name'] = $catalogue->name;
            $array[$i+1]['count'] = $catalogue->libraries->count();
            $array[$i+1]['icon'] = $catalogue->icon;
            $array[$i+1]['model'] = false;
            $array[$i+1]['url'] = route('api.library.catalogue', $category);
        }
    }
}
