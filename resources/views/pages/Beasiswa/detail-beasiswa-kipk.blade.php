@extends('layouts.filter')
@extends('layouts.notification')
@extends('layouts.main')

@section('content')
    @include('component.navbar', ['path' => 'List Beasiswa', 'id' => null])

    <div class="flex flex-row m-5 p-5 mr-40 ml-40 ">
        <div class="basis-1/2">
            <img src="{{asset('assets/img/kipk.png')}}" class="w-full max-w-sm lg:max-h-80 rounded-lg" alt="kipk">
            
        </div>
        
        <div class="w-1 rounded-lg h-50 bg-orange-500"></div>

        <div class="basis-1/2 flex flex-col items-center justify-center">
            <div class="flex flex-col gap-2 text-center">
                <div class="basis-1/2 flex justify-center items-center">
                    <p class="font-bold text-5xl">
                        KIP - KULIAH
                    </p>
                </div>
                <div class="basis-1/2 flex justify-center items-center">
                    <p class="font-normal text-lg">
                        Kartu Indonesia Pintar Kuliah Merdeka 2024
                    </p>
                </div>   
            </div>
        </div>
    </div>
    <div class="flex flex-row items-center justify-center mt-14">
        <p class="font-bold text-lg text-blue-900">
            Kartu Indonesia Pintar Kuliah
        </p>
    </div>
    <div class="flex flex-col items-start justify-left ml-10 mr-10 gap-5">
        <p class="font-normal text-sm text-black">
            Pemerintah Indonesia terus berkomitmen untuk fokus meningkatkan pembangunan Sumberdaya Manusia melalui berbagai upaya cerdas. Kartu Indonesia Pintar Kuliah (KIP-Kuliah) 
            adalah salah satu upaya untuk membantu asa para siswa yang memiliki keterbatasan ekonomi tetapi berprestasi untuk melanjutkan studi di perguruan tinggi.
        </p>
        <p class="font-normal text-sm text-black">
            KIP-KULIAH MERDEKA 2023 KIP Kuliah Merdeka Tahun 2023 sudah dibuka! Ayo manfaatkan program KIP Kuliah Merdeka untuk meraih cita-citamu.
            Pendaftaran KIP Kuliah Merdeka memerlukan data Nomor Induk Siswa Nasional (NISN), Nomor Pokok Sekolah Nasional (NPSN), dan Nomor Induk Kependudukan (NIK). 
            Pastikan NISN, NPSN dan NIK dari calon peserta KIP Kuliah 2023 valid, sesuai data yang tercatat di Data Pokok Pendidikan (Dapodik), Kemendikbudristek.
        </p>
        <p class="font-normal text-sm text-black">
            Pastikan NISN, NPSN dan NIK dari calon peserta KIP Kuliah 2023 valid, sesuai data yang tercatat di Data Pokok Pendidikan (Dapodik), Kemendikbudristek.
        </p>
    </div>
    <div class="flex flex-row md:flex-col gap-5 mt-5 ml-10 mr-10">
        <div class="text-center bg-orange-500 rounded-lg shadow-lg p-2 basis-1/3 flex items-center justify-center">
            <p class="text-white">Daftar KIP - Kuliah</p>
        </div>
        <div class="border border-orange-500 rounded-lg text-center p-2 basis-1/3 flex items-center justify-center">
            <p class="text-orange-500">Download Panduan</p>
        </div>
        <div class="text-center bg-orange-500 rounded-lg shadow-lg p-2 basis-1/3 flex items-center justify-center">
            <p class="text-white">Kunjungi Web Resmi</p>
        </div>
    </div>
@endsection    
