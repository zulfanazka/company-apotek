@props([
    'layout' => 'text-left',
    'textAlign' => 'left', // default left
    'title',
    'text' => null,
    'image' => null,
])

@php
    $textAlignClass = match($textAlign) {
        'left' => 'text-left',
        'center' => 'text-center',
        'right' => 'text-right',
        'justify' => 'text-justify',
        default => 'text-left',
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
                <img src="{{ $image }}" alt="Card Image" class="max-w-full h-auto rounded-lg shadow-md" />
            </div>
        @endif

@elseif($layout === 'text-right')
    @if($image)
        <div class="w-full md:w-1/2">
            <img src="{{ $image }}" alt="Card Image" class="w-full h-auto rounded-lg shadow-md" />
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
            <div class="w-full md:w-1/2">
                <img src="{{ $image }}" alt="Card Image" class="w-full h-auto rounded-lg shadow-md" />
            </div>
        @endif
    @endif

</div>
