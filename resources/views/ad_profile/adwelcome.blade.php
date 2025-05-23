@extends('layouts.main')

@section('content')
@include('layout.header')

<body>
    <div class="container mx-auto py-12 space-y-8">

        @php
            $firstCard = $cards->first();
            $otherCards = $cards->skip(1);
        @endphp

        {{-- Card pertama dengan layout khusus --}}
        @if ($firstCard)
        <section class="bg-white py-16 px-6 rounded-lg shadow-md" id="card-{{ $firstCard->id }}">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-10">
                {{-- Text Section --}}
                <div class="md:w-1/2">
                    <h1 class="text-5xl font-bold text-blue-700 leading-tight mb-6">
                        {!! $firstCard->title !!}
                    </h1>
                    <p class="text-gray-600 mb-6 whitespace-pre-line text-justify">
                        {!! e($firstCard->text) !!}
                    </p>
                    <a href="{{ route('profiles') }}"
                        class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md shadow hover:bg-blue-700 transition duration-300">
                        About us
                    </a>

                    <div class="mt-6">
<a href="{{ route('adwelcome.create', ['after' => $firstCard->id]) }}" class="inline-block bg-green-600 text-white px-6 py-3 rounded-md shadow hover:bg-green-700 transition duration-300">
    Tambah Card
</a>

                        <a href="{{ route('adwelcome.edit', $firstCard->id) }}"
                            class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md shadow hover:bg-blue-700 transition duration-300">
                            Edit
                        </a>
                    </div>
                </div>

                {{-- Image Section --}}
                <div class="md:w-1/2">
                    @if ($firstCard->image)
                        <img src="{{ asset($firstCard->image) }}" alt="Card Image" class="rounded-xl shadow-lg w-full object-cover" />
                    @else
                        <img src="{{ asset('img/placeholder.png') }}" alt="Placeholder" class="rounded-xl shadow-lg w-full object-cover" />
                    @endif
                </div>
            </div>
        </section>
        @endif

        {{-- Loop cards selain yang pertama --}}
        @foreach ($otherCards as $card)
            <div id="card-{{ $card->id }}" class="border p-6 rounded-lg shadow-md flex flex-col space-y-4">

<x-card-section
    :layout="$card->layout"
    :textAlign="$card->text_align ?? 'left'"
    :title="$card->title"
    :text="$card->text"
    :image="$card->image ? asset('storage/' . $card->image) : null"
/>


                <div class="flex justify-between mt-4 px-2">
<a href="{{ route('adwelcome.create', ['after' => $card->id]) }}" class="inline-block bg-green-600 text-white px-6 py-3 rounded-md shadow hover:bg-green-700 transition duration-300">
    Tambah Card
</a>

                    <a href="{{ route('adwelcome.edit', $card->id) }}"
                       class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md shadow hover:bg-blue-700 transition duration-300">
                        Edit
                    </a>

                    <form action="{{ route('adwelcome.destroy', $card->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus card ini?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 text-white px-6 py-3 rounded-md shadow hover:bg-red-700 transition duration-300">
                            Hapus
                        </button>
                    </form>
                </div>

            </div>
        @endforeach

    </div>
</body>

@include('layout.footer')
@endsection
