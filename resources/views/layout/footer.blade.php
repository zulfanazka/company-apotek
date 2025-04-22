<footer class="border-t py-10 bg-white">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-gray-600">

        <!-- Logo & Name -->
        <div class="flex flex-col items-start space-y-2">
            <img src="{{ asset('img/logo.png') }}" alt="Apotek Rajawali Logo" class="w-56 h-auto">
        </div>

        <!-- Contact Info -->
        <div class="flex flex-col space-y-2">
            <h2 class="font-semibold text-black">Apotek Rajawali</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
            <div class="flex items-center space-x-2">
                <i class="fas fa-envelope text-blue-500 w-5 h-5"></i>
                <span>Email : apotek@gmail.com</span>
            </div>
            <div class="flex items-center space-x-2">
                <i class="fas fa-phone text-blue-500 w-5 h-5"></i>
                <span>Phone : 12345678910</span>
            </div>
        </div>

        <!-- Company Links -->
        <div>
            <h2 class="font-semibold text-black mb-2">Company</h2>
            <ul class="space-y-1">
                <li><a href="{{ route('profiles') }}" class="hover:text-blue-600">Profile</a></li>
                <li><a href="{{ route('product') }}" class="hover:text-blue-600">Product</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-blue-600">Contact</a></li>
            </ul>
        </div>
    </div>
</footer>
