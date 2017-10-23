(function(){
	// images url
	var images = [
		// 'https://image.freepik.com/photos-libre/quot-pere-a-cheveux-court-portant-un-enfant-en-bas-age-sur-les-epaules-quot_1304-4145.jpg',
		'https://image.freepik.com/photos-libre/parc-de-bonheur-deux-portrait-brune_1157-3435.jpg', // https://image.freepik.com/photos-libre/parc-de-bonheur-deux-portrait-brune_1157-3435.jpg
		'https://image.freepik.com/photos-libre/jeune-parent-joue-avec-un-garcon-enfantin_1304-4269.jpg',
		'https://image.freepik.com/photos-libre/jeune-famille-dans-la-rue_1157-4584.jpg'
	];

	var randimg = images[Math.ceil(Math.random()*(images.length-1))];
	if(!localStorage.getItem('previmg')){
		localStorage.setItem('previmg', randimg);
	};

	while (randimg == localStorage.getItem('previmg')) {
		randimg = images[Math.floor(Math.random()*(images.length-1))];
	};
	localStorage.setItem('previmg', randimg);

	$('#bg')
	// .css('background-color', '#9E9E9E')
	.css('background', 'url('+randimg+') no-repeat center center')
	.css('height', '100%')
	.css('width', '100%')
	.css('background-size', 'cover')
	.css('z-index', '-1')
	.css('-webkit-filter', 'blur(5px)')
	.css('-webkit-background-size', 'cover')
	.css('-moz-background-size', 'cover')
	.css('-o-background-size', 'cover')
	.css('background-size', 'cover')
	.css('position', 'fixed');
})()