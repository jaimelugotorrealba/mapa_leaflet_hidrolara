<div>
    <section class=" mx-auto">
        <h1 class="font-bold text-center mt-5 text-3xl">{{ __('Panel de Administración') }}</h1>
        <div class="md:flex md:justify-center mt-3 p-3">
            <section
                class="mx-auto md:w-1/2 lg:w-2/5 border rounded-lg shadow-lg bg-white @if ($edit) max-h-128 @endif">
                @if (session()->has('message'))
                    <div class="bg-green-600 p-2">
                        <h5 class="text-center font-bold text-white text-md">{{ session('message') }}</h5>
                    </div>
                @endif
                <h2 class="text-center text-xl font-bold mt-4">{{ __('Gestionar Usuarios') }}</h2>
                <form class="p-5 @if ($edit) mt-10 @endif" method="POST" wire:submit.prevent='save'>
                    @csrf
                    <div class="md:flex md:justify-center md:gap-3 md:items-center mb-3">
                        <x-label for="email" class="text-lg capitalice md:w-2/5">{{ __('Correo') }}</x-label>
                        @if ($edit)
                            <x-input type="text" class="w-full" placeholder="ejemplo@ejemplo.com" name="email"
                                id="email" wire:model="email" readonly />
                        @else
                            <x-input type="text" class="w-full" placeholder="ejemplo@ejemplo.com" name="email"
                                id="email" wire:model="email" />
                        @endif
                    </div>
                    <div class="md:flex md:justify-center md:gap-3 md:items-center mb-3">
                        <x-label for="name" class="text-lg capitalice md:w-2/5">{{ __('Nombre') }}</x-label>
                        <x-input type="text" class="w-full" placeholder="Escriba su nombre y apellido" name="name"
                            id="name" wire:model="name" />
                    </div>
                    @if (is_null($edit))
                        <div class="md:flex md:justify-center md:gap-3 md:items-center mb-3">
                            <x-label for="password" class="text-lg capitalice md:w-2/5">{{ __('Contraseña') }}</x-label>
                            <x-input type="password" class="w-full" placeholder="Ingresa tu contraseña" name="password"
                                id="password" wire:model="password" />
                        </div>
                        <div class="md:flex md:justify-center md:gap-3 md:items-center mb-3">
                            <x-label for="password_confirmation"
                                class="text-lg capitalice md:w-2/5">{{ __('Repetir Contraseña') }}</x-label>
                            <x-input type="password" class="w-full" placeholder="Ingresa tu contraseña"
                                name="password_confirmation" id="password_confirmation"
                                wire:model="password_confirmation" />
                        </div>
                    @endif
                    <div class="md:flex md:justify-center md:gap-3 md:items-center mb-3">
                        <x-label for="userType"
                            class="text-lg capitalice md:w-2/5">{{ __('Tipo de Usuario') }}</x-label>
                        <select name="userType" id="userType" wire:model='userType' class="text-lg capitalice w-full">
                            <option value="">{{ __('Seleccione') }}</option>
                            @foreach ($userTypes as $userType)
                                <option class="w-full" value="{{ $userType->id }}">{{ $userType->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:w-2/5 md:flex md:justify-center md:gap-3 mx-auto mt-5">
                        <x-input type="submit" value="Guardar"
                            class="text-white text-center font-bold bg-blue-500 hover:bg-blue-700 p-3 w-full cursor-pointer rounded-lg" />

                        @if ($edit)
                            <button type="button" wire:click='cancel'
                                class="mt-4 md:mt-0 text-white text-center font-bold bg-gray-500 hover:bg-gray-700 p-3 w-full rounded-lg">{{ __('Cancelar') }}</button>
                        @endif

                    </div>
                    <x-validation-errors />
                </form>
            </section>

            <section
                class="mx-auto max-h-128  lg:w-3/5 border rounded-lg shadow-lg mt-4 md:mt-0 bg-white md:ml-5 overflow-x-auto overflo-y-auto flex flex-col justify-between">
                <div>
                    @if (session()->has('message-two-factor'))
                        <div class="bg-green-600 p-2">
                            <h5 class="text-center font-bold text-white text-md">{{ session('message-two-factor') }}
                            </h5>
                        </div>
                    @endif
                    @if (session()->has('message-success'))
                        <div class="bg-green-600 p-2">
                            <h5 class="text-center font-bold text-white text-md">{{ session('message-success') }}
                            </h5>
                        </div>
                    @endif
                    @if (session()->has('message-error'))
                        <div class="bg-red-600 p-2">
                            <h5 class="text-center font-bold text-white text-md">{{ session('message-error') }}
                            </h5>
                        </div>
                    @endif
                    <h2 class="text-center text-xl font-bold mt-4">{{ __('Listado de Usuarios') }}</h2>
                    @if ($users->count() > 0)
                        <table class="w-full mx-auto text-center mt-4 mb-4 md:mb-2">
                            <thead>
                                <tr>
                                    <th class="text-lg">{{ __('Usuario') }}</th>
                                    <th class="text-lg">{{ __('Nombre y Apellido') }}</th>
                                    <th class="text-lg">{{ __('Permiso') }}</th>
                                    <th class="text-lg">{{ __('Opciones') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->description }}</td>
                                        <td>
                                            <button type="button" wire:click="editUser({{ $user->id }})"
                                                class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 rounded text-center w-10"><i
                                                    class="fas fa-edit" title="{{ __('Editar') }}"></i></button>

                                            @if ($user->two_factor_recovery_codes && $user->two_factor_secret && $user->two_factor_confirmed_at)
                                                <button type="button"
                                                    wire:click='restoreTwoFactor({{ $user->id }})'
                                                    class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-1 rounded text-center w-10"
                                                    title="{{ __('Remover Dos Factores') }}"><i
                                                        class="fas fa-key"></i></button>
                                            @endif
                                            <button
                                                wire:click='userDelete({{$user->id}})'
                                                wire:confirm="¿Está seguro que desea eliminar ese usuario?"
                                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 rounded text-center w-10"
                                                title="{{ __('Eliminar Usuario') }}">X</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center font-semibold mt-12 text-2xl">{{ __('No hay usuarios cargados') }}</p>
                    @endif
                </div>
                <div class="p-3">
                    {{ $users->links() }}
                </div>
            </section>
        </div>
    </section>
</div>
