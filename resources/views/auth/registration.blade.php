@extends('layout')
@section('title', 'Kayıt Ol')
@section('content')

<div class="container mt-5">
    @if($errors->any())
        <div class="col-12">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
</div>

<div class="container">
    <form action="{{ route('registration.post') }}" method="POST" class="ms-auto me-auto mt-5" style="width: 500px">
        @csrf

        <div class="mb-3">
            <label class="form-label">İsim Soyisim</label>
            <input class="form-control" name="name" >
        </div>

        <div class="mb-3">
            <label class="form-label">Email Adresi</label>
            <input class="form-control" name="email" >
        </div>

        <div class="mb-3">
            <label class="form-label">Şifre</label>
            <input type="password" class="form-control" name="password" >
        </div>

        <div class="mb-3">
            <label class="form-label">Şifre Onayla</label>
            <input type="password" class="form-control" name="password_confirmation" >
        </div>

        <button type="submit" class="btn btn-primary">Kaydol</button>
    </form>
</div>

@endsection
