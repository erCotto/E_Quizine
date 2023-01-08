<!--

Auteur : COTTO Erwan
Date de création : 24 Novembre 2022
Sprint : 1
Nom du fichier : compte_creer.php

-----------------------------------------------------------------

vue compte_creer :
- permet de creer un compte

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

<?php
    echo validation_errors(); 
    echo form_open('compte_creer');
    echo form_label('Pseudo :');
    $champ1=array('name'=>'id',
    'required'=>'required');
    echo form_input($champ1);
    echo form_label('Mot de passe :');
    $champ2=array('name'=>'mdp',
    'required'=>'required');
    echo form_input($champ2);
?>
<?php
    echo form_open('compte_creer');
?>
    <label for="id">Identifiant</label>
    <input type="input" name="id" /><br />
    <label for="mdp">Mot de passe</label>
    <input type="input" name="mdp" /><br />
    <input type="submit" name="submit" value="Créer un compte" />
</form>
