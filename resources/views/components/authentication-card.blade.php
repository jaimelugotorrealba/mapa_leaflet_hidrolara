<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

    <div class="flex flex-col justify-center items-center gap-3">
        {{ $logo }}
        <section class="mt-3">
            <h1 class="font-bold text-2xl text-center aplication-title">Sistema Digital de Gestión Hídrica</h1>
        </section>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
