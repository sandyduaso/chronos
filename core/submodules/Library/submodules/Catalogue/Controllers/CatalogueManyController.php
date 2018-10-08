<?php

namespace Catalogue\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Catalogue\Models\Catalogue;

class CatalogueManyController extends AdminController
{
    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        foreach ($request->input('catalogues') as $id) {
            $catalogue = Catalogue::onlyTrashed()->findOrFail($id);
            $catalogue->restore();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        foreach ($request->input('catalogues') as $id) {
            $catalogue = Catalogue::findOrFail($id);
            $catalogue->delete();
        }

        return redirect()->route('catalogues.index');
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        foreach ($request->input('catalogues') as $id) {
            $catalogue = Catalogue::withTrashed()->findOrFail($id);
            $catalogue->forceDelete();
        }

        return back();
    }
}
