@extends('layout')
@section('content')

<div class="container mt-5">
    <form>
        <div class="mb-3">
            <label class="form-label">ÜRÜN ADI</label>
            <input type="text" class="form-control" name="name" value="{{ $product['name'] }}" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">ÜRÜN AÇIKLAMASI</label>
            <input type="text" class="form-control" name="description" value="{{ $product['description'] }}" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">ÜRÜN FİYATI</label>
            <input type="text" class="form-control" name="price" value="{{ $product['price'] }}" readonly>
        </div>
    </form>
</div>

<div class="container">
    <a href="{{ route('products.edit', $product['id']) }}" type="button" class="btn btn-warning">GÜNCELLE</a>
</div>

<div class="container mt-2">
    <form action="{{ route('products.destroy', $product['id']) }}" method="POST">
        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-danger">ÜRÜN SİL</button>
    </form>
</div>

@endsection
