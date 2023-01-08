<!--

Auteur : COTTO Erwan
Date de création : 10 Novembre 2022
Sprint : 1
Nom du fichier : Accueil.php

-----------------------------------------------------------------

Contrôleur Accueil :
- contrôle la page d'accueil
- contient les fonctions pour le bon affichage de la page d'accueil

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Accueil extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('db_model');
		}

		// affiche la page d'accueil
		public function afficher(){
			$this->load->view('templates/haut');
			$this->load->view('templates/menu');
			// appel à la fonction pour afficher les actualites
			$data['titre'] = 'Actualités';
			$data['actu'] = $this->db_model->get_all_actualite();
			$this->load->view('page_accueil', $data);
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('code', 'code', 'required');
			$data['valide'] = true;
			if ($this->form_validation->run() == FALSE){
				$this->load->view('rejoindre_match', $data);
			} else {
				$data['valide'] = true;
				$this->load->view('choix_pseudo',$data);
			}
			$this->load->view('templates/bas');
		}
		
	}
?>
