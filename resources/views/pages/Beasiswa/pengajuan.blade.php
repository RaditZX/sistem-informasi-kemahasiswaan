@extends('layouts.main')

@section('content')
    @include('component.navbar', ['path' => 'List Beasiswa', 'id' => null])

    <div class="max-w-10xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="container px-4 py-6 sm:px-0">
            <h2 class="text-3xl font-bold mb-6">Data Pribadi Mahasiswa</h2>

            <!-- Profile Card -->
            <div class="bg-white p-6 border-2 border-t-0 border-r-0 border-l-0 border-orange-300 mb-6">
                <div class="flex items-center">
                <div class="w-20 h-20 rounded-full bg-gray-300 mr-6"></div> 
                <div>
                    <h3 class="text-xl font-bold">Daiva Raditya Pradipa</h3>
                    <p class="text-lg text-gray-700">D3 - Teknik Informatika</p>
                    <p class="text-sm text-gray-500">Teknik Komputer dan Informatika</p>
                </div>
                </div>
            </div>

            <!-- Student Information -->
            <div class="container p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Nama Depan</label>
                        <p class="mt-1 text-base text-gray-800">Daiva Raditya</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Nama Belakang</label>
                        <p class="mt-1 text-base text-gray-800">Pradipa</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Alamat Email</label>
                        <p class="mt-1 text-base text-gray-800">daiva.raditya.tif23@polban.ac.id</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Nomor Telepon</label>
                        <p class="mt-1 text-base text-gray-800">+62 821-212-212</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">NIM</label>
                        <p class="mt-1 text-base text-gray-800">231511038</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Status Mahasiswa</label>
                        <p class="mt-1 text-base text-gray-800">Mengikuti Perkuliahan di Kelas</p>
                    </div>
                </div>
            </div>

            <!-- Notification -->
            <div class="bg-yellow-100 p-4 border border-yellow-300 rounded-lg text-sm text-yellow-800 mb-10">
                Silakan cermati dengan seksama data pribadi Anda. Jika terdapat kekeliruan pada data pribadi Anda, silakan update pada menu <a href="#" class="font-medium underline">Profil Mahasiswa</a> → <span class="font-medium underline">Data Pribadi</span>. Jika terdapat kekeliruan pada status mahasiswa Anda, silakan hubungi BAAK.
            </div>

            <!-- Title -->
            <h2 class="text-3xl font-bold mb-6">Lampiran Dokumen</h2>

            <!-- Document Fields -->
            <div class="container">
                <!-- Kartu Tanda Mahasiswa -->
                <div class="group">
                    <div class="flex items-center border p-4 bg-white rounded-lg drop-shadow-lg relative cursor-pointer" onclick="toggleUpload(1)">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAodJREFUWEftlkuojVEUx383Bt4GJl55pZDERKSUDIiBgfI2MpPE0GPgMfAaYaCQEgojYYBSpJQBE+UtRSTd65VIUey/1lfL7uzzfft+hy6dVaf2/vZae//OWmuvtTvoYdLRw3hoA5VFpO2h/9pDfYDpwHhgJNCr7N+69e/APeA+8KiZXZUcmgbsAhZkADRTfQosB+40UioDOgSsbRFIvM1G4ED8MQU0GLgCzIgMnjjXf8sEHRDCtQIY7uwWhjMu+X1SQDeA2U7xIrAeeJ4JEasPCkBHgGW28AaYBLwvFBsBbbacKXT2AptqgsTmt5z3NwAHU0D9gBfAEFM4Y24u9EfYXO7PkeuAfoXMBy7b5DSwMgW0Bjhmi2+BscAnm68GDgOCzpUdwWC7M1LoPtpcDhidAhK16CVbgN02ngXczKVw+jHQUOC1rb+yuvZrGueQknaUKU4Irnxs42vB5XNs/A444f5hFc44ZIuA82aoC6N5Q6Afbve+IZm/2tx/1614WIWiic5dYIqt7wS2pYAUV8VX0h/4YuMPgGqTpA6Q9jgaatkSt6/AXqaAHgATbXGy9R5NVSTn2fcu4DjwOcNLvUOYx1nYhzm7xcA5v0+cQ6eAVaaw1dUjFUkVy1ZKpdahpqe6IOm0a194QmuqsgNrUj2zSn270T6xh/TEUDdWAZT8VrSsD80NIRsDKAxVRX1Pzw+lRPbzQwXwpDtpD6B28lck1VzPhoRe6gguhBCu87fhT9GlgHTlr4Z+MzM6WIWyePnpFVhV4sKYtCt7oO0PTwN147oSt45uA8lwamio+1wd6g5cS4EKAHVkXX21lFxpWchyD66tX5ZDtQ/I3aANVOaxtof+OQ/9BMebaiVc4cz0AAAAAElFTkSuQmCC" class="h-6 w-6 mr-4" alt="Upload Icon" />
                        <p class="text-gray-700">Kartu Tanda Mahasiswa (KTM)</p>
                    </div>

                    <!-- Upload Section (Hidden by default) -->
                    <div class="hidden" id="upload-section-1">
                        <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                            <div class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                <label for="file-upload-1" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk mengunggah berkas</p>
                                    <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                </label>
                            </div>
                            <input id="file-upload-1" name="file-upload-1" type="file" accept=".pdf" class="hidden" onchange="uploadFile(1)">
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="flex">
                        <div class="progress-bar" id="progress-bar-1" style="display: none; width: 100%; background-color: #f3f4f6; height: 10px; margin: 10px 6px;">
                            <div class="progress h-full bg-gradient-to-r from-blue-500 to-orange-500" id="progress-1" style="width: 0%; height: 100%; background-color: #3B3BBD; border-radius: 5px;"></div>
                        </div>
                    </div>

                    <!-- Uploaded Files Container -->
                    <div id="uploaded-files-1"></div>
                </div>

                <!-- Curriculum Vitae -->
                <div class="group">
                    <div class="flex items-center border p-4 bg-white rounded-lg drop-shadow-lg relative cursor-pointer mt-8" onclick="toggleUpload(2)">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAodJREFUWEftlkuojVEUx383Bt4GJl55pZDERKSUDIiBgfI2MpPE0GPgMfAaYaCQEgojYYBSpJQBE+UtRSTd65VIUey/1lfL7uzzfft+hy6dVaf2/vZae//OWmuvtTvoYdLRw3hoA5VFpO2h/9pDfYDpwHhgJNCr7N+69e/APeA+8KiZXZUcmgbsAhZkADRTfQosB+40UioDOgSsbRFIvM1G4ED8MQU0GLgCzIgMnjjXf8sEHRDCtQIY7uwWhjMu+X1SQDeA2U7xIrAeeJ4JEasPCkBHgGW28AaYBLwvFBsBbbacKXT2AptqgsTmt5z3NwAHU0D9gBfAEFM4Y24u9EfYXO7PkeuAfoXMBy7b5DSwMgW0Bjhmi2+BscAnm68GDgOCzpUdwWC7M1LoPtpcDhidAhK16CVbgN02ngXczKVw+jHQUOC1rb+yuvZrGueQknaUKU4Irnxs42vB5XNs/A444f5hFc44ZIuA82aoC6N5Q6Afbve+IZm/2tx/1614WIWiic5dYIqt7wS2pYAUV8VX0h/4YuMPgGqTpA6Q9jgaatkSt6/AXqaAHgATbXGy9R5NVSTn2fcu4DjwOcNLvUOYx1nYhzm7xcA5v0+cQ6eAVaaw1dUjFUkVy1ZKpdahpqe6IOm0a194QmuqsgNrUj2zSn270T6xh/TEUDdWAZT8VrSsD80NIRsDKAxVRX1Pzw+lRPbzQwXwpDtpD6B28lck1VzPhoRe6gguhBCu87fhT9GlgHTlr4Z+MzM6WIWyePnpFVhV4sKYtCt7oO0PTwN147oSt45uA8lwamio+1wd6g5cS4EKAHVkXX21lFxpWchyD66tX5ZDtQ/I3aANVOaxtof+OQ/9BMebaiVc4cz0AAAAAElFTkSuQmCC" class="h-6 w-6 mr-4" alt="Upload Icon" />
                        <p class="text-gray-700">Curriculum Vitae</p>
                    </div>

                    <!-- Upload Section (Hidden by default) -->
                    <div class="hidden" id="upload-section-2">
                        <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                            <div class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                <label for="file-upload-2" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk mengunggah berkas</p>
                                    <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                </label>
                            </div>
                            <input id="file-upload-2" name="file-upload-2" type="file" accept=".pdf" class="hidden" onchange="uploadFile(2)">
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="flex">
                        <div class="progress-bar" id="progress-bar-2" style="display: none; width: 100%; background-color: #f3f4f6; height: 10px; margin: 10px 6px;">
                            <div class="progress h-full bg-gradient-to-r from-blue-500 to-orange-500" id="progress-2" style="width: 0%; height: 100%; background-color: #3B3BBD; border-radius: 5px;"></div>
                        </div>
                    </div>

                    <!-- Uploaded Files Container -->
                    <div id="uploaded-files-2"></div>
                </div>

                <!-- Transkrip Nilai -->
                <div class="group">
                    <div class="flex items-center border p-4 bg-white rounded-lg drop-shadow-lg relative cursor-pointer mt-8" onclick="toggleUpload(3)">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAodJREFUWEftlkuojVEUx383Bt4GJl55pZDERKSUDIiBgfI2MpPE0GPgMfAaYaCQEgojYYBSpJQBE+UtRSTd65VIUey/1lfL7uzzfft+hy6dVaf2/vZae//OWmuvtTvoYdLRw3hoA5VFpO2h/9pDfYDpwHhgJNCr7N+69e/APeA+8KiZXZUcmgbsAhZkADRTfQosB+40UioDOgSsbRFIvM1G4ED8MQU0GLgCzIgMnjjXf8sEHRDCtQIY7uwWhjMu+X1SQDeA2U7xIrAeeJ4JEasPCkBHgGW28AaYBLwvFBsBbbacKXT2AptqgsTmt5z3NwAHU0D9gBfAEFM4Y24u9EfYXO7PkeuAfoXMBy7b5DSwMgW0Bjhmi2+BscAnm68GDgOCzpUdwWC7M1LoPtpcDhidAhK16CVbgN02ngXczKVw+jHQUOC1rb+yuvZrGueQknaUKU4Irnxs42vB5XNs/A444f5hFc44ZIuA82aoC6N5Q6Afbve+IZm/2tx/1614WIWiic5dYIqt7wS2pYAUV8VX0h/4YuMPgGqTpA6Q9jgaatkSt6/AXqaAHgATbXGy9R5NVSTn2fcu4DjwOcNLvUOYx1nYhzm7xcA5v0+cQ6eAVaaw1dUjFUkVy1ZKpdahpqe6IOm0a194QmuqsgNrUj2zSn270T6xh/TEUDdWAZT8VrSsD80NIRsDKAxVRX1Pzw+lRPbzQwXwpDtpD6B28lck1VzPhoRe6gguhBCu87fhT9GlgHTlr4Z+MzM6WIWyePnpFVhV4sKYtCt7oO0PTwN147oSt45uA8lwamio+1wd6g5cS4EKAHVkXX21lFxpWchyD66tX5ZDtQ/I3aANVOaxtof+OQ/9BMebaiVc4cz0AAAAAElFTkSuQmCC" class="h-6 w-6 mr-4" alt="Upload Icon" />
                        <p class="text-gray-700">Transkrip Nilai</p>
                    </div>

                    <!-- Upload Section (Hidden by default) -->
                    <div class="hidden" id="upload-section-3">
                        <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                            <div class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                <label for="file-upload-3" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk mengunggah berkas</p>
                                    <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                </label>
                            </div>
                            <input id="file-upload-3" name="file-upload-3" type="file" accept=".pdf" class="hidden" onchange="uploadFile(3)">
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="flex">
                        <div class="progress-bar" id="progress-bar-3" style="display: none; width: 100%; background-color: #f3f4f6; height: 10px; margin: 10px 6px;">
                            <div class="progress h-full bg-gradient-to-r from-blue-500 to-orange-500" id="progress-3" style="width: 0%; height: 100%; background-color: #3B3BBD; border-radius: 5px;"></div>
                        </div>
                    </div>

                    <!-- Uploaded Files Container -->
                    <div id="uploaded-files-3"></div>
                </div>

                <!-- Surat Berperilaku Baik -->
                <div class="group">
                    <div class="flex items-center border p-4 bg-white rounded-lg drop-shadow-lg relative cursor-pointer mt-8" onclick="toggleUpload(4)">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAodJREFUWEftlkuojVEUx383Bt4GJl55pZDERKSUDIiBgfI2MpPE0GPgMfAaYaCQEgojYYBSpJQBE+UtRSTd65VIUey/1lfL7uzzfft+hy6dVaf2/vZae//OWmuvtTvoYdLRw3hoA5VFpO2h/9pDfYDpwHhgJNCr7N+69e/APeA+8KiZXZUcmgbsAhZkADRTfQosB+40UioDOgSsbRFIvM1G4ED8MQU0GLgCzIgMnjjXf8sEHRDCtQIY7uwWhjMu+X1SQDeA2U7xIrAeeJ4JEasPCkBHgGW28AaYBLwvFBsBbbacKXT2AptqgsTmt5z3NwAHU0D9gBfAEFM4Y24u9EfYXO7PkeuAfoXMBy7b5DSwMgW0Bjhmi2+BscAnm68GDgOCzpUdwWC7M1LoPtpcDhidAhK16CVbgN02ngXczKVw+jHQUOC1rb+yuvZrGueQknaUKU4Irnxs42vB5XNs/A444f5hFc44ZIuA82aoC6N5Q6Afbve+IZm/2tx/1614WIWiic5dYIqt7wS2pYAUV8VX0h/4YuMPgGqTpA6Q9jgaatkSt6/AXqaAHgATbXGy9R5NVSTn2fcu4DjwOcNLvUOYx1nYhzm7xcA5v0+cQ6eAVaaw1dUjFUkVy1ZKpdahpqe6IOm0a194QmuqsgNrUj2zSn270T6xh/TEUDdWAZT8VrSsD80NIRsDKAxVRX1Pzw+lRPbzQwXwpDtpD6B28lck1VzPhoRe6gguhBCu87fhT9GlgHTlr4Z+MzM6WIWyePnpFVhV4sKYtCt7oO0PTwN147oSt45uA8lwamio+1wd6g5cS4EKAHVkXX21lFxpWchyD66tX5ZDtQ/I3aANVOaxtof+OQ/9BMebaiVc4cz0AAAAAElFTkSuQmCC" class="h-6 w-6 mr-4" alt="Upload Icon" />
                        <p class="text-gray-700">Surat Berperilaku Baik</p>
                    </div>

                    <!-- Upload Section (Hidden by default) -->
                    <div class="hidden" id="upload-section-4">
                        <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                            <div class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                <label for="file-upload-4" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk mengunggah berkas</p>
                                    <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                </label>
                            </div>
                            <input id="file-upload-4" name="file-upload-4" type="file" accept=".pdf" class="hidden" onchange="uploadFile(4)">
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="flex">
                        <div class="progress-bar" id="progress-bar-4" style="display: none; width: 100%; background-color: #f3f4f6; height: 10px; margin: 10px 6px;">
                            <div class="progress h-full bg-gradient-to-r from-blue-500 to-orange-500" id="progress-4" style="width: 0%; height: 100%; background-color: #3B3BBD; border-radius: 5px;"></div>
                        </div>
                    </div>

                    <!-- Uploaded Files Container -->
                    <div id="uploaded-files-4"></div>
                </div>

                <!-- Surat Pernyataan -->
                <div class="group">
                    <div class="flex items-center border p-4 bg-white rounded-lg drop-shadow-lg relative cursor-pointer mt-8" onclick="toggleUpload(5)">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAodJREFUWEftlkuojVEUx383Bt4GJl55pZDERKSUDIiBgfI2MpPE0GPgMfAaYaCQEgojYYBSpJQBE+UtRSTd65VIUey/1lfL7uzzfft+hy6dVaf2/vZae//OWmuvtTvoYdLRw3hoA5VFpO2h/9pDfYDpwHhgJNCr7N+69e/APeA+8KiZXZUcmgbsAhZkADRTfQosB+40UioDOgSsbRFIvM1G4ED8MQU0GLgCzIgMnjjXf8sEHRDCtQIY7uwWhjMu+X1SQDeA2U7xIrAeeJ4JEasPCkBHgGW28AaYBLwvFBsBbbacKXT2AptqgsTmt5z3NwAHU0D9gBfAEFM4Y24u9EfYXO7PkeuAfoXMBy7b5DSwMgW0Bjhmi2+BscAnm68GDgOCzpUdwWC7M1LoPtpcDhidAhK16CVbgN02ngXczKVw+jHQUOC1rb+yuvZrGueQknaUKU4Irnxs42vB5XNs/A444f5hFc44ZIuA82aoC6N5Q6Afbve+IZm/2tx/1614WIWiic5dYIqt7wS2pYAUV8VX0h/4YuMPgGqTpA6Q9jgaatkSt6/AXqaAHgATbXGy9R5NVSTn2fcu4DjwOcNLvUOYx1nYhzm7xcA5v0+cQ6eAVaaw1dUjFUkVy1ZKpdahpqe6IOm0a194QmuqsgNrUj2zSn270T6xh/TEUDdWAZT8VrSsD80NIRsDKAxVRX1Pzw+lRPbzQwXwpDtpD6B28lck1VzPhoRe6gguhBCu87fhT9GlgHTlr4Z+MzM6WIWyePnpFVhV4sKYtCt7oO0PTwN147oSt45uA8lwamio+1wd6g5cS4EKAHVkXX21lFxpWchyD66tX5ZDtQ/I3aANVOaxtof+OQ/9BMebaiVc4cz0AAAAAElFTkSuQmCC" class="h-6 w-6 mr-4" alt="Upload Icon" />
                        <p class="text-gray-700">Surat Pernyataan</p>
                    </div>

                    <!-- Upload Section (Hidden by default) -->
                    <div class="hidden" id="upload-section-5">
                        <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                            <div class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                <label for="file-upload-5" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk mengunggah berkas</p>
                                    <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                </label>
                            </div>
                            <input id="file-upload-5" name="file-upload-5" type="file" accept=".pdf" class="hidden" onchange="uploadFile(5)">
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="flex">
                        <div class="progress-bar" id="progress-bar-5" style="display: none; width: 100%; background-color: #f3f4f6; height: 10px; margin: 10px 6px;">
                            <div class="progress h-full bg-gradient-to-r from-blue-500 to-orange-500" id="progress-5" style="width: 0%; height: 100%; background-color: #3B3BBD; border-radius: 5px;"></div>
                        </div>
                    </div>

                    <!-- Uploaded Files Container -->
                    <div id="uploaded-files-5"></div>
                </div>


                


                <!-- Submit Button -->
                <div class="flex justify-center pt-20 p-3">
                    <button type="submit" id="submit-btn" class="h-10 w-full bg-gray-500 text-white px-4 rounded-lg opacity-50 cursor-not-allowed" disabled>Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleUpload(sectionId) {
            var uploadSection = document.getElementById('upload-section-' + sectionId);
            if (uploadSection.classList.contains('hidden')) {
                uploadSection.classList.remove('hidden');
            } else {
                uploadSection.classList.add('hidden');
            }
        }

        function uploadFile(sectionId) {
            var fileInput = document.getElementById('file-upload-' + sectionId);
            var files = fileInput.files;

            if (files.length > 0) {
                var formData = new FormData();
                Array.from(files).forEach(file => formData.append('files[]', file));

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'upload.php', true);

                // Update progress bar during file upload
                xhr.upload.onprogress = function (e) {
                    if (e.lengthComputable) {
                        var percentage = (e.loaded / e.total) * 100;
                        var progressBar = document.getElementById('progress-' + sectionId);
                        progressBar.style.width = percentage + '%';
                    }
                };

                // Show progress bar
                document.getElementById('progress-bar-' + sectionId).style.display = 'block';

                // File upload completed
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Hide the upload section after successful upload
                        document.getElementById('upload-section-' + sectionId).style.display = 'none';

                        // Display uploaded files
                        var uploadedFilesContainer = document.getElementById('uploaded-files-' + sectionId);
                        Array.from(files).forEach(file => {
                            var uploadedFileDisplay = document.createElement('div');
                            uploadedFileDisplay.className = 'flex items-center p-4 mx-6 mt-2 border border-gray-300 rounded-lg';
                            uploadedFileDisplay.innerHTML = `
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 mr-4" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14v-4h-2v4H7v-4H5v-2h2v-2h2v2h2v2H9v4h2zm4 0h-2v-6h-2V8h4v8z"/>
                                </svg>
                                <p class="text-gray-700">${file.name}</p>
                            `;
                            uploadedFilesContainer.appendChild(uploadedFileDisplay);
                        });

                        // Reset progress bar
                        var progressBar = document.getElementById('progress-' + sectionId);
                        progressBar.style.width = '0%';
                        document.getElementById('progress-bar-' + sectionId).style.display = 'none';

                    } else {
                        alert('Error while uploading the file.');
                    }
                };

                // Send the file via AJAX
                xhr.send(formData);
            } else {
                alert('Please select at least one file to upload.');
            }
        }
    </script>


@endsection