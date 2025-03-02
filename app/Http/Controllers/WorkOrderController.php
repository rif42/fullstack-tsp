<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
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
        return view('work_order.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        WorkOrder::create($request->all());

        return redirect()->route('work_order.index')->with('success', 'Work Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkOrder $workOrder)
    {
        return view('work_order.show', compact('work_order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkOrder $workOrder)
    {
        return view('work_order.edit', compact('work_order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkOrder $workOrder)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $workOrder->update($request->all());

        return redirect()->route('work_order.index')->with('success', 'Work Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkOrder $workOrder)
    {
        $workOrder->delete();
        return redirect()->route('work_order.index')->with('success', 'Work Order deleted successfully.');
    }
}
