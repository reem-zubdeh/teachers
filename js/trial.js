//THIS IS JUST TO SAVE SOME STUFF FOR REFERENCE LATER.
function add_course() {
    console.log("hey");
    window.alert("eh");
    const commonDiv = document.getElementById("common");
    common.style.display = "block";
    commonDiv.style.backgroundColor("red");
    const label_element = document.createElement("label");
    const label_text = document.createTextNode(label_element);
    const input_element = document.createElement("input");
    const input_type = document.createAttribute("type");
    input_type.value = "text";
    label_text.textContent = "Course" + coursesCounter.toString;
    label_element.appencChild(label_text);
    input_element.appendChild(input_type);
    commonDiv.appendChild(label_element);
    commonDiv.appendChild(input_element);
  }


  
  coursesCounter = 2;
  const commonDiv = document.getElementById("common");
  const rmv_button = document.getElementById("remove-button");
  const children = [];
  var label_element;
  var label_text;
  var input_element;
  var button_add;
  var lineBr;
  var lineBr1;
  var label_warning;
  var warning_text;

  rmv_button.onclick = function () {
    if (coursesCounter > 1) {
      var len = children.length;
      commonDiv.removeChild(children.pop());
      commonDiv.removeChild(children.pop());
      commonDiv.removeChild(children.pop());

    }
    //   commonDiv.removeChild(lineBr1);

    if (coursesCounter > 4) {
      commonDiv.removeChild(label_warning);
    }

    coursesCounter--;
    if (coursesCounter == 1) {
      coursesCounter++;
    }

  }


  const add_button = document.getElementById("add-button");
  add_button.onclick = function () {

    if (coursesCounter <= 4) {
      label_element = document.createElement("label");
      label_text = document.createTextNode(label_element);
      input_element = document.createElement("input");
      button_add = document.createElement("button");
      lineBr = document.createElement("br");
      lineBr1 = document.createElement("br");
      label_warning = document.createElement("p");
      warning_text = document.createTextNode(label_warning);
      label_text.textContent = "Course " + coursesCounter.toString();
      label_element.appendChild(label_text);
      children.push(label_element);
      children.push(input_element);
      children.push(lineBr1);
      commonDiv.appendChild(children[children.length - 3]);
      commonDiv.appendChild(children[children.length - 2]);
      commonDiv.appendChild(children[children.length - 1]);

      console.log(coursesCounter);
      coursesCounter++;
    }
    else {
      if (coursesCounter == 5) {

        warning_text.textContent = "Warning: You cannot add more than 4 courses.";
        label_warning.appendChild(warning_text);
        commonDiv.appendChild(label_warning);
      }
      else {
        console.log("hi");
      }

    }
  }