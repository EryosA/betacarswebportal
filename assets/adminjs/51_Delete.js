/*function myFunction5() {
  var txt5;
  var click = confirm("Are you sure you want to delete this vehicle entry?");
  if (click == true) {
  	txt5 = "Vehicle successfully deleted.";
  } else {
    txt5 = "Deleting vehicle vehicle not successful.";
  }
  document.getElementById("embed5").innerHTML = txt5;
} */

function myFunction5() {
  var txt5;
  var click = confirm("Are you sure you want to delete this vehicle?");
  if (click == true) {
  	myFunction5_A();
  } else {
	myFunction5_B();
  }
} 

function myFunction5_A() {
	alert("Vehicle successfully deleted.");
}

function myFunction5_B() {
	alert("Deleting vehicle not successful.");
}