

$(document).ready(function () {
    $('.checkIfNumber').on('input',function(){
        if($(this).val().includes(',')){
            $(this).val($(this).val().replace(',','.'));
        }
        if (isNaN($(this).val())) {
            $(this).val( $(this).val().replace(/\D/g, ''));
            
            //showDialog("entrez un nombre positif valide","type de valeur non valide");
            toastr.options.hideDuration = 200;


            toastr.error("entrez un nombre positif valide","valeur non valide",

                "WARNING"

            );
        }
        if($(this).val()<0){
            $(this).val(0);
            //showDialog("entrez un nombre positif valide","type de valeur non valide");
            toastr.options.hideDuration = 200;


            toastr.error("entrez un nombre positif valide","valeur non valide",

                "WARNING"

            );
        }
    });

});