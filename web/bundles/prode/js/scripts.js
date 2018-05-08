$("#mas1").on("click", function() { 
    numeroGoles($(this), 1)
});

$("#menos1").on("click", function() { 
    numeroGoles($(this), 1)
});

$("#mas2").on("click", function() { 
    numeroGoles($(this), 2)
});

$("#menos2").on("click", function() { 
    numeroGoles($(this), 2)
});






function numeroGoles($self, $e) {
  var $button = $self;
  var oldValue = $button.parent().find("#resultado"+$e).val();

  if ($button.text() == "+") {
    if (oldValue < 15){
      var newVal = parseFloat(oldValue) + 1;
    } else { 
      var newVal = parseFloat(oldValue);
    }
    
      
  } else {
   // Don't allow decrementing below zero
    if (oldValue > 0) {
      var newVal = parseFloat(oldValue) - 1;
    } else {
      newVal = 0;
    }
  }

  $button.parent().find("#resultado"+$e).val(newVal);
}


