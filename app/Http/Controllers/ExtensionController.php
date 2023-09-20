<?php

namespace App\Http\Controllers;

use ApiExtensions;
use App\Http\Requests\ExtensionStoreRequest;
use App\Models\ApiExtensions\Kernel\ApiExtensionMigrator;
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

        if( ApiExtensionMigrator::is($extension->model) &&! ApiExtensionMigrator::install($extension->model) )
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

    public function destroy(Extension $extension)
    {        
        if( ApiExtensionMigrator::is($extension->model) && ApiExtensionMigrator::installed( $extension->model::migrations() ) )
        {
            if(! ApiExtensionMigrator::uninstall($extension->model) )
                return back()->with('danger', 'Error uninstalling extension database');
        }
        
        if(! $extension->delete() )
            return back()->with('danger', 'Error to uninstalling the extension');

        return redirect()->route('extensions.index')->with('success', "Extension <b>{$extension->name}</b> uninstalled");
    }
}
