@include('layout.header')

<body>
    <div class="container mx-auto py-12 space-y-12">

        @php
            $firstCard = $cards->first();
            $otherCards = $cards->skip(1);
        @endphp

        @if ($firstCard)
            @php
                $fitMode = $firstCard->fit_mode ?? 'contain';
                $fitClass = match($fitMode) {
                    'cover' => 'object-cover',
                    'contain' => 'object-contain',
                    'original' => '',
                    default => 'object-contain',
                };
            @endphp

            <section class="py-12 px-6">
                <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-10">

                    @php
                        $isTextOnly = $firstCard->layout === 'text-only';
                        $isImageOnly = $firstCard->layout === 'image-only';
                        $isTextRight = $firstCard->layout === 'text-right';
                    @endphp

                    @if($isTextOnly)
                        <div class="w-full text-{{ $firstCard->text_align }}">
                            <h2 class="text-5xl font-bold text-blue-700 mb-6 leading-tight">{!! $firstCard->title !!}</h2>
                            <p class="text-gray-600 whitespace-pre-line">{{ $firstCard->text }}</p>
                        </div>

                    @elseif($isImageOnly)
                        <div class="w-full flex justify-center" style="height: 384px; max-width: 100%;">
                            <img src="{{ $firstCard->image ? asset('storage/' . $firstCard->image) : asset('img/placeholder.png') }}"
                                 alt="Card Image"
                                 class="w-full h-full {{ $fitClass }} rounded-lg" />
                        </div>

                    @elseif($isTextRight)
                        <div class="w-full md:w-1/2 flex justify-center" style="height: 384px; max-width: 100%;">
                            <img src="{{ $firstCard->image ? asset('storage/' . $firstCard->image) : asset('img/placeholder.png') }}"
                                 alt="Card Image"
                                 class="w-full h-full {{ $fitClass }} rounded-lg" />
                        </div>

                        <div class="w-full md:w-1/2 text-{{ $firstCard->text_align }}">
                            <h2 class="text-5xl font-bold text-blue-700 mb-6 leading-tight">{!! $firstCard->title !!}</h2>
                            <p class="text-gray-600 whitespace-pre-line">{{ $firstCard->text }}</p>
                        </div>

                    @else {{-- text-left --}}
                        <div class="w-full md:w-1/2 text-{{ $firstCard->text_align }}">
                            <h2 class="text-5xl font-bold text-blue-700 mb-6 leading-tight">{!! $firstCard->title !!}</h2>
                            <p class="text-gray-600 whitespace-pre-line">{{ $firstCard->text }}</p>
                        </div>

                        <div class="w-full md:w-1/2 flex justify-center" style="height: 384px; max-width: 100%;">
                            <img src="{{ $firstCard->image ? asset('storage/' . $firstCard->image) : asset('img/placeholder.png') }}"
                                 alt="Card Image"
                                 class="w-full h-full {{ $fitClass }} rounded-lg" />
                        </div>
                    @endif

                </div>
            </section>
        @endif

        {{-- Loop kartu lainnya tanpa tombol About Us --}}
        @foreach ($otherCards as $card)
            @php
                $fitMode = $card->fit_mode ?? 'contain';
                $fitClass = match($fitMode) {
                    'cover' => 'object-cover',
                    'contain' => 'object-contain',
                    'original' => '',
                    default => 'object-contain',
                };

                $isTextOnly = $card->layout === 'text-only';
                $isImageOnly = $card->layout === 'image-only';
                $isTextRight = $card->layout === 'text-right';
            @endphp

            <section class="py-12 px-6">
                <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-10">

                    @if($isTextOnly)
                        <div class="w-full text-{{ $card->text_align }}">
                            <h2 class="text-5xl font-bold text-blue-700 mb-6 leading-tight">{!! $card->title !!}</h2>
                            <p class="text-gray-600 whitespace-pre-line">{{ $card->text }}</p>
                        </div>

                    @elseif($isImageOnly)
                        <div class="w-full flex justify-center" style="height: 384px; max-width: 100%;">
                            <img src="{{ $card->image ? asset('storage/' . $card->image) : asset('img/placeholder.png') }}"
                                 alt="Card Image"
                                 class="w-full h-full {{ $fitClass }} rounded-lg" />
                        </div>

                    @elseif($isTextRight)
                        <div class="w-full md:w-1/2 flex justify-center" style="height: 384px; max-width: 100%;">
                            <img src="{{ $card->image ? asset('storage/' . $card->image) : asset('img/placeholder.png') }}"
                                 alt="Card Image"
                                 class="w-full h-full {{ $fitClass }} rounded-lg" />
                        </div>

                        <div class="w-full md:w-1/2 text-{{ $card->text_align }}">
                            <h2 class="text-5xl font-bold text-blue-700 mb-6 leading-tight">{!! $card->title !!}</h2>
                            <p class="text-gray-600 whitespace-pre-line">{{ $card->text }}</p>
                        </div>

                    @else {{-- text-left --}}
                        <div class="w-full md:w-1/2 text-{{ $card->text_align }}">
                            <h2 class="text-5xl font-bold text-blue-700 mb-6 leading-tight">{!! $card->title !!}</h2>
                            <p class="text-gray-600 whitespace-pre-line">{{ $card->text }}</p>
                        </div>

                        <div class="w-full md:w-1/2 flex justify-center" style="height: 384px; max-width: 100%;">
                            <img src="{{ $card->image ? asset('storage/' . $card->image) : asset('img/placeholder.png') }}"
                                 alt="Card Image"
                                 class="w-full h-full {{ $fitClass }} rounded-lg" />
                        </div>
                    @endif

                </div>
            </section>
        @endforeach

    </div>
</body>

@include('layout.footer')
