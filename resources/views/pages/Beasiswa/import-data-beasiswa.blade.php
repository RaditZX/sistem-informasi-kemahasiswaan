@extends('layouts.filter')
@extends('layouts.notification')
@extends('layouts.main')

@section('content')
    @include('component.navbar', ['path' => 'List Beasiswa', 'id' => null])

    <div class="p-3 mt-3 flex flex-row">
        <p class="text-2xl lg:text-3xl font-bold text-black">Import Data Penerima Beasiswa</p>
    </div>
    <div class="border border-grey-500 rounded-lg text-center flex justify-center items-center p-2 overflow-x-auto min-h-96 min-w-96 mr-10 mb-10">
        <div class="flex flex-col">
            <i class="fas fa-upload text-gray-500 text-lg"></i>  
            <p class="text-sm font-light text-gray-500">
                Seret dan letakkan atau klik untuk mengunggah berkas
            </p>
        </div>
    </div>
    <div class="flex flex-row-reverse gap-3 text-center mr-10">
        <div class="border border-orange-500 rounded-lg w-24 h-10">
            <p class="text-sm font-normal text-orange-500 flex justify-center items-center w-full h-full">
                Cancel
            </p>
        </div>
        <div class="border bg-orange-500 rounded-lg w-24 h-10">
            <p class="text-sm font-normal text-white flex justify-center items-center w-full h-full">
                Import File
            </p>
        </div>
    </div>
@endsection
    
    