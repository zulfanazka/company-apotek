@include('layout.header')
<section class="bg-white py-16 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-5xl md:text-5xl font-bold text-blue-700 leading-tight mb-3">
            Semua Obat yang<br />Anda Butuhkan, Ada di Sini
        </h2>
        <p class="text-gray-500 mb-12">Jaminan Ketersediaan Obat yang Lengkap Setiap Saat</p>
    </div>

    <!-- GENERIK -->
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-10">
        <div class="md:w-1/2">
            <img src="img/generik.png" alt="Produk Obat" class="rounded-xl shadow-lg w-full object-cover" />
        </div>
        <div class="md:w-1/2">
            <h2 class="text-5xl font-bold text-blue-700 leading-tight mb-4">GENERIK</h2>
            <p class="text-gray-700 text-sm leading-relaxed">
                Ada dua jenis obat generik, yaitu obat generik bermerek dagang dan obat generik berlogo yang
                dipasarkan dengan
                merek kandungan zat aktifnya. Kami memproduksi 200 produk generik berlogo dengan merek Kimia Farma
                seperti
                Paracetamol, Amoxicillin dan Omeprazole.
            </p>
        </div>
    </div>

    <!-- OTC & HERBAL -->
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-10 mt-20">
        <div class="md:w-1/2">
            <h2 class="text-5xl font-bold text-blue-700 leading-tight mb-4">OTC & HERBAL</h2>
            <p class="text-gray-700 text-sm leading-relaxed">
                Melalui produk OTC & Herbal seperti Fituno, kami membantu meningkatkan kekebalan tubuh. Produk OTC &
                Herbal
                lainnya juga dapat membantu menjaga kesehatan Anda seperti Enkasari dan Batugin.
            </p>
        </div>
        <div class="md:w-1/2">
            <img src="img/otc.png" alt="Produk Obat" class="rounded-xl shadow-lg w-full object-cover" />
        </div>
    </div>

    <!-- ETIKAL -->
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-10 mt-20">
        <div class="md:w-1/2">
            <img src="img/etikal.png" alt="Produk Obat" class="rounded-xl shadow-lg w-full object-cover" />
        </div>
        <div class="md:w-1/2">
            <h2 class="text-5xl font-bold text-blue-700 leading-tight mb-4">ETIKAL</h2>
            <p class="text-gray-700 text-sm leading-relaxed">
                Obat Etikal ditandai dengan lingkaran berwarna merah dan bergaris tepi hitam dengan tulisan K warna
                hitam di
                dalam lingkaran warna merah. Beberapa produk unggulan seperti Lipidef, Merokaf, Avicov Favipiravir,
                Tecavir,
                Alergine, Kimoxil, Loprezol, Rahistin, Kifarox, dan Protofen.
            </p>
        </div>
    </div>
</section>
@include('layout.footer')