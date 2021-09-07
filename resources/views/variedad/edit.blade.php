@extends('adminlte::page')

@section('title', 'Alertas Tempranas')
<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
@section('content_header')

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h1>Editar Registro</h1>
    </div>
    <div class="card-body">
      <form class="needs-validation" action="{{ route('variedades.update',$variedad->id) }}" method="POST" novalidate>
      @csrf @method('PATCH')
        @include('variedad.form')
      </form>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
