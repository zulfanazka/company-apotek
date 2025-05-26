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
                {{-- Link kembali ke list card --}}
                <a href="{{ route($routePrefix . '.index') }}" class="fw-bold text-dark">Card List</a>
            </li>
            <li class="breadcrumb-item active text-primary" aria-current="page">
                <strong>{{ isset($card) ? 'Edit Card' : 'Tambah Card' }}</strong>
            </li>
        </ol>
    </nav>

    <p class="text-muted">*Semua field wajib diisi kecuali ada keterangan</p>

    @if(isset($card))
        <form action="{{ route($routePrefix . '.update', $card->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form action="{{ route($routePrefix . '.store') }}" method="POST" enctype="multipart/form-data">
    @endif
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title (boleh pakai &lt;br&gt; untuk line break)</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                value="{{ old('title', isset($card) ? $card->title : '') }}"
                required
            >
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">Text</label>
            <textarea
                id="text"
                name="text"
                class="form-control"
                rows="4"
                required
            >{{ old('text', isset($card) ? $card->text : '') }}</textarea>
            @error('text')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3 flex flex-col md:flex-row md:space-x-6">
            <div class="flex-1 mb-4 md:mb-0">
                <label for="layout" class="form-label block mb-1">Layout</label>
                <select id="layout" name="layout" class="form-select w-full" required>
                    <option value="" hidden>- Pilih Layout -</option>
                    <option value="text-left" {{ old('layout', isset($card) ? $card->layout : '') == 'text-left' ? 'selected' : '' }}>Text Left</option>
                    <option value="text-right" {{ old('layout', isset($card) ? $card->layout : '') == 'text-right' ? 'selected' : '' }}>Text Right</option>
                    <option value="text-only" {{ old('layout', isset($card) ? $card->layout : '') == 'text-only' ? 'selected' : '' }}>Text Only</option>
                    <option value="image-only" {{ old('layout', isset($card) ? $card->layout : '') == 'image-only' ? 'selected' : '' }}>Image Only</option>
                </select>
                @error('layout')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="flex-1 mb-4 md:mb-0">
                <label for="text_align" class="form-label block mb-1">Text Alignment</label>
                <select id="text_align" name="text_align" class="form-select w-full" required>
                    <option value="left" {{ old('text_align', isset($card) ? $card->text_align : '') == 'left' ? 'selected' : '' }}>Left</option>
                    <option value="center" {{ old('text_align', isset($card) ? $card->text_align : '') == 'center' ? 'selected' : '' }}>Center</option>
                    <option value="right" {{ old('text_align', isset($card) ? $card->text_align : '') == 'right' ? 'selected' : '' }}>Right</option>
                    <option value="justify" {{ old('text_align', isset($card) ? $card->text_align : '') == 'justify' ? 'selected' : '' }}>Justify</option>
                </select>
                @error('text_align')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="flex-1">
                <label for="fit_mode" class="form-label block mb-1">Fit Mode Gambar</label>
                <select id="fit_mode" name="fit_mode" class="form-select w-full" required>
                    <option value="cover" {{ old('fit_mode', isset($card) ? $card->fit_mode : 'cover') == 'cover' ? 'selected' : '' }}>Cover</option>
                    <option value="contain" {{ old('fit_mode', isset($card) ? $card->fit_mode : 'cover') == 'contain' ? 'selected' : '' }}>Contain</option>
                    <option value="original" {{ old('fit_mode', isset($card) ? $card->fit_mode : 'cover') == 'original' ? 'selected' : '' }}>Original</option>
                </select>
                @error('fit_mode')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">
                Upload Gambar (jpg, png max 3MB)
                @if(isset($card) && $card->image)
                    <br><small>Gambar saat ini:</small><br>
                    <img src="{{ asset('storage/' . $card->image) }}" alt="Current Image" class="rounded mb-2" style="max-width: 200px;">
                    <br><small>Upload gambar baru untuk mengganti</small>
                @endif
            </label>
            <input
                type="file"
                id="image"
                name="image"
                class="form-control"
                accept="image/*"
                {{ isset($card) ? '' : 'required' }}
            >
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="text-end">
            <a href="{{ route($routePrefix . '.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">{{ isset($card) ? 'Update Card' : 'Simpan Card' }}</button>
            <input type="hidden" name="after_id" value="{{ $afterId ?? '' }}">
        </div>

    </form>
</div>
@endsection
