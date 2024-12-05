import './bootstrap';


window.Echo.private(`App.Models.User.${userId}`)
    .notification((notification) => {
        alert(notification.message); // Show in navbar dynamically
    });



