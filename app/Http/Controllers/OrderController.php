<?php

namespace App\Http\Controllers;

use App\Http\Controllers\OrderController\Traits\ExtensionsDataHandler;
use App\Http\Controllers\OrderController\Traits\ReflashErrors;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Job;
use App\Models\Order;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    use ExtensionsDataHandler;
    use ReflashErrors;

    public function index()
    {
        return view('orders.index', [
            'orders' => Order::with('job')->whereJobsAvailable()->orderBy('id', 'desc')->get(),
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
        if(! $order = Order::create( $request->validated() ) )
            return back()->with('danger', 'Order not created, please try again');

        if(! $request->has('job_extensions_cache') )
            return redirect()->route('orders.index')->with('success', "Order <b>#{$order->id} {$order->job->name}</b> created");
           
        $result = $this->storeExtensionData($request->get('job_extensions_cache'), $request, $order);

        if( $result->has('failed') )
        {    
            $this->destroyExtensionData($result->get('success'), $request, $order);
    
            $order->delete();

            $name_extensions_failed = $result->get('failed')->pluck('name')->implode(',');
    
            return back()->withInput($request->all())->with('danger', "Order was not created due to extension errors {$name_extensions_failed}, please try again");
        }

        return redirect()->route('orders.index')->with('success', "Order <b>#{$order->id} {$order->job->name}</b> with extensions created");       
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
            return back()->with('danger', 'Order not updated, plase try again');
    
        if(! $request->has('job_extensions_cache') )
            return redirect()->route('orders.edit', $order)->with('success', "Order <b>#{$order->id} {$order->job->name}</b> updated");

        $result = $this->updateExtensionData($request->get('job_extensions_cache'), $request, $order);

        if( $result->has('failed') )
        {
            $name_extensions_failed = $result->get('failed')->pluck('name')->implode(',');

            return back()->with('danger', "Order <b>#{$order->id} {$order->job->name}</b> was updated, except for these extensions <b>{$name_extensions_failed}</b>, please try again");
        }

        return redirect()->route('orders.edit', $order)->with('success', "Order <b>#{$order->id} {$order->job->name}</b> updated");
    }

    public function destroy(Request $request, Order $order)
    {
        if(! $order->delete() )
            return back()->with('danger', 'Order not deleted, please try again');
        
        if( $order->job->hasExtensions() )
            $this->destroyExtensionData($order->job->extensions, $request, $order);

        return redirect()->route('orders.index')->with('success', "Order <b>#{$order->id} {$order->job->name}</b> deleted");
    }
}
