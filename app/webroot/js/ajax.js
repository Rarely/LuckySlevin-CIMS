var Ajax = {
    trackIdea: function(dom, id) {
        $.ajax({
          type: "POST",
          url: '/trackings/track/' + id,
          async: true,
          success: function(data) {
            if (data.response === "success") {
                $(dom).unbind().text("Untrack").attr("onclick", "event.stopPropagation();").click(function() {Ajax.untrackIdea(dom, id)});
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
                $(dom).unbind().text("Track").attr("onclick", "event.stopPropagation();").click(function() {Ajax.trackIdea(dom, id)});
            }
          },
          dataType: 'json'
        });
    }
};