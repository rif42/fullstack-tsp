@extends('layouts.app')

@section('content')
    <div class="mb-8 text-4xl">
        <h2>Edit Work Order</h2>
    </div>
    <form class="flex flex-col w-fit" action="{{ route('work_orders.update', $workOrder) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3 flex flex-row gap-4">
            <label>Title</label>
            <input type="text" name="title" value="{{ $workOrder->title }}" class="border-1" required>
        </div>
        <div class="mb-6 flex flex-row gap-4">
            <label>Content</label>
            <textarea name="content" class="border-1" required>{{ $workOrder->content }}</textarea>
        </div>
        <div class="flex flex-row gap-2">
            <a href="{{ route('work_orders.index') }}" class="border-2 text-xl flex-grow bg-red-400 text-center">Back</a>
            <button type="submit" class="border-2 text-xl flex-grow">Submit</button>
        </div>
    </form>
@endsection
