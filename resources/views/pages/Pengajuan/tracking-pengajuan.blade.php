@extends('layouts.filter')
@extends('layouts.notification')
@extends('layouts.main')
@section('content')
@include('component.navbar', [
    'path' => "Tracking Beasiswa > " . $dataPengajuan[0]->nama_beasiswa,
    'id' => null
])

    <div class="wrapper pb-5">
        <!-- Timeline Section -->
        <section class="timeline mx-auto py-6 sm:px-6 lg:px-8">
            <ol class="flex justify-between items-center w-full relative">
                <!-- Timeline Steps -->
                {{-- {{ $status = ['diproses', ''] }} --}}
                @foreach (['Submit', 'Review oleh Staff', 'Review oleh Ketua Jurusan', 'Review oleh WD3', 'Selesai'] as $index => $step)
                    <li class="flex flex-col items-center w-full relative">
                        @if ($index == 0)
                            <!-- First Step Completed -->
                            <span class="flex items-center justify-center w-10 h-10 bg-green-500 text-white rounded-full lg:h-12 lg:w-12 shrink-0 z-10">
                                <svg class="w-4 h-4 lg:w-5 lg:h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                </svg>
                            </span>
                            <div class="absolute top-1/2 right-0 w-full h-1 bg-green-500 transform -translate-y-4 z-0"></div>
                        @else
                            <!-- Upcoming or In-Progress Steps -->
                            <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-300 dark:bg-gray-700 transform -translate-y-4 z-0"></div>
                            <span class="flex items-center justify-center w-10 h-10 bg-gray-300 text-gray-500 rounded-full lg:h-12 lg:w-12 shrink-0 z-10">
                                <svg class="w-4 h-4 lg:w-5 lg:h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                </svg>
                            </span>
                            @if ($index < 4)
                                <div class="absolute top-1/2 right-0 w-full h-1 bg-gray-300 dark:bg-gray-700 transform -translate-y-4 z-0"></div>
                            @endif
                        @endif
                        <p class="mt-2 text-center text-sm text-gray-700">{{ $step }}</p>
                    </li>
                @endforeach
            </ol>
        </section>

        <!-- Timer Section -->
        <section class="timer my-8">
            <h1 class="text-center text-xl font-semibold mb-4">ESTIMASI</h1>
            <div class="timer-block">
                <div class="mx-auto w-1/2 grid grid-cols-4 justify-items-center items-center mb-4">
                    <p>Hari</p>
                    <p>Jam</p>
                    <p>Menit</p>
                    <p>Detik</p>
                </div>
                <div class="mx-auto w-1/2 grid grid-cols-4 justify-items-center items-center">
                    <h3>XX</h3>
                    <h3>XX</h3>
                    <h3>XX</h3>
                    <h3>XX</h3>
                </div>
            </div>
        </section>

        <!-- Scholarship Section -->
        <section class="beasiswa my-8 px-4">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 items-center bg-white rounded-2xl shadow-lg p-6 md:p-8">
                <div class="beasiswa-images md:col-span-2 flex justify-center">
                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEik4McHhDC2otgAFVVxX1_9KI4xqY0KLdkThGiFYjsfN720_z_kIvi2TARm24mA68XO1CbMBSILOHFfy0HIQVO9Hn1qXFxSVfTC54ZaoHKLi6Yj-fd6Lm02syaeQ_Q3nkaGu4LpM6JSk-MwEEzzYqjZMbMNDyQiP8InBNz7sFn00DMJXQQBakiNtx8qBw/s1080/Beasiswa-Creativa-Feed.png" 
                        alt="Beasiswa LKPD" class="rounded-xl w-full h-auto max-w-sm object-cover">
                </div>
                <div class="beasiswa-content md:col-span-3 mt-6 md:mt-0">
                    <h1 class="text-2xl font-semibold mb-4 text-gray-900">{{ $dataPengajuan[0]->nama_beasiswa }}</h1>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $dataPengajuan[0]->deskripsi }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Accordion Section -->
        <section class="dokumen my-8 px-4">
            <h1 class="text-xl font-semibold mb-4">Dokumen yang di ajukan</h1>
            <div class="space-y-4">
                @foreach (['Kartu Tanda Mahasiswa (KTM)', 'Curriculum Vitae', 'Transkrip Nilai', 'Surat Berperilaku Baik', 'Surat Pernyataan sedang tidak menerima beasiswa'] as $document)
                    <div class="accordion-item rounded-xl shadow-md overflow-hidden">
                        <button class="accordion-button flex items-center justify-between w-full p-4 text-left text-gray-900 font-medium focus:outline-none" onclick="toggleAccordion(this)">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ $document }}
                            </span>
                            <svg class="accordion-icon w-5 h-5 text-gray-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="accordion-content hidden p-4 bg-gray-50 transition-all duration-200 max-h-0 overflow-hidden">
                            <p class="text-sm text-gray-500 mb-4">Preview for {{ $document }}:</p>
                            <iframe src="https://docs.google.com/gview?url=https://firebasestorage.googleapis.com/v0/b/sistem-informasi-kemahasiswaan.appspot.com/o/dokumen%2F3-a.pdf?alt=media&embedded=true" 
                                    width="1000px" 
                                    height="600px" 
                                    class="w-full rounded-lg border" 
                                    frameborder="0">
                            </iframe>
                        </div>                        
                    </div>
                @endforeach
            </div>
        </section>

        @if ($userData[0]->nim == NULL)
            <!-- Comment Form -->
            <form action="#" method="POST" class="my-8 px-4">
                @csrf
                <div>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Your message</label>
                    <textarea id="message" rows="10" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Tambahkan komentar disini..."></textarea>
                </div>
                <div class="mt-4 flex items-center justify-end space-x-2">
                    <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">Tolak</button>
                    <button type="button" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5">Revisi</button>
                    <button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">Terima</button>
                </div>
            </form>
        @else
            <form action="#" method="POST" class="my-8 px-4">
                @csrf
                <div class="flex flex-col items-center justify-end">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Ingin membatalkan pengajuan?</label>
                    <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">Batalkan</button>
                </div>
            </form>
        @endif
    </div>
@endsection

<script>
    function toggleAccordion(element) {
        const content = element.nextElementSibling;
        const icon = element.querySelector('.accordion-icon');

        // Toggle visibility
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            content.style.maxHeight = content.scrollHeight + 'px';
        } else {
            content.classList.add('hidden');
            content.style.maxHeight = '0';
        }

        // Rotate icon
        icon.classList.toggle('rotate-180');
    }
</script>