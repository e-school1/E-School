require('./bootstrap');

var subject = 2;
window.newSubject = function() {
    if (subject<11) {
  			$("#subject").append('<label for="name'+subject+'" class="col-md-3 col-form-label text-md-right">Subject '+subject+'</label> <div class="col-md-3"> <input id="name'+subject+'" type="text" class="form-control" name="name'+subject+'" autocomplete="name'+subject+'" autofocus placeholder="Name"> </div> <div class="col-md-2"> <input id="degree'+subject+'" type="text" class="form-control" name="degree'+subject+'" autocomplete="degree'+subject+'" autofocus placeholder="Degree"> </div> <p class="pt-2">/</p> <div class="col-md-2"> <input id="of'+subject+'" type="text" class="form-control" name="of'+subject+'" autocomplete="of'+subject+'" autofocus placeholder="Of"> </div>');
  			subject = subject+1;
  		}
  		else{
  			alert("Soory We Accept Only Ten Subject!");
  		}
}