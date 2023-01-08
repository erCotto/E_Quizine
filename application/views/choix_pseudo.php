<!--

Auteur : COTTO Erwan
Date de création : 20 Novembre 2022
Sprint : 1
Nom du fichier : choix_pseudo.php

-----------------------------------------------------------------

vue choix_pseudo :
- affiche la page de choix d'un pseudo pour un match

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

</br>
</br>
</br>
<div class='container'>
	<div class='jumbotron'>
		<?php if(!$valide){ echo "<div class='alert alert-danger' role='alert'><center>Pseudo déjà utilisé pour ce match.</div>"; } ?>
		<?php if( validation_errors() != null ){ echo "<div class='alert alert-danger' role='alert'><center>".validation_errors()."</div>"; } ?>
			<?php echo form_open('choix_pseudo'); ?>
				<center><label for="pseudo"><h3>Entrez votre pseudo</h3></label>
				<center><input type="input" name="pseudo" /><br />
				<input type="hidden" name="code" value="<?php echo $this->input->post('code') ?>" />
				</br>
				<center><button type="submit" name="submit" class="btn btn-primary" />Choisir</button>
			</form>
	</div>
</div>
</br>
</br>
</br>
