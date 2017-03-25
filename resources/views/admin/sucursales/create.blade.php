@extends('main')
@section('title','Sucursales | Nueva')
@section('nav')
@include('admin.nav')
@endsection
@section('content')
<div class="container">
  <div class="card-panel">
    @include('admin.sucursales.formulario')
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