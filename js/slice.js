// Slicing steps hover

$(function(){

	$("#steps .st").mouseenter(function(){

		$("#steps .st_active").animate({ height : "0px" }, 600);
		$("#steps .st_active p.active a.naruci_sad").animate({ bottom: "-70px" }, 500)
		$("#steps .st_active p.active a.info_btn").animate({ bottom: "-70px" }, 400)

		//svaki div box ima dvije klase. prva je ".st", a druga st_imekoraka.
		var  klasa = $(this).attr("class");

		//maknem st iz klase i ostaje mi samo pravo ime koraka u varijabli "klasa"
		klasa =  klasa.replace(/st st_background /, "");

		//samo za definiciju vrijednost je za otkrivanje errora, nikad se nebi smjelo pojaviti na stranici
		var height_active="10px";

		//svaki box ima drukciju visinu, u "height_active" varijablu se sprema vrijednost
		if(( klasa=="st_idea") || ( klasa=="st_deployment")){ height_active="279px"; }
		if(( klasa=="st_design") || ( klasa=="st_coding")){ height_active="309px"; }
		if ( klasa=="st_slicing"){ height_active = "339px" }

		//otvaranje boxa na kojemu je miš
		$("." + klasa + ':not(.st_background)').animate({ height:height_active }, 600); //


		//micanje klase st_active s prozora koji se zatvara
		$("#steps .st_active").removeClass("st_active");

		//postavljanje klase st_active na box koji je otvoren
		$("." + klasa + ':not(.st_background)').addClass("st_active");

		//animiranje naruci sad i info gumbova
		setTimeout('$(".st_active p.active a.naruci_sad").animate({ bottom: "9px" }, 400);',500);
		setTimeout('$(".st_active p.active a.info_btn").animate({ bottom: "9px" }, 350);',400);

	})//end mouseenter .st

})

// Hover effects for links

$(function(){

	$(".one_line_info:first").hover(

		function()
		{
			$(this).clone().css( {
								position: "absolute",
								background: "#fff",
								margin:"-12px 0 0 0",
								left:0,
								//height:"30px",
								opacity:0 })
								.addClass("hover_active").prependTo(this).animate({ opacity:1.0}, 350 );
		},

		function(){
				$(".hover_active:animated").stop().animate({ opacity:0 }, 250, function(){ $(this).remove(); });
				$(".hover_active").stop().animate({ opacity:0 }, 250, function(){ $(this).remove(); });
		}
	);

	$("#header li a:not('.active')").hover(
		function()
		{
			$(this).find('.hover_active').stop().remove();
			$(this).clone().css( {
								position: "absolute",
								background: "#266382",
								margin:0,
								left:"4px",
								top:"1px",
								padding:"2px 6px 2px 6px",
								height:0,
								opacity:0 })
								.addClass("hover_active").prependTo(this).animate({ opacity:1.0, height:"22px" }, 400);
		},

		function(){

			$(".hover_active").animate({ opacity: 0, height:0 }, 300, function(){ $(this).remove(); });
		}
	)


	/* PRELOADING IMAGES */
	if (document.images)
	{
		preload_image = new Image(270,42);
	  	preload_image.src="design/giveaway_hover.jpg";

		preload_image = new Image(270,42);
	  	preload_image.src="design/giveaway_hover_hr.jpg";

		preload_image = new Image(62,60);
		preload_image.src="design/info_gumb_active.png";

	  	preload_image = new Image(71,71);
	  	preload_image.src="design/naruci_sad_gumb_active.png";

		preload_image = new Image(71,71);
	  	preload_image.src="design/order_now_button_active.png";

		preload_image = new Image(71,71);
	  	preload_image.src="design/jetzt_bestellen_button_active.png";

		preload_image = new Image(83,26);
	  	preload_image.src="design/submit_button_active.png";

		preload_image = new Image(321,43);
	  	preload_image.src="design/order_button_big_hover.jpg";

		preload_image = new Image(304,42);
	  	preload_image.src="design/box_price_h2_hover.jpg";

		preload_image = new Image(436,56);
	  	preload_image.src="design/big_button_hover.png";}


})