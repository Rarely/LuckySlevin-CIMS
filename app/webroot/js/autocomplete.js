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

/*
 * Makes a select box a category value chooser by passing it a categoryid
*/
jQuery.fn.categorySelect = function(defaultvals) {
  var el = $(this[0]); // It's your element
  // debugger;
  if (typeof el.attr('specifiable') != 'undefined') {
    el.select2({
      createSearchChoice:function(term, data) { if ($(data).filter(function() { return this.text.localeCompare(term)===0; }).length===0) {return {id:term, text:term};} },
      allowClear: true,
      multiple: (typeof el.attr('multiple') != 'undefined'),
      initSelection: function (element, callback) {
          callback(jQuery.parseJSON( defaultvals ));
      },
      ajax: {
        url: "/ideas/valueslist/" + el.attr('data-id'),
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
    });
  } else {
    el.select2({
      allowClear: true,
      multiple: (typeof el.attr('multiple') != 'undefined'),
      initSelection: function (element, callback) {
          callback(jQuery.parseJSON( defaultvals ));
      },
      ajax: {
        url: "/ideas/valueslist/" + el.attr('data-id'),
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
    });
  }
};