{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

<x-layouts.dashboard>
    <h1 class="app-page-title">Selamat Datang</h1>

    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-6">
            <select class="form-select" aria-label="Default select example">
                @if (auth()->user()->hasRole('admin'))
                    <option selected>Semua Bulan</option>
                @endif
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
        </div>
        <div class="col-6 col-lg-6">
            <select class="form-select" aria-label="Default select example">
                <option selected>2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
                <option value="2030">2030</option>
            </select>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Total Anggaran</h4>
                    <h6 class="mt-4">{{ 'Rp 2.000.0000.000' }}</h6>
                </div>
                <a class="app-card-link-mask" href="#"></a>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Realisasi</h4>
                    @if (auth()->user()->hasRole('admin'))
                        <h6 class="mt-4">{{ 'Rp 1.500.0000.000' }}</h6>
                    @else
                        <h6 class="mt-4">{{ 'Rp 0' }}</h6>
                    @endif
                </div>
                <a class="app-card-link-mask" href="#"></a>
            </div>
        </div>

    </div>
</x-layouts.dashboard>
