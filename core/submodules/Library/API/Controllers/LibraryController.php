<?php

namespace Library\API\Controllers;

use Catalogue\Models\Catalogue;
use Illuminate\Http\Request;
use Library\Models\Library;
use Library\Requests\LibraryRequest;
use Pluma\API\Controllers\APIController;

class LibraryController extends APIController
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

        $resources = Library::search($search)->orderBy($sort, $order);
        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }
        $resources = $resources->get();

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

        $resources = Library::search($search)->orderBy($sort, $order);
        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }
        $resources = $resources->get();

        return response()->json($resources);
    }

    /**
     * Get the paginated resources.
     *
     * @param  Illuminate\Http\Request $request [description]
     * @return Illuminate\Http\Response
     */
    public function paginated(Request $request)
    {
        $onlyTrashed = $request->get('trashedOnly') !== 'null' && $request->get('trashedOnly') ? $request->get('trashedOnly'): false;
        $order = $request->get('descending') === 'true' && $request->get('descending') !== 'null' ? 'DESC' : 'ASC';
        $search = $request->get('q') !== 'null' && $request->get('q') ? $request->get('q'): '';
        $sort = $request->get('sort') && $request->get('sort') !== 'null' ? $request->get('sort') : 'id';
        $take = $request->get('take') && $request->get('take') > 0 ? $request->get('take') : 0;

        $resources = Library::search($search)->orderBy($sort, $order);
        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        if ($request->input('catalogue_id') && $request->input('catalogue_id') != 'undefined' && $request->input('catalogue_id') != 0) {
            $resources->where('catalogue_id', $request->input('catalogue_id'));
        }

        $resources = $take ? $resources->paginate($take) : $resources->get();

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

        $permissions = Library::search($search)->orderBy($sort, $order)->onlyTrashed()->paginate($take);

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
        $library = Library::findOrFail($id);

        $this->successResponse['text'] = "{$library->name} moved to trash.";
        $library->delete();

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
        $library = Library::onlyTrashed()->findOrFail($id);
        $library->restore();

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
        $library = Library::withTrashed()->findOrFail($id);
        $library->forceDelete();

        return response()->json($this->successResponse);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Library\Requests\LibraryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(LibraryRequest $request)
    {
        try {
            $file = $request->file('file');
            if (is_array($file) && $files = $file) {
                foreach ($files as $file) {
                    $this->save($request, $file);
                }
            } else {
                $library = $this->save($request, $file);
                if ($request->input('return')) {
                    return response()->json($library);
                }
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }


        return response()->json($this->successResponse);
    }

    /**
     * Save the library.
     *
     * @param  File $file
     * @return boolean
     */
    public function save($request, $file)
    {
        $originalName = $file->getClientOriginalName();
        $date = date('Y-m-d');
        $filePath = storage_path(settings('library.storage_path', 'public/library')) . "/$date";

        $name = (bool) $request->input('originalname') ? pathinfo($request->input('originalname'), PATHINFO_FILENAME) : pathinfo($originalName, PATHINFO_FILENAME);

        $fileName = str_slug($name);
        $fileName .= ".".$file->getClientOriginalExtension();

        $fullFilePath = "$filePath/$fileName";

        if ($file->move($filePath, $fileName)) {
            $library = new Library();
            $library->name = $name;
            $library->originalname = $originalName;
            $library->pathname = $fullFilePath;
            $library->mimetype = $file->getClientMimeType();
            $library->thumbnail = settings('library.storage_path', 'public/library') . "/$date/$fileName";
            $library->size = $file->getClientSize();
            $library->url = settings('library.storage_path', 'public/library') . "/$date/$fileName";
            if ((bool) $request->input('catalogue_id')) {
                $library->catalogue()->associate(Catalogue::find($request->input('catalogue_id')));
            }
            $library->save();

            if ($request->input('extract') && Library::isExtractable($library->mimetype)) {
                $output = storage_path(settings('package.storage_path', 'public/package'))."/$date/{$library->id}";
                Library::extract($fullFilePath, $output);
            }

            return $library;
        }
    }

    /**
     * Get all catalogues.
     *
     * @return \Illuminate\Http\Response
     */
    public function catalogues()
    {
        return response()->json(Catalogue::get()->toArray());
    }

    /**
     * Get library entries from given catalogue's ID
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $catalogue_id
     * @return \Illuminate\Http\Response
     */
    public function fromCatalogue(Request $request, $catalogue_id)
    {
        $catalogue = Catalogue::findOrFail($catalogue_id);
        $resources = $catalogue->libraries();

        $onlyTrashed = $request->get('trashedOnly') !== 'null' && $request->get('trashedOnly') ? $request->get('trashedOnly'): false;
        $order = $request->get('descending') === 'true' && $request->get('descending') !== 'null' ? 'DESC' : 'ASC';
        $search = $request->get('q') !== 'null' && $request->get('q') ? $request->get('q'): '';
        $sort = $request->get('sort') && $request->get('sort') !== 'null' ? $request->get('sort') : 'id';
        $take = $request->get('take') && $request->get('take') > 0 ? $request->get('take') : 0;

        $resources = $resources->orderBy($sort, $order);
        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }
        $resources = $take > 0 ? $resources->paginate($take) : $resources->paginate();

        return response()->json($resources);
    }
}
