<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Job;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index', [
            'orders' => Order::with('job')->get(),
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
            if(! $this->storeForExtensions($request, $order) )
            {
                $order->delete();
                return back()->with('danger', 'Could not save order by some extension, try again');
            }
        }

        return redirect()->route('orders.index')->with('success', 'Order saved');
    }

    private function storeForExtensions(Request $request, Order $order)
    {
        $failed_save = collect([]);

        foreach($request->job_extensions_cache as $extension)
        {
            $prepared = $extension->model_class::prepare($request->validated(), $order);
            
            if(! $extension->model_class::create($prepared) )
                $failed_save->push($extension);
        }

        if( $failed_save->isNotEmpty() )
        {
            $failed_save->each(function ($extension) use ($order) {
                $extension->model_class::where('order_id', $order->id)->delete();
            });
    
            return false;
        }

        return true;
    }

    public function show(Order $order)
    {
        return view('orders.show')->with('order', $order);
    }

    public function edit(Order $order)
    {
        return view('orders.edit')->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
