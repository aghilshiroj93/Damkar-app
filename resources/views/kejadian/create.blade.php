{{-- resources/views/kejadian/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Buat Kejadian')

@section('content')
    <div class="container mx-auto p-4 max-w-3xl">
        <h1 class="text-2xl font-semibold mb-4">Buat Kejadian Baru</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php
            $action = route('kejadian.store');
            $method = 'POST';
        @endphp

        @include('kejadian._form', ['action' => $action, 'method' => $method])
    </div>
@endsection
