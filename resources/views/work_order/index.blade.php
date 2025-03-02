@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Work Order List</h2>
    <a class="btn btn-primary" href="{{ route('work_orders.create') }}">Create Work Order</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Action</th>
    </tr>
    @foreach ($workOrder as $work_order)
    <tr>
        <td>{{ $work_order->id }}</td>
        <td>{{ $work_order->title }}</td>
        <td>
            <a class="btn btn-info btn-sm" href="{{ route('work_orders.edit', $work_order) }}">Edit</a>
            <form action="{{ route('work_orders.destroy', $work_order) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $workOrder->links() }}
@endsection
