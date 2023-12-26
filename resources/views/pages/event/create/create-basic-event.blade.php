<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg lg:text-4xl leading-tight">
            Create Event
        </h2>
        <h3 class="text-md lg:text-xl opacity-50">Buat dan promosikan event kamu di Evenin</h3>
        <div class="mt-10">
            <ol class="flex flex-wrap gap-2 text-md lg:text-lg">
                @foreach (Breadcrumbs::generate('createBasicEvent') as $breadcrumb)
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
        <h1 class="text-4xl font-bold mb-5">Buat Event</h1>
        <div class="flex gap-2 flex-wrap mb-10">
            <a href="#">
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
        <h1 class="text-4xl font-bold mb-5">Lengkapi form di bawah untuk membuat event</h1>
        <div class="mt-5">
            <form action="#" method="post" class="flex flex-col gap-3">
                @csrf
                <div class="mb-2">
                    <h2 class="text-2xl font-bold mb-2">Detail Penyelenggara</h2>
                    <div class="mb-1">
                        <x-input-label for="organizer_name" :value="__('Organisasi penyelenggara')" />
                        <x-text-input id="organizer_name" class="block mt-1 w-full" type="text" name="organizer_name"
                            :value="old('organizer_name')" required autofocus autocomplete="orgnainzer_name" />
                    </div>
                    <div class="mb-1">
                        <x-input-label for="organizer_email" :value="__('Email penanggung jawab')" />
                        <x-text-input id="organizer_email" class="block mt-1 w-full" type="email"
                            name="organizer_email" :value="old('organizer_email')" required autofocus autocomplete="organizer_email" />
                    </div>
                    <div class="mb-1">
                        <x-input-label for="organizer_phone" :value="__('Nomor telepon penanggung jawab')" />
                        <x-text-input id="organizer_phone" class="block mt-1 w-full" type="text"
                            name="organizer_phone" :value="old('organizer_phone')" required autofocus autocomplete="organizer_phone"
                            placeholder="+628xxx" />
                    </div>
                </div>
                <div class="mb-2">
                    <h2 class="text-2xl font-bold mb-2">Detail Event</h2>
                    <div class="mb-1">
                        <x-input-label for="title" :value="__('Nama Event')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title')" required autofocus autocomplete="title" />
                    </div>
                    <div class="mb-1">
                        <x-input-label :value="__('Tempat pelaksanaan event')" />
                        <div>
                            <input type="radio" id="online_checked" name="is_online" value="1" checked />
                            <label for="online">Online</label>
                        </div>
    
                        <div>
                            <input type="radio" id="offline_checked" name="is_online" value="0" />
                            <label for="offline">Offline</label>
                        </div>
    
                    </div>
                    <div class="mb-1">
                        <x-input-label for="customer_address" :value="__('Detail tempat pelaksanaan (isi alamat tempat atau link jika online)')" />
                        <textarea id="customer_address" rows="4"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            type="text" name="customer_address" :value="old('customer_address')" required autofocus
                            autocomplete="customer_address"></textarea>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-1">
                        <x-input-label for="potrait_banner" :value="__('Potrait banner (rekomendasi ukuran 324px x 405px)')" />
                        <input type="file" name="potrait_banner" id="">
                        <x-input-error :messages="__('hanya menerima jpg, jpeg, png dan maksimal 1mb')" class="mt-2" />
                    </div>
                    <div class="mb-1">
                        <x-input-label for="landscape_banner" :value="__('Landscape banner (rekomendasi ukuran 811px x 374px)')" />
                        <input type="file" name="landscape_banner" id="">
                        <x-input-error :messages="__('hanya menerima jpg, jpeg, png dan maksimal 1mb')" class="mt-2" />
                    </div>
                    <div class="mb-1">
                        <x-input-label for="capacity" :value="__('Kapasitas Event')" />
                        <x-text-input id="capacity" class="block mt-1 w-full" type="number" name="capacity"
                        :value="old('capacity')" required autofocus autocomplete="capacity" />
                    </div>
                </div>
               

                <button type="submit"
                    class="py-2 px-5 border-2 border-black rounded text-lg md:text-xl text-gray-200 bg-gray-800 mt-4">Buat
                    Event</button>
            </form>
        </div>
    </div>
    @include('components.footer')
</x-app-layout>