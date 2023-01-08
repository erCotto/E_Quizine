<!--

Auteur : COTTO Erwan
Date de création : 15 Novembre 2022
Sprint : 1
Nom du fichier : compte_liste.php

-----------------------------------------------------------------

vue compte_liste :
- construction et organisation de l'affichage des comptes

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

<h1><?php echo $titre;?></h1>
<br />
<?php
	if($pseudos != NULL) {
		foreach($pseudos as $login){
			echo "<br />";
			echo " -- ";
			echo $login["cmp_pseudo"];
			echo " -- ";
			echo "<br />";
		}
	} else {
		echo "<br />";
		echo "Aucun compte !";
	}
?>
