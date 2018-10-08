<?php

namespace Library\Controllers;

use Catalogue\Models\Catalogue;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Library\Models\Library;
use Library\Requests\LibraryRequest;

class LibraryManyController extends AdminController
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        foreach ($request->input('library') as $id) {
            $library = Library::findOrFail($id);
            $library->delete();
        }

        return back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        foreach ($request->input('library') as $id) {
            $library = Library::onlyTrashed()->findOrFail($id);
            $library->restore();
        }

        return back();
    }
}
