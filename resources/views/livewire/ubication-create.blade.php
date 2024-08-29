<div>
    <fieldset class="border border-solid border-gray-300 p-3">
        <legend class="text-sm font-semibold">Datos</legend>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 py-2 mb-6 md:mb-0">
                <x-label class="block text-gray-700 text-sm font-bold mb-2" for="code">
                    {{ __('Código') }}
                </x-label>
                <x-input type="text" name="code" wire:model.live="code"
                    class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="code" type="text" placeholder="Código" value="{{ old('code') }}" />

            </div>
            <div class="w-full md:w-1/2 px-3 py-2 mb-6 md:mb-0">
                <x-label class="block text-gray-700 text-sm font-bold mb-2" for="municipalitySelected">
                    {{ __('Municipio') }}
                </x-label>
                <select name="municipalitySelected" class="w-full rounded" id="municipalitySelected"
                    wire:model.live="municipalitySelected">
                    <option value="">{{ __('Seleccione') }}</option>
                    @foreach ($municipalities as $municipality)
                        <option value="{{ $municipality->municipality_id }}">
                            {{ $municipality->municipality }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-1/2 px-3 py-2 mb-6 md:mb-0">
                <x-label class="block text-gray-700 text-sm font-bold mb-2" for="parishesSelected">
                    {{ __('Parroquia') }}
                </x-label>
                <select name="parishesSelected" id="parishesSelected" class="w-full rounded" wire:model.live="parishesSelected">
                    <option value="">{{ __('Seleccione') }}</option>
                    @if ($parishes)
                        @foreach ($parishes as $parish)
                            <option value="{{ $parish->parish_id }}">{{ $parish->parish }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="w-full md:w-1/2 px-3 py-2 mb-6 md:mb-0">
                <x-label class="block text-gray-700 text-sm font-bold mb-2" for="system">
                    {{ __('Sistema') }}
                </x-label>
                <select name="system" id="system" class="w-full rounded" wire:model.lazy="systemSelected" >
                    <option value="">{{ __('Seleccione') }}</option>
                    @if ($systems)
                        @foreach ($systems as $system)
                            <option value="{{ $system->id }}">{{ $system->description }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="w-full md:w-1/2 px-3 py-2 mb-6 md:mb-0">
                <x-label class="block text-gray-700 text-sm font-bold mb-2" for="sector">
                    {{ __('Sector') }}
                </x-label>
                <x-input type="text" name="sector" wire:model.live="sector"
                    class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="sector" type="text" placeholder="Sector de la parroquia" value="{{ old('sector') }}" />

            </div>

            <div class="w-full md:w-1/2 px-3 py-2 mb-6 md:mb-0">
                <x-label class="block text-gray-700 text-sm font-bold mb-2" for="details">
                    {{ __('Nombre del lugar') }}
                </x-label>
                <x-input type="text" name="details" wire:model.live="details"
                    class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="details" type="text" placeholder="Ejemplo: Dos cerritos" value="{{ old('details') }}" />
            </div>

            <div class="w-full md:w-1/2 px-3 py-2 mb-6 md:mb-0">
                <x-label class="block text-gray-700 text-sm font-bold mb-2" for="utm_x">
                    {{ __('Coordenada UTM X') }}
                </x-label>
                <x-input type="text" name="utm_x" wire:model.live="utmX"
                    class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="utm_x" type="text" placeholder="UTM X"
                    value="{{ old('utm_x') }}" />
            </div>

            <div class="w-full md:w-1/2 px-3 py-2 mb-6 md:mb-0">
                <x-label class="block text-gray-700 text-sm font-bold mb-2" for="utm_y">
                    {{ __('Coordenada UTM Y') }}
                </x-label>
                <x-input type="text" name="utm_y" wire:model.live="utmY"
                    class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="utm_y" type="text" placeholder="UTM Y"
                    value="{{ old('utm_y') }}" />
            </div>

            <div class="w-full md:w-1/2 px-3 py-2 mb-6 md:mb-0">
                <x-label class="block text-gray-700 text-sm font-bold mb-2" for="zone">
                    {{ __('Zona') }}
                </x-label>
                <x-input type="text" name="zone" wire:model.live="zone"
                    class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="zone" type="text" placeholder="Zona"
                    value="{{ old('zone') }}" />
            </div>

            <div class="w-full md:w-1/2 px-3 py-2 mb-6 md:mb-0">
                <x-label class="block text-gray-700 text-sm font-bold mb-2" for="flow">
                    {{ __('Caudal') }}
                </x-label>
                <x-input type="text" name="flow" wire:model.live="flow"
                    class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="flow" type="text" placeholder="En números" value="{{ old('flow') }}" />
            </div>

            <div class="w-full md:w-1/2 px-3 py-2 mb-6 md:mb-0">
                <x-label class="block text-gray-700 text-sm font-bold mb-2" for="capacity">
                    {{ __('Capacidad') }}
                </x-label>
                <x-input type="number" name="capacity" wire:model.live="capacity"
                    class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="capacity" min="0" placeholder="Capacidad instalada" value="{{ old('capacity') }}" />
            </div>

            <div class="w-full md:w-1/2 px-3 py-2 mb-6 md:mb-0">
                <x-label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                    {{ __('Estatus') }}
                </x-label>
                <select name="status" class="w-full rounded" id="status" wire:model.live='operabilityTypeSelected'>
                    <option value="">{{ __('Seleccione') }}</option>
                    @foreach ($operabilityTypes as $operabilityType)
                        <option value="{{ $operabilityType->id }}">{{ $operabilityType->description }}</option>
                    @endforeach
                </select>
            </div>
            @if ($operabilityTypeSelected)
                <div class="w-full md:w-1/2 px-3 py-2 mb-6 md:mb-0">
                    <x-label class="block text-gray-700 text-sm font-bold mb-2"
                        for="statusDescription">{{ __('Descripción') }}</x-label>
                    <select class="w-full rounded" name="statusDescription" id="statusDescription"
                        wire:model.live="statusDescription">
                        @foreach ($descriptionOperabilities as $descriptionOperability)
                            <option>
                                {{ $descriptionOperability->description }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>

    </fieldset>

    <fieldset class="border border-solid border-gray-300 p-3 mt-3">
        <legend class="text-sm font-semibold">{{ __('Ícono') }}</legend>
        <div class="flex flex-wrap -mx-3 mb-3">
            <div class="w-full md:w-1/2 mt-3 px-3">
                <select name="icons" class="w-full" id="icons" wire:model.live="iconSelected">
                    <option value="">{{ __('Seleccione') }}</option>
                    @foreach ($icons as $icon)
                        <option value="{{ $icon->id }}">{{ $icon->description }}</option>
                    @endforeach

                </select>
            </div>

            <div class="w-full md:w-1/2 px-3 mt-5 md:mt-4">
                @if ($iconImage)
                    <div class="icon text-3xl text-black text-center">
                        {!! $iconImage->icon !!}
                    </div>
                @endif
            </div>
        </div>
    </fieldset>

    <fieldset class="border border-solid border-gray-300 p-3 mt-3">
        <legend class="text-sm font-semibold">{{ __('Observaciones') }}</legend>
        <div class="w-full py-1 mb-6 md:mb-0">
            <textarea class="w-full resize-none overflow-scroll" wire:model.live="observation" rows="4" name="observation"
                id="observation"></textarea>
        </div>
    </fieldset>
</div>
