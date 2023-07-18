<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
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
        ]);
    }

    public function store(StoreOrderRequest $request)
    {
        return $request->validated();
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
