<!--

Auteur : COTTO Erwan
Date de création : 24 Novembre 2022
Sprint : 1
Nom du fichier : menu_forma.php

-----------------------------------------------------------------

Vue menu_forma :
- affiche la page d'accueil de l'espace d'un formateur

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

<?php
	if( (strcmp($this->session->userdata('role'), 'F') != 0 ) && ($_SESSION['valide'] != 1) ){
		redirect(base_url()."index.php/compte/connecter");
	}
?>

</br>
</br>
</br>

<h2><center>Espace formateur</h2>
</br>
<?php
	
	if( $all_match != NULL ) {
		echo "<table class='table'>
                	<thead class='thead-dark'>
                        	<tr>
                                	<th>Code du match</th>
                                       	<th>Nom du match</th>
                                       	<th>Auteur du match</th>
                                        <th>Quiz</th>
                                        <th>Auteur du quiz</th>
                                        <th>Informations</th>
                                        <th>Lancer</th>
                                        <th>Réinitialiser</th>
										<th>Correction</th>
                                        <th>Supprimer</th>
                                </tr>
                        </thead>
                       	<tbody>";
		foreach( $all_match as $match ){
			echo "<tr>";
			echo "<th>";
			echo $match['mch_code'];
			echo "</th>";
			echo "<th>";
			echo $match['mch_intitule'];
			echo "</th>";
			echo "<th>";
			if( $match['mch_code'] != null ){
				if( $match['a_match'] != NULL ) {
					echo $match['a_match'];
				} else {
					echo "Formateur supprimé.";
				}
			}
			echo "</th>";
			echo "<th>";
			echo "<a href = ".$this->config->base_url()."index.php/compte/info_quiz/".$match['qiz_id_quiz'].">";
			echo $match['qiz_intitule_quiz'];
			echo "</a>";
			echo "</th>";
			echo "<th>";
			if( $match['auteur_quiz'] != NULL ) {
				echo $match['auteur_quiz'];
			} else {
				echo "Formateur supprimé.";
			}
			echo "</th>";
			echo "<th>";
			if( $match['mch_code'] != null ){
				echo "<a href = ".$this->config->base_url()."index.php/compte/info_match/".$match['mch_code'].">";
				echo "informations détaillées";
			}
			echo "</a>";
			echo "</th>";
			echo "<th>";
			if( $match['mch_code'] != null ){
				if( strcmp($match['a_match'], $this->session->userdata('username')) == 0 ){
					if( $match['mch_activation'] == 0 ){
						echo "<a href = ".$this->config->base_url()."index.php/compte/activer_match/".$match['mch_code'].">";
						echo "<button type='submit' name='submit' class='btn btn-success' />Lancer</button>";
						echo "</a>";
					} else {
						echo "<a href = ".$this->config->base_url()."index.php/compte/desactiver_match/".$match['mch_code'].">";
						echo "<button type='submit' name='submit' class='btn btn-danger' />Stopper</button>";
						echo "</a>";
					}
				} else {
					if( $match['mch_activation'] == 0 ){
						echo "<button type='submit' name='submit' class='btn btn-success' disabled='disabled'/>Lancer</button>";
					} else {
						echo "<button type='submit' name='submit' class='btn btn-danger' disabled='disabled'/>Stopper</button>";
					}
				}
			}
			echo "</th>";
			echo "<th>";
			if( $match['mch_code'] != null ){
				if( strcmp($match['a_match'], $this->session->userdata('username')) == 0 ){
					echo "<a href = ".$this->config->base_url()."index.php/compte/reset_match/".$match['mch_code'].">";
					echo "<button type='submit' name='submit' class='btn btn-secondary' />Réinitialiser</button>";
					echo "</a>";
				} else {
					echo "<button type='submit' name='submit' class='btn btn-secondary' disabled='disabled'/>Réinitialiser</button>";
				}
			}
			echo "</th>";
			echo "<th>";
			if( $match['mch_code'] != null ){
				if( (strcmp($match['a_match'], $this->session->userdata('username')) == 0)){
					echo "<a href = ".$this->config->base_url()."index.php/compte/correction/".$match['mch_code'].">";
					if( $match['mch_correction'] == 0 ){
						echo "<button type='submit' name='submit' class='btn btn-danger' />Invisible</button>";
					} else {
						echo "<button type='submit' name='submit' class='btn btn-success' />Visible</button>";
					}
					echo "</a>";
				} else {
					if( $match['mch_correction'] == 0 ){
						echo "<button type='submit' name='submit' class='btn btn-danger' disabled='disabled'/>Invisible</button>";
					} else {
						echo "<button type='submit' name='submit' class='btn btn-success' disabled='disabled'/>Visible</button>";
					}
				}
			}
			echo "</th>";
			echo "<th>";
			if( $match['mch_code'] != null ){
				if( (strcmp($match['a_match'], $this->session->userdata('username')) == 0) && ($match['mch_activation'] == 0 ) ){
					echo "<a href = ".$this->config->base_url()."index.php/compte/supprimer_match/".$match['mch_code'].">";
					echo "<button type='submit' name='submit' class='btn btn-danger' />Supprimer</button>";
					echo "</a>";
				} else {
					echo "<button type='submit' name='submit' class='btn btn-danger' disabled='disabled'/>Supprimer</button>";
				}
			}
			echo "</th>";
			echo "</tr>";
		}
		echo "  </tbody>
                </table>";
	} else {
		echo "<h5><center>Aucun match.</h5>";
	}
?>

</br>
</br>
</br>

	<center>
	<a href = "<?php echo $this->config->base_url() ?>index.php/compte/ajouter_match">
		<button type="submit" name="submit" class="btn btn-primary" />Créer un match</button>
	</a>

</br>
</br>
</br>
