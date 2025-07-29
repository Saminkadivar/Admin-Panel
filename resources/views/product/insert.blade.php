@extends('layout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <body>
<form class="container w-75 mx-auto" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="" class="form-label">Product Name:</label>
    <input type="text" name="p_name" class="form-control">

    <label for="" class="form-label">Product Category:</label>
    <input type="text" name="category" class="form-control">

    <label for="" class="form-label">Product Price:</label>
    <input type="text" name="price" class="form-control">

    <label for="" class="form-label">Product Stock:</label>
    <input type="text" name="stock" class="form-control">

    <label for="product_picture" class="form-label">Product Picture:</label>
    <input type="file" name="product_picture" id="product_picture" class="form-control">

    <div class="mt-3">
        <button class="btn btn-sm btn-primary">Submit</button>
    </div>
</form>

    </body>

    </html>
@endsection
