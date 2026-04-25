@extends('admin-layout')
  
@section('admin-content')
<div class="container">
    <p>Total Product : {{$items->total()}}</p>
    <a href="{{route('admin.product.create')}}" class="btn btn-primary float-right">Add Product</a>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">Image</th>
        <th scope="col">Category</th>
        <th scope="col">Created At</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{!! $item->description !!}</td>
                <td>{{ $item->status}}</td>
                <td><img src="{{ asset('storage/'.$item->image) }}" style="width:50px;height50px;" /></td>
                <td>{{ $item->category_name}}</td>
                <td>{{ $item->created_at}}</td>
                <td>
                    <a href="{{route('admin.product.edit', ['id' => $item->id])}}" class="btn btn-primary">Edit</a>
                    <a data-url="{{route('admin.product.delete', ['id' => $item->id])}}" data-title="Delete Entry" class="btn btn-danger ajax-modal">Delete</a>
                </td>
            </tr>
        @endforeach
            
    </tbody>
    </table>

    <div class="d-flex justify-content-center">
    <!-- {{ $items->render("pagination::simple-bootstrap-4") }} -->
        {{ $items->render("pagination::bootstrap-4") }}
    </div>
</div>
@endsection