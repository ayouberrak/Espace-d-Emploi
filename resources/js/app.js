import './bootstrap';
window.Echo.private(`App.Models.User.${window.userId}`)
    .notification((notification) => {
        alert(notification.message);
    });
