jQuery.fn.userSelect = function() {
    var el = $(this[0]) // It's your element
    el.select2({
        placeholder: "Share with Others",
        multiple: true,
        allowClear: true,
        minimumInputLength: 0,
        ajax: {
          url: "/users/memberslist",
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term
            };
          },
          results: function (data, page) {
            return { results: data };
          }
        },
        dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
        escapeMarkup: function (m) { return m; }
    });
};