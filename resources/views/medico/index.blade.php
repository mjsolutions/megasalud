@extends('main')
@section('title','Medico')
@section('nav')
@include('sucursal.nav')
@endsection
@section('content')

<div class="row">
  <div class="valign-wrapper minh-400 col l12">
    <h1 class="valign center" style="width: 100%">Bienvenido {{ Auth::user()->nombre }} </h1>
  </div>
</div>
<div class="row">
  <div class="valign-wrapper minh-400 col l12 center-align">
    <h2 class="valign center" style="width: 100%"">Médico</h2>
  </div>
</div>
@endsection
@section('scripts')
  @if($errors)
    @foreach($errors->all() as $error)
      Materialize.toast('{{ $error }}', 4000);
    @endforeach
  @endif
@endsection