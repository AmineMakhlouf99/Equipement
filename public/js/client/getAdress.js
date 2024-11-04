
$(document).ready(function () {

    $(".loading").hide();
    
    
    $('#client-list tbody').on('click', ".modifierClient", function () {
    
    
    
    $(".loading1").show();
    
    var client = $(this).parent().parent().attr('id');
    
    var dataString = 'id=' + client;
    alert(dataString);
    $.ajax({
    
    type: "POST",
    url: "{{url('RemplirAdresse')}}",
    dataType: "json",
    data: dataString,
    
    
    success: function (msg) {
    $('.ChoiceAdresseSearch').html('');
    $.each(msg, function (index, aClient) {
    
    
    $('.ChoiceAdresseSearch').append('<option value="' + aClient.id + '" selected="selected"> ' + aClient.adresse + '&nbsp | &nbsp' + aClient.code_postal + '&nbsp | &nbsp' + aClient.ville + '</option>');
    
    });
    $('.ChoiceAdresse2Search').html('');
    $.each(msg, function (index, aClient) {
    
    $('.ChoiceAdresse2Search').append('<option value="' + aClient.id + '" selected="selected"> ' + aClient.adresse + '&nbsp | &nbsp' + aClient.code_postal + '&nbsp | &nbsp' + aClient.ville + '</option>');
    
    });
    
    $(".loading").hide();
    
    }
    
    
    });
    
    return false;
    });
    
    
    });