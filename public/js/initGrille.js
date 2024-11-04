
function format(item) {

    // Create a span element for formatting
    var span = $("<span>");
    
    // Add bold text for item.text
    $("<b>", { text: item.text }).appendTo(span);
    
    // Add small text for the value of the item
    $("<small>", { text: " " + $(item.element).val() }).appendTo(span);
    
    return span;
}
  
function initTheGrille(id){
    $('#'+id).select2({
        placeholder:'choisir',
        allowClear: false, 
        width: 179,
        multiple: false,
        templateResult: function(item) {
            return format(item);
        }
    });
}
  

