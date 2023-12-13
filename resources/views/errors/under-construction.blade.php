<x-app-layout>
    <div class="flex flex-col items-center justify-center my-24">
        <div class="content-wrapper">
            <div class="flex items-center justify-center text-center mb-10">
                <img src="{{ asset('images/undraw-building-block.svg') }}" alt="" class="w-2/3 h-2/3">
            </div>
            <h1 class="text-4xl text-center">Halaman ini sedang dalam tahap pengembangan</h1>
            <div class="flex flex-col items-center text-center my-10">
                <a href="{{  url()->previous() }}" class="py-2 px-5 border-2 border-black rounded text-lg md:text-xl text-gray-200 bg-gray-800 animate-bounce">Kembali</a>
            </div>
        </div>
    </div>       
</x-app-layout>
