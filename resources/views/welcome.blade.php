@extends('layouts.template')

@section('content')
<head>
    @vite('resources/css/app.css')
</head>
<div>
    <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">      
        <dl class="mt-6 grid grid-cols-1 gap-4 sm:mt-8 sm:grid-cols-2 lg:grid-cols-4">
          <div class="flex flex-col rounded-lg bg-blue-50 px-4 py-8 text-center">
            <dt class="order-last text-lg font-medium text-gray-500">Prodi</dt>
      
            <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">$4.8m</dd>
          </div>
      
          <div class="flex flex-col rounded-lg bg-blue-50 px-4 py-8 text-center">
            <dt class="order-last text-lg font-medium text-gray-500">Mahasiswa</dt>
      
            <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">24</dd>
          </div>
      
          <div class="flex flex-col rounded-lg bg-blue-50 px-4 py-8 text-center">
            <dt class="order-last text-lg font-medium text-gray-500">Personil Akademik</dt>
      
            <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">86</dd>
          </div>
      
          <div class="flex flex-col rounded-lg bg-blue-50 px-4 py-8 text-center">
            <dt class="order-last text-lg font-medium text-gray-500">Downloads</dt>
      
            <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">86k</dd>
          </div>
        </dl>
      </div>
</div>
@endsection
