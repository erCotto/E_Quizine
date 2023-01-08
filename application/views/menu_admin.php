<!--

Auteur : COTTO Erwan
Date de création : 24 Novembre 2022
Sprint : 1
Nom du fichier : menu_admin.php

-----------------------------------------------------------------

Vue menu_admin :
- affiche la page d'accueil de l'espace d'administration

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

</br>
</br>
</br>

<h2><center>Espace d'administration</h2>
</br>
<?php
	
	echo "<h5><center>Liste des comptes :</h5>";
	echo "</br>";
	
	if( $pseudos != NULL ) {
		echo "<table class='table'>
                	<thead class='thead-dark'>
                        	<tr>
                                	<th>Pseudo</th>
                                       	<th>Rôle</th>
                                        <th>Activé</th>
                                        <th>Date de création</th>
                                </tr>
                        </thead>
                       	<tbody>";
		foreach( $pseudos as $login ){
			echo "<tr>";
			echo "<th>";
			echo $login['cmp_pseudo'];
			echo "</th>";
			echo "<th>";
			if( strcmp( $login['pfl_role'], 'A') == 0 ){
				echo "Administrateur";
			} else {
				echo "Formateur";
			}
			echo "</th>";
			echo "<th>";
			if( $login['pfl_validite'] == 1 ){
				echo "Oui";
			} else{
				echo "Non";
			}
			echo "</th>";
			echo "<th>";
			echo $login['pfl_creation'];
			echo "</th>";
			echo "</tr>";
		}
		echo "  </tbody>
                </table>";
	} else {
		echo "Aucun compte enregistré.";
	}
?>

</br>
</br>
</br>
