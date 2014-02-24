var Ajax = {
    trackIdea: function(dom, id) {
        $.ajax({
          type: "POST",
          url: '/trackings/track/' + id,
          async: true,
          success: function(data) {
            if (data.response === "success") {
                $(dom).unbind("click").text("Untrack").bind("click", function(e) { 
                    Ajax.untrackIdea(dom, id);
                });
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
                $(dom).unbind("click").text("Track").bind("click", function(e) { 
                    Ajax.trackIdea(dom, id);
                });
            }
          },
          dataType: 'json'
        });
    }
};