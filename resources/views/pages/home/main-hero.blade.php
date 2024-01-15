 {{-- hero banner --}}
 <div class="flex gap-8 items-center justify-center px-5 py-10 lg:p-5 bg-[#E3F0F6] rounded-xl">
     <div class="max-w-full text-center lg:max-w-xl lg:text-start">
         <h1 class="text-2xl md:text-3xl lg:text-5xl font-semibold mb-5">Temukan Event Menarik Dan Bermanfat, Atau Buat Dan
             Promosikan Eventmu Sendiri</h1>
         <div class="block sm:flex gap-3 mt:5 sm:mt-10 items-start justify-center lg:justify-start">
             <div>
                 <a class="py-2 px-5 border-2 border-black rounded text-lg md:text-xl text-black bg-[#E3F0F6]" href="{{ route('event.create') }}">Buat Event</a>

             </div>
             <div class="mt-5 sm:mt-0">
                 <a href="#eventPilihan"
                     class="py-2 px-5 border-2 border-black rounded text-lg md:text-xl text-gray-200 bg-gray-800">Telusuri
                     Event</a>
             </div>
         </div>
     </div>
     <div class="my-10 hidden lg:block">
         <img src="{{ asset('images/main/main-hero-illust.png') }}" alt=""
             class="rounded-lg min-w-[400px] min-h-[400px]">
     </div>
 </div>
