<!DOCTYPE html>
<html>
<head>
    <style>
        /* Additional styles for better visuals */
        .notification-popup {
            transition: all 0.3s ease;
        }
    </style>
    {{-- notification --}}
    <script>
        // Sample notifications data
        const notifications = [
            {
                message: "Daffa Al Ghifari mengajukan beasiswa pada 17 Agustus...",
                timestamp: "2024-08-17T21:00:00",
                read: false
            },
            {
                message: "Notification 2: Example message...",
                timestamp: "2024-08-18T12:00:00",
                read: true
            },
            {
                message: "Notification 3: Another example...",
                timestamp: "2024-08-19T14:00:00",
                read: false
            }
        ];

        let currentNotifications = notifications; // Store current notifications to show

        function renderNotifications() {
            const notificationList = document.getElementById('notificationList');
            notificationList.innerHTML = ""; // Clear existing notifications
            let unreadCount = 0;

            currentNotifications.forEach((notification, index) => {
                const date = new Date(notification.timestamp);
                const dateString = date.toLocaleString('id-ID', { 
                    year: 'numeric', month: 'long', day: 'numeric', 
                    hour: 'numeric', minute: 'numeric', hour12: false 
                });

                // Create notification item
                const notificationItem = document.createElement('div');
                notificationItem.className = 'notification-item p-2 rounded-md cursor-pointer transition-colors duration-200';
                notificationItem.style.backgroundColor = notification.read ? '#f7fafc' : '#ffffff'; // Light gray for read

                // Construct the inner HTML of the notification item
                notificationItem.innerHTML = `
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-lg mr-2"></div>
                        <div class="flex-1">
                            <p class="font-medium text-sm">${notification.message}</p>
                            <p class="text-xs text-gray-500">${dateString}</p>
                        </div>
                        <span class="w-2 h-2 ${notification.read ? 'invisible' : 'bg-red-500'} rounded-full"></span>
                    </div>
                    <div class="description hidden mt-2 text-sm text-gray-600">
                        Deskripsi lengkap mengenai ${notification.message}
                    </div>
                `;

                // Append click event to toggle description and mark as read if necessary
                notificationItem.onclick = () => {
                    toggleDetails(notificationItem.querySelector('.description'));
                    if (!notification.read) {
                        notification.read = true; // Mark as read
                        unreadCount--; // Decrement unread count
                        renderNotifications(); // Re-render notifications
                    }
                };

                // Append notification item to the list
                notificationList.appendChild(notificationItem);

                if (!notification.read) {
                    unreadCount++;
                }
            });

            // Update the unread count and animate the text
            const unreadText = document.getElementById('unreadText');
            unreadText.innerText = `Belum Dibaca (${unreadCount})`;
            if (unreadCount > 0) {
                unreadText.style.color = '#38a169'; // Green color for unread text
                unreadText.style.transform = 'translateX(4px)'; // Animate the text
            } else {
                unreadText.style.color = ''; // Reset color
                unreadText.style.transform = ''; // Reset transform
            }
        }

        function toggleDetails(descriptionElement) {
            descriptionElement.classList.toggle('hidden'); // Toggle visibility of the description
        }

        function markAllAsRead() {
            notifications.forEach(notification => {
                notification.read = true; // Mark all as read
            });
            renderNotifications();
        }

        function closeNotification() {
        const notificationPopup = document.getElementById('notificationPopup');
        notificationPopup.classList.add('hidden'); // or use 'display: none' if you want to remove it from flow
        }

        function showAll() {
            currentNotifications = notifications; // Set to all notifications
            renderNotifications(); // Re-render notifications
            updateActiveButton('showAllButton');
        }

        function showUnread() {
            currentNotifications = notifications.filter(notification => !notification.read); // Set to unread notifications
            renderNotifications(); // Re-render notifications
            updateActiveButton('unreadCount');
        }

        function updateActiveButton(activeButtonId) {
            const showAllButton = document.getElementById('showAllButton');
            const unreadCountButton = document.getElementById('unreadCount');

            if (activeButtonId === 'showAllButton') {
                showAllButton.style.color = '#38a169';
                showAllButton.style.borderBottom = '2px solid #38a169';
                unreadCountButton.style.color = '#6b7280'; // Reset color
                unreadCountButton.style.borderBottom = 'none'; // Remove underline
            } else {
                unreadCountButton.style.color = '#38a169';
                unreadCountButton.style.borderBottom = '2px solid #38a169';
                showAllButton.style.color = '#6b7280'; // Reset color
                showAllButton.style.borderBottom = 'none'; // Remove underline
            }
        }

        function togglePopup() {
            const popup = document.getElementById('notificationPopup');
            popup.classList.toggle('hidden');
            renderNotifications(); // Render notifications when popup is shown
        }

        // Initial render of notifications
        renderNotifications();
    </script>
</head>
<body>
    
</body>
</html>