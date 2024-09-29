<!DOCTYPE html>
<html>
<head>
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
    </script>
</head>
<body>
    
</body>
</html>