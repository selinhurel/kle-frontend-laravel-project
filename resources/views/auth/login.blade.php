@extends('layout')
@section('title', 'Giriş Yap')
@section('content')

<div class="container mt-5">
    @if($errors->any())
        <div class="col-12">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        </div>
    @endif
</div>

<div class="container">
    <form action="{{ route('login.post') }}" method="POST" class="ms-auto me-auto mt-5" style="width: 500px">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email Adresi</label>
            <input class="form-control" name="email">
        </div>

        <div class="mb-3">
            <label class="form-label">Şifre</label>
            <input class="form-control" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Giriş Yap</button>
    </form>
</div>

@endsection
