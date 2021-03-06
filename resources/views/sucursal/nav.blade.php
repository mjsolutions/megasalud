<ul id="user_options" class="dropdown-content">
  <li><a href="#!">Perfil</a></li>
  <li><a href="#!">other</a></li>
  <li class="divider"></li>
  <li><a href="{{ route('logout') }}">Salir</a></li>
</ul>
<nav>
  <div class="nav-wrapper blue darken-1">
    <div class="container">
      <a href="{{ route('sucursal.inicio') }}" class="brand-logo mt-5"><img class="responsive-img" width="150px" src="{{asset('images/Logo_Blanco.svg')}}"></a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="{{ route('sucursal.inicio') }}">Inicio</a></li>
        <li><a href="{{ route('sucursal.pacientes.index') }}">Pacientes</a></li>
        <li><a href="{{ route('sucursal.medicos.index') }}">Médicos</a></li>
        <li><a href="{{ route('sucursal.productos.index') }}">Productos</a></li>
        <li><a href="{{ route('sucursal.pedidos.index') }}">Pedidos</a></li>
        <li><a class="dropdown-button" href="#!" data-activates="user_options">{{ Auth::user()->nombre }}<i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
    </div>
    <ul class="center-align side-nav" id="mobile-demo">
      <div class="row mb-0">
        <div class="col s10 col-center mt-30">
          <a href="{{ route('sucursal.inicio') }}">
            <img class="responsive-img" src="{{asset('images/Logo.svg')}}">
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col s8 col-center divider"></div>
      </div>
      <li><a href="{{ route('sucursal.inicio') }}">Inicio</a></li>
      <li><a href="{{ route('sucursal.pacientes.index') }}">Pacientes</a></li>
      <li><a href="{{ route('sucursal.medicos.index') }}">Médicos</a></li>
      <li><a href="{{ route('sucursal.productos.index') }}">Productos</a></li>
      <li><a href="{{ route('sucursal.pedidos.index') }}">Pedidos</a></li>
    </ul>
  </div>
</nav>