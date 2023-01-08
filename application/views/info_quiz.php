<!--

Auteur : COTTO Erwan
Date de création : 29 Novembre 2022
Sprint : 1
Nom du fichier : info_quiz.php

-----------------------------------------------------------------

Vue info_quiz :
- affiche les réponses d'un quiz

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

	if($quiz != NULL) {
	
		foreach($quiz as $q){
			if( !isset($t[$q['qiz_intitule_quiz']])){
				echo "<h2><center>".$q['qiz_intitule_quiz']."</h2></br></br>";
			}
			$t[$q['qiz_intitule_quiz']] = 1;
		}
		
		foreach($quiz as $qz){
			if (!isset($traite[$qz["qtn_id_question"]])){
				echo "<div class='container'><div class='jumbotron'>";
				$q_id = $qz['qtn_id_question'];
				if( $qz['qtn_active'] == 0 ){
					echo "<div class='alert alert-danger' role='alert'><center>Cette question ne sera pas visible !</div>";
					echo "</br></br>";
				}
				echo "<h5><center>".$qz['qtn_texte_question']."</h5>";
				echo "</br></br>";
				echo "<center>";
				foreach($quiz as $qiz){
					if(strcmp($q_id,$qiz["qtn_id_question"])==0){
						echo "<h4>";
						if( $qiz['rpn_valide'] == 1 ){
							echo "<span class='badge badge-secondary badge-success'>";
						} else {
							echo "<span class='badge badge-secondary badge-danger'>";
						}
						echo $qiz['rpn_libelle_reponse'];
						echo "</span>";
						echo "</h4>";
					}
				}
				echo "</div></div>";
				echo "</br></br>";
				$traite[$qz["qtn_id_question"]]=1;
			}
		} 
	} else {
		echo "<h4><center>Aucune question pour ce quiz.</h4>";
	}
?>

</br>
</br>
</br>
