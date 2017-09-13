(function(){
	console.log('coufcou');
	var h = window.innerHeight;
	// $('group_receiver')
	var i = 0,j = 1;

	function nbChildVerifListener(){
		$('.child_nb').unbind('keyup').on('keyup', function(e){
			if($(this).val() < 1 ){
				$(this).val(1);
			}else if($(this).val() > 4){
				$(this).val(4);
			}
			console.log($(this).val());
		});
	}nbChildVerifListener();

	function attrNamelist_placesX(){
		$('.place').each(function(){
			$(this).attr('name', 'list_places['+ i +']');
			i++;
		});
		i = 0;
		$('.child_nb').each(function(){
			$(this).attr('name', 'list_child_nbs['+ i +']');
			i++;
		});
		i = 0;
		$('.range').each(function(){
			$(this).attr('name', 'list_range['+ i +']');
			i++;
		});
		i = 0;
	}

	$('.add_place_btn').on('click', function(){

		if(j<4){
			$('.place_receiver').append('<div><hr /><label>Lieu de grade chez moi/Lieu de travail</label><div class="input-group input_group"><input type="text" class="input-group form-control place" placeholder="lieu" aria-describedby="sizing-addon2"><span class="input-group-btn"><button type="button" class="input-group btn btn-danger suppr_place_btn">suppr</button></span></div><div class="row"> <div class="col-md-4"> <label>nombre d\'enfant pour ce lieu</label> <input type="number" max="4" min="1" class="child_nb form-control" placeholder="nb d\'enfant max" aria-describedby="sizing-addon2"></div><div class="col-md-8"> <label title="rayon" >Rayon autour du lieu précédement donné où je peux garder | facultatif</label> <input type="number" class="form-control range" placeholder="rayon en km" aria-describedby="sizing-addon2"></div></div></div>');
			attrNamelist_placesX();
			nbChildVerifListener();

			$('.suppr_place_btn').unbind('click').on('click', function(e){
				$(this).parent().parent().parent().remove();

				attrNamelist_placesX();
				j--;
			});

			scroll(0, window.pageYOffset + 94);
			j++;
		}
	})

	// $('body').mousemove(function(e){
		// console.log(e.pageX + ' ' + e.pageY);
	// })
})()