jQuery.fn.bindIdeaModal = function() {
    var el = $(this[0]);
    var id = $("#ajax-modal").attr("data-id");

    //Hook up Sharing
    $('#ajax-modal .sharing-autocomplete').userSelect(true, null, true, "Share with Others");
    $('#ajax-modal .btn-share').bind("click", function(e) {
      Ajax.Idea.shareIdea(id, $('#ajax-modal .sharing-autocomplete').select2("val").join(","));
      $('#ajax-modal .sharing-autocomplete').select2('data', null);
    });

    //bind comment button
    $('#ajax-modal .commentbtn').bind("click", function(e) {
      Ajax.Comments.comment($('#ajax-modal #commentField').val(), id);
    });
};

jQuery.fn.selectable = function(toggle) {
  var el = $(this[0]);
  if ((el.hasClass("selectable") || el.hasClass("selected")) && toggle == false) {
    el.removeClass("selectable").removeClass("selected");
  } else {
    el.addClass("selectable");
    el.unbind("click").bind("click", function() {
      if (el.hasClass("selected")) {
        el.removeClass("selected").addClass("selectable");
      } else {
        el.removeClass("selectable").addClass("selected");
      }
    });
  }
};