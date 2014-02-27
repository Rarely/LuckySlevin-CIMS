$(function() {
    $('.navbar .notifications-btn').bind("click", function(e) {
        Ajax.Notifications.getNotifications();
    });
});