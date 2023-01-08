<!--

Auteur : COTTO Erwan
Date de création : 15 Novembre 2022
Sprint : 1
Nom du fichier : Match.php

-----------------------------------------------------------------

Contrôleur Match :
- contrôle l'affichage des matchs
- contient les fonctions pour le bon affichage de la page d'un match

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Match extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('db_model');
		}
		
		// affiche la page pour rejoindre un match
		public function rejoindre(){
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('code', 'code', 'required');
			$data['valide'] = true;
			if ($this->form_validation->run() == FALSE){
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->load->view('rejoindre_match', $data);
				$this->load->view('templates/bas');
			} else {
				if($this->db_model->check_match()){
					$data['valide'] = true;
					$this->load->view('templates/haut');
					$this->load->view('templates/menu');
					$this->load->view('choix_pseudo',$data);
					$this->load->view('templates/bas');
				} else {
					$data['valide'] = false;
					$this->load->view('templates/haut');
					$this->load->view('templates/menu');
					$this->load->view('rejoindre_match', $data);
					$this->load->view('templates/bas');
				}
			}
		}
		
		// affiche la page pour choisir un pseudo
		public function pseudo(){
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('pseudo', 'pseudo', 'required');
			$data['valide'] = true;
			if ($this->form_validation->run() == FALSE){
				$this->load->view('templates/haut');
				$this->load->view('templates/menu');
				$this->load->view('choix_pseudo', $data);
				$this->load->view('templates/bas');
			} else {
				if($this->db_model->insert_match()){
					$data['match'] = $this->db_model->join_match();
					$this->load->view('templates/haut');
					$this->load->view('templates/menu');
					$this->load->view('joue_match', $data);
					$this->load->view('templates/bas');
				} else {
					$data['valide'] = false;
					$this->load->view('templates/haut');
					$this->load->view('templates/menu');
					$this->load->view('choix_pseudo', $data);
					$this->load->view('templates/bas');
				}
			}
		}

		// permet de jouer un match
		public function jouer(){
			$this->load->helper('form');
			$this->load->library('form_validation');
			$mch = $this->db_model->join_match();
			$data['match'] = $mch;
			$score = 0;
			$score_pourcent = 0;
			foreach( $mch as $m ){
				if( !(isset( $t[$m['qtn_id_question']])) ){
					if( $this->db_model->correct_answer( $this->input->post($m['qtn_id_question']) ) ){
						$score++;
					}
					$t[$m['qtn_id_question']] = 1;
				}
			}
			$score_pourcent = $this->db_model->player_score( $score, $this->input->post('id_quiz') );
			$data['score_pourcent'] = $score_pourcent;
			$this->load->view('templates/haut');
			$this->load->view('templates/menu');
			$this->load->view('score', $data);
			$this->load->view('templates/bas');
		}
		
	}
?>
