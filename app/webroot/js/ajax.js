var Ajax = {
    /*
     description: send out an ajax call to '/trackings/track/' + id
     input: id
     preconditions: '/trackings/track/' + id is a valid url
     postconditions:
            remove class "trackbtn"
            add class "untrackbtn"
            change title to "Untrack"
     return value: none
    */
    trackIdea: function(id) {
        $.ajax({
          type: "POST",
          url: '/trackings/track/' + id,
          async: true,
          success: function(data) {
            if (data.response === "success") {
              jQuery(".idea-actions[data-id=" + id + "] .trackbtn").each(function() {
                $(this).unbind().removeClass("trackbtn").addClass("untrackbtn").attr('title','Untrack').attr("onclick", "event.stopPropagation();").click(function() {Ajax.untrackIdea(id)});
              });
            }
          },
          dataType: 'json'
        });
    },

    /*
     description: send out an ajax call to '/trackings/untrack/' + id
     input: id
     preconditions: '/trackings/track/' + id is a valid url
     postconditions:
            remove class "untrackbtn"
            add class "trackbtn"
            change title to "Track"
     return value: none
    */
    untrackIdea: function(id) {
        $.ajax({
          type: "POST",
          url: '/trackings/untrack/' + id,
          async: true,
          success: function(data) {
            if (data.response === "success") {
                jQuery(".idea-actions[data-id=" + id + "] .untrackbtn").each(function() {
                $(this).unbind().removeClass("untrackbtn").addClass("trackbtn").attr('title','Track').attr("onclick", "event.stopPropagation();").click(function() {Ajax.trackIdea(id)});
              });
            }
          },
          dataType: 'json'
        });
    },

    Idea: {

      /*
       description: send out an ajax call to '/ideas/idea/' + ideaid
       input: ideaid
       preconditions: '/ideas/idea/' + ideaid is a valid url
       postconditions:
            show ajax-modal
       return value: none
      */
      showIdea: function(ideaid) {
        $.ajax({
          type: "GET",
          url: '/ideas/idea/' + ideaid,
          async: true,
          success: function(data) {
            $('#ajax-modal').remove();
            $('.modal-backdrop').remove();
            $('body').append(data);
            $('#ajax-modal').modal();
            $('#ajax-modal').bindIdeaModal();
          }
        });
      },
      
      /*
       description: send out an ajax call to '/ideas/delete?ids=' + ideaids
       input: ideaids
       preconditions: '/ideas/delete?ids=' + ideaids is a valid url
       postconditions: remove small idea views for the deleted ideas
       return value: none
      */
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
              alert("Error Deleting Idea: " + ideaids);
            }
          }
        });
      },

      /*
       description: send out an ajax call to '/ideas/share/' + ideaid + '?userids=' + userids
       input: ideaid, userids
       preconditions: '/ideas/share/' + ideaid + '?userids=' + userids is a valid url
       postconditions: Render bootbox informing the user is idea was shared successfully or not
       return value: none
      */
      shareIdea: function(ideaid, userids) {
        $.ajax({
          type: "POST",
          dataType: "json",
          url: '/ideas/share/' + ideaid + '?userids=' + userids,
          async: true,
          success: function(data) {
            if (data.response === "success") {
              bootbox.alert("Shared");
            } else {
              bootbox.alert("Failed to share idea");
            }
          }
        });
      }
    },

    Notifications: {

      /*
       description: send out an ajax call to /notifications
       input: none
       preconditions: /notifications is a valid url
       postconditions: update notification badge
       return value: none
      */
      getNotifications: function() {
        $.ajax({
          type: "GET",
          url: '/notifications',
          async: true,
          success: function(data) {
            $('.navbar .notifications-menu').html(data);
            if ($('.navbar .notifications-menu a.active').length > 0) {
              $('.navbar .badge-notifications').text($('.navbar .notifications-menu a.active').length).show();
            } else {
              $('.navbar .badge-notifications').text($('.navbar .notifications-menu a.active').length).hide();
            }
          }
        });
      },

      /*
       description: send out an ajax call to '/notifications/notified/' + id
       input: dom, id
       preconditions: '/notifications/notified/' + id is a valid url
       postconditions: update notification badge
       return value: none
      */
      setNotified: function(dom, id) {
        $.ajax({
          type: "GET",
          url: '/notifications/notified/' + id,
          async: true,
          success: function(data) {
            $(dom).removeClass('active');
            if ($('.navbar .notifications-menu a.active').length > 0) {
              $('.navbar .badge-notifications').text($('.navbar .notifications-menu a.active').length).show();
            } else {
              $('.navbar .badge-notifications').text($('.navbar .notifications-menu a.active').length).hide();
            }

          }
        });
      },

      /*
       description: Notify users with a message, send ajax call to '/notifications/notify/' + ideaid + "?m=" + message
       input: 
           required: message, ideaid
           optional: userid
       preconditions: '/notifications/notify/' + ideaid + "?m=" + message is a valid url
       postconditions: alert is sharing failed
       return value: none
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

    
    Comments: {

      /*
       description: send ajax call to '/ideas/comment/' + ideaid + "?c=" + message
       input: message, ideaid
       preconditions: '/ideas/comment/' + ideaid + "?c=" + message is a valid url
       postconditions: prepend new comment to comments section
       return value: none
      */
      comment: function(message, ideaid) {
        var url = '/ideas/comment/' + ideaid + "?c=" + message;
        $.ajax({
           type: "POST",
           url: url,
           async: true,
           success: function(data) {
             if (data.response === "success") {
                 $("#ajax-modal .commentblock ul").prepend(data.data.html);
                 $("#ajax-modal .commentblock").animate({ scrollTop: 0 }, "slow");
                 $("#ajax-modal #commentField").val("");
             }
          },
          dataType: 'json'
        });
      }
    },

    User: {

      /*
       description: send ajax call to '/users/delete/' + userid
       input: userid
       preconditions: '/users/delete/' + userid is a valid url
       postconditions: remove deleted user from user list
       return value: none
      */
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
    },

    Categories: {

      /*
       description: send ajax call to '/categories/delete/' + valueID
       input: valueID
       preconditions: '/categories/delete/' + valueID is a valid url
       postconditions: remove deleted value from value list
       return value: none
      */
      delete: function(valueID) {
        $.ajax({
          type: "POST",
          dataType: 'json',
          url: '/categories/delete/' + valueID,
          async: true,
          success: function(data) {
            if (data.response === "success") {
              $('tr[data-id=' + valueID + ']').remove();
            }
          }
        });
      },

      /*
       description: send ajax call to '/categories/create/' + categoryID + "?name=" + name
       input: categoryID, name
       preconditions: '/categories/create/' + categoryID + "?name=" + name is a valid url
       postconditions: add new value to value list
       return value: none
      */
      create: function(categoryID, name) {
        $.ajax({
          type: "POST",
          dataType: 'json',
          url: '/categories/create/' + categoryID + "?name=" + name,
          async: true,
          success: function(data) {
            if (data.response === "success") {
              var html = "<tr data-id=\"" + data.data.dataid + "\" data-name=\"" + data.data.dataname + "\"><td  class=\"value-name\">" + name + 
              "</td><td>" +
              "<div class=\"btn-delete-value admin-btn admin-btn-sm admin-btn-delete\"></div>" +
              "<div class=\"btn-edit-value admin-btn admin-btn-sm admin-btn-edit\"></div>" +
              "</td></tr>";
              $('.table-category').append(html);
              $("tr[data-id=\"" + data.data.dataid + "\"] .btn-edit-value").click(function() {
                
                  var id = $(this).parent().parent().attr('data-id');
                  var name = $(this).parent().parent().attr('data-name');
                  bootbox.prompt("Please enter a new value for " + name + ":", function(result) {
                    if (result !== null) {
                      Ajax.Categories.edit(id, result);
                    }
                  }).find("div.modal-content").addClass("confirmWidth");
              });
              $("tr[data-id=\"" + data.data.dataid + "\"] .btn-delete-value").click(function() {
                  var id = $(this).parent().parent().attr('data-id');
                  var name = $(this).parent().parent().attr('data-name');
                  bootbox.confirm("Are you sure you want to remove the value " + name + "?", function(result) {
                   if (result === true) {
                    Ajax.Categories.delete(id);
                   }
                  }).find("div.modal-content").addClass("confirmWidth");
              });
            }
          }
        });
      },

      /*
       description: send ajax call to '/categories/edit/' + valueID + "?name=" + name
       input: valueID, name
       preconditions: '/categories/edit/' + valueID + "?name=" + name is a valid url
       postconditions: updated edited value in value list
       return value: none
      */
      edit: function(valueID, name) {
        $.ajax({
          type: "POST",
          dataType: 'json',
          url: '/categories/edit/' + valueID + "?name=" + name,
          async: true,
          success: function(data) {
            if (data.response === "success") {
              $('tr[data-id=' + valueID + '] .value-name').text(name);
            }
          }
        });
      }
    }
};


