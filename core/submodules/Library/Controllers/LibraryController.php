<?php

namespace Library\Controllers;

use Catalogue\Models\Catalogue;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Library\Models\Library;
use Library\Requests\LibraryRequest;
use Library\Support\Traits\LibraryResourceApiTrait;

class LibraryController extends AdminController
{
    use LibraryResourceApiTrait,
        Resources\LibraryResourceUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Library::all();
        $count = $resources->count();
        $catalogues = Catalogue::orderBy('name')->get();

        if (! is_null($request->get('catalogue'))) {
            $resources = Library::where('catalogue_id', $request->get('catalogue'))->get();
        }

        return view("Theme::library.index")->with(compact('resources', 'catalogues', 'count'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //

        return view("Theme::library.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::library.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Library\Requests\LibraryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LibraryRequest $request)
    {
        // try {
        //     $files = $request->file('file');
        //     if (is_array($files)) {
        //         foreach ($files as $file) {
        //             $fileName = $file->getClientOriginalName();
        //             $fullFilePath = storage_path(settings('library.storage_path', 'public/library')) . "/$fileName";
        //             if ($file->move($fullFilePath, $fileName)) {
        //                 $library = new Library();
        //                 $library->name = $request->input
        //                 $library->originalname = $file->getClientOriginalName();
        //             }
        //         }
        //     }
        // } catch (Exception $e) {
        //     return response()->json($this->errorResponse);
        // }

        // return response()->json($this->successResponse);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //

        return view("Theme::library.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Library\Requests\LibraryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LibraryRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Library::destroy($request->has('id') ? $request->input('id') : $id);

        return redirect()->route('library.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::library.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Library\Requests\LibraryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(LibraryRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Library\Requests\LibraryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(LibraryRequest $request, $id)
    {


        return redirect()->route('library.trash');
    }
}
