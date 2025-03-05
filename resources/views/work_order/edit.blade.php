@extends('layouts.app')

@section('content')
    <div class="mb-8 text-4xl">
        <h2>Edit Work Order</h2>
    </div>
    <form class="flex flex-col w-fit" action="{{ route('work_orders.update', $workOrder) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3 flex flex-row gap-4">
            <label class="w-40">Product Name</label>
            <div class="flex flex-col">
                <input type="text" name="product_name" class="border-1 @error('product_name') border-red-500 @enderror"
                    value="{{ old('product_name', $workOrder->product_name) }}" required minlength="3" maxlength="255"
                    @if(auth()->user()->role === 'operator') disabled @endif>
                @error('product_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="mb-3 flex flex-row gap-4">
            <label class="w-40">Quantity</label>
            <div class="flex flex-col">
                <input type="number" name="quantity" class="border-1 @error('quantity') border-red-500 @enderror"
                    value="{{ old('quantity', $workOrder->quantity) }}" required min="1">
                @error('quantity')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="mb-3 flex flex-row gap-4">
            <label class="w-40">Production Deadline</label>
            <div class="flex flex-col">
                <input type="date" name="production_deadline"
                    class="border-1 @error('production_deadline') border-red-500 @enderror"
                    value="{{ old('production_deadline', $workOrder->production_deadline ? date('Y-m-d', strtotime($workOrder->production_deadline)) : '') }}"
                    required min="{{ date('Y-m-d', strtotime('+1 day')) }}" @if(auth()->user()->role === 'operator') disabled
                    @endif>
                @error('production_deadline')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="mb-3 flex flex-row gap-4">
            <label class="w-40" for="status">Status</label>
            <div class="flex flex-col">
                <select name="status" id="status" class="@error('status') border-red-500 @enderror">
                    @if(auth()->user()->role === 'admin')
                        <!-- Admin sees all options -->
                        <option value='pending' {{ old('status', $workOrder->status) == 'pending' ? 'selected' : '' }}>pending</option>
                        <option value='progress' {{ old('status', $workOrder->status) == 'progress' ? 'selected' : '' }}>progress</option>
                        <option value='completed' {{ old('status', $workOrder->status) == 'completed' ? 'selected' : '' }}>completed</option>
                        <option value='canceled' {{ old('status', $workOrder->status) == 'canceled' ? 'selected' : '' }}>canceled</option>
                    @else
                        <!-- Operator sees limited transitions -->
                        <option value="{{ $workOrder->status }}" selected>{{ $workOrder->status }}</option>
                        @if($workOrder->status === 'pending')
                            <option value='progress'>progress</option>
                        @endif
                        @if($workOrder->status === 'progress')
                            <option value='completed'>completed</option>
                        @endif
                    @endif
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="mb-6 flex flex-row gap-4">
            <label class="w-40" for="responsible_operator">Responsible Operator</label>
            <div class="flex flex-col">
                <select name="responsible_operator" id="responsible_operator"
                    class="@error('responsible_operator') border-red-500 @enderror" @if(auth()->user()->role === 'operator')
                    disabled @endif>
                    @foreach($users as $user)
                        @if ($user->role == 'operator')
                            <option value="{{ $user->name }}" {{ old('responsible_operator') == $user->name ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('responsible_operator')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="flex flex-row gap-2">
            <a href="{{ route('work_orders.index') }}" class="border-2 text-xl flex-grow bg-red-400 text-center">Back</a>
            <button type="submit" class="border-2 text-xl flex-grow cursor-pointer">Update</button>
        </div>
    </form>
@endsection
