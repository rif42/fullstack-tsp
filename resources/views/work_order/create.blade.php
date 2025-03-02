@extends('layouts.app')

@section('content')
    <div class="mb-8 text-4xl">
        <h2>Create Work Order</h2>
    </div>
    <form class="flex flex-col w-fit" action="{{ route('work_orders.store') }}" method="POST">
        @csrf
        <div class="mb-3 flex flex-row gap-4">
            <label>Title</label>
            <input type="text" name="title" class="border-1" required>
        </div>
        <div class="mb-6 flex flex-row gap-4">
            <label>Content</label>
            <textarea name="content" class="border-1" required></textarea>
        </div>
        <div class="flex flex-row gap-2">

            <a href="{{ route('work_orders.index') }}" class="border-2 text-xl flex-grow bg-red-400 text-center">Back</a>
            <button type="submit" class="border-2 text-xl flex-grow">Create</button>
        </div>

    </form>
@endsection
