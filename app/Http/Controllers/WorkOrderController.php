<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use App\Models\User;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workOrder = WorkOrder::latest()->paginate(5);
        return view('work_order.index', compact('workOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = \App\Models\User::all();
        return view('work_order.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|min:3|max:255',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,progress,completed,canceled',
            'production_deadline' => 'required|date|after:today',
            'responsible_operator' => 'required|exists:users,name',
        ]);

        WorkOrder::create($validated);

        return redirect()->route('work_orders.index')
            ->with('success', 'Work order created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkOrder $workOrder)
    {
        return view('work_order.show', compact('workOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkOrder $workOrder)
    {
        return view('work_order.edit', compact('workOrder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkOrder $workOrder)
    {
        $request->validate([
            'product_name' => 'required',
            'quantity' => 'required|integer',
            'production_deadline' => 'required|date',
            'responsible_operator' => 'required',
        ]);

        $workOrder->update($request->all());

        return redirect()->route('work_orders.index')->with('success', 'Work Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkOrder $workOrder)
    {
        $workOrder->delete();
        return redirect()->route('work_orders.index')->with('success', 'Work Order deleted successfully.');
    }
}
