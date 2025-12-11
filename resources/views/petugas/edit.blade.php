@extends('layouts.app')

@section('title', 'Edit Petugas')

@section('content')
    <div class="max-w-xl mx-auto">
        <h2 class="text-2xl font-semibold mb-4">Edit Petugas</h2>

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
            $action = route('petugas.update', $petugas);
            $method = 'PUT';
        @endphp

        @include('petugas._form', ['action' => $action, 'method' => $method, 'petugas' => $petugas])
    </div>
@endsection
