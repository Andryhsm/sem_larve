
/* Enregistrement des commentaires des ticketings */
add_commentaire_in_tickets();
function add_commentaire_in_tickets() {
	$('.add-comment').click(function(event) {		
		event.preventDefault();
		var $form = $(this).parents('.form-comment');
		$content_comment = $form.find('.content-comment');
		if($content_comment.val().trim()!= ""){
			data = $form.serializeArray();
			$.ajax({
				url: 'tickets-subscribe/add_comment',
				type: 'POST',
				data: {ticket_id: data[0].value, content: encodeURI(data[1].value)},
			})
			.done(function(datas) {
				$('.comment-list').append(get_comment_element(data[1].value));
				$('.content-comment').val("");
			})
			.fail(function(xhr) {
				//console.log(xhr.responseText);
			});
		}
	});
}

function get_comment_element(comment)
{
	var e = '<div class="panel panel-primary">';
    e+=    '<div class="panel-heading">';
    e+=        '<h3 class="panel-title"> Vous';
    //e+=            user_first_name+' '+user_last_name;
    e+=        	'<span class="pull-right"> now </span>';
    e+=        '</h3>';
    e+=    '</div>';
    e+=	'<div class="panel-body">';
    e+=        '<div class="content-comment">';
    e+=            comment;
    e+=        '</div>';
    e+=    '</div>';
    e+= '</div>';
    return e;
}