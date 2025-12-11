@extends('layouts.app')

@section('title', 'Tambah Petugas')

@section('content')
    <div class="max-w-xl mx-auto">
        <h2 class="text-2xl font-semibold mb-4">Tambah Petugas</h2>

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
            $action = route('petugas.store');
            $method = 'POST';
        @endphp

        @include('petugas._form', ['action' => $action, 'method' => $method])
    </div>
@endsection
