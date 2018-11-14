(function(){
	var h = window.innerHeight;
	// $('perform_receiver')
	var i = 1;

	function attrNamelist_performsX(){
		$('.perform_receiver').children().children('input').each(function(){
			$(this).attr('name', 'list_performs['+ i +']');
			i++;
		});
		i = 1;
	}

	$('.add_perform_btn').on('click', function(){
		$('.perform_receiver').append('<div class="input-group input_group"><input type="text" class="input-group form-control" placeholder="nom de l\'artiste/performer" aria-describedby="sizing-addon2"><span class="input-group-btn"><button type="button" class="input-group btn btn-danger suppr_perform_btn">suppr</button></span></div>');

		$('.suppr_perform_btn').on('click', function(e){
			$(this).parent().parent().remove();
			attrNamelist_performsX();
		});
		attrNamelist_performsX();
		scroll(0, window.pageYOffset + 36);
	})
})()