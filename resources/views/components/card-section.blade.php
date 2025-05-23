@props([
    'layout' => 'text-left',
    'textAlign' => 'left',
    'title',
    'text' => null,
    'image' => null,
    'fitMode' => 'contain',
])

@php
    $textAlignClass = match($textAlign) {
        'left' => 'text-left',
        'center' => 'text-center',
        'right' => 'text-right',
        'justify' => 'text-justify',
        default => 'text-left',
    };

    $fitClass = match($fitMode) {
        'cover' => 'object-cover',
        'contain' => 'object-contain',
        'original' => '',
        default => 'object-contain',
    };
@endphp

<div class="card flex flex-col md:flex-row items-start gap-6">

    @if($layout === 'text-only')
        <div class="w-full {{ $textAlignClass }}">
            <h2 class="text-5xl font-bold mb-4 leading-tight text-blue-700">{!! $title !!}</h2>
            @if($text)
                <p class="text-gray-700 whitespace-pre-line">{{ $text }}</p>
            @endif
        </div>

    @elseif($layout === 'image-only')
        @if($image)
            <div class="w-full flex justify-center" style="height: 300px; max-width: 100%;">
                <img src="{{ $image }}" alt="Card Image" class="w-full h-full {{ $fitClass }} rounded-lg shadow-md" />
            </div>
        @endif

    @elseif($layout === 'text-right')
        @if($image)
            <div class="w-full md:w-1/2 flex justify-center" style="height: 300px; max-width: 100%;">
                <img src="{{ $image }}" alt="Card Image" class="w-full h-full {{ $fitClass }} rounded-lg shadow-md" />
            </div>
        @endif

        <div class="w-full md:w-1/2 {{ $textAlignClass }} flex flex-col">
            <h2 class="text-5xl font-bold mb-4 leading-tight text-blue-700">{!! $title !!}</h2>
            @if($text)
                <div class="flex-grow flex items-center">
                    <p class="text-gray-700 whitespace-pre-line">{{ $text }}</p>
                </div>
            @endif
        </div>

    @else {{-- text-left --}}
        <div class="w-full md:w-1/2 {{ $textAlignClass }} flex flex-col">
            <h2 class="text-5xl font-bold mb-4 leading-tight text-blue-700">{!! $title !!}</h2>
            @if($text)
                <div class="flex-grow flex items-center">
                    <p class="text-gray-700 whitespace-pre-line">{{ $text }}</p>
                </div>
            @endif
        </div>

        @if($image)
            <div class="w-full md:w-1/2 flex justify-center" style="height: 300px; max-width: 100%;">
                <img src="{{ $image }}" alt="Card Image" class="w-full h-full {{ $fitClass }} rounded-lg shadow-md" />
            </div>
        @endif
    @endif

</div>
