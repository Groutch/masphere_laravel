(function(){
	console.log('coufcou');
	var h = window.innerHeight;
	// $('group_receiver')
	var i = 1;

	function attrNamelist_groupsX(){
		$('.group_receiver').children().children('input').each(function(){
			$(this).attr('name', 'list_groups['+ i +']');
			i++;
		});
		i = 1;
	}

	$('.add_group_btn').on('click', function(){
		$('.group_receiver').append('<div class="input-group input_group"><input type="text" class="input-group form-control" placeholder="nom du groupe" aria-describedby="sizing-addon2"><span class="input-group-btn"><button type="button" class="input-group btn btn-danger suppr_group_btn">suppr</button></span></div>');

		attrNamelist_groupsX()

		$('.suppr_group_btn').unbind('click').on('click', function(e){
			$(this).parent().parent().remove();

			attrNamelist_groupsX()
		});

		scroll(0, window.pageYOffset + 36);
	})
	// $('body').mousemove(function(e){
		// console.log(e.pageX + ' ' + e.pageY);
	// })
})()