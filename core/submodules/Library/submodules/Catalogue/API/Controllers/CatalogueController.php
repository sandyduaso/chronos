<?php

namespace Catalogue\API\Controllers;

use Illuminate\Http\Request;
use Pluma\API\Controllers\APIController;
use Catalogue\Models\Grant;
use Catalogue\Models\Catalogue;

class CatalogueController extends APIController
{
    /**
     * Search the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $onlyTrashed = $request->get('trashedOnly') !== 'null' && $request->get('trashedOnly') ? $request->get('trashedOnly'): false;
        $order = $request->get('descending') === 'true' && $request->get('descending') !== 'null' ? 'DESC' : 'ASC';
        $search = $request->get('q') !== 'null' && $request->get('q') ? $request->get('q'): '';
        $sort = $request->get('sort') && $request->get('sort') !== 'null' ? $request->get('sort') : 'id';
        $take = $request->get('take') && $request->get('take') > 0 ? $request->get('take') : 0;

        $resources = Catalogue::search($search)->orderBy($sort, $order);
        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }
        $resources = $resources->paginate($take);

        return response()->json($resources);
    }

    /**
     * Get all resources.
     *
     * @param  Illuminate\Http\Request $request [description]
     * @return Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $onlyTrashed = $request->get('trashedOnly') !== 'null' && $request->get('trashedOnly') ? $request->get('trashedOnly'): false;
        $order = $request->get('descending') === 'true' && $request->get('descending') !== 'null' ? 'DESC' : 'ASC';
        $search = $request->get('q') !== 'null' && $request->get('q') ? $request->get('q'): '';
        $sort = $request->get('sort') && $request->get('sort') !== 'null' ? $request->get('sort') : 'id';
        $take = $request->get('take') && $request->get('take') > 0 ? $request->get('take') : 0;

        $resources = Catalogue::search($search)->orderBy($sort, $order);
        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }
        $resources = $resources->paginate($take);

        return response()->json($resources);
    }

    /**
     * Get all resources.
     *
     * @param  Illuminate\Http\Request $request [description]
     * @return Illuminate\Http\Response
     */
    public function getTrash(Request $request)
    {
        $search = $request->get('q') !== 'null' && $request->get('q') ? $request->get('q'): '';
        $take = $request->get('take') && $request->get('take') > 0 ? $request->get('take') : 0;
        $sort = $request->get('sort') && $request->get('sort') !== 'null' ? $request->get('sort') : 'id';
        $order = $request->get('descending') === 'true' && $request->get('descending') !== 'null' ? 'DESC' : 'ASC';

        $permissions = Catalogue::search($search)->orderBy($sort, $order)->onlyTrashed()->paginate($take);

        return response()->json($permissions);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $catalogue = Catalogue::findOrFail($id);

        if (in_array($catalogue->code, config('auth.rootcatalogues', []))) {
            $this->errorResponse['text'] = "Deleting Root Catalogues is not permitted";

            return response()->json($this->errorResponse);
        }

        $this->successResponse['text'] = "{$catalogue->name} moved to trash.";
        $catalogue->delete();

        return response()->json($this->successResponse);
    }

    /**
     * Copy the resource as a new resource.
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clone(Request $request, $id)
    {
        $catalogue = Catalogue::findOrFail($id);

        $clone = new Catalogue();
        $clone->name = $catalogue->name;
        $clone->icon = $catalogue->icon;
        $clone->alias = $catalogue->alias;
        $clone->code = "{$catalogue->code}-clone-".rand((int) $id, (int) date('Y'));
        $clone->description = $catalogue->description;
        $clone->save();

        return response()->json($this->successResponse);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $catalogue = Catalogue::onlyTrashed()->findOrFail($id);
        $catalogue->restore();

        return response()->json($this->successResponse);
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $catalogue = Catalogue::withTrashed()->findOrFail($id);
        $catalogue->forceDelete();

        return response()->json($this->successResponse);
    }
}
