$(document).ready(function(){
    var currentTab = 0; 
    showTab(0); 
    
    function showTab(n) {
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      fixStepIndicator(n)
    }
    
    $('#campaign_list .show_keyword_number').click(function() {
      var campaign_id = $(this).attr('data-id');
      
      $.ajax({
				url: $(this).attr('action'),
				type: 'POST',
				data: {campaign_id: campaign_id},
			})
			.done(function(datas) {
				console.log(datas);
			})
			.fail(function(xhr) {
				//console.log(xhr.responseText);
			});
      
      var x = document.getElementsByClassName("tab");
      x[0].style.display = "none";
      showTab(1);
    });
    
    
    function fixStepIndicator(n) {
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      x[n].className += " active";
    }
    
    $('#previous').click(function(){
        var x = document.getElementsByClassName("tab");
        x[1].style.display = "none";
        showTab(0);
    })
    
    /***  Progress bar  ***/
    var progressbar = $("#progressbar"),
	      progressLabel = $(".progress-label");

	  progressbar.progressbar({
	     value: false,
	     change: function () {
	        progressLabel.text(progressbar.progressbar("value") + "%");
	     },
	     complete: function () {
	        progressLabel.text("Complete!");
	     }
	  });

    function progress() {
        var val = progressbar.progressbar("value") || 0;

        progressbar.progressbar("value", val + 1);

        if (val < 99) {
            setTimeout(progress, 100);
        }
    }

    setTimeout(progress, 3000);
	    
	   /*** end progress bar ***/
});

function exportTo(type) {
  $('#keyword_number').tableExport({
    filename: 'Keywords_%DD%-%MM%-%YY%',
    format: type,
  });
}