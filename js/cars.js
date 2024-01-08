$(document).ready(function(){

    $('#btn-add').click(function(){
        $('#editor').show();
    });

    $('#btn-cancel').click(function(){
        $('#name').val("");
        $('#id').val("");
        $('#editor').hide();
    });

    $('#btn-import').click(function(){
        $('#import').show();
    });

    $('#btn-cancel-import').click(function(){
        $('#import').hide();
    });

});

function btnEditOnClick(id, name)
{
    $('#editor').show();
    $('#name').val(name);
    $('#id').val(id);
}
