const ignoredKeys = ['Tab', 'Control', 'Shift', 'Alt', 'CapsLock', 'Escape'];

let isOpen = false;
let id='';
$(document).keydown(function(event) {
    if (event.key === 'Tab') {
        setTimeout(function() {
            
            var focusedElement = $(document.activeElement);
            if (focusedElement.hasClass('select2-selection')) {
                var sibling = $(focusedElement).parent().parent().prev();
                var id = sibling.attr('id');
                if(isOpen){
                $('#'+id).select2('close');
                isOpen=false;
                }
                
                // Add your custom functionality here
            }
        }, 0);
        
    }else if(!ignoredKeys.includes(event.key)){

        setTimeout(function() {
            var focusedElement = $(document.activeElement);
            if (focusedElement.hasClass('select2-selection')) {
                var sibling = $(focusedElement).parent().parent().prev();
                var id = '#'+sibling.attr('id');
                
                
                if(!isOpen){
                $(id).select2('open');
                $('.select2-search__field').val(event.key);

                isOpen=true;
                }
                
                // Add your custom functionality here
            }
        }, 0);
        
    }
});
$('#Frais,#select3,#grillePrest,#A,#B,#C,#D,#ChoiceDebut,#ChoiceFin,#RechercheClient,#ChoiceAdresseSearchDev,#ChoiceContactSearchDev,#ChoiceAdresse2SearchDev,#ChoiceContact2SearchDev').on('select2:open', function() {
    isOpen=true;
    $('.select2-search__field')[0].focus();
    

});

