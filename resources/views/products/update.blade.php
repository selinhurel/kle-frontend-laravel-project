@extends('layout')
@section('content')

<div class="container mt-3">
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        @endforeach
    @endif
</div>

<div class="container mt-5">
    <form action="{{ route('products.update', $product['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">ÜRÜN ADI</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $product['name']) }}">
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">ÜRÜN AÇIKLAMASI</label>
            <input type="text" class="form-control" name="description" value="{{ old('description', $product['description']) }}">
            @if ($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">ÜRÜN FİYATI</label>
            <input type="text" class="form-control" name="price" value="{{ old('price', $product['price']) }}">
            @if ($errors->has('price'))
                <span class="text-danger">{{ $errors->first('price') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-warning">ÜRÜN GÜNCELLE</button>
    </form>
</div>


@endsection
