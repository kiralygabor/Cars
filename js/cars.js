$(document).ready(function() {
    $('#btn-add').click(function(){
        $('#editor').show();
    });

    $('#btn-cancel').click(function(){
        $('#edit-box').val("");
        $('#id').val("");
        $('#editor').hide();
    });

});