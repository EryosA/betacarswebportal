function leaveInput(el) {
		if (el.value.length > 0) {
				if (!el.classList.contains('active')) {
						el.classList.add('active');
				}
		} else {
				if (el.classList.contains('active')) {
						el.classList.remove('active');
				}
		}
}

var inputs = document.getElementsByClassName("m-input");
for (var i = 0; i < inputs.length; i++) {
		var el = inputs[i];
		el.addEventListener("blur", function() {
				leaveInput(this);
		});
}

function myFunction3() {
  var txt3;
  var click = confirm("Are you sure you want to save information?");
  if (click == true) {
  	txt3 = "Vehicle successfully added.";
  } else {
    txt3 = "Adding vehicle not successful.";
  }
  document.getElementById("embed3").innerHTML = txt3;
} 