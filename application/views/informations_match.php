<!--

Auteur : COTTO Erwan
Date de création : 26 Novembre 2022
Sprint : 1
Nom du fichier : informations_match.php

-----------------------------------------------------------------

Vue informations_match :
- affiche la page d'un match d'un formateur

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

<?php

	if($match != NULL) {
	
		foreach($match as $m){
			if( !isset($t[$m['mch_intitule']])){
				echo "<h2><center>".$m['mch_intitule']."</h2></br>";
				echo "<h3><center>".$m['qiz_intitule_quiz']."</h3></br></br>";
				echo "<h4><center>Date de début : ".$m['mch_date_debut']."</h4></br>";
				if( $m['mch_date_fin'] != null ){
					echo "<h4><center>Match terminé depuis le : ".$m['mch_date_fin']."</h4></br>";
				}
			}
			$t[$m['mch_intitule']] = 1;
		}
		
		echo "<h4><center>Pourcentage moyen de bonnes réponses : ";
		if( $score_match->score != NULL ){
			echo $score_match->score;
		} else {
			echo "0";
		}
		echo "%</h4>";
		echo "</br>";
		
		foreach($match as $mch){
			if (!isset($traite[$mch["qtn_id_question"]])){
				echo "<div class='container'><div class='jumbotron'>";
				$q_id = $mch['qtn_id_question'];
				echo "<h5><center>".$mch['qtn_texte_question']."</h5>";
				echo "</br></br>";
				echo "<center>";
				foreach($match as $mtch){
					if(strcmp($q_id,$mtch["qtn_id_question"])==0){
						echo "<h4>";
						echo "<span class='badge badge-primary'>";
						echo $mtch['rpn_libelle_reponse'];
						echo "</span>";
						echo "</h4>";
					}
				}
				echo "</div></div>";
				echo "</br>";
				$traite[$mch["qtn_id_question"]]=1;
			}
		}
	}
?>

<?php
	echo "<center>";
	foreach( $match as $m ){
		if( !isset($trt[$m['mch_intitule']])){
			if( ($m['mch_activation'] == 1) && ($m['mch_date_fin'] == null) ){
				echo "<a href = ".$this->config->base_url()."index.php/compte/terminer_match/".$m['mch_code'].">";
				echo "<button type='submit' name='submit' class='btn btn-primary' />Terminer le match</button>";
				echo "</a>";
			}
		}
		$trt[$m['mch_intitule']] = 1;
	}
?>

</br>
</br>
</br>
