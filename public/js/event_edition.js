(function(){
	console.log('coufcou');
	var h = window.innerHeight;
	// $('perform_receiver')
	var i = 1;


	$('.suppr_perform_btn').unbind('click').on('click', function(e){
		$(this).parent().parent().remove();

		attrNamelist_performsX();
	});


	function attrNamelist_performsX(){
		$('.perform_receiver').children().children('input').each(function(){
			$(this).attr('name', 'list_performs['+ i +']');
			i++;
		});
		i = 1;
	}

	$('.add_perform_btn').on('click', function(){
		$('.perform_receiver').append('<div class="input-group input_group"><input type="text" class="input-group form-control" placeholder="nom de l\'artiste/performer" aria-describedby="sizing-addon2"><span class="input-group-btn"><button type="button" class="input-group btn btn-danger suppr_perform_btn">suppr</button></span></div>');

		attrNamelist_performsX();

		$('.suppr_perform_btn').unbind('click').on('click', function(e){
			$(this).parent().parent().remove();
			attrNamelist_performsX();
		});

		scroll(0, window.pageYOffset + 36);
	})
	// $('body').mousemove(function(e){
		// console.log(e.pageX + ' ' + e.pageY);
	// })
})()