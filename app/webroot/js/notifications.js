$(function() {

    /*
     description: attach on click funtion to $('.navbar .notifications-btn') to get notification when pressed
     input: e
     preconditions:
            $('.navbar .notifications-btn') exists
            $('.navbar .notifications-btn') has been clicked
     postconditions: Ajax.Notifications.getNotifications() is called
     return value: none
    */
    $('.navbar .notifications-btn').bind("click", function(e) {
        Ajax.Notifications.getNotifications();
    });
});