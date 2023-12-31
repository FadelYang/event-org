<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg lg:text-4xl leading-tight">
            Create Event
        </h2>
        <h3 class="text-md lg:text-xl opacity-50">Buat dan promosikan event kamu di Evenin</h3>
        <div class="mt-10">
            <ol class="flex flex-wrap gap-2 text-md lg:text-lg">
                @foreach (Breadcrumbs::generate('createEvent') as $breadcrumb)
                    @if (!is_null($breadcrumb->url) && !$loop->last)
                        <li class="opacity-70 hover:opacity-100"><a
                                href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                        <li>></li>
                    @else
                        <li class="breadcrumb-item">{{ $breadcrumb->title }}</li>
                    @endif
                @endforeach
            </ol>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl text-center font-bold mb-5">Paket pembuatan dan promosi event</h1>
        <div class="flex gap-2 flex-wrap items-center justify-center mb-10">
            <a href="{{ route('event.create.form-basic') }}">
                <div
                    class="p-5 bg-gray-200 rounded lg min-h-[252px] max-w-[352px] box-content hover:bg-gray-300 border-2 hover:border-2 border-gray-500 hover:border-gray-700 hover:shadow-lg">
                    <div class="mb-5">
                        <p class="text-md">Paket basic</p>
                        <p class="my-2 text-4xl">Basic</p>
                    </div>
                    <div>
                        <ul class="p-5 list-disc opacity-50">
                            <li>Gratis membuat event</li>
                            <li>Event akan dipromosikan lewat sosial media Evenin</li>
                            <li>24/7 dukungan teknis Evenin</li>
                            <li>Cocok untuk siswa atau mahasiswa</li>
                        </ul>
                    </div>
                    <p class="mt-2 text-4xl">Gratis</p>
                </div>
            </a>
        </div>
        <div id="secondHero" class="my-5 hero-banner px-5 py-2 lg:p-5 rounded-xl">
            <div class="lg:p-5 rounded-xl items-center">
                <h1 class="text-2xl md:text-3xl lg:text-5xl font-bold text-center">Masih bingung atau ada pertanyaan seputar pembuatan event? Hubungi kami untuk berkonsultasi</h1>
                <div class="flex mt-5 lg:mt-10 items-center justify-center">
                    <a href="#eventSeminar"
                        class="mt-3 md:mt-0 py-2 px-5 border-2 border-black rounded text-lg md:text-xl text-gray-200 bg-gray-800">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
</x-app-layout>
