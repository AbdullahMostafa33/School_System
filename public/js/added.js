//show message for 4 sec
document.addEventListener('DOMContentLoaded', function () {
    const notification = document.getElementById('notification');
    if (notification) {
        // Show the notification
        notification.classList.add('show');

        // Hide the notification after 4 seconds
        setTimeout(() => {
            notification.classList.remove('show');
            // Optionally remove the notification from the DOM
            setTimeout(() => notification.remove(), 500); // Allow fade out to complete
        }, 4000);
    }
});