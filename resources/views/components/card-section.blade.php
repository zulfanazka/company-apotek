@props([
    'title' => '',
    'text' => '',
    'image' => null,
    'layout' => 'text-left',  // pilihan: text-left, text-right, text-only, image-only
    'textAlign' => 'left'     // pilihan: left, center, right
])

@php
    $flexClass = match($layout) {
        'text-right' => 'md:flex-row-reverse',
        'text-left' => 'md:flex-row',
        'text-only' => 'flex-col',
        'image-only' => 'flex-col',
        default => 'md:flex-row',
    };

    $textAlignClass = match($textAlign) {
        'center' => 'text-center',
        'right' => 'text-right',
        default => 'text-left',
    };
@endphp

<section class="bg-white bg-opacity-30 backdrop-blur-md rounded-xl shadow-lg max-w-7xl mx-auto my-16 px-6 py-16">
    <div class="flex flex-col {{ $flexClass }} items-center gap-10">
        {{-- Text --}}
        @if(!in_array($layout, ['image-only']))
            <div class="md:w-1/2 {{ $textAlignClass }}">
                {{-- Judul bisa ada tag <br> --}}
                <h2 class="text-5xl font-bold text-blue-700 leading-tight mb-6">{!! $title !!}</h2>
                {{-- Isi teks --}}
                <p class="text-gray-600 mb-6">{!! $text !!}</p>
                {{-- Bisa tambah slot untuk tombol atau list jika perlu --}}
                {{ $slot }}
            </div>
        @endif

        {{-- Gambar --}}
        @if(!in_array($layout, ['text-only']) && $image)
            <div class="md:w-1/2">
                <img src="{{ $image }}" alt="Image" class="rounded-xl shadow-lg w-full object-cover" />
            </div>
        @endif
    </div>
</section>
