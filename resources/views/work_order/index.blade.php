@extends('layouts.app')

@section('content')
    <div class="mb-4 text-4xl">
        <h2>Work Order List</h2>
    </div>

    <a class="p-2 border-2 rounded-md mb-4" href="{{ route('work_orders.create') }}">Create Work Order</a>

    @if (session('success'))
        <div class="mt-4">{{ session('success') }}</div>
    @endif

    <table class="table-auto mt-8 w-full items-center justify-center text-left border-2">
        <thead class="border-2">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="border-2">
            @foreach ($workOrder as $work_order)
                <tr>
                    <td>{{ $work_order->id }}</td>
                    <td>{{ $work_order->title }}</td>
                    <td class="flex flex-row gap-4 w-4">
                        <a class="px-2 border-2" href="{{ route('work_orders.edit', $work_order) }}">Edit</a>
                        <form action="{{ route('work_orders.destroy', $work_order) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-2 border-2 cursor-pointer">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $workOrder->links() }}
@endsection
