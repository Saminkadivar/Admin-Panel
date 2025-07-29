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
        <form class="container  mx-auto w-75" action="{{ route('user.store') }}" method="post">
            @csrf
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name">
            <span>
                @error('name')
                    {{ $message }}
                @enderror
            </span>

            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email">
            <span>
                @error('email')
                    {{ $message }}
                @enderror
            </span>


            <label class="form-label">phone</label>
            <input type="text" class="form-control" name="phone">
            <span>
                @error('phone')
                    {{ $message }}
                @enderror
            </span>

            <label class="form-label">password</label>
            <input type="password" class="form-control" name="password">
            <span>
                @error('password')
                    {{ $message }}
                @enderror
            </span>

            <label class="form-label">address</label>
            <textarea type="text" class="form-control" name="address">
        </textarea>
            <span>
                @error('address')
                    {{ $message }}
                @enderror
            </span>
            <div class="mt-3">
                <button class="btn btn-sm btn-primary">Submit</button>
            </div>
        </form>
    </body>

    </html>
@endsection
