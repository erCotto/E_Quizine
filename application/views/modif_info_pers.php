<!--

Auteur : COTTO Erwan
Date de création : 2 Décembre 2022 2022
Sprint : 1
Nom du fichier : modif_info_pers.php

-----------------------------------------------------------------

Vue modif_info_pers :
- possède un formulaire de modification du mot de passe

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

<div class='container'>
	<div class='jumbotron'>
		<h4><center>Modifier vos informations personnelles</h4>
		</br>
		<?php if(!$valide1){ echo "<div class='alert alert-danger' role='alert'><center>Les mots de passe ne correspondent pas.</div>"; } ?>
		<?php if(!$valide2){ echo "<div class='alert alert-danger' role='alert'><center>Mot de passe erroné.</div>"; } ?>
		<?php if( validation_errors() != null ){ echo "<div class='alert alert-danger' role='alert'><center>".validation_errors()."</div>"; } ?>
			<?php echo form_open('compte/modif_info_personne'); ?>
                <!-- pseudo, nom et prénom -->
                <center><label for="pseudo"><h5>Nouveau pseudo</h5></label>
				<center><input type="text" name="pseudo" value ="<?php echo $this->session->userdata('username') ?>"/><br />
                <center><label for="nom"><h5>Modifier nom</h5></label>
				<center><input type="text" name="nom" value ="<?php echo $infos->pfl_nom ?>"/><br />
                <center><label for="prenom"><h5>Modifier prenom</h5></label>
				<center><input type="text" name="prenom" value ="<?php echo $infos->pfl_prenom ?>"/><br />
                <!-- mot de passe -->
				<center><label for="mdp1"><h5>Nouveau mot de passe</h5></label>
				<center><input type="password" name="mdp1" /><br />
				<center><label for="mdp2"><h5>Confirmez le nouveau mot de passe</h5></label>
				<center><input type="password" name="mdp2" /><br />
				<center><label for="mdp-A"><h5>Entrez votre mode de passe pour confirmer</h5></label>
				<center><input type="password" name="mdp_A" /><br />
				</br>
				<center><button type="submit" name="submit" class="btn btn-primary" />Modifier</button>
			</form>
			</br>
			<center>
				<a href = "<?php echo $this->config->base_url() ?>index.php/compte/info_personne">
		            <button type="button" name="annuler" class="btn btn-primary">Annuler</button>
	            </a>
	</div>
</div>
	
</br>
</br>
</br>