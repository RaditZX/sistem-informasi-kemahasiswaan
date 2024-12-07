function showAlert(type, title, message) {
    const alertOverlay = document.getElementById('alertOverlay');
    const alertPopup = document.getElementById('alertPopup');
    const alertIcon = document.getElementById('alertIcon');
    const alertTitle = document.getElementById('alertTitle');
    const alertMessage = document.getElementById('alertMessage');

    // Update title, message, and icon based on type
    alertTitle.textContent = title;
    alertMessage.textContent = message;
    alertIcon.className = 'w-10 h-10 flex items-center justify-center rounded-full';

    switch (type) {
        case 'success':
            alertIcon.classList.add('bg-green-100', 'text-green-600');
            alertIcon.innerHTML = '<i class="fas fa-check-circle text-2xl"></i>';
            break;
        case 'error':
            alertIcon.classList.add('bg-red-100', 'text-red-600');
            alertIcon.innerHTML = '<i class="fas fa-times-circle text-2xl"></i>';
            break;
        case 'warning':
            alertIcon.classList.add('bg-yellow-100', 'text-yellow-600');
            alertIcon.innerHTML = '<i class="fas fa-exclamation-circle text-2xl"></i>';
            break;
        case 'info':
            alertIcon.classList.add('bg-blue-100', 'text-blue-600');
            alertIcon.innerHTML = '<i class="fas fa-info-circle text-2xl"></i>';
            break;
    }

    // Show overlay and notification
    alertOverlay.classList.remove('hidden');

    // Automatically hide after 3 seconds
    setTimeout(() => {
        alertOverlay.classList.add('hidden');
    }, 3000);
}

// Close alert manually
document.getElementById('alertClose').addEventListener('click', () => {
    document.getElementById('alertOverlay').classList.add('hidden');
});
