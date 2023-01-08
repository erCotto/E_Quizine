<!--

Auteur : COTTO Erwan
Date de création : 24 Novembre 2022
Sprint : 1
Nom du fichier : compte_connecter.php

-----------------------------------------------------------------

vue compte_connecter :
- affiche la page de connexion

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

</br>
</br>
</br>

<div class='container'>
	<div class='jumbotron'>
		<?php if(!$valide){ echo "<div class='alert alert-danger' role='alert'><center>Mot de passe ou pseudo erroné.</div>"; } ?>
		<?php if( validation_errors() != null ){ echo "<div class='alert alert-danger' role='alert'><center>".validation_errors()."</div>"; } ?>
			<?php echo form_open('compte/connecter'); ?>
				<center><label for="pseudo"><h3>Pseudo :</h3></label>
				<center><input type="input" name="pseudo" /><br /><br />
				<center><label for="mdp"><h3>Mot de passe :</h3></label>
				<center><input type="password" name="mdp" />
				</br></br>
				<center><button type="submit" name="submit" class="btn btn-primary" />Connexion</button>
			</form>
	</div>
</div>

</br>
</br>
</br>
