@extends('adminlte::page')

@section('title', 'Gestionar Usuarios')

@section('content_header')
    <section class="mt-2">
        <h1>Gestionar Usuarios</h1>
    </section>
@stop

@section('content')
    <div class="container-fluid p-1">
      @livewire('administrator-component')
    </div>
@stop

@section('adminlte_css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">

@stop

@section('js')
<script src="{{ asset('js/sweetalert.js')}}"></script>

@stop
