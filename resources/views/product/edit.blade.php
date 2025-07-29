@extends('layout')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
</head>

<body>
    {{-- @endsection --}}
    {{-- @section('scripts') --}}

    {{-- <form class="container  w-75 mx-auto" action="{{ route('product.update', $product->id) }}" method="post"> --}}
<form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')
        <label for="" class="form-label">product name:</label>
        <input type="text" name="p_name" class="form-control" value="{{ $product->p_name }}">


        <label for="" class="form-label">product category:</label>
        <input type="text" name="category" class="form-control" value="{{ $product->category }}">


        <label for="" class="form-label">product price:</label>
        <input type="text" name="price" class="form-control" value="{{ $product->price }}">


        <label for="" class="form-label">product stock:</label>
        <input type="text" name="stock" class="form-control" value="{{ $product->stock }}">



<label for="product_picture" class="form-label">Product Picture:</label>
<input type="file" name="product_picture" id="product_picture" class="form-control">

@if($product->product_picture)
    <div class="mt-2">
        <p>Current Image:</p>
        <img src="{{ asset('storage/product_picture/' . $product->product_picture) }}" alt="Product Image" width="120">

    </div>
@endif


        <div class="mt-3">
        <button class="btn btn-sm btn-primary">Submit</button>
        </div>
    </form>
</body>

</html>
@endsection
