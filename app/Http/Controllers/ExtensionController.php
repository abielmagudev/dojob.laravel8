<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExtensionStoreRequest;
use App\Models\Extension;
use App\Models\FakeApiExtension;
use Illuminate\Http\Request;

class ExtensionController extends Controller
{
    public function index(Request $request)
    {
        return view('extensions.index', [
            'apiExtensions' => $request->has('tags') ? FakeApiExtension::hasTags($request->tags)->get() : FakeApiExtension::all(),
            'extensions' => Extension::all(),
            'tags' => $request->get('tags', ''),
        ]);
    }

    public function store(ExtensionStoreRequest $request)
    {
        if(! $extension = Extension::create( $request->validated() ) )
        {
            return back()->with('danger', 'Error saving the extension, please try again');
        }

        if(! $extension->model::install() )
        {
            $extension->delete();
            return back()->with('danger', 'Error installing the extension, please try again');
        }

        return redirect()->route('extensions.index')->with('success', "Extension <b>{$extension->name}</b> installed");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Extension $extension)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Extension $extension)
    {        
        if(! $extension->model::uninstall() ||! $extension->delete() )
            return back()->with('danger', 'Error to uninstall the extension');

        return redirect()->route('extensions.index')->with('success', "Extension <b>{$extension->name}</b> uninstalled");
    }
}
