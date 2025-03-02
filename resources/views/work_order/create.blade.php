@extends('layouts.app')

@section('content')
    <div class="mb-8 text-4xl">
        <h2>Create Work Order</h2>
    </div>
    <form class="flex flex-col w-fit" action="{{ route('work_orders.store') }}" method="POST">
        @csrf
        <div class="mb-3 flex flex-row gap-4">
            <label class="w-40">Product Name</label>
            <div class="flex flex-col">
                <input type="text" name="product_name" class="border-1 @error('product_name') border-red-500 @enderror"
                    value="{{ old('product_name') }}" required minlength="3" maxlength="255">
                @error('product_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="mb-3 flex flex-row gap-4">
            <label class="w-40">Quantity</label>
            <div class="flex flex-col">
                <input type="number" name="quantity" class="border-1 @error('quantity') border-red-500 @enderror"
                    value="{{ old('quantity') }}" required min="1">
                @error('quantity')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="mb-3 flex flex-row gap-4">
            <label class="w-40">Production Deadline</label>
            <div class="flex flex-col">
                <input type="date" name="production_deadline" class="border-1 @error('production_deadline') border-red-500 @enderror"
                    value="{{ old('production_deadline') }}" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                @error('production_deadline')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="mb-3 flex flex-row gap-4">
            <label class="w-40" for="status">Status</label>
            <div class="flex flex-col">
                <select name="status" id="status" class="@error('status') border-red-500 @enderror">
                    <option value='pending' {{ old('status') == 'pending' ? 'selected' : '' }}>pending</option>
                    <option value='progress' {{ old('status') == 'progress' ? 'selected' : '' }}>progress</option>
                    <option value='completed' {{ old('status') == 'completed' ? 'selected' : '' }}>completed</option>
                    <option value='canceled' {{ old('status') == 'canceled' ? 'selected' : '' }}>canceled</option>
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
                    class="@error('responsible_operator') border-red-500 @enderror">
                    @foreach($users as $user)
                        <option value="{{ $user->name }}" {{ old('responsible_operator') == $user->name ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('responsible_operator')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="flex flex-row gap-2">
            <a href="{{ route('work_orders.index') }}" class="border-2 text-xl flex-grow bg-red-400 text-center">Back</a>
            <button type="submit" class="border-2 text-xl flex-grow cursor-pointer">Create</button>
        </div>
    </form>
@endsection
