

var list_li=document.getElementsByName('menu_button');




        
   // Create a MutationObserver instance
   const observer = new MutationObserver(mutations => {
       mutations.forEach(mutation => {
           if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
               if(mutation.target.className=='nav-item menu-open menu-is-open'){
                list_li.forEach(function(li) {

                    if(li!==mutation.target && li.className=='nav-item menu-open menu-is-open'){
                        li.firstElementChild.click();
                    }
                    
                
                   });
               }
           }
       });
   });

   // Configure the observer to watch for attribute changes
   const config = { attributes: true };
   
   
   list_li.forEach(function(li) {

    observer.observe(li, config);

   });

   $('#sidebar').css({
    'left': '-300px',}
   );
  /* setTimeout(function() {
    $('#sidebar').animate({
        'left': '-300px',
        'top':'0px',
      }, 500);
    
    
  }, 1000);
  
*/
  
var display=false;
   document.getElementById('menu_displayer').addEventListener('click',function(event){
    if(display){
    $('#sidebar').animate({
        'left': '-600px',

      }, 500); 
      display=false;
    }else{
        $('#sidebar').animate({
            'left': '0px',
    
          }, 500); 
          display=true;
          menu_displayer=true;
    }
   });


   document.addEventListener('click', function(event) {
 
    if (!document.getElementById('sidebar').contains(event.target) && !document.getElementById('menu_displayer').contains(event.target) && display) {
        document.getElementById('menu_displayer').click();
    } 
  });
   


/*
   document.addEventListener('click', function(event) {
    console.log(event.target.id);
    if(display && ){
        $('#sidebar').animate({
            'left': '-600px',
    
          }, 500); 
          display=false;
    }
    else if (event.target.id=='menu_displayer' && !display) {
        $('#sidebar').animate({
            'left': '0px',
    
          }, 500); 
          display=true;
          menu_displayer=true;
    }
    
  });*/