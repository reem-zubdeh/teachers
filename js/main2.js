function change_student_education(){
  var val=document.getElementById("education").value;
  if (val=== "college") {
    document.getElementById("menu-label").style.display="none";
    document.getElementById("menu-course").style.display="none";
    document.getElementById("course-name-id").style.display="inline";
    document.getElementById("course-name").style.display="inline";


  }
  else{
   
    document.getElementById("menu-label").style.display="inline";
    document.getElementById("menu-course").style.display="inline";
    document.getElementById("course-name-id").style.display="none";
    document.getElementById("course-name").style.display="none";

  }
}

function change_tutor_education() {
    let val = document.getElementById("education-level").value;

    if (val == "0") {
      document.getElementById("school-label").innerHTML = "High School Name "
      document.getElementById("school").placeholder = "High School Name "
      document.getElementById("field-label").innerHTML = "Field/degree";
      document.getElementById("field").placeholder = "i.e. General Sciences Baccalaureate";
    }
    else {
      document.getElementById("school-label").innerHTML = "College Name "
      document.getElementById("school").placeholder = "i.e. Lebanese American University "
      document.getElementById("field-label").innerHTML = "Major";
      document.getElementById("field").placeholder = "i.e. Computer Science";
    }
}

function change_level() {
  
  let level1 = document.getElementById("course1-level").value;

  if (level1 == "college") {
    document.getElementById("course1-input").style.display="inline-block";
    document.getElementById("course1-select").style.display="none";
  }
  else {
    document.getElementById("course1-input").style.display="none";
    document.getElementById("course1-select").style.display="inline-block";
  }

  let level2 = document.getElementById("course2-level").value;

  if (level2 == "none") {
    document.getElementById("course2-input").style.display="none";
    document.getElementById("course2-select").style.display="none";
  }
  else if (level2 == "college") {
    document.getElementById("course2-input").style.display="inline-block";
    document.getElementById("course2-select").style.display="none";
  }
  else {
    document.getElementById("course2-input").style.display="none";
    document.getElementById("course2-select").style.display="inline-block";
  }

  let level3 = document.getElementById("course3-level").value;

  if (level3 == "none") {
    document.getElementById("course3-input").style.display="none";
    document.getElementById("course3-select").style.display="none";
  }
  else if (level3 == "college") {
    document.getElementById("course3-input").style.display="inline-block";
    document.getElementById("course3-select").style.display="none";
  }
  
  else {
    document.getElementById("course3-input").style.display="none";
    document.getElementById("course3-select").style.display="inline-block";
  }

  let level4 = document.getElementById("course4-level").value;

  if (level4 == "none") {
    document.getElementById("course4-input").style.display="none";
    document.getElementById("course4-select").style.display="none";
  }
  else if (level4 == "college") {
    document.getElementById("course4-input").style.display="inline-block";
    document.getElementById("course4-select").style.display="none";
  }
  else {
    document.getElementById("course4-input").style.display="none";
    document.getElementById("course4-select").style.display="inline-block";
  }

}

function clear_filters() {
  $("#filter option:selected").removeAttr('selected');
  $("#filter option[value='all'").attr('selected','selected');
  $("#filter input").val('');
  $("#filter").submit();
}


function forgotSubmit() {
  //check if email empty
}

function loginSubmit() {
  //check if email and pass empty
}

function loadBookingData(button) {

  let row = $(button.parentElement.parentElement);
  let id = +row.find("[name='id']").text();
  let student = +row.find("[name='student']").text();
  let tutor = +row.find("[name='tutor']").text();
  let course = +row.find("[name='course']").text();
  let date = row.find("[name='date']").text();
  let days = row.find("[name='days']").text();

  daysArr = days.split(" ");

  $("#editform").find("[name='id']").val(id);
  $("#editform").find("[name='student']").val(student);
  $("#editform").find("[name='tutor']").val(tutor);
  $("#editform").find("[name='course']").val(course);
  $("#editform").find("[name='date']").val(date);

  $("#editform").find("[type='checkbox']").prop( "checked", false );
  daysArr.forEach(day => {
    $("#editform").find(`[name='${day}']`).prop( "checked", true );
  });

}

function sortBookingsBy(column) {
  let name = $(column).attr("name");
  let page = $("[data-page]").data("page");
  console.log(name);
  console.log(page);
  //send php get request: select from bookings table, sort by col, limit according to page
}




// Create a "close" button and append it to each list item
// var myNodelist = document.getElementsByTagName("LI");
// var i;
// for (i = 0; i < myNodelist.length; i++) {
//   var span = document.createElement("SPAN");
//   var txt = document.createTextNode("\u00D7");
//   span.className = "close";
//   span.appendChild(txt);
//   myNodelist[i].appendChild(span);
// }

// // Click on a close button to hide the current list item
// var close = document.getElementsByClassName("close");
// var i;
// for (i = 0; i < close.length; i++) {
//   close[i].onclick = function() {
//     var div = this.parentElement;
//     div.style.display = "none";
//   }
// }

// // Add a "checked" symbol when clicking on a list item
// var list = document.querySelector("ul");
// list.addEventListener("click", function(ev) {
//   if (ev.target.tagName === "li") {
//     ev.target.classList.toggle("checked");
//   }
// }, false);

// // Create a new list item when clicking on the "Add" button
// function newElement() {
//   var li = document.createElement("li");
//   var inputValue = document.getElementById("myInput").value;
//   var t = document.createTextNode(inputValue);
//   li.appendChild(t);
//   if (inputValue === '') {
//     alert("You must write something!");
//   } else {
//     document.getElementById("myUL").appendChild(li);
//   }
//   document.getElementById("myInput").value = "";

//   var span = document.createElement("SPAN");
//   var txt = document.createTextNode("\u00D7");
//   span.className = "close";
//   span.appendChild(txt);
//   li.appendChild(span);

//   for (i = 0; i < close.length; i++) {
//     close[i].onclick = function() {
//       var div = this.parentElement;
//       div.style.display = "none";
//     }
//   }
// } 