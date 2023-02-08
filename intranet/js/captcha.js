var total;

function getRandom(){return Math.ceil(Math.random()* 20);}
function createSum(){
		var randomNum1 = getRandom(),
			randomNum2 = getRandom();
	total =randomNum1 + randomNum2;
  $( "#question" ).text( randomNum1 + " + " + randomNum2 + " =" );  
  $("#ans").val('');
  checkInput();
}

function checkInput(){
		var input = $("#ans").val(), 
    	slideSpeed = 200,
      hasInput = !!input, 
      valid = hasInput && input == total;
   
    $('button[type=submit]').prop('disabled', !valid);  
   
	if(valid){
		$('#btnLogin').css("background","rgb(40, 228, 240)");
		$('#btnLogin').css("color","rgb(0,0,0)");
		$('#icono').css("color","rgb(0,0,0)");
	} else{
		$('#btnLogin').css("background","rgb(0, 0, 0)");
		$('#btnLogin').css("color","white");
		$('#icono').css("color","white");
	}
    $('#fail').toggle(hasInput && !valid);
}

$(document).ready(function(){
	//create initial sum
	createSum();
	// On "reset button" click, generate new random sum
	$('button[type=reset]').click(createSum);
	// On user input, check value
	$( "#ans" ).keyup(checkInput);
});