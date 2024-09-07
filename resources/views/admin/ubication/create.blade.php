@extends('adminlte::page')

@section('title', 'Ubicaciones')
@section('css')
<link rel="stylesheet" href="{{asset('css/styles4.css')}}">
@endsection
@section('content_header')
<span> </span>
@stop

@section('content')
<section class="container-fluid">
    <h1 class="block text-2xl font-semibold text-center mb-5">{{ __('Agregar ubicación') }}</h1>
    <form method="POST" action="{{ ($operability) ? route('map.update',['operability' => $operability->id]) : route('map.store') }}"
        class="py-3 bg-white shadow rounded px-4 pt-6 pb-4 mb-4 ">
        @csrf
        <x-validation-errors />
        @if (session('successful-message'))
            <div class="alert alert-success">
                <p class="text-center font-weight-bold mb-0">{{ session('successful-message') }}</p>
            </div>
        @endif
        @livewire('ubication-create', ['operability' => $operability])

        {{-- Botón de guardar y volver --}}
    <div class="col-12">
        <div class="d-flex justify-content-center">
            <button type="submit"
                class="btn btn-primary m-2 w-100 w-md-50">{{ __('Guardar') }}</button>

            <a href="{{ route('dashboard') }}" class="btn btn-secondary m-2 w-100 w-md-50">{{ __('Volver') }}</a>
        </div>
    </div>

    </form>

</section>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script src="{{ asset('js/fontawesome.js') }}"></script>
@stop
