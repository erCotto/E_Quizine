<!--

Auteur : COTTO Erwan
Date de création : 15 Novembre 2022
Sprint : 1
Nom du fichier : joue_match.php

-----------------------------------------------------------------

vue joue_match :
- affiche la page d''un match

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

</br>
</br>
</br>

<?php 
	if($match != NULL) {
		echo form_open('match/jouer');
		foreach($match as $m){
			if( !isset($t[$m['mch_intitule']])){
				echo "<h2><center>".$m['mch_intitule']."</h2></br>";
				echo "<h3><center>".$m['qiz_intitule_quiz']."</h3></br></br>";
				echo "<input type='hidden' name='id_quiz' value=".$m['qiz_id_quiz']." />";
			}
			$t[$m['mch_intitule']] = 1;
		}
		foreach($match as $mch){
			if (!isset($traite[$mch["qtn_id_question"]])){
				echo "<div class='container'><div class='jumbotron'>";
				$q_id = $mch['qtn_id_question'];
				echo "<h5><center>".$mch['qtn_texte_question']."</h5>";
				echo "</br></br>";
				echo "<center><div class='btn-group' data-toggle='buttons'>";
				foreach($match as $mtch){
					if(strcmp($q_id,$mtch["qtn_id_question"])==0){
						echo "<label class='btn btn-primary'>";
						echo "<input type='radio' name='".$mtch['qtn_id_question']."' value ='".$mtch['rpn_id_reponse']."' autocomplete='off' checked=''>";
						echo $mtch['rpn_libelle_reponse'];
						echo "</label>";
					}
				}
				echo "</div>";
				echo "</div></div>";
				echo "</br></br>";
				$traite[$mch["qtn_id_question"]]=1;
			}
		}
	}
?>

<input type="hidden" name="code" value="<?php echo $this->input->post('code') ?>" />
<input type="hidden" name="pseudo" value="<?php echo $this->input->post('pseudo') ?>" />
</br>
<center><button type="submit" name="submit" class="btn btn-primary" />Valider</button>
</form>

</br>
</br>
</br>