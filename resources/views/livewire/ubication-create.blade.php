<div>
    <fieldset class="border border-solid border-secondary p-3">
        <legend class="small font-weight-bold">Datos</legend>
        <div class="row -mx-3 mb-6">
            <div class="col-12 col-md-6 px-3 py-2 mb-6 mb-md-0">
                <label class="form-label font-weight-bold" for="code">{{ __('Código') }}</label>
                <input type="text" name="code" wire:model.live="code"
                    class="form-control" id="code" placeholder="Código" value="{{ old('code') }}" />
            </div>

            <div class="col-12 col-md-6 px-3 py-2 mb-6 mb-md-0">
                <label class="form-label font-weight-bold" for="municipalitySelected">{{ __('Municipio') }}</label>
                <select name="municipalitySelected" class="form-control" id="municipalitySelected"
                    wire:model.live="municipalitySelected">
                    <option value="">{{ __('Seleccione') }}</option>
                    @foreach ($municipalities as $municipality)
                        <option value="{{ $municipality->municipality_id }}">
                            {{ $municipality->municipality }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-6 px-3 py-2 mb-6 mb-md-0">
                <label class="form-label font-weight-bold" for="parishesSelected">{{ __('Parroquia') }}</label>
                <select name="parishesSelected" id="parishesSelected" class="form-control" wire:model.live="parishesSelected">
                    <option value="">{{ __('Seleccione') }}</option>
                    @if ($parishes)
                        @foreach ($parishes as $parish)
                            <option value="{{ $parish->parish_id }}">{{ $parish->parish }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-12 col-md-6 px-3 py-2 mb-6 mb-md-0">
                <label class="form-label font-weight-bold" for="system">{{ __('Sistema') }}</label>
                <select name="system" id="system" class="form-control" wire:model.lazy="systemSelected">
                    <option value="">{{ __('Seleccione') }}</option>
                    @if ($systems)
                        @foreach ($systems as $system)
                            <option value="{{ $system->id }}">{{ $system->description }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-12 col-md-6 px-3 py-2 mb-6 mb-md-0">
                <label class="form-label font-weight-bold" for="sector">{{ __('Sector') }}</label>
                <input type="text" name="sector" wire:model.live="sector"
                    class="form-control" id="sector" placeholder="Sector de la parroquia" value="{{ old('sector') }}" />
            </div>
            <div class="col-12 col-md-6 px-3 py-2 mb-6 mb-md-0">
                <label class="form-label font-weight-bold" for="details">{{ __('Nombre del lugar') }}</label>
                <input type="text" name="details" wire:model.live="details"
                    class="form-control" id="details" placeholder="Ejemplo: Dos cerritos" value="{{ old('details') }}" />
            </div>

            <div class="col-12 col-md-6 px-3 py-2 mb-6 mb-md-0">
                <label class="form-label font-weight-bold" for="utm_x">{{ __('Coordenada UTM X') }}</label>
                <input type="text" name="utm_x" wire:model.live="utmX"
                    class="form-control" id="utm_x" placeholder="UTM X" value="{{ old('utm_x') }}" />
            </div>

            <div class="col-12 col-md-6 px-3 py-2 mb-6 mb-md-0">
                <label class="form-label font-weight-bold" for="utm_y">{{ __('Coordenada UTM Y') }}</label>
                <input type="text" name="utm_y" wire:model.live="utmY"
                    class="form-control" id="utm_y" placeholder="UTM Y" value="{{ old('utm_y') }}" />
            </div>
            <div class="col-12 col-md-6 px-3 py-2 mb-6 mb-md-0">
                <label class="form-label font-weight-bold" for="zone">{{ __('Zona') }}</label>
                <input type="text" name="zone" wire:model.live="zone"
                    class="form-control" id="zone" placeholder="Zona" value="{{ old('zone') }}" />
            </div>

            <div class="col-12 col-md-6 px-3 py-2 mb-6 mb-md-0">
                <label class="form-label font-weight-bold" for="flow">{{ __('Caudal') }}</label>
                <input type="text" name="flow" wire:model.live="flow"
                    class="form-control" id="flow" placeholder="En números" value="{{ old('flow') }}" />
            </div>

            <div class="col-12 col-md-6 px-3 py-2 mb-6 mb-md-0">
                <label class="form-label font-weight-bold" for="capacity">{{ __('Capacidad') }}</label>
                <input type="number" name="capacity" wire:model.live="capacity"
                    class="form-control" id="capacity" min="0" placeholder="Capacidad instalada" value="{{ old('capacity') }}" />
            </div>

            <div class="col-12 col-md-6 px-3 py-2 mb-6 mb-md-0">
                <label class="form-label font-weight-bold" for="status">{{ __('Estatus') }}</label>
                <select name="status" class="form-control" id="status" wire:model.live='operabilityTypeSelected'>
                    <option value="">{{ __('Seleccione') }}</option>
                    @foreach ($operabilityTypes as $operabilityType)
                        <option value="{{ $operabilityType->id }}">{{ $operabilityType->description }}</option>
                    @endforeach
                </select>
            </div>
            @if ($operabilityTypeSelected)
                <div class="col-12 col-md-6 px-3 py-2 mb-6 mb-md-0">
                    <label class="form-label font-weight-bold" for="statusDescription">{{ __('Descripción') }}</label>
                    <select class="form-control" name="statusDescription" id="statusDescription" wire:model.live="statusDescription">
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

    <fieldset class="border p-3 mt-3">
        <legend class="small font-weight-bold">{{ __('Ícono') }}</legend>
        <div class="row mb-3">
            <div class="col-12 col-md-6 mt-3">
                <select name="icons" class="form-control" id="icons" wire:model.live="iconSelected">
                    <option value="">{{ __('Seleccione') }}</option>
                    @foreach ($icons as $icon)
                        <option value="{{ $icon->id }}">{{ $icon->description }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-6  text-center">
                @if ($iconImage)
                    <div class="icon display-4 text-black">
                        {!! $iconImage->icon !!}
                    </div>
                @endif
            </div>
        </div>
    </fieldset>

    <fieldset class="border p-3 mt-3">
        <legend class="small font-weight-bold">{{ __('Observaciones') }}</legend>
        <div class="form-group">
            <textarea class="form-control" wire:model.live="observation" rows="4" name="observation" id="observation"></textarea>
        </div>
    </fieldset>
</div>
