var Ajax = {
  
    trackIdea: function(id) {
        $.ajax({
          type: "POST",
          url: '/trackings/track/' + id,
          async: true,
          success: function(data) {
            if (data.response === "success") {
              jQuery(".idea-actions[data-id=" + id + "] .trackbtn").each(function() {
                $(this).unbind().removeClass("trackbtn").addClass("untrackbtn").attr("onclick", "event.stopPropagation();").click(function() {Ajax.untrackIdea(id)});
              });
            }
          },
          dataType: 'json'
        });
    },

    untrackIdea: function(id) {
        $.ajax({
          type: "POST",
          url: '/trackings/untrack/' + id,
          async: true,
          success: function(data) {
            if (data.response === "success") {
                jQuery(".idea-actions[data-id=" + id + "] .untrackbtn").each(function() {
                $(this).unbind().removeClass("untrackbtn").addClass("trackbtn").attr("onclick", "event.stopPropagation();").click(function() {Ajax.trackIdea(id)});
              });
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
      },
      
      deleteIdea: function(ideaids) {
        $.ajax({
          type: "POST",
          dataType: "json",
          url: '/ideas/delete?ids=' + ideaids,
          async: true,
          success: function(data) {
            if (data.response === "success") {
              $("#btn-cancel-delete").click();
              $.each(data.data, function(key, value) {
                $(".ideablock[data-id=" + value + "]").remove();
              });
            } else {
              alert("PROBLEM");
            }
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
            $('.navbar .badge-notifications').text($('.navbar .notifications-menu a.active').length);
          }
        });
      },

      setNotified: function(dom, id) {
        $.ajax({
          type: "GET",
          url: '/notifications/notified/' + id,
          async: true,
          success: function(data) {
            $(dom).removeClass('active');
            $('.navbar .badge-notifications').text($('.navbar .notifications-menu a.active').length);
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
    },

    User: {
      delete: function(userid) {
        $.ajax({
          type: "POST",
          dataType: 'json',
          url: '/users/delete/' + userid,
          async: true,
          success: function(data) {
            if (data.response === "success") {
              $("tr[data-id=" + data.data.userid + "]").remove();
            }
          }
        });
      }
    }
};


