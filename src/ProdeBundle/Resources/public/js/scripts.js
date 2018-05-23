$(".mas").on("click", function() { 
    numeroGoles($(this))
});

$(".menos").on("click", function() { 
    numeroGoles($(this))
});








function numeroGoles($self) {
  var $button = $self;
  //var oldValue = $button.parent().find("#resultado"+$e).val();
  var oldValue = $button.prev().val();
  if ($button.text() == "+") {
    
    var input = $button.prev();
     if (oldValue < 15){
       var newVal = parseFloat(oldValue) + 1;
     } else { 
       var newVal = parseFloat(oldValue);
     }
    
      
   } else {
  //  // Don't allow decrementing below zero
     
      var input = $button.next(); 
      if (oldValue > 0) {  
       var newVal = parseFloat(oldValue) - 1;
     } else {
       newVal = 0;
     }
  }

  input.val(newVal);
}


