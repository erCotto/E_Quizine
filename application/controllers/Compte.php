<!--

Auteur : COTTO Erwan
Date de création : 15 Novembre 2022
Sprint : 1
Nom du fichier : Compte.php

-----------------------------------------------------------------

Contrôleur Compte :
- contrôle l'accès aux comptes
- contient l'appel à la fonction de récupération des pseudo

-----------------------------------------------------------------

Bug(s) :
- aucun répertorié

-->

<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Compte extends CI_Controller {
	
		public function __construct(){
			parent::__construct();
			$this->load->model('db_model');
			$this->load->helper('url_helper');
		}

		// fonction listant les pseudo
		public function lister(){
			$data['titre'] = 'Liste des pseudos :';
			// liste des pseudo
			$data['pseudos'] = $this->db_model->get_all_compte();
			$this->load->view('templates/haut');
			$this->load->view('compte_liste',$data);
			$this->load->view('templates/bas');
		}
		
		// fonction de test des formulaires
		public function creer(){
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id', 'id', 'required');
			$this->form_validation->set_rules('mdp', 'mdp', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->load->view('templates/haut');
				$this->load->view('compte_creer');
				$this->load->view('templates/bas');
			} else {
				$this->db_model->set_compte();
				$this->load->view('templates/haut');
				$this->load->view('compte_succes');
				$this->load->view('templates/bas');
			}
		}
		
		// fonction de connexion
		public function connecter(){
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('pseudo', 'pseudo', 'required');
			$this->form_validation->set_rules('mdp', 'mdp', 'required');
			$data['valide'] = true;
			if ($this->form_validation->run() == FALSE){
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->load->view('compte_connecter', $data);
				$this->load->view('templates/bas');
			} else {
				// test du mot de passe entré
				$salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
				$username = htmlspecialchars(addslashes($this->input->post('pseudo')));
				$password_hash = htmlspecialchars(addslashes($this->input->post('mdp')));
				$password = hash('sha256', $salt.$password_hash);
				if($this->db_model->connect_compte($username,$password)){
					// stockage des données de session
					$data_compte = $this->db_model->info_compte($username);
					$session_data = array('username' => $username,
							      'role'     => $data_compte->pfl_role,
							      'valide'   => $data_compte->pfl_validite,
							      'id'       => $data_compte->cmp_id_compte );
					$this->session->set_userdata($session_data);
					$this->load->view('templates/haut');
					$this->load->view('templates/menu');
					// accès espace administrateur
					if( (strcmp($this->session->userdata('role'), 'A') == 0 ) && ($this->session->userdata('valide') == 1 ) ){
						$data['pseudos'] = $this->db_model->get_all_compte();
						$this->load->view('menu_admin', $data);
					// accès espace formateur
					} else if ( (strcmp($this->session->userdata('role'), 'F') == 0 ) && ($this->session->userdata('valide') == 1 ) ){
						redirect(base_url().'index.php/accueil/afficher') ;
					} else {
						$this->session->sess_destroy();
						unset($_SESSION['valide']);
  						unset($_SESSION['role']);
  						unset($_SESSION['id']);
  						unset($_SESSION['username']);
					}
					$this->load->view('templates/bas');
				} else {
					$data['valide'] = false;
					$this->load->view('templates/haut');
					$this->load->view('templates/menu');
					$this->load->view('compte_connecter', $data);
					$this->load->view('templates/bas');
				}
			}
		}
		
		// fonction de deconnection
		public function deconnecter(){
			$this->session->sess_destroy();
			unset($_SESSION['valide']);
  			unset($_SESSION['role']);
  			unset($_SESSION['id']);
  			unset($_SESSION['username']);
  			redirect(base_url().'index.php/accueil/afficher');
		}
		
		// récupération des informations d'un match
		// param $code = code du match dont on récupère les infos
		public function info_match($code =FALSE){
			if($code == FALSE){
				$url=base_url(); header("Location:$url");
			} else {
				$data['score_match'] = $this->db_model->avg_score($code);
				$data['match'] = $this->db_model->get_match($code);
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->load->view('informations_match', $data);
				$this->load->view('templates/bas');
			}
		}

		// informations personnelles
		public function info_personne(){
			//récupération des données du compte
			$data_compte['infos'] = $this->db_model->info_compte($this->session->userdata('username'));
			$this->load->view('templates/haut');
			$this->load->view('templates/menu');
			$this->load->view('informationsPersonnelles', $data_compte);
			$this->load->view('templates/bas');
		}
		
		// modifier informations personnelles
		public function modif_info_personne(){
			$this->load->helper('form');
			$this->load->library('form_validation');
			$data_compte['valide1'] = true;
			$data_compte['valide2'] = true;
			if( isset($_SESSION['valide']) ){
				//règles du formulaire
				$this->form_validation->set_rules('mdp1', 'mdp1', 'required');
				$this->form_validation->set_rules('mdp2', 'mdp2', 'required');
				$this->form_validation->set_rules('mdp_A', 'mdp_A', 'required');
				//récupération des données du compte
				$data_compte['infos'] = $this->db_model->info_compte($this->session->userdata('username'));
				//fomulaire invalide
				if ($this->form_validation->run() == FALSE){
					$this->load->view('templates/haut');
					$this->load->view('templates/menu');
					$this->load->view('modif_info_pers', $data_compte);
					$this->load->view('templates/bas');
				//formulaire valide
				} else {
					$this->load->view('templates/haut');
					$this->load->view('templates/menu');
					if( (strcmp(htmlspecialchars(addslashes($this->input->post('mdp1'))), htmlspecialchars(addslashes($this->input->post('mdp2')))) == 0) ){
						$mdp = htmlspecialchars(addslashes($this->input->post('mdp1')));
						$salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
						$username = $this->session->userdata('username');
						$password_hash = htmlspecialchars(addslashes($this->input->post('mdp_A')));
						$password = hash('sha256', $salt.$password_hash);
						$n_mdp = hash('sha256', $salt.$mdp);
						if($this->db_model->connect_compte($username,$password)){
							$this->db_model->update_password($n_mdp, $this->session->userdata('id'));
							$data_compte['mdp'] = $mdp;
							$data_compte['mdph'] = $n_mdp;
							$this->load->view('informationsPersonnelles', $data_compte);
						} else {
							$data_compte['valide2'] = false;
							$this->load->view('modif_info_pers', $data_compte);
						}
					} else {
						$data_compte['valide1'] = false;
						$this->load->view('modif_info_pers', $data_compte);
					}
					$this->load->view('templates/bas');
				}
			//tentative d'accès sans connexion
			} else {
				$data['valide'] = true;
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->load->view('compte_connecter', $data);
				$this->load->view('templates/bas');
			}
		}
		
		
		// fonction pour afficher le menu formateur
		public function menu_forma(){
			if( $this->session->userdata('valide') != null ){
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$data['all_match'] = $this->db_model->get_all_match();
				$this->load->view('menu_forma', $data);
				$this->load->view('templates/bas');
			} else {
				$this->load->helper('form');
				$this->load->library('form_validation');
				$data['valide'] = true;
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->load->view('compte_connecter', $data);
				$this->load->view('templates/bas');
			}
		}
		
		// fonction permettant d'afficher le corrigé d'un quiz
		// @param $id = id du quiz
		public function info_quiz($id){
			$this->load->view('templates/haut');
			$this->load->view('templates/menu');
			$data['quiz'] = $this->db_model->get_answer_quizz($id);
			$this->load->view('info_quiz', $data);
			$this->load->view('templates/bas');
		}
		
		// fonction pour afficher le menu administrateur
		public function menu_admin(){
			if( $this->session->userdata('valide') != null ){
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$data['pseudos'] = $this->db_model->get_all_compte();
				$this->load->view('menu_admin', $data);
				$this->load->view('templates/bas');
			} else {
				$this->load->helper('form');
				$this->load->library('form_validation');
				$data['valide'] = true;
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->load->view('compte_connecter', $data);
				$this->load->view('templates/bas');
			}
		}
		
		// fonction pour afficher le menu formateur et reset un match
		// @param $code = code du match à réinitialiser
		public function reset_match($code){
			if( $this->session->userdata('valide') != null ){
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->db_model->reset_match($code);
				$data['all_match'] = $this->db_model->get_all_match();
				$this->load->view('menu_forma', $data);
				$this->load->view('templates/bas');
			} else {
				$this->load->helper('form');
				$this->load->library('form_validation');
				$data['valide'] = true;
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->load->view('compte_connecter', $data);
				$this->load->view('templates/bas');
			}
		}
		
		// fonction pour afficher le menu formateur et activer un match
		// @param $code = code du match à réinitialiser
		public function activer_match($code){
			if( $this->session->userdata('valide') != null ){
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->db_model->start_match($code);
				$data['all_match'] = $this->db_model->get_all_match();
				$this->load->view('menu_forma', $data);
				$this->load->view('templates/bas');
			} else {
				$this->load->helper('form');
				$this->load->library('form_validation');
				$data['valide'] = true;
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->load->view('compte_connecter', $data);
				$this->load->view('templates/bas');
			}
		}
		
		// fonction pour afficher le menu formateur et désactiver un match
		// @param $code = code du match à réinitialiser
		public function desactiver_match($code){
			if( $this->session->userdata('valide') != null ){
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->db_model->stop_match($code);
				$data['all_match'] = $this->db_model->get_all_match();
				$this->load->view('menu_forma', $data);
				$this->load->view('templates/bas');
			} else {
				$this->load->helper('form');
				$this->load->library('form_validation');
				$data['valide'] = true;
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->load->view('compte_connecter', $data);
				$this->load->view('templates/bas');
			}
		}
		
		// fonction pour afficher le menu formateur et désactiver un match
		// @param $code = code du match à réinitialiser
		public function supprimer_match($code){
			if( $this->session->userdata('valide') != null ){
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->db_model->delete_match($code);
				$data['all_match'] = $this->db_model->get_all_match();
				$this->load->view('menu_forma', $data);
				$this->load->view('templates/bas');
			} else {
				$this->load->helper('form');
				$this->load->library('form_validation');
				$data['valide'] = true;
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->load->view('compte_connecter', $data);
				$this->load->view('templates/bas');
			}
		}

		// fonction pour afficher le menu formateur et modifier la visibilité de la correction pour un match
		// @param $code = code du match
		public function correction($code){
			if( $this->session->userdata('valide') != null ){
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->db_model->correct_match($code);
				$data['all_match'] = $this->db_model->get_all_match();
				$this->load->view('menu_forma', $data);
				$this->load->view('templates/bas');
			} else {
				$this->load->helper('form');
				$this->load->library('form_validation');
				$data['valide'] = true;
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->load->view('compte_connecter', $data);
				$this->load->view('templates/bas');
			}
		}
		
		// fonction pour créer le match
		public function ajouter_match(){
			$this->load->helper('form');
			$this->load->library('form_validation');
			if( $this->session->userdata('valide') != null ){
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->form_validation->set_rules('nom', 'nom', 'required');
				$data['all_quiz'] = $this->db_model->get_quizz();
				if ($this->form_validation->run() == FALSE){
					$this->load->view('creer_match', $data);
				} else {
					$this->db_model->create_match( $this->input->post('id_quiz'), $this->input->post('nom') );
					$data['all_match'] = $this->db_model->get_all_match();
					$this->load->view('menu_forma', $data);
				}
				$this->load->view('templates/bas');
			} else {
				$this->load->helper('form');
				$this->load->library('form_validation');
				$data['valide'] = true;
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->load->view('compte_connecter', $data);
				$this->load->view('templates/bas');
			}
		}
		
		// fonction pour terminer le match
		public function terminer_match($code =False){
			if($code == FALSE){
				$url=base_url(); header("Location:$url");
			} else {
				$this->db_model->end_match($code);
				$data['score_match'] = $this->db_model->avg_score($code);
				$data['match'] = $this->db_model->get_match($code);
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->load->view('informations_match', $data);
				$this->load->view('templates/bas');
			}
		}
		
	}
?>
