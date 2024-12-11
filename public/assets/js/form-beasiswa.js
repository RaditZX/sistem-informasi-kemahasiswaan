
let jenjang_tags = [];
let syarat_tags = [];
let benefit_tags = [];
let dokumen_tags = [];


// Fetch tags for jenjang pendidikan
function fetchJenjangTags() {
    let query = $('#jenjang_pendidikan').val().trim();
    if (query === '') {
        $('#jenjang-suggestions').addClass('hidden');
        return;
    }
    $.ajax({
        url: "{{ route('Beasiswa.search_jenjang') }}",
        type: 'GET',
        data: { query: query },
        success: function(tags) {
            let suggestions = $('#jenjang-suggestions').empty().removeClass('hidden');
            if (!tags.length) {
                suggestions.addClass('hidden');
                return;
            }
            tags.forEach(tag => {
                suggestions.append(`
                    <div class="tag-suggestion-jenjang px-4 py-2 text-gray-700 hover:bg-indigo-100 cursor-pointer">
                        ${tag.nama_prodi}
                    </div>
                `);
            });
            $('.tag-suggestion-jenjang').on('click', function() {
                addJenjangTag($(this).text());
                suggestions.empty().addClass('hidden');
            });
        }
    });
}

// Add tag for jenjang pendidikan
function addJenjangTag(tagText) {
    tagText = tagText.trim();

    if (jenjang_tags.includes(tagText)) {
        $('#jenjang_pendidikan').val('');
        return;
    }

    if (tagText === ''){
        return;
    }

    // Tambahkan tag ke array dan ke UI
    jenjang_tags.push(tagText);

    let tagContainer = $('#selected-tags-jenjang');
    tagContainer.append(`
        <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
            ${tagText}
            <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="removeTag('${tagText.replace(/'/g, "\\'")}', this, 'jenjang_tags');">×</span>
            <input type="hidden" name="jenjang_pendidikan[]" value="${tagText}">
        </div>
    `);
    updateJenjangCounter();
    $('#jenjang_pendidikan').val('');
}

function updateJenjangCounter() {
    let count = $('#selected-tags-jenjang input[type="hidden"]').length;
    $('#tag-counter-jenjang').text(`Jumlah jenjang yang dipilih: ${count}`);
}

// Fetch tags for beasiswa
function fetchBeasiswaTags() {
    let query = $('#syarat_beasiswa').val().trim();
    if (query === '') {
        $('#syarat-suggestions-beasiswa').addClass('hidden');
        return;
    }
    $.ajax({
        url: "{{ route('Beasiswa.search_syarat') }}",
        type: 'GET',
        data: { query: query },
        success: function(tags) {
            let suggestions = $('#syarat-suggestions-beasiswa').empty().removeClass('hidden');
            if (!tags.length) {
                suggestions.addClass('hidden');
                return;
            }
            tags.forEach(tag => {
                suggestions.append(`
                    <div class="tag-suggestion-syarat px-4 py-2 text-gray-700 hover:bg-indigo-100 cursor-pointer">
                        ${tag.syarat}
                    </div>
                `);
            });
            $('.tag-suggestion-syarat').on('click', function() {
                addBeasiswaTag($(this).text());
                suggestions.empty().addClass('hidden');
            });
        }
    });
}

// Add tag for beasiswa
function addBeasiswaTag(tagText) {
    tagText = tagText.trim();
    if (syarat_tags.includes(tagText)) {
        $('#syarat_beasiswa').val('');
        return;
    }

    if (tagText === ''){
        return;
    }
    // Tambahkan tag ke array dan ke UI
    syarat_tags.push(tagText);
    
    let tagContainer = $('#selected-tags-beasiswa');
    tagContainer.append(`
        <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
            ${tagText}
            <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="removeTag('${tagText.replace(/'/g, "\\'")}', this, 'syarat_tags');">×</span>
            <input type="hidden" name="syarat_beasiswa[]" value="${tagText}">
        </div>
    `);
    updateBeasiswaCounter();
    $('#syarat_beasiswa').val('');
}

function updateBeasiswaCounter() {
    let count = $('#selected-tags-beasiswa input[type="hidden"]').length;
    $('#tag-counter-beasiswa').text(`Jumlah syarat yang dipilih: ${count}`);
}

// Similar functions for dokumen
function fetchDokumenTags() {
    let query = $('#syarat_dokumen').val().trim();
    if (query === '') {
        $('#syarat-suggestions-dokumen').addClass('hidden');
        return;
    }
    $.ajax({
        url: "{{ route('Beasiswa.search_dokumen') }}",
        type: 'GET',
        data: { query: query },
        success: function(tags) {
            let suggestions = $('#syarat-suggestions-dokumen').empty().removeClass('hidden');
            if (!tags.length) {
                suggestions.addClass('hidden');
                return;
            }
            tags.forEach(tag => {
                suggestions.append(`
                    <div class="tag-suggestion-dokumen px-4 py-2 text-gray-700 hover:bg-indigo-100 cursor-pointer">
                        ${tag.dokumen}
                    </div>
                `);
            });
            $('.tag-suggestion-dokumen').on('click', function() {
                addDokumenTag($(this).text());
                suggestions.empty().addClass('hidden');
            });
        }
    });
}

function addDokumenTag(tagText) {
    tagText = tagText.trim();

    if (dokumen_tags.includes(tagText)) {
        $('#syarat_dokumen').val('');
        return;
    }
    if (tagText === ''){
        return;
    }

    // Tambahkan tag ke array dan ke UI
    dokumen_tags.push(tagText);

    let tagContainer = $('#selected-tags-dokumen');
    tagContainer.append(`
        <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
            ${tagText}
            <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="removeTag('${tagText.replace(/'/g, "\\'")}', this, 'dokumen_tags');">×</span>
            <input type="hidden" name="syarat_dokumen[]" value="${tagText}">
        </div>
    `);
    updateDokumenCounter();
    $('#syarat_dokumen').val('');
}

function updateDokumenCounter() {
    let count = dokumen_tags.length;
    $('#tag-counter-dokumen').text(`Jumlah syarat dokumen yang dipilih: ${count}`);
}

// Fetch tags for benefit
function fetchBenefitTags() {
    let query = $('#benefit_beasiswa').val().trim();
    if (query === '') {
        $('#benefit-suggestions-beasiswa').addClass('hidden');
        return;
    }
    $.ajax({
        url: "{{ route('Beasiswa.search_benefit') }}",
        type: 'GET',
        data: { query: query },
        success: function(tags) {
            let suggestions = $('#benefit-suggestions-beasiswa').empty().removeClass('hidden');
            if (!tags.length) {
                suggestions.addClass('hidden');
                return;
            }
            tags.forEach(tag => {
                suggestions.append(`
                    <div class="tag-suggestion-benefit px-4 py-2 text-gray-700 hover:bg-indigo-100 cursor-pointer">
                        ${tag.benefit}
                    </div>
                    `);
            });
            $('.tag-suggestion-benefit').on('click', function() {
                addBenefitTag($(this).text());
                suggestions.empty().addClass('hidden');
            });
        }
    });
}

// Add tag for benefit
function addBenefitTag(tagText) {
    tagText = tagText.trim();

    if (benefit_tags.includes(tagText)) {
        $('#benefit_beasiswa').val('');
        return;
    }

    
    // Tambahkan tag ke array dan ke UI
    benefit_tags.push(tagText);

    let tagContainer = $('#selected-tags-benefit');
    tagContainer.append(`
        <div class="flex items-center bg-indigo-100 text-indigo-700 rounded-md px-2 py-1 text-sm">
            ${tagText}
            <span class="ml-2 text-gray-500 hover:text-red-500 cursor-pointer" onclick="removeTag('${tagText.replace(/'/g, "\\'")}', this, 'benefit_tags');">×</span>
            <input type="hidden" name="benefit_beasiswa[]" value="${tagText}">
        </div>
    `);
    updateBenefitCounter();
    $('#benefit_beasiswa').val('');
} 

function updateBenefitCounter() {
    let count = $('#selected-tags-benefit input[type="hidden"]').length;
    $('#tag-counter-benefit').text(`Jumlah benefit yang dipilih: ${count}`);
}

function removeTag(tagText, element, arrayName) {
    tagText = tagText.trim();

    // Hapus tag dari UI
    $(element).parent().remove();

    if (arrayName == 'benefit_tags'){
        benefit_tags = benefit_tags.filter(tag => tag !== tagText);
        updateBenefitCounter();
    } else if (arrayName == 'jenjang_tags'){
        jenjang_tags = jenjang_tags.filter(tag => tag !== tagText);
        updateJenjangCounter();
    } else if (arrayName == 'syarat_tags'){
        syarat_tags = syarat_tags.filter(tag => tag !== tagText);
        updateBeasiswaCounter();
    } else {
        dokumen_tags = dokumen_tags.filter(tag => tag !== tagText);
        updateDokumenCounter();
    }
}

// Preview gambar
document.getElementById('poster_beasiswa').addEventListener('change', function () {
    if (this.files.length > 3) {
        alert("Anda hanya dapat mengupload maksimal 3 file.");
        this.value = ""; // Reset file input
    }
});
let selectedFiles = []; // Menyimpan file yang dipilih

// function displayFileNamesAndPreview() {
//     const input = document.getElementById('poster_beasiswa');
//     if (input.files.length > 3) {
//         alert("Anda hanya dapat mengupload maksimal 3 file.");
//         input.value = "";
//         return;
//     }
//     selectedFiles = Array.from(input.files); // Salin file yang dipilih ke array `selectedFiles`
//     renderPreviews();
// }

function displayFileNamesAndPreview() {
    const input = document.getElementById('poster_beasiswa');
    
    if (input.files.length > 3) {
        alert("Anda hanya dapat mengupload maksimal 3 file.");
        input.value = "";
        return;
    }
    
    // Simpan file yang dipilih ke sessionStorage
    selectedFiles = Array.from(input.files);
    saveFilesToStorage(selectedFiles);
    
    renderPreviews(selectedFiles);  // Tampilkan pratinjau untuk file yang dipilih
}

function saveFilesToStorage(files) {
    let fileUrls = [];
    
    // Ambil data URL dari setiap file dan simpan ke sessionStorage
    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            fileUrls.push(e.target.result);
            // Setelah semua file di proses, simpan ke sessionStorage
            if (fileUrls.length === files.length) {
                sessionStorage.setItem('uploadedFiles', JSON.stringify(fileUrls));
            }
        };
        reader.readAsDataURL(file);
    });
}

function renderFileList() {
    const fileList = document.getElementById('file-list');
    fileList.innerHTML = ''; // Kosongkan daftar file

    selectedFiles.forEach((file, index) => {
        const fileItem = document.createElement('div');
        fileItem.classList.add('flex', 'items-center', 'justify-between', 'mb-1');

        const fileName = document.createElement('span');
        fileName.textContent = file.name;

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Hapus';
        deleteButton.classList.add('text-red-500', 'ml-2', 'hover:underline');
        deleteButton.onclick = () => removeFile(index); // Panggil fungsi `removeFile`

        fileItem.appendChild(fileName);
        fileItem.appendChild(deleteButton);
        fileList.appendChild(fileItem);
    });
}

function renderPreviews() {
    const previewContainer = document.getElementById('preview-container');
    previewContainer.innerHTML = ''; // Kosongkan kontainer preview

    selectedFiles.forEach((file, index) => {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imgContainer = document.createElement('div');
                imgContainer.classList.add('relative', 'w-24', 'h-24', 'mb-2', 'mr-2');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = file.name;
                img.classList.add('w-full', 'h-full', 'object-cover', 'rounded-md', 'shadow-sm');

                // Fungsi untuk memperbesar gambar saat diklik
                img.onclick = () => openModal(e.target.result);

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'X';
                deleteButton.classList.add(
                    'absolute', 'top-1', 'right-1', 'bg-red-500', 'text-white', 'rounded-full', 'w-6', 'h-6', 'flex',
                    'items-center', 'justify-center', 'text-xs', 'opacity-0', 'hover:opacity-100', 'transition-opacity'
                );
                deleteButton.onclick = () => removeFile(index); // Panggil fungsi `removeFile`

                imgContainer.onmouseenter = () => (deleteButton.style.opacity = '1'); // Tampilkan tombol saat dihover
                imgContainer.onmouseleave = () => (deleteButton.style.opacity = '0'); // Sembunyikan tombol saat tidak dihover

                imgContainer.appendChild(img);
                imgContainer.appendChild(deleteButton);
                previewContainer.appendChild(imgContainer);
            };
            reader.readAsDataURL(file);
        }
    });
}

function removeFile(index) {
    selectedFiles.splice(index, 1); // Hapus file dari array `selectedFiles`
    renderFileList(); // Perbarui daftar file
    renderPreviews(); // Perbarui preview gambar
}

function openModal(imageSrc) {
    const modal = document.getElementById('modal');
    const modalImage = document.getElementById('modal-image');
    modalImage.src = imageSrc; // Set gambar modal ke gambar yang diklik
    modal.classList.remove('hidden'); // Tampilkan modal
}

document.getElementById('close-modal').onclick = function () {
    event.preventDefault();
    document.getElementById('modal').classList.add('hidden'); // Sembunyikan modal saat tombol close diklik
};

document.getElementById('modal').onclick = function (e) {
    if (e.target === this) {
        event.preventDefault();
        this.classList.add('hidden'); // Sembunyikan modal saat area luar gambar diklik
    }
};
