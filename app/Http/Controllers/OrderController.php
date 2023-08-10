<?php

namespace App\Http\Controllers;

use App\Http\Controllers\OrderControllerFeatures\ReflashErrorsTrait;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Job;
use App\Models\Order;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    use ReflashErrorsTrait;

    public function index()
    {
        return view('orders.index', [
            'orders' => Order::with('job')->orderBy('id', 'desc')->get(),
        ]);
    }

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
            $result = app(OrderJobExtensionsController::class)->callAction('store', [
                $request, 
                $order, 
                $request->get('job_extensions_cache')
            ]);
                         
            if( $result->has('failed') )
            {
                app(OrderJobExtensionsController::class)->callAction('destroy', [
                    $request, 
                    $order, 
                    $result->get('success')
                ]);

                $order->delete();

                $extension_failed_names = $result->get('failed')->map(function ($extension) {
                    return $extension->name;
                })->implode(',');

                return back()->withInput($request->all())->with('danger', "Order was not created due to extension errors {$extension_failed_names}, try again...");
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
            $result = app(OrderJobExtensionsController::class)->callAction('update', [$request, $order, $request->get('job_extensions_cache')]);
            
            if( $result->has('failed') )
            {
                $extension_failed_names = $result->get('failed')->map(function ($extension) {
                    return $extension->name;
                })->implode(',');
            
                return back()->with('danger', "Order was updated, except for these extensions {$extension_failed_names}, try again...");
            }
        }

        return redirect()->route('orders.edit', $order)->with('success', 'Order was updated');
    }

    public function destroy(Request $request, Order $order)
    {
        if(! $order->delete() )
            return back()->with('danger', 'Order not deleted, try again...');
        
        if( $order->job->hasExtensions() )
        {            
            app(OrderJobExtensionsController::class)->callAction('destroy', [
                $request, 
                $order, 
                $order->job->extensions
            ]);
        }

        return redirect()->route('orders.index')->with('success', "Order #{$order->id} - {$order->job->name} was deleted");
    }
}
