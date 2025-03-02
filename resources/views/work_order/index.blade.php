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
                <th>
                    <a
                        href="{{ route('work_orders.index', ['sort' => 'work_order_id', 'direction' => request('sort') === 'work_order_id' && request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                        work_order_id
                        @if(request('sort') === 'work_order_id')
                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                        @endif
                    </a>
                </th>
                <th>
                    <a
                        href="{{ route('work_orders.index', ['sort' => 'product_name', 'direction' => request('sort') === 'product_name' && request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                        product_name
                        @if(request('sort') === 'product_name')
                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                        @endif
                    </a>
                </th>
                <th>
                    <a
                        href="{{ route('work_orders.index', ['sort' => 'quantity', 'direction' => request('sort') === 'quantity' && request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                        quantity
                        @if(request('sort') === 'quantity')
                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                        @endif
                    </a>
                </th>
                <th>
                    <a
                        href="{{ route('work_orders.index', ['sort' => 'production_deadline', 'direction' => request('sort') === 'production_deadline' && request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                        production_deadline
                        @if(request('sort') === 'production_deadline')
                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                        @endif
                    </a>
                </th>
                <th>
                    <a
                        href="{{ route('work_orders.index', ['sort' => 'status', 'direction' => request('sort') === 'status' && request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                        status
                        @if(request('sort') === 'status')
                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                        @endif
                    </a>
                </th>
                <th>
                    <a
                        href="{{ route('work_orders.index', ['sort' => 'responsible_operator', 'direction' => request('sort') === 'responsible_operator' && request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                        responsible_operator
                        @if(request('sort') === 'responsible_operator')
                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                        @endif
                    </a>
                </th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody class="border-2">
            @foreach ($workOrder as $work_order)
                <tr>
                    <!-- data -->
                    <td> {{$work_order->work_order_id}}</td>
                    <td> {{$work_order->product_name}}</td>
                    <td> {{$work_order->quantity}}</td>
                    <td> {{$work_order->production_deadline ? $work_order->production_deadline->format('Y-m-d') : '' }}</td>
                    <td> {{$work_order->status}}</td>
                    <td> {{$work_order->responsible_operator}}</td>

                    <!-- actions -->
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

    {{ $workOrder->appends(request()->query())->links() }}
@endsection
