@extends('layouts.filter')
@extends('layouts.notification')
@extends('layouts.main')
@section('content')

@include('component.navbar', [
    'path' => "Tracking Beasiswa > " . $dataPengajuan->nama_beasiswa,
    'id' => null
])

    <div class="wrapper pb-5">
        <!-- Timeline Section -->
        <section class="timeline mx-auto py-6 sm:px-6 lg:px-8">
            <ol class="flex justify-between items-center w-full relative">
                @php
                    $idStatuses = $dataStatus->pluck('id_status'); // Extract 'id_status' values from the collection
                    $idStatusesArray = $idStatuses->toArray(); // Convert the collection to an array
                    $whatIndex = array_search($dataPengajuan->status, $idStatusesArray);
                @endphp

                <!-- Timeline Steps -->
                @foreach ($dataStatus as $index => $step)
                    @if (in_array($index, [0, 1, 3, 5, 7, 9]))
                        <li class="flex flex-col items-center w-full relative">
                            @if ($dataPengajuan->status == 10)
                                <!-- Completed Step -->
                                <span class="flex items-center justify-center w-10 h-10 text-white rounded-full lg:h-12 lg:w-12 shrink-0 z-10 mb-4 bg-green-500">
                                    <svg class="w-4 h-4 lg:w-5 lg:h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                    </svg>
                                </span>
                                <div class="absolute top-1/2 right-0 w-full h-1 bg-green-500 transform -translate-y-4 z-0" style="top: 40px"></div>
                            @elseif ($dataPengajuan->status == 11)
                                <!-- Completed Step -->
                                <span class="flex items-center justify-center w-10 h-10 text-white rounded-full lg:h-12 lg:w-12 shrink-0 z-10 mb-4 bg-red-500">
                                    <svg class="w-4 h-4 lg:w-5 lg:h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                    </svg>
                                </span>
                                <div class="absolute top-1/2 right-0 w-full h-1 bg-red-500 transform -translate-y-4 z-0" style="top: 40px"></div>
                            @else
                                @if ($index == $dataPengajuan->status-1)
                                    <!-- Completed Step -->
                                    <span class="flex items-center justify-center w-10 h-10 text-white rounded-full lg:h-12 lg:w-12 shrink-0 z-10 mb-4 bg-yellow-500">
                                        <svg class="w-4 h-4 lg:w-5 lg:h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                        </svg>
                                    </span>
                                    <div class="absolute top-1/2 right-0 w-full h-1 bg-yellow-500 transform -translate-y-4 z-0" style="top: 40px"></div>
                                @elseif ($index < $dataPengajuan->status-1)
                                    <!-- Completed Step -->
                                    <span class="flex items-center justify-center w-10 h-10 text-white rounded-full lg:h-12 lg:w-12 shrink-0 z-10 mb-4 {{ ($index == $dataPengajuan->status-2) ? 'bg-yellow-500' : 'bg-green-500' }}">
                                        <svg class="w-4 h-4 lg:w-5 lg:h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                        </svg>
                                    </span>
                                    <div class="absolute top-1/2 right-0 w-full h-1 {{ ($index == $dataPengajuan->status-2)  ? 'bg-yellow-500' : 'bg-green-500' }} transform -translate-y-4 z-0" style="top: 40px"></div>
                                @else
                                    <!-- Upcoming or In-Progress Steps -->
                                    <span class="flex items-center justify-center w-10 h-10 bg-gray-300 text-gray-500 rounded-full lg:h-12 lg:w-12 shrink-0 z-10 mb-4">
                                        <svg class="w-4 h-4 lg:w-5 lg:h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                        </svg>
                                    </span>
                                    <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-300 dark:bg-gray-700 transform -translate-y-4 z-0" style="top: 40px"></div>
                                @endif
                            @endif
                            <div>
                                <!-- Step Text with Fixed Max Height and Clipping Overflow -->
                                <p class="text-center text-sm text-gray-700 px-2 max-w-[8rem] min-h-[4rem] line-clamp-3 overflow-hidden">
                                    {{ $step->isi_status }}
                                </p>
                            </div>
                        </li>
                    @endif
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
                    <h3 id="days">0</h3>
                    <h3 id="hours">0</h3>
                    <h3 id="minutes">0</h3>
                    <h3 id="seconds">0</h3>
                </div>
            </div>
        </section>

        @if (($dataReviewer == NULL))
            @if ($dataPengajuan->status == 3 || $dataPengajuan->status == 5 || $dataPengajuan->status == 7 || $dataPengajuan->status == 9)
            <section class="reminderAlert px-4">
                <div class="flex items-center p-4 mb-4 text-sm border border-yellow-300 rounded-lg bg-yellow-300  dark:border-yellow-800" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                    <span class="font-medium">Revisi Data Pengajuan!</span> Cek komentar untuk mengetahui lebih lanjut
                    </div>
                </div>
            </section>
            @endif
        @endif

        <!-- Scholarship Section -->
        <section class="beasiswa my-8 px-4">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 items-center bg-white rounded-2xl shadow-lg p-6 md:p-8">
                <div class="beasiswa-images md:col-span-2 flex justify-center">
                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEik4McHhDC2otgAFVVxX1_9KI4xqY0KLdkThGiFYjsfN720_z_kIvi2TARm24mA68XO1CbMBSILOHFfy0HIQVO9Hn1qXFxSVfTC54ZaoHKLi6Yj-fd6Lm02syaeQ_Q3nkaGu4LpM6JSk-MwEEzzYqjZMbMNDyQiP8InBNz7sFn00DMJXQQBakiNtx8qBw/s1080/Beasiswa-Creativa-Feed.png"
                        alt="Beasiswa LKPD" class="rounded-xl w-full h-auto max-w-sm object-cover">
                </div>
                <div class="beasiswa-content md:col-span-3 mt-6 md:mt-0">
                    <h1 class="text-2xl font-semibold mb-4 text-gray-900">{{ $dataPengajuan->nama_beasiswa }}</h1>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $dataPengajuan->deskripsi }}
                    </p>
                </div>
            </div>
        </section>
        @php
        $n = 0;
    @endphp
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


                                <embed src="{{ $dataDokumenPengajuan[$n]->link_dokumen }}" width="500" height="375" type="application/pdf">
                            @php
                                $n += 1;
                            @endphp
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        @if ($dataReviewer != NULL)
            <form action="{{ route('pengajuan.update-progress', $dataPengajuan->id) }}" method="POST" class="my-8 px-4">
                @csrf
                @method('PATCH')
                <div>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Your message</label>
                    <textarea id="message" rows="10" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Tambahkan komentar disini..." name="reviewerComment"></textarea>
                </div>
                <div class="mt-4 flex items-center justify-end space-x-2">
                    <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5" name="action" value="reject">Tolak</button>
                    <button type="submit" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5" name="action" value="revise">Revisi</button>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5" name="action" value="approve">Terima</button>
                </div>

                <!-- Hidden input field for role_id -->
                <input type="hidden" name="role_id" value="{{ $dataReviewer->role_id }}">
                <input type="hidden" name="pengajuan_status" value="{{ $dataPengajuan->status }}">
            </form>
        @elseif (($dataPengajuan->status <= 1) && ($dataReviewer == NULL))
            <div class="flex justify-center items-center">
                <form action="{{ route('pengajuan.batalkan-pengajuan', $dataPengajuan->id)  }}" method="POST" class="my-8 px-4" onsubmit="return confirm('Are you sure you want to delete this?');">
                    @csrf
                    @method('DELETE')
                    <div class="flex flex-col items-center justify-end">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Ingin membatalkan pengajuan?</label>
                        <button type="submit" class="btn btn-danger text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">Batalkan</button>
                    </div>
                </form>
                <div class="flex flex-col items-center justify-center">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Ingin mengubah data pengajuan?</label>
                    <a href="{{ route('pengajuan.show', $dataPengajuan->id)  }}" class="btn btn-warning rounded-lg bg-yellow-400 hover:bg-yellow-600 focus:ring-4 px-5 py-2.5">
                        Edit
                    </a>
                </div>
            </div>
        @else
            @if (($dataPengajuan->status == 3 || $dataPengajuan->status == 5 || $dataPengajuan->status == 7 || $dataPengajuan->status == 9) )
                <div class="px-4">
                    <h1 class="text-xl font-semibold mb-4">Komentar Revisi</h1>
                    <p>
                        @if ($dataPengajuan->komentar)
                        <section class="reminderAlert">
                            <div class="flex items-center p-4 mb-4 text-sm border border-yellow-300 rounded-lg  dark:border-yellow-800" role="alert">
                                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                  <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                </svg>
                                <span class="sr-only">Info</span>
                                <div>
                                  <p>{{ $dataPengajuan->komentar }}</p>
                                </div>
                            </div>
                        </section>
                        @endif
                    </p>
                </div>

                <div class="flex flex-col items-center justify-center">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Perbaiki data pengajuan?</label>
                    <a href="{{ url('/pengajuan-beasiswa/edit/') . $dataPengajuan->id }}" class="btn btn-warning rounded-lg bg-yellow-400 hover:bg-yellow-600 focus:ring-4 px-5 py-2.5">
                        Edit
                    </a>
                </div>
            @endif
            <div class="flex flex-col items-center justify-end">
                <p><b>Pengajuan hanya dapat dibatalkan jika masih dalam proses "Diajukan"!</b></p>
            </div>
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

<script>
    // Data from backend
    const waktuSisa = {
        days: {{ $waktuSisa['days'] }},
        hours: {{ $waktuSisa['hours'] }},
        minutes: {{ $waktuSisa['minutes'] }},
        seconds: {{ $waktuSisa['seconds'] }}
    };

    function startCountdown() {
        let { days, hours, minutes, seconds } = waktuSisa;

        const timerInterval = setInterval(() => {
            // Countdown logic
            if (seconds > 0) {
                seconds--;
            } else if (minutes > 0) {
                minutes--;
                seconds = 59;
            } else if (hours > 0) {
                hours--;
                minutes = 59;
                seconds = 59;
            } else if (days > 0) {
                days--;
                hours = 23;
                minutes = 59;
                seconds = 59;
            }

            // Update DOM
            document.getElementById('days').innerText = days;
            document.getElementById('hours').innerText = hours;
            document.getElementById('minutes').innerText = minutes;
            document.getElementById('seconds').innerText = seconds;
        }, 1000); // Update every second
    }

    // Start the timer when the page loads
    window.onload = startCountdown;
</script>
