@extends('layout')
@section('title', 'Ana Sayfa')
@section('content')
<br>

<div class="container">
  <a href="{{ route('products.create') }}" method="GET" type="button" class="btn btn-success">ÜRÜN EKLE</a>
</div>
<br>

<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th class="headers" scope="col">#</th>
        <th class="headers" scope="col">ÜRÜN ADI</th>
        <th class="headers" scope="col">AÇIKLAMA</th>
        <th class="headers" scope="col">FİYAT</th>
        <th class="headers" scope="col">AYRINTI GÖSTER</th>
        <th class="headers" scope="col">DÜZENLE</th>
        <th class="headers" scope="col">SİL</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
        <tr>
          <th scope="row">{{ $product['id'] }}</th>
          <td>{{ $product['name'] }}</td>
          <td>{{ $product['description'] }}</td>
          <td>{{ $product['price'] }}</td>
          <td><a href="{{ route('products.show', $product['id']) }}" type="button" class="btn btn-info">➡️</a></td>
          <td><a href="{{ route('products.update', $product['id']) }}" type="button" class="btn btn-warning">🛠</a></td>
          <td>
            <form action="{{ route('products.destroy', $product['id']) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">✖️</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
