<!--

Auteur : COTTO Erwan
Date de création : 16 Novembre 2022
Sprint : 1
Nom du fichier : rejoindre_match.php

-----------------------------------------------------------------

Vue bas :
- affiche la page pour rejoindre un match

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

</br>
</br>
</br>
<div class='container'>
	<div class='jumbotron'>
		<?php if(!$valide){ echo "<div class='alert alert-danger' role='alert'><center>Match introuvable.</div>"; } ?>
		<?php if( validation_errors() != null ){ echo "<div class='alert alert-danger' role='alert'><center>".validation_errors()."</div>"; } ?>
			<?php echo form_open('rejoindre_match'); ?>
				<center><label for="code"><h3>Entrez le code d'un match</h3></label>
				<center><input type="input" name="code" /><br />
				</br>
				<center><button type="submit" name="submit" class="btn btn-primary" />Rejoindre</button>
			</form>
	</div>
</div>
</br>
</br>
</br>
