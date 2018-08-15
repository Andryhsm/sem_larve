var dialogContainer=document.body.appendChild(document.createElement("div"));
dialogContainer.style.position="fixed";
dialogContainer.style.top=dialogContainer.style.left="50%";

jQuery(document).ready(function($) {

	$(".validateTips").removeClass('hide');
	var buttonText = "";
	if(location.href.replace(/(.+\w\/)(.+)/,"/$2") == "/en"){
		buttonText = "CONTINUE";
	}else{
		buttonText = "CONTINUER";
	}

	$("#dialog-position").removeClass('hide');
	$( "#dialog-position" ).dialog({
	      modal: true,
	      appendTo: dialogContainer,
	      position: { 
		        at: 'center center',
		        of: dialogContainer
		    },
	      maxWidth: 1000,
	      minWidth: 540,
	      widht: 900,
	      height: 360,
	      maxHeight: 400,
	      create: function (event, ui) {
		        $(".ui-widget-header").hide();
		    },
	      buttons: {
	      	Search : {
	      		text : buttonText,
	      		class: "centerButton ripple",
	      		click: function(){
		      		var code = $("#postal_code").val();
		      		var distance = $("#distance").val();
			      	if(code.trim() != "" && distance.trim() != ""){
			      		$.ajax({
			      			url: 'add-info-cookie',
			      			type: 'GET',
			      			dataType: 'json',
			      			data: {"zip_code": code, "distance": distance},
			      			beforeSend: function(){
			      				$.LoadingOverlay("show",{'size': "10%",'zIndex': 9999});
			      			}
			      		})
			      		.done(function(data) {
			      			//$(location).attr('href', 'search?q=');
			      			location.reload();
			      			 $.LoadingOverlay("hide");
			      		})
			      		.fail(function() {
			      			 $.LoadingOverlay("hide");
			      		});
			      	}
		      	}
	      	}
	      }
	});
	$("#fermer-dialog").click(function(event) {
		event.preventDefault();
		$("#dialog-position").dialog( "close");
		$("#dialog-position").addClass('hide');
		$(this).parent().remove();
	});
	$("#fermer-dialog2").click(function(event) {
		event.preventDefault();
		$("#dialog-position2").dialog( "close");
		$("#dialog-position2").addClass('hide');
		$(this).parent().remove();
	});
    $('#change-location').click(function(e){
    	 show_dialog_position(buttonText);
    });
    $('#dialog-position').keypress(function(event) { 
	 	if( event.keyCode == $.ui.keyCode.ENTER ) { 
	 		$(this).parent().find('.ui-dialog-buttonpane button:first').click(); 
	 		return false; 
	 	} 
	});
	$('#dialog-position2').keypress(function(event) { 
	 	if( event.keyCode == $.ui.keyCode.ENTER ) { 
	 		$(this).parent().find('.ui-dialog-buttonpane button:first').click(); 
	 		return false; 
	 	} 
	});
}); 

function show_dialog_position(buttonText){
	  $("#dialog-position2").removeClass('hide');
		$( "#dialog-position2" ).dialog({
		      modal: true,
		      appendTo: dialogContainer,
		      position: { 
			        at: 'center center',
			        of: dialogContainer
			    },
		      maxWidth: 1000,
		      minWidth: 540,
		      widht: 900,
		      height: 360,
		      maxHeight: 400,
		      create: function (event, ui) {
			        $(".ui-widget-header").hide();
			    },
		      buttons: {
		      	Search : {
		      		text : buttonText,
		      		class: "centerButton ripple",
		      		click: function(){
			      		var code = $("#postal_code2").val();
			      		var distance = $("#distance2").val();
				      	if(code.trim() != "" && distance.trim() != ""){
				      		$.ajax({
				      			url: base_url +'/add-info-cookie',
				      			type: 'GET',
				      			dataType: 'json',
				      			data: {"zip_code": code, "distance": distance},
				      			beforeSend: function(){
			      					$.LoadingOverlay("show",{'size': "10%",'zIndex': 9999});
			      				}
				      		})
				      		.done(function(data) {
				      			location.reload();
				      			$.LoadingOverlay("hide");
				      		})
				      		.fail(function(xhr) {
				      			$.LoadingOverlay("hide");
				      		});
				      	}
			      	}
		      	}
		      },
		      open: function () {
	            $("#dialog-position2").keypress(function (e) {
	                if (e.keyCode == 13) {
	                    $(this).parent().find(".ui-dialog-buttonset button").trigger("click");
	                }
	            });
	          }
			});
}