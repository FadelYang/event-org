 {{-- hero banner --}}
 <div class="flex gap-8 items-center justify-center px-5 py-10 lg:p-5 hero-banner rounded-xl">
     <div class="max-w-full text-center lg:max-w-xl lg:text-start">
         <h1 class="text-2xl md:text-3xl lg:text-5xl font-bold">Temukan Event Menarik Dan Bermanfat, Atau Buat Dan
             Promosikan Eventmu Sendiri</h1>
         <div class="block md:flex gap-3 mt-5 items-start justify-center lg:justify-start">
             <button class="py-2 px-5 border-2 border-black rounded text-lg md:text-xl text-gray-200">Buat Event</button>
             <button
                 class="mt-3 md:mt-0 py-2 px-5 border-2 border-black rounded text-lg md:text-xl text-gray-200 bg-gray-800">Telusuri
                 Event</button>
         </div>
     </div>
     <div class="my-10 hidden lg:block">
         <img src="{{ fake()->imageUrl($width = 400, $height = 400) }}" alt="" class="rounded-lg">
     </div>
 </div>
