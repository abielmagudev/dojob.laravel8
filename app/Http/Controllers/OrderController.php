<?php

namespace App\Http\Controllers;

use App\Http\Controllers\OrderControllerFeatures\ReflashErrorsTrait;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Job;
use App\Models\Order;
class OrderController extends Controller
{
    use ReflashErrorsTrait;

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
        $this->reflashApiExtensionErrors();

        return view('orders.create', [
            'jobs' => Job::withCount('extensions')->orderBy('name')->get(),
            'order' => new Order,
        ]);
    }

    public function store(OrderStoreRequest $request)
    {
        if(! $order = Order::create($request->validated()) )
            return back()->with('danger', 'Order not created, try again...');

        if( $request->has('job_extensions_cache') )
        {
            $result = app(OrderJobExtensionsController::class)->callAction('store', [$request, $order]);
             
            if( $result->has('failed') )
            {
                // Delete all data of extensions success stored for reset
                $result->get('success')->map(function ($item, $key) use ($request, $order) {
                    $extension = $request->job_extensions_cache->get($key);
                    app($extension->controller_class)->callAction('destroy', [$order]);
                });

                $extension_failed_names = $result->get('failed')->map(function ($item, $key) use ($request) {
                    return $request->job_extensions_cache->get($key)->name;
                });

                $failed_names = $extension_failed_names->implode(',');

                $order->delete();

                return back()->withInput($request->all())->with('danger', "Order was not created due to extension errors {$failed_names}, try again...");
            }
        }

        return redirect()->route('orders.index')->with('success', 'Order was created');
    }

    public function show(Order $order)
    {
        return view('orders.show')->with('order', $order);
    }

    public function edit(Order $order)
    {
        $this->reflashApiExtensionErrors();

        return view('orders.edit')->with('order', $order);
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        if( $order->fill( $request->validated() )->save() === false )
            return back()->with('danger', 'Order not updated, try again...');
    
        if( $request->has('job_extensions_cache') )
        {
            $result = app(OrderJobExtensionsController::class)->callAction('update', [$request, $order]);
            
            if( isset($result['failed']) )
            {
                $extension_names = implode(', ', $result['failed']); 
                return back()->with('danger', "Order was updated, except for these extensions {$extension_names}, try again...");
            }
        }

        return redirect()->route('orders.edit', $order)->with('success', 'Order was updated');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
