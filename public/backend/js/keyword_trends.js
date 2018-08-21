var keyword_list = [];
var keyword_duplicate_list = [];

$(document).ready(function(){
  $("form#import-data").submit(function(e) {
//      e.preventDefault();    
      var formData = new FormData(this);
      $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data: formData,
          success: function (response) {
              insert_data(response.data);
          },
          cache: false,
          contentType: false,
          processData: false
      });
  });
  
  $('#show_keyword_list').on('click', function(){
     if($('.keywords-list').hasClass('hidden')) {
         $('.keywords-list').removeClass('hidden');
         $(this).html('Hide keywords list');
     } else {
         $('.keywords-list').addClass('hidden');
         $(this).html('Show keywords list');
     }
     
  });
});
    
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

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
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
 // if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if(currentTab == 1) {
    $('form#import-data').submit();
  }
  if (currentTab >= x.length) {
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
  y = x[currentTab].getElementsByTagName("input");
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

function insert_data(data) {
    $('.keywords-list tbody').html('');
    keyword_list = data;
    var sorted_arr = keyword_list.slice().sort();
    var results = [];
    for (var i = 0; i < sorted_arr.length - 1; i++) {
        if (sorted_arr[i + 1] == sorted_arr[i]) {
            results.push(sorted_arr[i]);
        }
    }
    console.log(results);
    for(var j = 1; j < keyword_list.length; j++) {
        $('.keywords-list tbody').append('<tr>'+
                                            '<td>'+keyword_list[j]+'</td>' +
                                            '<td><a href="#" data-id='+j+'><i class="fa fa-times"></i></a></td>'+
                                         '</tr>');
    }
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}