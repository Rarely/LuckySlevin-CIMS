jQuery.fn.bindIdeaModal = function() {
    var el = $(this[0]);
    var id = $("#ajax-modal").attr("data-id");

    //Hook up Sharing
    $('#ajax-modal .sharing-autocomplete').userSelect(true, null, true, "Share with others");
    $('#ajax-modal .btn-share').bind("click", function(e) {
      Ajax.Idea.shareIdea(id, $('#ajax-modal .sharing-autocomplete').select2("val").join(","));
      $('#ajax-modal .sharing-autocomplete').select2('data', null);
    });

    //bind comment button
    $('#ajax-modal .commentbtn').bind("click", function(e) {
      Ajax.Comments.comment($('#ajax-modal #commentField').val(), id);
    });

    //bind split button
    $('#ajax-modal .split-btn').unbind().bind("click", function(e) {
      e.preventDefault();
      //grab data first
      var data = {
        community_partner: $("#ajax-modal .community_partner").text(),
        contact_name: $("#ajax-modal .contact_name").text(),
        contact_email: $("#ajax-modal .contact_email").text(),
        contact_phone: $("#ajax-modal .contact_phone").text(),
        parentid: $("#ajax-modal").attr('data-id')
      };

      $("#ajax-modal .close").click(); //close modal
      $("#ajax-modal").remove();
      $('.modal-backdrop').remove();

      $("#btn-add-idea").click(); //open new idea dialog
      //add hidden field with parent id
      $('<input name="data[Idea][parentid]" id="parent-id">').attr('type','hidden').val(data.parentid).appendTo('#new-idea-form');
      //now set the rest of the fields
      $("#new-idea-form #IdeaCommunityPartner").val(data.community_partner);
      $("#new-idea-form #IdeaContactName").val(data.contact_name);
      $("#new-idea-form #IdeaContactEmail").val(data.contact_email);
      $("#new-idea-form #IdeaContactPhone").val(data.contact_phone);
      return false;
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