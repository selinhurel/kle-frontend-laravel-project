<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('products.index') }}">Ana Sayfa</a>
        </li> 
        @if(Session::has('user'))
        <li class="nav-item">
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Çıkış Yap
          </a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Giriş Yap</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Kaydol</a>
        </li>
        @endif
      </ul>
      <span class="navbar-text">
        @if(Session::has('user'))
          {{ Session::get('user')['name'] }}
        @endif
      </span>
    </div>
  </div>
</nav>
