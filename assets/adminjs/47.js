/*function myFunction() {
  var txt;
  var reason = prompt("Please enter reason:", "");
  if (reason == null || reason == "") {
    txt = "No reason given";
  } else {
    txt = "This will be added to status history: " + reason + "<br/><br/><br/>";
  }
  document.getElementById("embed").innerHTML = txt;
} */

function myFunction() {
  var txt;
  var reason = prompt("Please enter reason:", "");
  if (reason == null || reason == "") {
    txt = "No reason given";
  } else {
    txt = "This will be added to status history: " + reason + "<br/><br/><br/>";
  }
  document.getElementById("embed").innerHTML = txt;
} 

/*function myFunction2() {
  var txt2;
  var click = confirm("Are you sure you want to save changes?");
  if (click == true) {
  	txt2 = "Changes saved.";
  } else {
    txt2 = "You cancelled saving.";
  }
  document.getElementById("embed2").innerHTML = txt2;
} */

// function myFunction() {
//   var txt5;
//   var click = confirm("Are you sure you want to delete this vehicle entry?");
//   if (click == true) {
//     myFunction_A();
//   } else {
//   myFunction_B();
//   }
// } 

// function myFunction_A() {
//   alert("Vehicle successfully deleted.");
// }

// function myFunction_B() {
//   alert("Deleting vehicle vehicle not successful.");
// }

// function myFunction() {
//   var txt5;
//   var click = confirm("Are you sure you want to delete this vehicle entry?");
//   if (click == true) {
//     myFunction2_A();
//   } else {
//   myFunction2_B();
//   }
// } 

// function myFunction2_A() {
//   alert("Vehicle successfully deleted.");
// }

// function myFunction2_B() {
//   alert("Deleting vehicle vehicle not successful.");
// }