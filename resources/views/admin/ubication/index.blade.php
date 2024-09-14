@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @if ($operabilities->count() > 0)
        <div class="overflow-y-auto text-center h-min-screen-75">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="w-1/3 ">{{ __('Nombre') }}</th>
                        <th class="w-1/3 ">{{ __('Estatus') }}</th>
                        <th class="w-1/3">{{ __('Opciones') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($operabilities as $operability)
                        <tr>
                            <td class="text-center py-2 align-middle uppercase">{{ $operability->details }}</td>
                            <td class="text-center align-middle uppercase">{{ $operability->operability_type }}</td>
                            <td class="gap-2 items-center align-middle">
                                <a href="{{ route('location.edit', ['operability' => $operability->id]) }}" type="button"
                                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 rounded text-center md:w-10"><i
                                        class="fas fa-edit"></i></a>

                                @if (auth()->user()->user_type_id === 1)
                                    <button type="button" id="{{ $operability->id }}"
                                        onclick="setTimeout(function() { ubicationDelete({{ $operability->latitude }}, {{ $operability->longitude }}) }, 150);"
                                        wire:click='delete({{ $operability->id }})'
                                        wire:confirm="¿Está seguro que desea eliminar esta ubicación?"
                                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 rounded text-center md:w-10"><i
                                            class="fas fa-trash"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
            <p class="text-center font-semibold mt-12 text-2xl">{{ __('No hay ubicaciones cargadas') }}</p>
    @endif
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
