
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Enviar";
  } else {
    document.getElementById("nextBtn").innerHTML = "Avançar";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}




function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByClassName("obrigatorio");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}


//Seleção de curso
function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

$('.radio-group .radio').click(function(){
    $(this).parent().find('.radio').removeClass('selected');
    $(this).addClass('selected');
    var val = $(this).attr('data-value');
    //alert(val);
    $(this).parent().find('input').val(val);
});

// Condição especial
function cond_especial(value){
var atendimentoespecial = document.getElementsByClassName('atendimentoespecial');
  if(value != "NENHUMA"){
    atendimentoespecial[0].style.display = 'block';
    document.getElementById('info_adicional').value = "";
    
  }else{
  atendimentoespecial[0].style.display = 'none';
  document.getElementById('info_adicional').value = "NENHUMA";
  }
}

function estado_num(sem){  
    var display = document.getElementById(sem).style.display;
    if(display == "none"){
      document.getElementById(sem).style.display = 'block';
      document.getElementById('numero').value = "";
    }
    else{
      document.getElementById(sem).style.display = 'none';
      document.getElementById('numero').value = "0";
    }   
}
function estado_comp(sem){  
    var display = document.getElementById(sem).style.display;
    if(display == "none"){
      document.getElementById(sem).style.display = 'block';
      document.getElementById('complemento').value = "";
    }
    else{
      document.getElementById(sem).style.display = 'none';
      document.getElementById('complemento').value = "SEM COMPLEMENTO";
    }   
}