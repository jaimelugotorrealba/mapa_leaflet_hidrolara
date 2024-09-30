@extends('adminlte::page')

@section('title', 'Bitácora')

@section('content_header')
    <section class="mt-2">
        <h1>Bitácora</h1>
    </section>
@stop

@section('content')
    <div class="container p-1">
            @if (session('successful-message'))
            <div class="alert alert-success">
                <p class="text-center font-weight-bold mb-0">{{ session('successful-message') }}</p>
            </div>
        @endif
        <div class="card-body">
            {{ $dataTable->table(['class' => 'table table-striped table-bordered']) }}
        </div>
    </div>
@stop

@section('adminlte_css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/datatable/datatable-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/button-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/responsive-datatable.css') }}">
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">

@stop

@section('js')
    <script src="{{ asset('js/datatable/datatable.js') }}"></script>
    <script src="{{ asset('js/sweetalert.js')}}"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete-btn', function() {
                console.log('entro');
                var id = $(this).data('id');
                var url = '{{ route('operability.delete', ':id') }}'.replace(':id', id);

                // Usar SweetAlert2 para la confirmación
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, elimínalo!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                $('#operability-table').DataTable().ajax.reload();
                                Swal.fire(
                                    '¡Eliminado!',
                                    'El registro ha sido eliminado.',
                                    'success'
                                );
                            },
                            error: function(xhr) {
                                alert('Error al eliminar el registro: ' + xhr
                                    .responseText);
                            }
                        });
                    }
                });
            });
        });
    </script>
@stop
