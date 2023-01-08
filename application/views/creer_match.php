<!--

Auteur : COTTO Erwan
Date de création : 1er Décembre 2022
Sprint : 1
Nom du fichier : menu_forma.php

-----------------------------------------------------------------

Vue creer_match :
- affiche le formulaire pour créer un match

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

</br>
</br>
</br>

<div class='container'>
	<div class='jumbotron'>
		<?php if( validation_errors() != null ){ echo "<div class='alert alert-danger' role='alert'><center>".validation_errors()."</div>"; } ?>
			<?php echo form_open('compte/ajouter_match'); ?>
				<center><label for="nom"><h3>Entrez le nom du match</h3></label>
				<center><input type="input" name="nom" /><br />
				</br>
				<center><label for="inputState"><h3>Quiz</h3></label>
                        	<select id="inputState" class="form-control" name="id_quiz">
                         		<?php
                         			foreach( $all_quiz as $quiz ){
                         				echo "<option value = '".$quiz['qiz_id_quiz']."'>".$quiz['qiz_intitule_quiz']."</option>";
                         			}
                         		?>
                        	</select>
                        	</br>
                        	<center><button type="submit" name="submit" class="btn btn-primary" />Créer</button>
                        </form>
	</div>
</div>

</br>
</br>
</br>
