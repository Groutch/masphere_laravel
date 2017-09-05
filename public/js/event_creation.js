(function(){
	console.log('coufcou');
	var h = window.innerHeight;
	// $('group_receiver')
	var i = 1;
	$('.add_group_btn').on('click', function(){
		$('.group_receiver').append('<div class="input-group"><input type="text" class="input-group form-control" placeholder="nom du groupe" aria-describedby="sizing-addon2"><span class="input-group-btn"><button type="button" class="input-group btn btn-danger suppr_group_btn">suppr</button></span></div>');
		$('.suppr_group_btn').unbind('click');
		$('.suppr_group_btn').each(function(i){
			$(this).attr('name', 'liste_groupes['+i+++']')
		});
		var scrollage = 0;
		$('.suppr_group_btn').on('click', function(e){
			$(this).parent().parent().remove();
			console.log($(this).height())
			scrollage += $(this).height();
		});
			scroll(0, i*scrollage+h);
		
	})
	// $('body').mousemove(function(e){
		// console.log(e.pageX + ' ' + e.pageY);
	// })
})()