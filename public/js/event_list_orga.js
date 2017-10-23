(function(){

	$('.deleteEvent').on('click', function(e){
        $("#modal"+$(this).attr('dataeventid')).modal();
    });

})()