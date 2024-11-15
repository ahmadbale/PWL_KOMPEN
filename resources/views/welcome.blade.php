@extends('layouts.template')

@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Dashboard Akademik</h1>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @php
                $stats = [
                    ['title' => 'Prodi', 'value' => '12', 'icon' => 'graduation-cap', 'color' => 'blue', 'trend' => '+2 dari tahun lalu'],
                    ['title' => 'Mahasiswa', 'value' => '3,854', 'icon' => 'users', 'color' => 'green', 'trend' => '+12% pertumbuhan'],
                    ['title' => 'Personil Akademik', 'value' => '286', 'icon' => 'user-cog', 'color' => 'purple', 'trend' => '18 profesor baru'],
                    ['title' => 'Unduhan', 'value' => '86k', 'icon' => 'download', 'color' => 'orange', 'trend' => '+24% bulan ini'],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div class="overflow-hidden transition-all hover:shadow-lg bg-white rounded-lg">
                    <div class="border-b border-gray-200 bg-gray-50 p-4">
                        <h3 class="text-sm font-medium text-gray-500">{{ $stat['title'] }}</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-3xl font-extrabold text-gray-900">{{ $stat['value'] }}</p>
                                <p class="mt-1 text-sm text-gray-500">{{ $stat['trend'] }}</p>
                            </div>
                            <div class="rounded-full bg-{{ $stat['color'] }}-100 p-3">
                                <i class="fas fa-{{ $stat['icon'] }} text-{{ $stat['color'] }}-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Custom styles can be added here if needed */
    .bg-gradient-to-br {
        background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
    }
    .from-blue-50 {
        --tw-gradient-from: #eff6ff;
        --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(239, 246, 255, 0));
    }
    .to-indigo-100 {
        --tw-gradient-to: #e0e7ff;
    }
</style>
@endpush

@push('scripts')
<script>
    // Any custom JavaScript can be added here
</script>
@endpush