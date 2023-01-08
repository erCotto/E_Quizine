<!--

Auteur : COTTO Erwan
Date de création : 15 Novembre 2022
Sprint : 1
Nom du fichier : Actualite.php

-----------------------------------------------------------------

Contrôleur Actualite :
- contrôle la page des actualiteq
- contient les fonctions pour le bon affichage de la page des actualites

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Actualite extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('db_model');
			$this->load->helper('url_helper');
		}

		// affichage des actualites
		// param $numero = id actualite
		public function afficher($numero =FALSE){
			if ($numero==FALSE){
				$url=base_url(); header("Location:$url");
			} else {
				$data['titre'] = 'Actualité :';
				$data['actu'] = $this->db_model->get_actualite($numero);
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->load->view('actualite_afficher',$data);
				$this->load->view('templates/bas');
			}
		}
	}
?>
