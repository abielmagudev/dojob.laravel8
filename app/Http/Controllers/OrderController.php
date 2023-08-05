<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Job;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index', [
            'orders' => Order::with('job')->orderBy('id', 'desc')->get(),
        ]);
    }

    /**
     * 1) Keeps the previous values for the views of the extensions 
     * of the selected job, when the save failed the validation
     * 
     * 2) Return the view create with available jobs
     */
    public function create()
    {
        if( session()->has('errors') )
            session()->reflash();

        return view('orders.create', [
            'jobs' => Job::withCount('extensions')->orderBy('name')->get(),
            'order' => new Order,
        ]);
    }

    public function store(OrderStoreRequest $request)
    {
        if(! $order = Order::create($request->validated()) )
            return back()->with('danger', 'Could not save order, try again');

        if( $request->has('job_extensions_cache') )
        {
            $failed_extension = $this->saveForExtensions($request, $order);

            if( is_object($failed_extension) )
            {
                $order->delete();
                return back()->with('danger', "Could not save order by extension {$failed_extension->name}, try again please...");
            }
        }

        return redirect()->route('orders.index')->with('success', 'Order saved');
    }

    /**
     * 1. Get job cached extensions from form request  
     * 2. Prepare the data for each model class of the extension to save
     * 3. Try to save the data with the job model class
     * 4. If you save the data in the extension model, it caches the extension
     * 5. In case the saving of the data in the extension model fails, 
     *    enter a loop to eliminate the extensions that did save data.
     * 6. Cache the extension that failed to save the data to return and 
     *    break the loop to avoid saving the data in the following models of 
     *    the extensions
     * 7. Return the cached extension object that failed or return a boolean 
     *    value of true for successful validation
     */
    private function storeForExtensions(Request $request, Order $order)
    {
        $successed_saved = collect([]);
        
        foreach($request->job_extensions_cache as $extension)
        {
            $prepared = $extension->model_class::prepare($request->validated(), $order);
            
            if(! $extension->model_class::create($prepared) )
            {
                $successed_saved->each(function ($extension) use ($order) {
                    $extension->model_class::where('order_id', $order->id)->delete();
                });

                $failed_extension = $extension;
                break;
            }
            
            $successed_saved->push($extension);
        }

        return isset($failed_extension) ? $failed_extension : true;
    }

    public function show(Order $order)
    {
        return view('orders.show')->with('order', $order);
    }

    public function edit(Order $order)
    {
        return view('orders.edit')->with('order', $order);
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        if(! $order->fill( $request->validated() )->save() )
            return back()->with('danger', 'Order cant be updated, try again please...');

        if( $request->has('job_extensions_cache') )
        {
            $updated = $this->updateForExtensions($request, $order);

            if( $updated->failed->isNotEmpty() )
                return back()->with('danger', "Could not update order complete by first extension fail {$updated->failed->first()->name}, try again please...");
        }
    
        return redirect()->route('orders.edit', $order)->with('success', 'Order updated');
    }

    private function updateForExtensions(Request $request, Order $order)
    {
        $updated = (object) [
            'successed' => collect([]),
            'failed' => collect([])
        ];
        
        foreach($request->job_extensions_cache as $extension)
        {
            $prepared = $extension->model_class::prepare($request->validated(), $order);
            
            if(! $extension->model_class::where('order_id', $order->id)->update($prepared) )
            {
                $updated->failed->push($extension);
                continue;
            }
            
            $updated->successed->push($extension);
        }

        return $updated;
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
