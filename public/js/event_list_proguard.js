(function(){

	$('.eventSuppr').on('click', function(e){
		window.location.href = "/guard_delete/"+$(this).attr('dataid');
    });

})()