@props([
    'layout' => 'text-left',
    'textAlign' => 'left',
    'title',
    'text' => null,
    'image' => null,
    'fitMode' => 'contain', // default
])
<div>DEBUG fitMode: {{ $fitMode }}</div>
@php
    $textAlignClass = match($textAlign) {
        'left' => 'text-left',
        'center' => 'text-center',
        'right' => 'text-right',
        'justify' => 'text-justify',
        default => 'text-left',
    };
@endphp
@php
    $fitClass = match($fitMode) {
        'cover' => 'object-cover',
        'contain' => 'object-contain',
        'original' => '',
        default => 'object-contain',
    };
@endphp
<div class="card flex flex-col md:flex-row items-center gap-6">

    @if($layout === 'text-only')
        <div class="w-full {{ $textAlignClass }}">
            <h2 class="text-5xl font-bold mb-4 leading-tight text-blue-700">{!! $title !!}</h2>
            @if($text)
                <p class="text-gray-700 whitespace-pre-line">{{ $text }}</p>
            @endif
        </div>

    @elseif($layout === 'image-only')
        @if($image)
            <div class="w-full flex justify-center">
                <img src="{{ $image }}" class="max-w-full max-h-72 {{ $fitClass }} rounded-lg shadow-md" />
            </div>
        @endif

    @elseif($layout === 'text-right')
        @if($image)
            <div class="w-full md:w-1/2 flex justify-center">
                <img src="{{ $image }}" class="max-w-full max-h-72 {{ $fitClass }} rounded-lg shadow-md" />
            </div>
        @endif

        <div class="w-full md:w-1/2 {{ $textAlignClass }}">
            <h2 class="text-5xl font-bold mb-4 leading-tight text-blue-700">{!! $title !!}</h2>
            @if($text)
                <p class="text-gray-700 whitespace-pre-line">{{ $text }}</p>
            @endif
        </div>

    @else
        <div class="w-full md:w-1/2 {{ $textAlignClass }}">
            <h2 class="text-5xl font-bold mb-4 leading-tight text-blue-700">{!! $title !!}</h2>
            @if($text)
                <p class="text-gray-700 whitespace-pre-line">{{ $text }}</p>
            @endif
        </div>

        @if($image)
            <div class="w-full md:w-1/2 flex justify-center">
                <img src="{{ $image }}" class="max-w-full max-h-72 {{ $fitClass }} rounded-lg shadow-md" />
            </div>
        @endif
    @endif

</div>
