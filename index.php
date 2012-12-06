<?php

// L'index
define('IDX', 3);

// Les directions
define('S', 0);
define('E', 1);
define('N', 2);
define('O', 3);

// On importe les classes
require_once 'labyrinthe.class.php';
require_once 'resolveur.class.php';

?>
<!DOCTYPE>
<html>
	<head>
		<title>Generateur Labyrinthe</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="labyrinthe.css">
	</head>
	<body>
	<?php
	if(isset($_POST['choix']))
	{
		if (isset($_POST['taille']))
		{
			$i_Largeur = $i_Hauteur = $_POST['taille'];
		}
		else
		{
			echo('Vous devez renseigner une taille !');
		}
	
		$i_Tcase = 20;
		
		$o_labyrinthe = new labyrinthe($i_Largeur, $i_Hauteur, $i_Tcase);
		$a_Labyrinthe = $o_labyrinthe->generer();
		$o_labyrinthe->laby2html($a_Labyrinthe);	

		?>
		<a href="#" id="voir_resolution" class="a-btn">
		    <span class="a-btn-text">Trop dur ?</span> 
		    <span class="a-btn-slide-text">Solution</span>
		    <span class="a-btn-icon-right"><span></span></span>
		</a>

		<!-- Le bloc qui contient le labyrinthe avec la solution (caché par défaut) -->
		<div id="resolution">
		<?php
			$o_resolution = new resolveur($a_Labyrinthe, $i_Largeur, $i_Hauteur);
			$a_solution = $o_resolution->resoudre();	
			$o_labyrinthe->laby2html($a_Labyrinthe, $a_solution);
		?>
		</div>
		<?php
	}
	else
	{
	?>
	    <div class="form_labyrinthe">
	        <h1 class="title">Bienvenue dans le générateur de Labyrinthes</h1>
	        <span class="author"><i>By Romain ARDIET & Franck GORIN</i></span>
	        <form action="" name="labyrinthe_form" method="POST" id="labyrinthe_form">
	        <fieldset>
	            <legend>Taille du labyrinthe (nombre de cases sur une ligne et sur une colonne)</legend>
	            <input type="text" name="taille" length="2" maxlength="2" placeholder="entre 1 et 99"/>
	        </fieldset>
	        
	        <input type="submit" name="choix" class="bouton_submit" value="Créer"/>
	        </form>
	    </div>
    <?php
	}
	?>   
	</body>
	<!-- Importation des scripts javascript-->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript" src="js/labyrinthe.js"></script>
</html>

