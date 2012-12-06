jQuery.extend(jQuery.validator.messages, {
		required: "<span style='color: red;'>Veuillez rentrer une taille !</span>",
		number: "<span style='color: red;'>Seulement des chiffres !</span>",
		maxlength: jQuery.validator.format("votre message {0} caractéres."),
		min: jQuery.validator.format("<span style='color: red;'>La valeur minimale est de 1 !</span>")
	});
	
$(document).ready(function() {
	$("#labyrinthe_form").validate({
	  rules: {
		 "taille":{
			"required": true,
			"maxlength": 2,
			"number"   : true,
			"min": 1
		 }
	  }
	})
});

/** Bouton qui affiche la résolution du labyrinthe **/
$("a#voir_resolution").click(function() {
	$("a#voir_resolution").hide();
	$("#resolution").show(1500, "easeOutBounce", function () {
		//montre la résolution avec un effet easing
	});
});