$(document).ready(function() {
    tinymce.init({
        selector: "textarea.help_edit",
        theme: "modern",
        //width: 300,
        height: 600,
        plugins: ["wordcount searchreplace advlist autolink autosave code table hr wordcount textcolor"],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor", 
        style_formats: [
            {title: 'Heading 1', block: 'h1'},
            {title: 'Heading 2', block: 'h2'},
            {title: 'Heading 3', block: 'h3'}
        ]
    });

});