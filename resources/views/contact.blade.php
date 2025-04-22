@include('layout.header')
<section class="bg-white py-12 px-4">
    <h2 class="text-3xl font-bold text-center text-blue-600 mb-10">Hubungi Kami</h2>
  
    <!-- Google Maps Embed -->
    <div class="max-w-5xl mx-auto mb-12">
      <iframe 
        class="w-full h-[400px] rounded-lg shadow-md"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.0198623722574!2d-122.41941518468157!3d37.774929279759834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858064d6c1784d%3A0x4e81b781c7e91bb1!2sSan+Francisco%2C+CA!5e0!3m2!1sen!2sus!4v1614112077379!5m2!1sen!2sus"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  
    <!-- Info Apotek -->
    <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
      <!-- Apotek Item -->
      <div>
        <h3 class="font-semibold text-gray-900 text-lg mb-2">Apotek Rajawali 1</h3>
        <p class="text-sm text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
        <div class="text-sm text-gray-700 space-y-2">
          <p><i class="fas fa-envelope text-blue-500 mr-2"></i>apotek@gmail.com</p>
          <p><i class="fas fa-phone text-blue-500 mr-2"></i>12345678910</p>
        </div>
      </div>
  
      <!-- Copy & Update for Apotek 2-4 -->
      <div>
        <h3 class="font-semibold text-gray-900 text-lg mb-2">Apotek Rajawali 2</h3>
        <p class="text-sm text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
        <div class="text-sm text-gray-700 space-y-2">
          <p><i class="fas fa-envelope text-blue-500 mr-2"></i>apotek@gmail.com</p>
          <p><i class="fas fa-phone text-blue-500 mr-2"></i>12345678910</p>
        </div>
      </div>
  
      <div>
        <h3 class="font-semibold text-gray-900 text-lg mb-2">Apotek Rajawali 3</h3>
        <p class="text-sm text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
        <div class="text-sm text-gray-700 space-y-2">
          <p><i class="fas fa-envelope text-blue-500 mr-2"></i>apotek@gmail.com</p>
          <p><i class="fas fa-phone text-blue-500 mr-2"></i>12345678910</p>
        </div>
      </div>
  
      <div>
        <h3 class="font-semibold text-gray-900 text-lg mb-2">Apotek Rajawali 4</h3>
        <p class="text-sm text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
        <div class="text-sm text-gray-700 space-y-2">
          <p><i class="fas fa-envelope text-blue-500 mr-2"></i>apotek@gmail.com</p>
          <p><i class="fas fa-phone text-blue-500 mr-2"></i>12345678910</p>
        </div>
      </div>
    </div>
  </section>
@include('layout.footer')