<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Additional styles for better visuals */
        .notification-popup {
            transition: all 0.3s ease;
        }
    </style>
    {{-- Filter --}}
    <script>
        function showPopup() {
            document.getElementById('popup').classList.remove('hidden');
        }

        function hidePopup() {
            document.getElementById('popup').classList.add('hidden');
        }
        function toggleSelection(id) {
        const btn = document.getElementById(id);
        if (btn.style.backgroundColor === 'rgb(249, 115, 22)') {  // Checking if the background is orange
            // Unselecting - Revert to default styles
            btn.style.backgroundColor = 'white';
            btn.style.color = '#6B7280';  // Grey text
            btn.style.border = '2px solid #F97316';  // Orange border
        } else {
            // Selecting - Apply selected styles
            btn.style.backgroundColor = '#F97316';  // Orange background
            btn.style.color = 'white';  // White text
            btn.style.border = 'none';  // No border for selected
        }
    }

    function setJenisBeasiswa(value) {
        document.getElementById('jenis_beasiswa').value = value;
        
        // Optionally, update the button styles to reflect the selected state
        document.getElementById('half').style.backgroundColor = (value === 'half') ? '#F97316' : 'white';
        document.getElementById('full').style.backgroundColor = (value === 'full') ? '#F97316' : 'white';

        }

        function searchBeasiswa() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const beasiswaCards = document.querySelectorAll('.beasiswa-card');

            beasiswaCards.forEach(card => {
                const namaBeasiswa = card.getAttribute('data-nama-beasiswa').toLowerCase();
                if (namaBeasiswa.includes(input)) {
                    card.style.display = ''; // Show the card
                } else {
                    card.style.display = 'none'; // Hide the card
                }
            });
        }

        function runFilter() {
            let halfSelected = document.getElementById('half').classList.contains('border-orange-500');
            let fullSelected = document.getElementById('full').classList.contains('border-orange-500');
            let programSelected = document.getElementById('tipe_beasiswa').value;
            let jenjangSelected = document.getElementById('jenjang_pendidikan').value;
            let jurusanSelected = document.getElementById('jurusan').value;

            // Create the query string based on selected filters
            let queryParams = new URLSearchParams();

            // Add jenis_beasiswa filters
            if (halfSelected) {
                queryParams.append('jenis_beasiswa[]', 'half');
            } 
            if (fullSelected) {
                queryParams.append('jenis_beasiswa[]', 'full');
            }

            // Add tipe_beasiswa filter (only if it is selected)
            if (programSelected) {
                queryParams.append('tipe_beasiswa', programSelected);
            }

            // Add jenjang_pendidikan filter (only if it is selected)
            if (jenjangSelected) {
                queryParams.append('jenjang_pendidikan', jenjangSelected);
            }

            if(jurusanSelected) {
                queryParams.append('jurusan_khusus', jurusanSelected);
            }

            // Redirect to the filtered URL
            window.location.href = `?${queryParams.toString()}`;
        }


    </script>
</head>
<body>

</body>
</html>