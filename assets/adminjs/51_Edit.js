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

/*function myFunction4() {
  var txt4;
  var click = confirm("Are you sure you want to save information?");
  if (click == true) {
  	txt4 = "Information edited successfully.";
  } else {
    txt4 = "Editing information not successful.";
  }
  document.getElementById("embed4").innerHTML = txt4;
} */

function myFunction4() {
  var txt5;
  var click = confirm("Are you sure you want to edit this?");
  if (click == true) {
  	myFunction4_A();
  } else {
	myFunction4_B();
  }
} 

function myFunction4_A() {
	alert("Vehicle successfully updated.");
}

function myFunction4_B() {
	alert("Updating vehicle not successful.");
}