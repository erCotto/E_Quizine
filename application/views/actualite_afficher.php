<!--

Auteur : COTTO Erwan
Date de création : 20 Novembre 2022
Sprint : 1
Nom du fichier : actualite_afficher.php

-----------------------------------------------------------------

vue actualite_afficher :
- affiche la page d'une actualite'

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

</br>
</br>
</br>
<?php
	if(isset($actu)) {
		echo "<h3><center>";
		echo $actu->actu_titre;
		echo "</h3></br><div class='container'><div class='jumbotron'>";
		echo "<h6><center>";
		echo $actu->actu_description;
		echo "</h6></div></div>";
	} else {
		echo "<br /><h3><center>";
		echo "Cette actualité n'existe pas !";
		echo "</h3>";
	}
?>
</br>
</br>
</br>
