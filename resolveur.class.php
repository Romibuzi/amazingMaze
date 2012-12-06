<?php

/**
* Classe qui permet de résoudre le labyrinthe
**/
class resolveur
{
	// Propriétés
	protected $a_Labyrinthe;
	protected $i_Largeur; // represente la largeur 
	protected $i_Hauteur; // represente la hauteur
	protected $DAG = array();
	
	/**
	* Constructeur
	* @param $a_Labyrinthe : le labyrinthe à résoudre
	* @param $i_Largeur : la largeur du labyrinthe
	* @param $i_Hauteur : la hauteur du labyrinthe
	**/	
	public function __construct($a_Labyrinthe, $i_Largeur, $i_Hauteur)
	{
		// Nettoyage du tableau $a_Labyrinthe
		for($i = 0; $i < $i_Hauteur; $i++)
		{
			for($j = 0; $j < $i_Largeur; $j++)
			{
				unset($a_Labyrinthe[$i][$j][IDX]);
			}
		}				
		$this->a_Labyrinthe = $a_Labyrinthe;
		$this->i_Largeur = $i_Largeur;
		$this->i_Hauteur = $i_Hauteur;
	}
	
	public function resoudre()
	{	
		$this->explorer(0, NULL);
		
		$idx = $this->i_Largeur * $this->i_Hauteur - 1; // Arrivée
		while($idx != NULL)
		{
			$solution[] = $idx;
			$idx = $this->DAG[$idx];
		}			
		unset($solution[0]);
		sort($solution);
		return $solution;
	}
	
	/**
	* Fonction qui explore le labyrinthe pour trouver le chemin de sortie
	**/
	public function explorer($id, $parent)
	{
		$x = $this->getX($id);
		$y = $this->getY($id);
		
		if(array_key_exists($id, $this->DAG))
		{
			return;
		}

		$this->DAG[$id] = $parent;
		
		if($this->a_Labyrinthe[$y][$x][E] === true)
		{
			
			$this->explorer($id+1, $id);
		}
		
		if($this->a_Labyrinthe[$y][$x][S] === true)
		{
			
			$this->explorer($id + $this->i_Largeur, $id);
		}
		
		if( ($y-1) >= 0)
		{
			if($this->a_Labyrinthe[$y-1][$x][S] === true)
			{
				
				$this->explorer($id - $this->i_Largeur, $id);
			}
		}
		
		if( ($x-1) >= 0)
		{
			if($this->a_Labyrinthe[$y][$x-1][E] === true)
			{
				
				$this->explorer($id - 1, $id);
			}
		}	
	}
	
	/**
	* Fonction qui renvoi la coordonnée en x à partir de l'index
	* @param $idx : l'index
	**/
	protected function getX($idx)
	{
		return intval($idx % $this->i_Largeur);	
	}
	
	/**
	* Fonction qui renvoi la coordonnée en y à partir de l'index
	* @param $idx : l'index
	**/
	protected function getY($idx)
	{
		return intval($idx / $this->i_Largeur);	
	}
	
	/**
	* Fonction qui renvoi l'index a partir des coordonnées
	* @param $x : coordonnée en x
	* @param $y : coordonnée en y
	**/
	protected function coord2idx($x, $y)
	{
		return intval($this->i_Largeur * $y + $x);	
	}
		
}
?>