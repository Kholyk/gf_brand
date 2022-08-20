var $=jQuery;

$(document).ready( function() {
	$( ".js-sortable" ).sortable();
	$( ".js-sortable" ).disableSelection();
} );

$('.logo__choose').on('click', function() {
	var file_frame;
	var obj = this;

	if ( file_frame ) {
		file_frame.open();
		return;
	}

	file_frame = wp.media.frames.file_frame = wp.media({
		title: 'Выберите файл',
		button: {
			text: $( this ).data( 'uploader_button_text' )
		},
		multiple: false
	});

	file_frame.on('select', function() {
		attachment = file_frame.state().get('selection').first().toJSON();
		var image = '<img src="' + attachment.url + '" class="logo__image"/>';
		$(obj).closest('.inside').prepend(image);
		$('[name="kitlot_logo"]').val(attachment.id).trigger('input');
		$(obj).hide();
		$('.logo__delete').show();
	});

	file_frame.open();
});

$('.logo__delete').on('click', function() {
	$('.logo__image').remove();
	$('[name="kitlot_logo"]').val('').trigger('input');
	$('.logo__choose').show();
	$(this).hide();
});


