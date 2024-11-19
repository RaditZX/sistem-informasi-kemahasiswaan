@extends('layouts.main')
@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-3xl p-10 bg-white rounded-3xl shadow-lg">
            <h1 class="text-3xl font-bold text-center mb-8">Ayo Kita Mulai</h1>
            <form method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Depan -->
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700">Nama Depan</label>
                        <input type="text" name="firstName" id="firstName" class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:border-orange-500 focus:ring-orange-500" placeholder="Nama Depan">
                    </div>
                    <!-- Nama Belakang -->
                    <div>
                        <label for="lastName" class="block text-sm font-medium text-gray-700">Nama Belakang</label>
                        <input type="text" name="lastName" id="lastName" class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:border-orange-500 focus:ring-orange-500" placeholder="Nama Belakang">
                    </div>
                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:border-orange-500 focus:ring-orange-500">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                        </select>
                    </div>
                    <!-- Nomor Induk Mahasiswa -->
                    <div>
                        <label for="studentId" class="block text-sm font-medium text-gray-700">Nomor Induk Mahasiswa</label>
                        <input type="text" name="studentId" id="studentId" class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:border-orange-500 focus:ring-orange-500" placeholder="NIM">
                    </div>
                    <!-- Nomor Handphone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Handphone</label>
                        <input type="tel" name="phone" id="phone" class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:border-orange-500 focus:ring-orange-500" placeholder="Nomor Handphone">
                    </div>
                    <!-- Jurusan -->
                    <div>
                        <label for="department" class="block text-sm font-medium text-gray-700">Jurusan</label>
                        <select name="department" id="department" class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:border-orange-500 focus:ring-orange-500">
                            <option value="">Pilih Jurusan</option>
                            <option value="informatics">Informatika</option>
                            <option value="engineering">Teknik Mesin</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <!-- Program Studi -->
                    <div>
                        <label for="program" class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <select name="program" id="program" class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:border-orange-500 focus:ring-orange-500">
                            <option value="">Pilih Program Studi</option>
                            <option value="d4">D4</option>
                            <option value="d3">D3</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full py-3 font-bold text-white bg-orange-500 rounded-lg shadow-md hover:bg-orange-700 focus:ring-2 focus:ring-orange-400 focus:outline-none">
                        MULAI MENJELAJAH
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
