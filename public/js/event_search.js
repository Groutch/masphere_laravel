(function(){

	function events_filter(){

		var inpname = $('#search_text_input').val().toLowerCase(),
		inpdebut = Math.floor(new Date($('#search_debut').val()).getTime()/10000000),
		inpfin = Math.floor(new Date($('#search_fin').val()).getTime()/10000000),
		totalevent = $('.event').length;
		totaleventtemp = totalevent;

		if(!inpfin){
			inpfin = undefined;
		}
		$('.event').each(function(e, i) {
			var t = $(this),
			name = t.attr('data-name').toLowerCase(),
			debut = Math.floor((new Date(t.attr('data-debut')).getTime()+7200)/10000000),
			fin = Math.floor((new Date(t.attr('data-fin')).getTime()+7200)/10000000);

			if(inpdebut <= debut && (inpfin >= fin || !inpfin) && (!inpname || name.includes(inpname))){
				$(this).show();
			}else{
				$(this).hide();
				totaleventtemp--;
			}
		});
		if(totaleventtemp == 0){
			$('#no-event-found').show();
		}else{
			$('#no-event-found').hide();
		}
	};
	events_filter()
	$('#event').on('click',function(){
		events_filter();
	})

})();