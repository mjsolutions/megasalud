<ul id="user_options" class="dropdown-content">
  <li><a href="#!">Perfil</a></li>
  <li><a href="#!">other</a></li>
  <li class="divider"></li>
  <li><a href="{{ route('logout') }}">Salir</a></li>
</ul>
<nav>
  <div class="nav-wrapper blue darken-1">
    <a href="#!" class="brand-logo"><img class="responsive-img" width="320px" src="{{asset('images/Logo_Blanco.svg')}}"></a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">
      <li><a href="sass.html">Inicio</a></li>
      <li><a href="badges.html">Pacientes</a></li>
      <li><a href="mobile.html">Pedidos</a></li>
      <li><a href="mobile.html">Información</a></li>
      <li><a class="dropdown-button" href="#!" data-activates="user_options">{{ Auth::user()->nombre }}<i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>
    <ul class="side-nav" id="mobile-demo">
      <div class="row mb-0">
        <div class="col s10 col-center mt-30">
          <img class="responsive-img" src="{{asset('images/Logo.svg')}}">
        </div>
      </div>
      <div class="row">
        <div class="col s8 col-center divider"></div>
      </div>
      <li><a href="sass.html">Inicio</a></li>
      <li><a href="badges.html">Pacientes</a></li>
      <li><a href="mobile.html">Pedidos</a></li>
      <li><a href="mobile.html">Información</a></li> 
    </ul>
  </div>
</nav>