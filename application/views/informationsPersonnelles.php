<!--

Auteur : COTTO Erwan
Date de création : 26 Novembre 2022
Sprint : 1
Nom du fichier : informationsPersonnelles.php

-----------------------------------------------------------------

Vue informationsPersonnelles :
- affiche les informations personnelles d'un compte

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

</br>
</br>
</br>

	<h2><center>Vos informations personnelles</h2>
	</br>
	</br>
	
	<?php
		echo "<table class='table'>
                	<thead class='thead-dark'>
                        	<tr>
                                	<th>Nom</th>
                                       	<th>Prenom</th>
                                        <th>Création du compte</th>
                                        <th>Date de naissance</th>
                                </tr>
                        </thead>
                       	<tbody>";

		echo "<tr>";
		echo "<th>";
		echo $infos->pfl_nom;
		echo "</th>";
		echo "<th>";
		echo $infos->pfl_prenom;
		echo "</th>";
		echo "<th>";
		echo $infos->pfl_creation;
		echo "</th>";
		echo "<th>";
		if( $infos->pfl_date_naissance != null ){
			echo $infos->pfl_date_naissance;
		} else {
			echo "Non renseigné";
		}
		echo "</th>";
		echo "</tr>";
		
		echo "  </tbody>
                </table>";
	?>

</br>
</br>
</br>

<center>
	<a href = "<?php echo $this->config->base_url() ?>index.php/compte/modif_info_personne">
		<button type="submit" name="submit" class="btn btn-primary" />Modifier</button>
	</a>
	
</br>
</br>
</br>
