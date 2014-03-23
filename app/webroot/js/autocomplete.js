jQuery.fn.userSelect = function(excludeSelf, initvalue, multiple, placeholder) {
    multiple = multiple !== false;
    initvalue = initvalue || null;
    placeholder = placeholder || "";
    var el = $(this[0]) // It's your element
    var options = {
      placeholder: placeholder,
      multiple: multiple,
      allowClear: true,
      minimumInputLength: 0,
      ajax: {
        url: "/users/memberslist/"+excludeSelf,
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
    };
    if (initvalue !== null) {
      $.extend(options, {
        initSelection: function (element, callback) {
          if (multiple === false) {
            el.attr("value", jQuery.parseJSON( initvalue ).id);
          }
          callback(jQuery.parseJSON( initvalue ));
        }
      });
    }
    el.select2(options);
  };

/*
 * Makes a select box a category value chooser by passing it a categoryid
 */
 jQuery.fn.categorySelect = function(defaultvals) {
  var el = $(this[0]); // It's your element
  var is_multiple = (typeof el.attr('data-multiple') != 'undefined');
  var options = {
    allowClear: true,
    multiple: is_multiple,
    tokenSeparators: [",", ";"],
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
  };
  if (defaultvals) {
    $.extend(options, {
      initSelection: function (element, callback) {
        if (is_multiple === true) { 
          el.attr("value", "");
        }
        if (defaultvals === "null") {
          callback("");
          return;
        }
        if (is_multiple === false) {
          el.attr("value", jQuery.parseJSON( defaultvals ).id);
        }
        callback(jQuery.parseJSON( defaultvals ));
      }
    });
  }
  if (typeof el.attr('data-specifiable') != 'undefined') {
    $.extend(options, {createSearchChoice:function(term, data) { if ($(data).filter(function() { return this.text.localeCompare(term)===0; }).length===0) {return {id:term, text:term};} }});
  }

  el.select2(options);
};


jQuery.fn.ideaSelect = function(ideaid) {
  ideaid = ideaid || "";
  if (ideaid === "") {
    var url = "/ideas/idealist";
  } else {
    var url = "/ideas/idealist/" + ideaid;
  }
  var el = $(this[0]);
  var is_multiple = (typeof el.attr('data-multiple') != 'undefined');
  var defaultvals = el.attr('data-initvalue');
  var options = {
    allowClear: true,
    multiple: is_multiple,
    tokenSeparators: [",", ";"],
    ajax: {
      url: url,
      dataType: 'json',
      data: function (term, page) {
        return {
          q: term
        };
      },
      results: function (data, page) {
        return { results: data };
      }
    }
  };

  if (defaultvals) {
    $.extend(options, {
      initSelection: function (element, callback) {
        if (is_multiple === true) {
          el.attr("value", "");
        }
        if (defaultvals === "null") {
          callback("");
          return;
        }
        if (is_multiple === false) {
          el.attr("value", jQuery.parseJSON( defaultvals ).id);
        }
        callback(jQuery.parseJSON( defaultvals ));
      }
    });
  }
  el.select2(options);
};