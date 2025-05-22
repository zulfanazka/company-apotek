@extends('layouts.main')

@section('content')
    <style>
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin: 0 20px;
            max-width: 700px;
        }

        .breadcrumb a {
            text-decoration: none;
        }
    </style>

    <div class="container">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('adwelcome.index') }}" class="fw-bold text-dark">Card List</a>
                </li>
                <li class="breadcrumb-item active text-primary" aria-current="page">
                    <strong>Tambah Card</strong>
                </li>
            </ol>
        </nav>

        <p class="text-muted">*Semua field wajib diisi kecuali ada keterangan</p>

        <form action="{{ route('adwelcome.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title (boleh pakai &lt;br&gt; untuk line break)</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">Text</label>
                <textarea id="text" name="text" class="form-control" rows="4" required>{{ old('text') }}</textarea>
                @error('text')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="layout" class="form-label">Layout</label>
                <select id="layout" name="layout" class="form-select" required>
                    <option value="" hidden>- Pilih Layout -</option>
                    <option value="text-left" {{ old('layout') == 'text-left' ? 'selected' : '' }}>Text Left</option>
                    <option value="text-right" {{ old('layout') == 'text-right' ? 'selected' : '' }}>Text Right</option>
                    <option value="text-only" {{ old('layout') == 'text-only' ? 'selected' : '' }}>Text Only</option>
                    <option value="image-only" {{ old('layout') == 'image-only' ? 'selected' : '' }}>Image Only</option>
                </select>
                @error('layout')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Gambar (jpg, png max 1MB)</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="text-end">
                <a href="{{ route('adwelcome.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan Card</button>
            </div>
        </form>
    </div>
@endsection
