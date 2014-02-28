var Ajax = {
  
    trackIdea: function(dom, id) {
        $.ajax({
          type: "POST",
          url: '/trackings/track/' + id,
          async: true,
          success: function(data) {
            if (data.response === "success") {
                $(dom).unbind().removeClass("trackbtn").addClass("untrackbtn").attr("onclick", "event.stopPropagation();").click(function() {Ajax.untrackIdea(dom, id)});
            }
          },
          dataType: 'json'
        });
    },

    untrackIdea: function(dom, id) {
        $.ajax({
          type: "POST",
          url: '/trackings/untrack/' + id,
          async: true,
          success: function(data) {
            if (data.response === "success") {
                $(dom).unbind().removeClass("untrackbtn").addClass("trackbtn").attr("onclick", "event.stopPropagation();").click(function() {Ajax.trackIdea(dom, id)});
            }
          },
          dataType: 'json'
        });
    },

    Idea: {
      showIdea: function(ideaid) {
        $.ajax({
          type: "GET",
          url: '/ideas/idea/' + ideaid,
          async: true,
          success: function(data) {
            $('#ajax-modal').remove();
            $('body').append(data);
            $('#ajax-modal').modal();
            $('#ajax-modal').bindIdeaModal();
          }
        });
      }
    },

    Notifications: {
      getNotifications: function() {
        $.ajax({
          type: "GET",
          url: '/notifications',
          async: true,
          success: function(data) {
            $('.navbar .notifications-menu').html(data);
            $('.navbar .badge-notifications').text($('.navbar .notifications-menu li').length);
          }
        });
      },

      /*
       * Notify users with a message
       * params:  required: message, ideaid
       *          optional: userid
       */
      notify: function(message, ideaid, userid) {
        userid = typeof userid !== 'undefined' ? userid : null;
        var url = '/notifications/notify/' + ideaid + "?m=" + message;
        if (userid != null) {
          url += "&userid=" + userid;
        }
        $.ajax({
          type: "POST",
          url: url,
          async: true,
          success: function(data) {
            if (data.response !== "success") {
              alert("Could not share with user");
            }
          },
          dataType: 'json'
        });
      }
    },

// url: /comments/comment/<<IDEA ID>>?c=<<TEXT FOR COMMENT>>
    Comments: {
      comment: function(message, ideaid) {
        var url = '/ideas/comment/' + ideaid + "?c=" + message;
        $.ajax({
           type: "POST",
           url: url,
           async: true,
           success: function(data) {
             if (data.response === "success") {
                 alert("Comment has been posted!");
                 $("#ajax-modal .commentList").append(data.data.html);
             }
          },
          dataType: 'json'
        });
      }
    }
};