@include('layout.header')
<body>
    <section class="bg-white py-16 px-6">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-10">
            <!-- Text Section -->
            <div class="md:w-1/2">
                <h1 class="text-5xl font-bold text-blue-700 leading-tight mb-6">
                    Berikan yang<br />
                    Terbaik untuk<br />
                    Kesehatan Anda
                </h1>
                <p class="text-gray-600 mb-6">
                    Apotek Kami adalah tujuan utama Anda untuk kesehatan yang lebih baik. Kami menyediakan berbagai
                    macam obat-obatan dan produk kesehatan dengan harga terjangkau dan layanan yang ramah.
                </p>
                <a href="{{ route('profiles') }}"
                    class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md shadow hover:bg-blue-700 transition duration-300">
                    About us
                </a>
            </div>

            <!-- Image Section -->
            <div class="md:w-1/2">
                <img src="img/klinik.png" alt="Apotek" class="rounded-xl shadow-lg w-full object-cover" />
            </div>
        </div>
    </section>
    <section class="bg-white py-16 px-6">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-10">
            <!-- Image Section -->
            <div class="md:w-1/2">
                <img src="img/obat.png" alt="Produk Obat" class="rounded-xl shadow-lg w-full object-cover" />
            </div>

            <!-- Text Section -->
            <div class="md:w-1/2">
                <h2 class="text-5xl font-bold text-blue-700 leading-tight mb-4">
                    Solusi kesehatan<br />lengkap,dari kami<br />untuk Anda
                </h2>
                <p class="text-gray-600 mb-6">
                    Apotek kami menyediakan obat lengkap untuk segala kebutuhan kesehatan Anda
                </p>
                <hr class="mb-6 border-gray-200" />
                <ul class="space-y-4 text-gray-800">
                    <li class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Generik
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        OTC & Herbal
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Etikal
                    </li>
                </ul>
            </div>
        </div>
    </section>
</body>
@include('layout.footer')
