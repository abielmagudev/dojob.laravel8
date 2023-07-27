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
            'api_extensions' => $request->has('tags') ? FakeApiExtension::hasTags($request->tags)->get() : FakeApiExtension::all(),
            'extensions' => Extension::all(),
            'tags' => $request->get('tags', ''),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fake_api_extension = FakeApiExtension::find( $request->extension );

        if(! 
            $extension = Extension::create([
                'api_extension_id' => $fake_api_extension->id,
                'name' => $fake_api_extension->name, 
                'classname' => $fake_api_extension->classname, 
                'description' => $fake_api_extension->description, 
            ])
         )
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
        //
    }
}
