<div>
    <section class="col-12">
        <div class="row justify-content-center mt-3 p-3">
            <section class="col-12 col-lg-4 mx-auto border rounded-lg shadow-lg bg-white @if ($edit) max-height: 128px; @endif" style="max-width: 500px;">
                @if (session()->has('message'))
                    <div class="alert alert-success text-center">
                        <h5 class="font-bold text-md">{{ session('message') }}</h5>
                    </div>
                @endif
                <h2 class="text-center text-xl font-bold mt-4">{{ __('Gestionar Usuarios') }}</h2>
                <form class="p-5 @if ($edit) mt-10 @endif" method="POST" wire:submit.prevent='save'>
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label text-lg capitalice">{{ __('Correo') }}</label>
                        @if ($edit)
                            <input type="text" class="form-control" placeholder="ejemplo@ejemplo.com" name="email" id="email" wire:model="email" readonly />
                        @else
                            <input type="text" class="form-control" placeholder="ejemplo@ejemplo.com" name="email" id="email" wire:model="email" />
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label text-lg capitalice">{{ __('Nombre') }}</label>
                        <input type="text" class="form-control" placeholder="Escriba su nombre y apellido" name="name" id="name" wire:model="name" />
                    </div>
                    @if (is_null($edit))
                        <div class="mb-3">
                            <label for="password" class="form-label text-lg capitalice">{{ __('Contraseña') }}</label>
                            <input type="password" class="form-control" placeholder="Ingresa tu contraseña" name="password" id="password" wire:model="password" />
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label text-lg capitalice">{{ __('Repetir Contraseña') }}</label>
                            <input type="password" class="form-control" placeholder="Ingresa tu contraseña" name="password_confirmation" id="password_confirmation" wire:model="password_confirmation" />
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="userType" class="form-label text-lg capitalice">{{ __('Tipo de Usuario') }}</label>
                        <select name="userType"  id="userType" wire:model='userType' class="form-control text-lg capitalice">
                            <option value="">{{ __('Seleccione') }}</option>
                            @foreach ($roles as $userType)
                                <option value="{{ $userType->id }}">{{ $userType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-center gap-3 mt-5">
                        <button type="submit" class="btn btn-primary w-100">{{ __('Guardar') }}</button>
                        @if ($edit)
                            <button type="button" wire:click='cancel' class="btn btn-secondary w-100">{{ __('Cancelar') }}</button>
                        @endif
                    </div>
                    <x-validation-errors />
                </form>
            </section>

            <section class="col-12 col-lg-8 mx-auto mt-4 mt-lg-0">
                <div class="border rounded-lg shadow-lg bg-white overflow-auto">
                    <div class="p-3">
                        @if (session()->has('message-two-factor'))
                            <div class="alert alert-success">
                                <h5 class="text-center font-weight-bold">{{ session('message-two-factor') }}</h5>
                            </div>
                        @endif
                        @if (session()->has('message-success'))
                            <div class="alert alert-success">
                                <h5 class="text-center font-weight-bold">{{ session('message-success') }}</h5>
                            </div>
                        @endif
                        @if (session()->has('message-error'))
                            <div class="alert alert-danger">
                                <h5 class="text-center font-weight-bold">{{ session('message-error') }}</h5>
                            </div>
                        @endif
                        <h2 class="text-center font-weight-bold mt-4">{{ __('Listado de Usuarios') }}</h2>
                        @if ($users->count() > 0)
                            <table class="table table-bordered text-center mt-4 mb-4">
                                <thead>
                                    <tr>
                                        <th>{{ __('Usuario') }}</th>
                                        <th>{{ __('Nombre y Apellido') }}</th>
                                        <th>{{ __('Permiso') }}</th>
                                        <th>{{ __('Opciones') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ isset($user->userRole) && !is_null($user->userRole) ? $user->userRole->role->name : $user->description }}</td>
                                            <td>
                                                <button type="button" wire:click="editUser({{ $user->id }})"
                                                    class="btn btn-success btn-sm"><i class="fas fa-edit" title="{{ __('Editar') }}"></i></button>

                                                @if ($user->two_factor_recovery_codes && $user->two_factor_secret && $user->two_factor_confirmed_at)
                                                    <button type="button"
                                                        wire:click='restoreTwoFactor({{ $user->id }})'
                                                        class="btn btn-secondary btn-sm"
                                                        title="{{ __('Remover Dos Factores') }}"><i
                                                            class="fas fa-key"></i></button>
                                                @endif
                                                <button
                                                    wire:click='userDelete({{ $user->id }})'
                                                    wire:confirm="¿Está seguro que desea eliminar ese usuario?"
                                                    class="btn btn-danger btn-sm"
                                                    title="{{ __('Eliminar Usuario') }}">X</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center font-weight-bold mt-4 text-2xl">{{ __('No hay usuarios cargados') }}</p>
                        @endif
                    </div>
                    <div class="p-3">
                        {{ $users->links() }}
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
