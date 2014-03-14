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
            $('.modal-backdrop').remove();
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
              alert("Error Deleting Idea: " + ideaids);
            }
          }
        });
      },

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
                 $("#ajax-modal .commentblock ul").append(data.data.html);
                 $("#ajax-modal .commentblock").animate({ scrollTop: $("#ajax-modal .commentblock ul").height() }, "slow");
                 $("#ajax-modal #commentField").val("");
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
    },

    Categories: {
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

      create: function(categoryID, name) {
        $.ajax({
          type: "POST",
          dataType: 'json',
          url: '/categories/create/' + categoryID + "?name=" + name,
          async: true,
          success: function(data) {
            if (data.response === "success") {
              var html = "<tr data-id=\"" + data.data.dataid + "\"><td  class=\"value-name\">" + name + 
              "</td><td>" +
              "<div class=\"btn-delete-value admin-btn admin-btn-sm admin-btn-delete\"></div>" +
              "<div class=\"btn-edit-value admin-btn admin-btn-sm admin-btn-edit\"></div>" +
              "</td></tr>";
              $('.table-category').append(html);
              $("tr[data-id=\"" + data.data.dataid + "\"] .btn-edit-value").click(function() {
                
                  var id = $(this).parent().parent().attr('data-id');
                  bootbox.prompt("Please enter a new value:", function(result) {
                      if (result !== null) {
                          Ajax.Categories.edit(id, result);
                      }
                  });
              });
              $("tr[data-id=\"" + data.data.dataid + "\"] .btn-delete-value").click(function() {
                  var id = $(this).parent().parent().attr('data-id');
                  bootbox.confirm("Are you sure?", function(result) {
                    if (result === true) {
                      Ajax.Categories.delete(id);
                    }
                  });
              });
            }
          }
        });
      },

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


