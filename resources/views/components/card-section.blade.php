<div class="card-section {{ $layout }}">
    {{-- Isi konten card --}}
    <h2>{!! $title !!}</h2>
    <p>{!! $text !!}</p>
    @if($image)
        <img src="{{ $image }}" alt="Card Image" class="w-full rounded" />
    @endif
</div>
