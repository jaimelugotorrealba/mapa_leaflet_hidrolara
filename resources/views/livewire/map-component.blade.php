<div>
    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}">
    @endsection
    <div class="flex">
        @if (isset(auth()->user()->userRole) && auth()->user()->userRole && (auth()->user()->userRole->role_id==1 || auth()->user()->userRole->role_id==2))
        <section class="hidden md:block md:w-2/5 p-3 ">
            <a href="{{ route('operability.create') }}"
            class="block m-6 mb-0 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center md:w-32">Crear</a>
            <h1 class="block py-3 font-semibold text-2xl text-center mt-3">Ubicaciones</h1>
            <form action="#">
                <x-input type="text"
                    class="mt-4 mb-5 shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    wire:model.live="search" name="search" id="search" placeholder="Buscar" />
            </form>
            @if ($operabilities->count() > 0)
                <div class="overflow-y-auto text-center h-min-screen-75" >
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
                                        <a href="{{ route('operability.edit', ['operability' => $operability->id]) }}"
                                            type="button"
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
                @if ($search)
                <section class="flex flex-col justify-center">
                    <h3 class="text-center font-semibold mt-1 text-2xl">{{ __('No se han encontrado resultados para tu búsqueda') }}</h3>
                    <svg class="max-h-72 -mt-20 mx-auto animated" id="freepik_stories-400-error-bad-request" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><style>svg#freepik_stories-400-error-bad-request:not(.animated) .animable {opacity: 0;}svg#freepik_stories-400-error-bad-request.animated #freepik--question-marks--inject-18 {animation: 1.5s Infinite  linear floating;animation-delay: 0s;}svg#freepik_stories-400-error-bad-request.animated #freepik--Character--inject-18 {animation: 1.5s Infinite  linear floating;animation-delay: 0s;}            @keyframes floating {                0% {                    opacity: 1;                    transform: translateY(0px);                }                50% {                    transform: translateY(-10px);                }                100% {                    opacity: 1;                    transform: translateY(0px);                }            }        .animator-hidden { display: none; }</style><g id="freepik--background-complete--inject-18" class="animable animator-hidden" style="transform-origin: 250px 211.568px;"><rect y="382.4" width="500" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 250px 382.525px;" id="elc8687edxlff" class="animable"></rect><rect x="416.78" y="398.49" width="33.12" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 433.34px 398.615px;" id="el70a1w3ps1ko" class="animable"></rect><rect x="260.33" y="395.36" width="12.89" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 266.775px 395.485px;" id="el4ev5ifiy7xn" class="animable"></rect><rect x="322.53" y="396.42" width="27.14" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 336.1px 396.545px;" id="eltwmtxx3svzh" class="animable"></rect><rect x="359.67" y="389.21" width="56.11" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 387.725px 389.335px;" id="el93r876soxsc" class="animable"></rect><rect x="52.46" y="400.78" width="26.53" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 65.725px 400.905px;" id="eli83z9sue41b" class="animable"></rect><rect x="87.89" y="400.78" width="23" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 99.39px 400.905px;" id="eleb97hqowgve" class="animable"></rect><rect x="131" y="395.24" width="60.81" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 161.405px 395.365px;" id="ell6gnlpg165n" class="animable"></rect><path d="M237,337.8H43.91a5.71,5.71,0,0,1-5.7-5.71V60.66A5.71,5.71,0,0,1,43.91,55H237a5.71,5.71,0,0,1,5.71,5.71V332.09A5.71,5.71,0,0,1,237,337.8ZM43.91,55.2a5.46,5.46,0,0,0-5.45,5.46V332.09a5.46,5.46,0,0,0,5.45,5.46H237a5.47,5.47,0,0,0,5.46-5.46V60.66A5.47,5.47,0,0,0,237,55.2Z" style="fill: rgb(235, 235, 235); transform-origin: 140.46px 196.4px;" id="elzfggku5tssq" class="animable"></path><path d="M453.31,337.8H260.21a5.72,5.72,0,0,1-5.71-5.71V60.66A5.72,5.72,0,0,1,260.21,55h193.1A5.71,5.71,0,0,1,459,60.66V332.09A5.71,5.71,0,0,1,453.31,337.8ZM260.21,55.2a5.47,5.47,0,0,0-5.46,5.46V332.09a5.47,5.47,0,0,0,5.46,5.46h193.1a5.47,5.47,0,0,0,5.46-5.46V60.66a5.47,5.47,0,0,0-5.46-5.46Z" style="fill: rgb(235, 235, 235); transform-origin: 356.75px 196.4px;" id="el5lari3mzl2" class="animable"></path><path d="M467.06,194.17a53.79,53.79,0,0,0-1-33,46.49,46.49,0,0,0-21-69.85A80.24,80.24,0,0,0,318.17,37.61a41,41,0,0,0-70.69,27.93,61.91,61.91,0,0,0-35.12,100.65,46.59,46.59,0,0,0,27.83,67.36,46.39,46.39,0,0,0,24.11.46,71.94,71.94,0,0,0,96.82,18.46c7.53,17.49,13.71,43.73.4,69.46,48.35-4.74,83.26-51.11,76.14-93.6A54,54,0,0,0,467.06,194.17Z" style="fill: rgb(235, 235, 235); transform-origin: 336.092px 172.018px;" id="el6qorqfvn254" class="animable"></path><path d="M374.32,312.33a1,1,0,0,1-.71-.29,1,1,0,0,1-.25-1c6.81-23.72.6-46.46-5.8-61.36l-3.25-7.55-6.94,4.41A64.92,64.92,0,0,1,270,229.9l-2.78-3.83-4.58,1.14a39.56,39.56,0,0,1-44.12-57.63l2.33-4.22-3.11-3.68A54.91,54.91,0,0,1,248.86,72.4l5.56-1.12.06-5.66a34,34,0,0,1,58.63-23.18l4.24,4.44,5-3.62a73.23,73.23,0,0,1,115.85,49l.57,4,3.79,1.5a39.47,39.47,0,0,1,17.81,59.33l-2.06,2.95,1.21,3.4A47.07,47.07,0,0,1,434.74,222l-4.87,2.24.89,5.28c3,18.13-2.43,37.93-15,54.33a81.06,81.06,0,0,1-41.18,28.47A.9.9,0,0,1,374.32,312.33Zm-9.55-72.65a1,1,0,0,1,.29,0,1,1,0,0,1,.62.56l3.71,8.62c6.38,14.83,12.55,37.29,6.37,60.93a79.13,79.13,0,0,0,38.43-27.24c12.22-16,17.54-35.2,14.6-52.78l-1-6a1,1,0,0,1,.56-1.08l5.56-2.55a45.05,45.05,0,0,0,23.69-56l-1.38-3.88a1,1,0,0,1,.13-.91l2.35-3.38a37.46,37.46,0,0,0-16.9-56.32l-4.34-1.72a1,1,0,0,1-.62-.79l-.65-4.61A71.21,71.21,0,0,0,323.49,44.87L317.82,49a1,1,0,0,1-1.31-.11l-4.85-5.07a32.15,32.15,0,0,0-23.16-9.9,32,32,0,0,0-32,31.71l-.07,6.48a1,1,0,0,1-.8,1l-6.35,1.28a52.91,52.91,0,0,0-30,86l3.55,4.21a1,1,0,0,1,.11,1.13l-2.66,4.82a38,38,0,0,0-3.26,7.81,37.59,37.59,0,0,0,45.15,46.91l5.24-1.3a1,1,0,0,1,1.05.38l3.17,4.37a62.87,62.87,0,0,0,84.71,16.15l7.93-5A1,1,0,0,1,364.77,239.68Z" style="fill: rgb(255, 255, 255); transform-origin: 336.135px 170.706px;" id="elywzbjwjnjr" class="animable"></path><path d="M304.19,146.19,277.39,142l.41-2.68a33.61,33.61,0,0,1,3.28-10.87,25,25,0,0,1,5.84-7.08q3.61-3,15.72-10.26c4.29-2.52,6.64-5.06,7-7.65a8,8,0,0,0-1.35-6.39c-1.3-1.67-3.51-2.75-6.61-3.23a11.31,11.31,0,0,0-8.81,2q-3.8,2.81-6,10.92l-26.84-7.65q3.76-14.87,14.76-22.59t30.74-4.64q15.38,2.39,23.83,10.28,11.48,10.68,9.23,25.14a22.65,22.65,0,0,1-5.11,11q-4.18,5.06-15.67,11.5-8,4.55-10.4,7.67A18.73,18.73,0,0,0,304.19,146.19ZM275.36,149l28.71,4.47-3.94,25.32-28.71-4.47Z" style="fill: rgb(255, 255, 255); transform-origin: 299.494px 124.896px;" id="el0trk9umdusge" class="animable"></path><path d="M372.59,185.42l-14.88-12,1.21-1.49a23.85,23.85,0,0,1,5.85-5.47,17.83,17.83,0,0,1,6.07-2.25,103.76,103.76,0,0,1,13.24-.69q5.26,0,7-2.17a5.56,5.56,0,0,0,1.44-4.38,7,7,0,0,0-2.89-4.32,7.94,7.94,0,0,0-6.09-1.88q-3.32.36-7.53,4.53l-13.67-14.19q7.56-7.74,17-8.55t20.42,8.07q8.54,6.91,10.89,14.73,3.22,10.59-3.27,18.61a16,16,0,0,1-7,4.94q-4.35,1.59-13.64,1.46c-4.33,0-7.35.28-9.07,1A13.4,13.4,0,0,0,372.59,185.42ZM354,176.91l15.94,12.91-11.39,14.06L342.61,191Z" style="fill: rgb(255, 255, 255); transform-origin: 377.164px 168.186px;" id="el76w5sjw43td" class="animable"></path><path d="M376.75,98.8,370.31,90l.88-.65a13.82,13.82,0,0,1,4-2.16,10,10,0,0,1,3.67-.35,56.9,56.9,0,0,1,7.38,1.54c1.94.5,3.33.44,4.18-.18a3.21,3.21,0,0,0,1.43-2.2,4,4,0,0,0-1-2.8,4.57,4.57,0,0,0-3.08-1.92c-1.25-.18-2.85.28-4.8,1.4l-5.47-9.79a15.14,15.14,0,0,1,10.61-2.24q5.32.93,10.07,7.4,3.69,5.06,3.86,9.69a10.9,10.9,0,0,1-4.51,9.78A9.09,9.09,0,0,1,393,99.22a23.06,23.06,0,0,1-7.72-1.17,14.7,14.7,0,0,0-5.14-.78A7.6,7.6,0,0,0,376.75,98.8Zm-9-7.38,6.9,9.42-8.31,6.08-6.9-9.41Z" style="fill: rgb(255, 255, 255); transform-origin: 380.76px 88.6905px;" id="elncsm4kf2zpp" class="animable"></path><path d="M128.34,223.57a46.93,46.93,0,0,1-24-6.65c-10.15-6-17.32-15.42-19.76-25.79a29.06,29.06,0,0,1-27-27.46A24.6,24.6,0,0,1,52,158.32,25,25,0,0,1,54.2,125a42.76,42.76,0,0,1,51.66-51.36,22.26,22.26,0,0,1,38-4.69,22.5,22.5,0,0,1,2.75,4.6,33.16,33.16,0,0,1,37,42.7,25.16,25.16,0,0,1-12.36,44,38.05,38.05,0,0,1-13.54,20.4,38.47,38.47,0,0,1-29.79,7.58c-.1,9.71,2.15,22.88,13,32.3a.8.8,0,0,1,.25.76.77.77,0,0,1-.55.58A44.1,44.1,0,0,1,128.34,223.57ZM95.73,74a41.22,41.22,0,0,0-39.9,51.07.77.77,0,0,1-.23.76,23.44,23.44,0,0,0-2.41,31.55,23.68,23.68,0,0,0,5.66,5.23.79.79,0,0,1,.36.62A27.49,27.49,0,0,0,85.3,189.6a.78.78,0,0,1,.72.62c2.21,10.17,9.2,19.41,19.16,25.35a44.63,44.63,0,0,0,33.63,5.14c-10.73-10-12.73-23.66-12.47-33.46a.8.8,0,0,1,.93-.76,36.84,36.84,0,0,0,42.56-27.16.77.77,0,0,1,.65-.59,23.59,23.59,0,0,0,11.69-41.64.78.78,0,0,1-.25-.85,31.59,31.59,0,0,0-35.69-41.07.78.78,0,0,1-.87-.47,20.69,20.69,0,0,0-38.31.13.8.8,0,0,1-.92.47A41.73,41.73,0,0,0,95.73,74Z" style="fill: rgb(230, 230, 230); transform-origin: 119.561px 141.939px;" id="elcawnd0dkz9f" class="animable"></path><path d="M100.59,140l-13.81,3.25-.32-1.38a17.34,17.34,0,0,1-.55-5.92,13,13,0,0,1,1.43-4.57,76.09,76.09,0,0,1,5.6-8.07c1.59-2.07,2.23-3.76,1.91-5.09a4.13,4.13,0,0,0-1.91-2.83,5.15,5.15,0,0,0-3.84-.27,5.91,5.91,0,0,0-3.87,2.71c-.86,1.41-1.11,3.56-.76,6.47L70,125.84A19.75,19.75,0,0,1,72.66,112q3.81-5.91,14-8.3,7.92-1.87,13.57.29,7.66,2.91,9.42,10.37a11.74,11.74,0,0,1-.3,6.36q-1,3.27-5.33,8.66-3,3.78-3.53,5.76A9.83,9.83,0,0,0,100.59,140Zm-13.42,7,14.8-3.48L105,156.56,90.25,160Z" style="fill: rgb(235, 235, 235); transform-origin: 89.8255px 131.416px;" id="elg0fow5mvbzv" class="animable"></path><path d="M135.75,110.79l-9.58-2.92.29-1a12.46,12.46,0,0,1,1.76-3.81,9.1,9.1,0,0,1,2.5-2.28A52.81,52.81,0,0,1,137,97.89q2.55-1,3-2.43a2.92,2.92,0,0,0-.16-2.41,3.68,3.68,0,0,0-2.25-1.53,4.19,4.19,0,0,0-3.32.29,7.18,7.18,0,0,0-2.76,3.68l-9.42-4.19a13.94,13.94,0,0,1,6.56-7.49q4.42-2.27,11.48-.11a16.11,16.11,0,0,1,8.18,5,9.94,9.94,0,0,1,2.08,9.66,8.35,8.35,0,0,1-2.44,3.78,21.52,21.52,0,0,1-6.33,3.4,13.78,13.78,0,0,0-4.2,2.26A7,7,0,0,0,135.75,110.79Zm-10.68-.47,10.26,3.12-2.75,9.06-10.27-3.12Z" style="fill: rgb(235, 235, 235); transform-origin: 136.474px 102.573px;" id="eluomiuyl906" class="animable"></path></g><g id="freepik--Shadow--inject-18" class="animable animator-active animator-hidden" style="transform-origin: 250px 416.24px;"><ellipse id="freepik--path--inject-18" cx="250" cy="416.24" rx="193.89" ry="11.32" style="fill: rgb(245, 245, 245); transform-origin: 250px 416.24px;" class="animable"></ellipse></g><g id="freepik--question-marks--inject-18" class="animable" style="transform-origin: 131.624px 260.025px;"><path d="M157.61,247.44l-.92-.39a18,18,0,0,0,1.45-5l1,.11A18.94,18.94,0,0,1,157.61,247.44ZM157.22,236a13.33,13.33,0,0,0-10.43-7.77l.16-1a14.31,14.31,0,0,1,11.18,8.35Z" style="fill: rgb(64, 123, 255); transform-origin: 152.965px 237.335px;" id="el2x0z2jddr5o" class="animable"></path><path d="M152,257.5,142.14,262l-.44-1a13.27,13.27,0,0,1-1.29-4.33,10,10,0,0,1,.39-3.64,58.94,58.94,0,0,1,3-6.86q1.32-2.67.67-4.09a3.16,3.16,0,0,0-1.85-1.83,4,4,0,0,0-2.91.37,4.56,4.56,0,0,0-2.49,2.61q-.65,1.75.4,4.94L127,251.49a15,15,0,0,1,0-10.75q2-5,9.22-8.27c3.76-1.72,7.16-2.31,10.19-1.8a10.78,10.78,0,0,1,8.57,6.35,9,9,0,0,1,.72,4.8,23,23,0,0,1-2.7,7.26,14.49,14.49,0,0,0-1.78,4.83A7.49,7.49,0,0,0,152,257.5Zm-9,7.24L153.54,260l4.23,9.29L147.23,274Z" style="fill: rgb(64, 123, 255); transform-origin: 141.887px 252.247px;" id="elgjm5z34oc2t" class="animable"></path><path d="M127.64,279.73l-5,6.8L122,286a10.64,10.64,0,0,1-2.53-2.47,7.67,7.67,0,0,1-1.11-2.63,42.47,42.47,0,0,1-.57-5.81c-.08-1.55-.45-2.56-1.1-3a2.46,2.46,0,0,0-2-.55,3.08,3.08,0,0,0-1.84,1.36,3.54,3.54,0,0,0-.71,2.72,6.09,6.09,0,0,0,2.15,3.22l-6,6.31a11.79,11.79,0,0,1-4.11-7.32q-.55-4.14,3.14-9.15a13.64,13.64,0,0,1,6.26-5.09,8.39,8.39,0,0,1,8.26,1.06,7,7,0,0,1,2.32,3,18.12,18.12,0,0,1,.92,6,11.36,11.36,0,0,0,.62,4A5.76,5.76,0,0,0,127.64,279.73Zm-3.37,8.36,5.36-7.28,6.42,4.73-5.36,7.28Z" style="fill: rgb(64, 123, 255); transform-origin: 120.079px 277.887px;" id="elxp4sze5pg6k" class="animable"></path></g><g id="freepik--Character--inject-18" class="animable" style="transform-origin: 239.996px 295.775px;"><path d="M234.09,412.64a4.5,4.5,0,0,1-4-2.43c-4-7.76-9.07-16.87-18.15-26.73a4.45,4.45,0,0,1-1-4.28c3.37-11.71,8.67-27.72,8.72-27.88a4.49,4.49,0,1,1,8.52,2.82c-.05.15-4.62,13.94-7.93,25.15a126.54,126.54,0,0,1,17.82,26.8,4.5,4.5,0,0,1-4,6.55Z" style="fill: rgb(64, 123, 255); transform-origin: 224.661px 380.366px;" id="el1uue85cmkzp" class="animable"></path><polygon points="241.56 416.24 206.77 416.24 225.21 405.78 240.66 406.38 241.56 416.24" style="fill: rgb(38, 50, 56); transform-origin: 224.165px 411.01px;" id="el5glzy14lja6" class="animable"></polygon><g id="elbh4hyzyn0i8"><ellipse cx="230.8" cy="350.34" rx="30.04" ry="24.9" style="fill: rgb(38, 50, 56); transform-origin: 230.8px 350.34px; transform: rotate(-17.36deg);" class="animable"></ellipse></g><path d="M151.65,334a4.49,4.49,0,0,1-1.72-8.63,5,5,0,0,0,3-3.77,4.48,4.48,0,0,1,3.67-4,33.55,33.55,0,0,0,3.3-.85c6.08-1.77,13.61-4,37.31,2.66,23.38-13.07,23.65-37.59,23.65-38.65a4.5,4.5,0,0,1,4.47-4.5h0a4.49,4.49,0,0,1,4.49,4.45c0,1.31-.14,32.09-30,47.5a4.45,4.45,0,0,1-3.3.32c-22.6-6.52-29-4.66-34.07-3.17l-1.38.4a13.83,13.83,0,0,1-7.64,7.89A4.51,4.51,0,0,1,151.65,334Z" style="fill: rgb(38, 50, 56); transform-origin: 188.499px 305.13px;" id="elqh3542xt0qg" class="animable"></path><path d="M204.08,301.89c-8.51-33.82-31.18-121.06,41.47-126.39,65.18-4.79,83.06,82,87.41,112a351.65,351.65,0,0,1,3.54,45.82,33.29,33.29,0,0,1-26.76,33c-35.51,7.22-69.11,8.24-91.75-.69a14.86,14.86,0,0,1-9.23-15.21C209.63,340.74,209.65,324,204.08,301.89Z" style="fill: rgb(64, 123, 255); transform-origin: 265.225px 273.671px;" id="elki0yahcc50n" class="animable"></path><g id="el77brhm3uk26"><path d="M333,287.52c-4.1-28.32-20.22-107-76.66-112a16.39,16.39,0,0,0-16.07,8.51c-2.52,4.88-2.44,10.79,1.33,16.64C254,220,283.67,286.67,279.19,323c-2,16.53-12.41,29.73-3.39,48.31a291.16,291.16,0,0,0,33.94-5,33.29,33.29,0,0,0,26.76-33A351.65,351.65,0,0,0,333,287.52Z" style="opacity: 0.1; transform-origin: 287.524px 273.373px;" class="animable"></path></g><path d="M323.24,333.79a.45.45,0,0,1-.45-.44,348.57,348.57,0,0,0-3.53-45.76c-10.8-74.66-39.87-112.41-84.1-109.15a.45.45,0,0,1-.48-.42.46.46,0,0,1,.42-.48c44.75-3.3,74.17,34.72,85,109.92a352.14,352.14,0,0,1,3.54,45.88.45.45,0,0,1-.45.45Z" style="fill: rgb(38, 50, 56); transform-origin: 279.16px 255.566px;" id="elwg2zh1fuuuq" class="animable"></path><g id="el2m8b3flw9b8"><ellipse cx="315.12" cy="352.73" rx="30.04" ry="24.9" style="fill: rgb(38, 50, 56); transform-origin: 315.12px 352.73px; transform: rotate(-17.36deg);" class="animable"></ellipse></g><path d="M325.3,412.64a4.49,4.49,0,0,1-4-2.43c-4-7.76-9.07-16.87-18.16-26.73a4.5,4.5,0,0,1-1-4.28c3.38-11.71,8.67-27.72,8.73-27.88a4.48,4.48,0,1,1,8.51,2.82c-.05.15-4.61,13.94-7.92,25.15a126.07,126.07,0,0,1,17.81,26.8,4.5,4.5,0,0,1-4,6.55Z" style="fill: rgb(64, 123, 255); transform-origin: 315.864px 380.439px;" id="elyvdyu7q31yo" class="animable"></path><path d="M315.88,275.91a4.49,4.49,0,0,1-2.1-8.46h0c.86-.46,20.39-11.13,25.87-36.77-13-5.44-36.42-17.73-41.54-23.91a4.62,4.62,0,0,1-1-2.08,22.37,22.37,0,0,1,1-11l-2.36-4.56a4.49,4.49,0,0,1,8-4.12l3.39,6.56A4.46,4.46,0,0,1,307,196a11,11,0,0,0-1.12,5.91c5.77,5.21,29,17.54,40.43,21.77a4.48,4.48,0,0,1,2.87,4.89c-5.07,32.77-30.14,46.27-31.2,46.83A4.48,4.48,0,0,1,315.88,275.91Z" style="fill: rgb(38, 50, 56); transform-origin: 322.242px 229.24px;" id="elkgzy6lcu5lp" class="animable"></path><path d="M301.57,206.15a2.25,2.25,0,0,1-1.88-3.47c.16-.24,3.86-5.83,9.5-7.34a2.24,2.24,0,1,1,1.16,4.33c-3.93,1.06-6.88,5.42-6.9,5.46A2.24,2.24,0,0,1,301.57,206.15Z" style="fill: rgb(38, 50, 56); transform-origin: 305.674px 200.706px;" id="elsrg2vie6st8" class="animable"></path><polygon points="332.77 416.24 297.98 416.24 316.42 405.78 331.87 406.38 332.77 416.24" style="fill: rgb(38, 50, 56); transform-origin: 315.375px 411.01px;" id="eljet4u5acg9o" class="animable"></polygon><g id="elobtesgiftw9"><ellipse cx="258.01" cy="260.82" rx="23.92" ry="21.53" style="fill: rgb(255, 255, 255); transform-origin: 258.01px 260.82px; transform: rotate(-5.06deg);" class="animable"></ellipse></g><g id="elzcepacsqvuq"><ellipse cx="252.18" cy="262.92" rx="6.57" ry="11.96" style="fill: rgb(38, 50, 56); transform-origin: 252.18px 262.92px; transform: rotate(-15.9deg);" class="animable"></ellipse></g><path d="M230.8,264.86c15.1-1.94,45-10.47,49.93-13.91-3.88-11.36-22-21.08-38.12-15.6C228,240.28,230.8,264.86,230.8,264.86Z" style="fill: rgb(38, 50, 56); transform-origin: 255.658px 249.319px;" id="elzklf7r9un5" class="animable"></path><path d="M233.73,272.16c18.75-3.56,43.12-9.54,50.09-13.37-.43,12.22-4,24.61-23.12,28.8C245.06,291,233.73,272.16,233.73,272.16Z" style="fill: rgb(38, 50, 56); transform-origin: 258.775px 273.396px;" id="elsko7ll6cq6j" class="animable"></path><g id="elibd55kocwst"><ellipse cx="208.01" cy="268.36" rx="14.72" ry="18.63" style="fill: rgb(255, 255, 255); transform-origin: 208.01px 268.36px; transform: rotate(-33.49deg);" class="animable"></ellipse></g><path d="M208.34,268.68c1.13,5.36.15,9.83-2.2,10s-5.17-4.06-6.31-9.42-.15-9.82,2.19-10S207.2,263.32,208.34,268.68Z" style="fill: rgb(38, 50, 56); transform-origin: 204.083px 268.97px;" id="elzp5b2ssky2" class="animable"></path><path d="M189.75,266.63c10.13,1.19,30.25-.14,33.59-2C220.87,255,208.89,244,198,245.4,188.18,246.66,189.75,266.63,189.75,266.63Z" style="fill: rgb(38, 50, 56); transform-origin: 206.499px 256.181px;" id="ell1b0rbqec4m" class="animable"></path><path d="M191.63,272.94c12.59.57,29,.25,33.68-1.52-.43,9.61-2.95,18.77-15.81,18.62C199,289.92,191.63,272.94,191.63,272.94Z" style="fill: rgb(38, 50, 56); transform-origin: 208.47px 280.731px;" id="elh984of154ir" class="animable"></path><path d="M264.09,229.3A56.43,56.43,0,0,1,232,219.5a4.48,4.48,0,0,1,5.41-7.15,49,49,0,0,0,35.84,7.11,4.48,4.48,0,1,1,1.67,8.81A58.41,58.41,0,0,1,264.09,229.3Z" style="fill: rgb(38, 50, 56); transform-origin: 254.398px 220.372px;" id="el2ydjadjk60t" class="animable"></path><path d="M183.88,221.57a4.5,4.5,0,0,1-4.22-6c2.37-6.62,6.32-10.91,11.72-12.77,9.78-3.37,20.32,3.18,20.77,3.46a4.49,4.49,0,0,1-4.78,7.6c-2-1.27-8.37-4.21-13.1-2.57-2.72.95-4.74,3.34-6.17,7.32A4.49,4.49,0,0,1,183.88,221.57Z" style="fill: rgb(38, 50, 56); transform-origin: 196.789px 211.704px;" id="elfv3v10ozpk" class="animable"></path><path d="M219.23,297.25a1.19,1.19,0,0,1-.37-.06,1.33,1.33,0,0,1-.92-1.64,8.74,8.74,0,0,1,4.56-4.93c5.14-2.65,13-2.1,23.31,1.63a1.34,1.34,0,0,1,.8,1.73,1.33,1.33,0,0,1-1.72.8c-11.83-4.28-18-3.36-21-1.82a6.25,6.25,0,0,0-3.32,3.33A1.35,1.35,0,0,1,219.23,297.25Z" style="fill: rgb(38, 50, 56); transform-origin: 232.293px 293.112px;" id="el3h9istp594b" class="animable"></path><path d="M176.88,292.32a119.22,119.22,0,0,0-44.78,13.15c7.72-1.46,35.35,32.73,42.45,59.09,13.11-4.85,28.39-8.16,44.68-10.75C209.36,326.64,191.31,295.85,176.88,292.32Z" style="fill: rgb(64, 123, 255); transform-origin: 175.665px 328.44px;" id="elho04vqtnsu4" class="animable"></path><g id="elzycgwj7k4xq"><path d="M176.88,292.32a119.22,119.22,0,0,0-44.78,13.15c7.72-1.46,35.35,32.73,42.45,59.09,13.11-4.85,28.39-8.16,44.68-10.75C209.36,326.64,191.31,295.85,176.88,292.32Z" style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 175.665px 328.44px;" class="animable"></path></g><path d="M176.88,292.32c-17.08-1.93-44.81,12.37-44.81,12.37-4.91,3.13-3.58,9-.9,11.49,2.57-3.69,31.23-13.29,42-14.58C167.82,296.64,172.8,293,176.88,292.32Z" style="fill: rgb(64, 123, 255); transform-origin: 152.826px 304.16px;" id="elmratmffdb9g" class="animable"></path><g id="eleuxvgw94okq"><path d="M176.88,292.32c-17.08-1.93-44.81,12.37-44.81,12.37-4.91,3.13-3.58,9-.9,11.49,2.57-3.69,31.23-13.29,42-14.58C167.82,296.64,172.8,293,176.88,292.32Z" style="fill: rgb(255, 255, 255); opacity: 0.2; transform-origin: 152.826px 304.16px;" class="animable"></path></g><path d="M151.66,334a4.52,4.52,0,0,1-3.77-2c-3.25-5-1.22-12.59-.78-14.07a4.49,4.49,0,0,1,8.6,2.56c-.73,2.51-.88,5.72-.3,6.6a4.49,4.49,0,0,1-1.31,6.21A4.38,4.38,0,0,1,151.66,334Z" style="fill: rgb(38, 50, 56); transform-origin: 151.108px 324.446px;" id="elxcwwrn8ublr" class="animable"></path></g><g id="freepik--error-400--inject-18" class="animable animator-hidden" style="transform-origin: 250.435px 128.563px;"><path d="M136.33,137.94H121.19v-6.83l15.14-18h7.24V131.5h3.75v6.44h-3.75v5.59h-7.24Zm0-6.44v-9.41l-8,9.41Z" style="fill: rgb(64, 123, 255); transform-origin: 134.255px 128.32px;" id="ely3ppvkzcmlk" class="animable"></path><path d="M149.91,128.46q0-8.52,3.07-11.93t9.35-3.41a13.92,13.92,0,0,1,5,.75,9.19,9.19,0,0,1,3.16,1.93,10.55,10.55,0,0,1,1.93,2.51,13.28,13.28,0,0,1,1.13,3.07,28.57,28.57,0,0,1,.83,7q0,8.13-2.75,11.91T162.11,144a13.31,13.31,0,0,1-6.1-1.2,9.93,9.93,0,0,1-3.82-3.53,13.29,13.29,0,0,1-1.68-4.52A30.94,30.94,0,0,1,149.91,128.46Zm8.24,0q0,5.72,1,7.8a3.17,3.17,0,0,0,2.93,2.09,3,3,0,0,0,2.19-.89,5.44,5.44,0,0,0,1.36-2.8,28.82,28.82,0,0,0,.44-6c0-4-.33-6.64-1-8a3.22,3.22,0,0,0-3-2,3.08,3.08,0,0,0-3,2.09Q158.16,122.82,158.15,128.48Z" style="fill: rgb(64, 123, 255); transform-origin: 162.145px 128.562px;" id="elgfbgfi2savu" class="animable"></path><path d="M177.77,128.46q0-8.52,3.07-11.93t9.35-3.41a13.92,13.92,0,0,1,5,.75,9.19,9.19,0,0,1,3.16,1.93,10.29,10.29,0,0,1,1.93,2.51,13.28,13.28,0,0,1,1.13,3.07,28.57,28.57,0,0,1,.84,7q0,8.13-2.76,11.91T190,144a13.31,13.31,0,0,1-6.1-1.2,9.83,9.83,0,0,1-3.81-3.53,13.08,13.08,0,0,1-1.69-4.52A30.94,30.94,0,0,1,177.77,128.46Zm8.24,0q0,5.72,1,7.8a3.17,3.17,0,0,0,2.93,2.09,3,3,0,0,0,2.19-.89,5.52,5.52,0,0,0,1.37-2.8,29.55,29.55,0,0,0,.44-6q0-6-1-8a3.24,3.24,0,0,0-3-2,3.09,3.09,0,0,0-3,2.09Q186,122.82,186,128.48Z" style="fill: rgb(64, 123, 255); transform-origin: 190.01px 128.562px;" id="eli6aale1seop" class="animable"></path><path d="M220.89,113.63h24.76V120h-15.5v4.76h14.38v6.1H230.15v5.89H246.1v6.77H220.89Z" style="fill: rgb(38, 50, 56); transform-origin: 233.495px 128.575px;" id="elqv8sb1hnmr" class="animable"></path><path d="M251.2,143.53v-29.9h15.4a22.37,22.37,0,0,1,6.55.74,6.91,6.91,0,0,1,3.65,2.72,8.43,8.43,0,0,1-2.6,12.06,11.28,11.28,0,0,1-3.24,1.19,8.81,8.81,0,0,1,2.4,1.1,9,9,0,0,1,1.48,1.57,11.39,11.39,0,0,1,1.3,1.86l4.47,8.66H270.17l-4.94-9.14a6.84,6.84,0,0,0-1.67-2.3,3.89,3.89,0,0,0-2.26-.69h-.82v12.13Zm9.28-17.78h3.9a14.16,14.16,0,0,0,2.44-.41,2.46,2.46,0,0,0,1.5-.94,3,3,0,0,0-.33-4,5.64,5.64,0,0,0-3.45-.77h-4.06Z" style="fill: rgb(38, 50, 56); transform-origin: 265.905px 128.573px;" id="elkpf4c4hdphk" class="animable"></path><path d="M283.69,143.53v-29.9h15.4a22.32,22.32,0,0,1,6.55.74,6.91,6.91,0,0,1,3.65,2.72,8.45,8.45,0,0,1-2.59,12.06,11.24,11.24,0,0,1-3.25,1.19,6.19,6.19,0,0,1,3.88,2.67,11.39,11.39,0,0,1,1.3,1.86l4.47,8.66H302.66l-4.94-9.14a6.84,6.84,0,0,0-1.67-2.3,3.89,3.89,0,0,0-2.26-.69H293v12.13ZM293,125.75h3.9a14.16,14.16,0,0,0,2.44-.41,2.41,2.41,0,0,0,1.5-.94,3,3,0,0,0-.33-4,5.6,5.6,0,0,0-3.45-.77H293Z" style="fill: rgb(38, 50, 56); transform-origin: 298.395px 128.573px;" id="elnn3vsi6bbnf" class="animable"></path><path d="M314.18,128.6q0-7.32,4.08-11.4t11.36-4.08q7.47,0,11.51,4t4,11.23A18.32,18.32,0,0,1,343.4,137a12.54,12.54,0,0,1-5.1,5.23A16.86,16.86,0,0,1,330,144a19.18,19.18,0,0,1-8.37-1.61,12.6,12.6,0,0,1-5.38-5.1A16.94,16.94,0,0,1,314.18,128.6Zm9.24,0q0,4.53,1.69,6.51a6.35,6.35,0,0,0,9.18,0q1.63-1.94,1.64-7,0-4.21-1.71-6.17a5.83,5.83,0,0,0-4.62-1.94,5.59,5.59,0,0,0-4.48,2C324,123.41,323.42,125.6,323.42,128.64Z" style="fill: rgb(38, 50, 56); transform-origin: 329.66px 128.568px;" id="el4arl205aug4" class="animable"></path><path d="M350.27,143.53v-29.9h15.39a22.32,22.32,0,0,1,6.55.74,6.87,6.87,0,0,1,3.65,2.72,8.2,8.2,0,0,1,1.39,4.84,8.34,8.34,0,0,1-1.06,4.3,8.25,8.25,0,0,1-2.92,2.92,11.28,11.28,0,0,1-3.24,1.19,8.81,8.81,0,0,1,2.4,1.1,9.36,9.36,0,0,1,1.48,1.57,11.19,11.19,0,0,1,1.29,1.86l4.48,8.66H369.24l-4.94-9.14a7,7,0,0,0-1.67-2.3,3.92,3.92,0,0,0-2.27-.69h-.81v12.13Zm9.28-17.78h3.89a14.23,14.23,0,0,0,2.45-.41,2.46,2.46,0,0,0,1.5-.94,2.74,2.74,0,0,0,.58-1.73,2.77,2.77,0,0,0-.92-2.23,5.6,5.6,0,0,0-3.45-.77h-4.05Z" style="fill: rgb(38, 50, 56); transform-origin: 364.975px 128.573px;" id="el0a18lzrq16wb" class="animable"></path></g><g id="freepik--bad-request--inject-18" class="animable animator-hidden" style="transform-origin: 251.03px 88.9689px;"><path d="M162.29,97V74.74h8.36a10.3,10.3,0,0,1,4.09.68,5.23,5.23,0,0,1,2.42,2.08,5.53,5.53,0,0,1,.88,2.94,5,5,0,0,1-.78,2.69,5.61,5.61,0,0,1-2.34,2,5.82,5.82,0,0,1,3.11,2,5.43,5.43,0,0,1,1.08,3.37,6.48,6.48,0,0,1-.66,2.91,5.63,5.63,0,0,1-1.63,2.08,6.78,6.78,0,0,1-2.44,1.1,14.78,14.78,0,0,1-3.59.37Zm3-12.92h4.82a10.44,10.44,0,0,0,2.81-.26,3.12,3.12,0,0,0,1.69-1.1,3.22,3.22,0,0,0,.57-1.95,3.52,3.52,0,0,0-.53-2,2.66,2.66,0,0,0-1.52-1.16,12.63,12.63,0,0,0-3.39-.31h-4.45Zm0,10.29h5.55a13,13,0,0,0,2-.1,4.78,4.78,0,0,0,1.7-.61,3.25,3.25,0,0,0,1.13-1.24,3.92,3.92,0,0,0,.44-1.88,3.65,3.65,0,0,0-.64-2.16,3.25,3.25,0,0,0-1.77-1.29,10.85,10.85,0,0,0-3.26-.38h-5.15Z" style="fill: rgb(38, 50, 56); transform-origin: 170.701px 85.8663px;" id="elobxmptlszsp" class="animable"></path><path d="M193.36,95a10.44,10.44,0,0,1-2.93,1.83,8.56,8.56,0,0,1-3,.53,5.83,5.83,0,0,1-4.08-1.3,4.27,4.27,0,0,1-1.43-3.32A4.5,4.5,0,0,1,183.85,89a6.45,6.45,0,0,1,2-.9,19.45,19.45,0,0,1,2.43-.41,25.08,25.08,0,0,0,4.88-.94c0-.38,0-.61,0-.72a3,3,0,0,0-.77-2.35,4.58,4.58,0,0,0-3.12-.93,4.87,4.87,0,0,0-2.85.68A4.18,4.18,0,0,0,185,85.85l-2.67-.36a6.59,6.59,0,0,1,1.2-2.78A5.3,5.3,0,0,1,186,81.09a10.84,10.84,0,0,1,3.67-.57A9.81,9.81,0,0,1,193,81a4.44,4.44,0,0,1,1.9,1.23,4.32,4.32,0,0,1,.85,1.86,15.39,15.39,0,0,1,.14,2.52v3.65a38.26,38.26,0,0,0,.17,4.82,6.17,6.17,0,0,0,.69,1.94H193.9A5.81,5.81,0,0,1,193.36,95Zm-.23-6.11a20,20,0,0,1-4.47,1,10.61,10.61,0,0,0-2.39.54,2.5,2.5,0,0,0-1.08.89,2.43,2.43,0,0,0,.45,3.13,3.62,3.62,0,0,0,2.43.73,5.66,5.66,0,0,0,2.81-.7,4.28,4.28,0,0,0,1.81-1.89,6.69,6.69,0,0,0,.44-2.74Z" style="fill: rgb(38, 50, 56); transform-origin: 189.334px 88.9446px;" id="el9v3i8mba8qh" class="animable"></path><path d="M210.61,97V95a5,5,0,0,1-4.52,2.4,6.32,6.32,0,0,1-3.54-1.07,6.93,6.93,0,0,1-2.51-3,10.14,10.14,0,0,1-.89-4.38,11.63,11.63,0,0,1,.8-4.39,6.35,6.35,0,0,1,2.42-3,6.46,6.46,0,0,1,3.6-1,5.37,5.37,0,0,1,2.6.61,5.49,5.49,0,0,1,1.86,1.61v-8h2.72V97ZM202,89a7,7,0,0,0,1.31,4.63,3.92,3.92,0,0,0,3.08,1.54,3.87,3.87,0,0,0,3.05-1.47,6.74,6.74,0,0,0,1.25-4.47,7.63,7.63,0,0,0-1.27-4.87,3.94,3.94,0,0,0-3.15-1.55,3.82,3.82,0,0,0-3,1.49A7.39,7.39,0,0,0,202,89Z" style="fill: rgb(38, 50, 56); transform-origin: 206.149px 86.093px;" id="el02y6ammeunb6" class="animable"></path><path d="M226.49,97V74.74h9.88a13.13,13.13,0,0,1,4.53.6,5,5,0,0,1,2.48,2.12,6.3,6.3,0,0,1,.93,3.36,5.6,5.6,0,0,1-1.54,4A7.75,7.75,0,0,1,238,86.88,7.75,7.75,0,0,1,239.81,88a15.2,15.2,0,0,1,2.45,3L246.13,97h-3.71l-2.95-4.63c-.86-1.34-1.57-2.36-2.12-3.07a6.67,6.67,0,0,0-1.5-1.49,4.48,4.48,0,0,0-1.35-.6,9,9,0,0,0-1.64-.1h-3.42V97Zm2.95-12.45h6.34a9.48,9.48,0,0,0,3.16-.41,3.43,3.43,0,0,0,1.74-1.34,3.65,3.65,0,0,0,.59-2,3.32,3.32,0,0,0-1.15-2.6,5.36,5.36,0,0,0-3.62-1h-7.06Z" style="fill: rgb(38, 50, 56); transform-origin: 236.31px 85.8639px;" id="el5lgvyw6kc4a" class="animable"></path><path d="M259.63,91.83l2.83.34A6.88,6.88,0,0,1,260,96a8.4,8.4,0,0,1-10.24-.81,8.56,8.56,0,0,1-2.07-6.12,8.9,8.9,0,0,1,2.1-6.32,7.08,7.08,0,0,1,5.44-2.25,6.91,6.91,0,0,1,5.29,2.2,8.8,8.8,0,0,1,2.05,6.2c0,.16,0,.41,0,.73h-12A6.25,6.25,0,0,0,252,93.72a4.46,4.46,0,0,0,3.37,1.42,4.16,4.16,0,0,0,2.57-.79A5.31,5.31,0,0,0,259.63,91.83Zm-9-4.43h9a5.49,5.49,0,0,0-1-3.05,4.18,4.18,0,0,0-3.39-1.58A4.34,4.34,0,0,0,252.07,84,5,5,0,0,0,250.65,87.4Z" style="fill: rgb(38, 50, 56); transform-origin: 255.129px 88.932px;" id="elazywa5h1x6w" class="animable"></path><path d="M276.18,103.21v-7.9a5,5,0,0,1-1.78,1.49,5.32,5.32,0,0,1-2.44.59,6.45,6.45,0,0,1-4.95-2.3,9,9,0,0,1-2.08-6.29,10.8,10.8,0,0,1,.85-4.36,6.31,6.31,0,0,1,2.45-2.93,6.53,6.53,0,0,1,3.51-1A5.42,5.42,0,0,1,276.46,83V80.88h2.46v22.33Zm-8.43-14.3a7.15,7.15,0,0,0,1.3,4.67,4,4,0,0,0,3.14,1.56,3.84,3.84,0,0,0,3-1.48,6.78,6.78,0,0,0,1.27-4.51,7.58,7.58,0,0,0-1.33-4.85A4,4,0,0,0,272,82.67a3.76,3.76,0,0,0-3,1.52A7.36,7.36,0,0,0,267.75,88.91Z" style="fill: rgb(38, 50, 56); transform-origin: 271.918px 91.8588px;" id="el7w9se4dsob5" class="animable"></path><path d="M293.78,97V94.65a5.89,5.89,0,0,1-5.12,2.74,6.48,6.48,0,0,1-2.67-.55,4.37,4.37,0,0,1-1.83-1.37,5,5,0,0,1-.85-2,14,14,0,0,1-.17-2.56v-10h2.74v9a16,16,0,0,0,.17,2.89,2.83,2.83,0,0,0,1.09,1.7,3.41,3.41,0,0,0,2.07.61,4.51,4.51,0,0,0,2.31-.63,3.49,3.49,0,0,0,1.53-1.72,8.54,8.54,0,0,0,.45-3.15V80.88h2.73V97Z" style="fill: rgb(38, 50, 56); transform-origin: 289.683px 89.1359px;" id="elp9nxfqlvsln" class="animable"></path><path d="M311.57,91.83l2.83.34A6.93,6.93,0,0,1,311.92,96a8.4,8.4,0,0,1-10.24-.81,8.56,8.56,0,0,1-2.07-6.12,8.94,8.94,0,0,1,2.09-6.32,7.12,7.12,0,0,1,5.45-2.25,6.91,6.91,0,0,1,5.29,2.2,8.8,8.8,0,0,1,2.05,6.2c0,.16,0,.41,0,.73h-12a6.2,6.2,0,0,0,1.51,4.07,4.44,4.44,0,0,0,3.37,1.42,4.16,4.16,0,0,0,2.57-.79A5.31,5.31,0,0,0,311.57,91.83Zm-9-4.43h9a5.49,5.49,0,0,0-1-3.05,4.2,4.2,0,0,0-3.39-1.58A4.34,4.34,0,0,0,304,84,5,5,0,0,0,302.59,87.4Z" style="fill: rgb(38, 50, 56); transform-origin: 307.05px 88.9322px;" id="elxpxz4u797ua" class="animable"></path><path d="M316.74,92.21l2.7-.43a3.8,3.8,0,0,0,1.27,2.49,4.43,4.43,0,0,0,2.91.87,4.29,4.29,0,0,0,2.8-.77,2.28,2.28,0,0,0,.91-1.8,1.68,1.68,0,0,0-.8-1.46,12.38,12.38,0,0,0-2.8-.93,24.64,24.64,0,0,1-4.17-1.31,4,4,0,0,1-2.37-3.7,4.15,4.15,0,0,1,.5-2A4.47,4.47,0,0,1,319,81.64a5.89,5.89,0,0,1,1.74-.8,8.59,8.59,0,0,1,2.37-.32,9.41,9.41,0,0,1,3.33.54,4.49,4.49,0,0,1,2.12,1.49,5.79,5.79,0,0,1,1,2.5l-2.68.36a2.91,2.91,0,0,0-1.06-2,3.88,3.88,0,0,0-2.47-.69,4.46,4.46,0,0,0-2.69.62,1.82,1.82,0,0,0-.8,1.46,1.55,1.55,0,0,0,.33,1,2.47,2.47,0,0,0,1.05.73c.27.1,1.08.33,2.42.69a34.72,34.72,0,0,1,4.05,1.27,4.16,4.16,0,0,1,1.8,1.44,4,4,0,0,1,.65,2.34,4.63,4.63,0,0,1-.79,2.58A5.22,5.22,0,0,1,327,96.73a8.38,8.38,0,0,1-3.4.66,7.6,7.6,0,0,1-4.8-1.31A6,6,0,0,1,316.74,92.21Z" style="fill: rgb(38, 50, 56); transform-origin: 323.451px 88.9627px;" id="elpwmgf5pnsng" class="animable"></path><path d="M339.37,94.58l.4,2.41a9.75,9.75,0,0,1-2.07.25,4.57,4.57,0,0,1-2.31-.48,2.64,2.64,0,0,1-1.16-1.23,10,10,0,0,1-.33-3.23V83h-2V80.88h2v-4l2.72-1.64v5.64h2.75V83h-2.75v9.44a5,5,0,0,0,.14,1.5,1.23,1.23,0,0,0,.47.54,1.86,1.86,0,0,0,.94.19A9,9,0,0,0,339.37,94.58Z" style="fill: rgb(38, 50, 56); transform-origin: 335.835px 86.2436px;" id="eln8slr7s1av" class="animable"></path></g><defs>     <filter id="active" height="200%">         <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>                <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>        <feMerge>            <feMergeNode in="OUTLINE"></feMergeNode>            <feMergeNode in="SourceGraphic"></feMergeNode>        </feMerge>    </filter>    <filter id="hover" height="200%">        <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>                <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>        <feMerge>            <feMergeNode in="OUTLINE"></feMergeNode>            <feMergeNode in="SourceGraphic"></feMergeNode>        </feMerge>            <feColorMatrix type="matrix" values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 "></feColorMatrix>    </filter></defs></svg>
                </section>
                @else
                <p class="text-center font-semibold mt-12 text-2xl">{{ __('No hay ubicaciones cargadas') }}</p>
                @endif
            @endif

        </section>
        @endif




        <section id="sectionMap" class="w-full h-screen-4rem z-0" wire:ignore>
            <div id="map" class="h-full"></div>
        </section>
    </div>

    {{-- <i class="far fa-lightbulb"></i> --}}
    @section('scripts')
        <script src="{{ asset('js/leaflet.js') }}"></script>
        <script>
            function ubicationDelete(latitude, longitude) {
                // Encontrar la capa de marcador correspondiente a las coordenadas especificadas
                map.eachLayer(function(layer) {
                    if (layer instanceof L.Marker && layer.getLatLng().equals([latitude, longitude])) {
                        // Eliminar la capa de marcador correspondiente
                        map.removeLayer(layer);
                        layer.remove();
                        map.on('zoomend', function() {
                            // Verificar si el marcador eliminado sigue en el mapa
                            if (map.hasLayer(layer)) {
                                // Eliminar el marcador del mapa
                                map.removeLayer(layer);

                                // Eliminar el marcador del DOM
                                layer.remove();
                            }
                        });
                    }
                });
            }
        </script>
        <script>
            let foundIcon;
            let foundLocation;
            let map;
            let locations;
            let sectionMap;
            let markers = [];
            if (map) {
                map.off();
                map.remove();
                for (var i = 0; i < markers.length; i++) {
                    map.removeLayer(markers[i]);
                }
                markers = [];
                locations = [];
            }
            map = L.map('map', {
                zoomControl: false
            }).setView([10.0545284, -69.3390881], 20.75);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            L.control.zoom({
                zoomInTitle: 'Acercar',
                zoomOutTitle: 'Alejar'
            }).addTo(map);
            locations = [{
                coords: [10.0545284, -69.3390881],
                icon: L.divIcon({
                    className: 'my-icon-green',
                    html: '<i class="fas fa-building"></i>',
                    iconSize: [30, 30],
                    iconAnchor: [5, 20],
                    popupAnchor: [0, -30]
                }),
                popupContent: '<h2 class="uppercase font-bold">Sede Principal de Hidrolara</h2> <p>Municipio: Iribarren</p><p>Parroquia: Concepción</p>'
            }, ];
            <?php foreach ($operabilities as $operability) { ?>
            foundIcon = L.divIcon({
                className: '{{ $operability->operability_type_id == 1 ? 'my-icon-green' : ($operability->operability_type_id == 3 ? 'my-icon-red' : 'my-icon-yellow') }}',
                html: '{!! $operability->icon !!}',
                iconSize: [30, 30],
                iconAnchor: [5, 20],
                popupAnchor: [0, -30]
            });
            foundLocation = {
                coords: [<?php echo $operability->latitude; ?>, <?php echo $operability->longitude; ?>],
                icon: foundIcon,
                popupContent: '<h2 class="font-bold uppercase text-center">{{ $operability->details }}</h2> <p>Municipio: {{$operability->municipality}}</p> <p>Parroquia: {{$operability->parish}}</p><p class="capitalize">Sector: {{$operability->sector}}</p><p class="capitalize">Capacidad: {{$operability->capacity}} litros</p> <p class="capitalize">Caudal: {{$operability->flow}} litros</p><p class="capitalize">Estatus: {{$operability->operability_type}}</p><p>Motivo: {{$operability->status_description}}</p>'
            };
            locations.push(foundLocation);
            <?php }?>

            for (var i = 0; i < locations.length; i++) {
                let marker = L.marker(locations[i].coords, {
                        icon: locations[i].icon
                    }).addTo(map)
                    .bindPopup(locations[i].popupContent,{ closeButton: false });
                markers.push(marker);
                marker.on('mouseover', function(e) {
                    this.openPopup();
                });
                marker.on('mouseout', function(e) {
                    this.closePopup();
                });
            }

            map.on('zoomend', function() {
                let currentZoom = map.getZoom();
                let desiredZoom = 9; // Nivel de zoom deseado

                if (currentZoom < desiredZoom) {
                    for (let i = 0; i < markers.length; i++) {
                        map.removeLayer(markers[i]);
                    }
                } else {
                    for (let i = 0; i < markers.length; i++) {
                        markers[i].addTo(map);
                    }
                }
            });
        </script>
    @endsection
</div>
