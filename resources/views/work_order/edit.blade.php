@extends('layouts.app')

@section('content')
    <h2>Edit Work Order</h2>
    <form action="{{ route('work_orders.update', $workOrder) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $workOrder->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" required>{{ $workOrder->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
