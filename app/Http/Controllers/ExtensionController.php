<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $fakeApiExtension = FakeApiExtension::find( $request->extension );

        if(! $extension = Extension::install( $fakeApiExtension ) )
            return back()->with('danger', 'Error installing the extension, please try again');

        return redirect()->route('extensions.index')->with('success',
            sprintf('Extension %s installed', $extension->name) 
        );
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
        if(! Extension::uninstall($extension) ||! $extension->delete() )
            return back()->with('danger', 'Error to uninstall the extension');

        return redirect()->route('extensions.index')->with('success', "Extension {$extension->name} uninstalled");
    }
}
