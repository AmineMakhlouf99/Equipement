
function addError(valid){
    var parent=$('#RechercheClient').parent();

if(!valid){
    var label = $('<label for="nameInput" class="error" id="client_error_label">client non sélectionné </label>');
    parent.append(label);
}
else{
    $('#client_error_label').remove();
}
}


