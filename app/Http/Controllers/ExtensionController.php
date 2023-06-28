<?php

namespace App\Http\Controllers;

use App\Models\ApiExtension;
use App\Models\Extension;
use Illuminate\Http\Request;

class ExtensionController extends Controller
{
    public function index(Request $request)
    {
        return view('extensions.index', [
            'api_extensions' => ApiExtension::all(),
            'extensions' => Extension::all(),
            'tags' => $request->get('tags', ''),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $api_extension = ApiExtension::find( $request->extension );

        if(! 
            $extension = Extension::create([
                'model_class' => $api_extension->model_class,
                'controller_class' => $api_extension->controller_class,
                'api_extension_id' => $api_extension->id,
            ])
         )
            return back()->with('danger', 'Error installing the extension, please try again');

        return redirect()->route('extensions.index')->with('success',
            sprintf('Extension %s installed', $extension->model_class::getName()) 
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
