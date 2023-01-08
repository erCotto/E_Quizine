<!--

Auteur : COTTO Erwan
Date de création : 12 Novembre 2022
Sprint : 1
Nom du fichier : Db_model.php

-----------------------------------------------------------------

Modèle Db_model :
- contient toutes les fonctions intéragissant avec la base de données

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

<?php
	class Db_model extends CI_Model {
	
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		// fonction de récupération des pseudo
		public function get_all_compte(){
			$query = $this->db->query("select * from T_contes_cmp join T_profil_pfl using(cmp_id_compte);");
			return $query->result_array();
		}
		
		// foncion de création d'un compte
		public function set_compte(){
			$this->load->helper('url');
			$id=htmlspecialchars(addslashes($this->input->post('id')));
			$mdp=htmlspecialchars(addslashes($this->input->post('mdp')));
			$req="INSERT INTO T_contes_cmp VALUES (NULL, '".$id."', '".$mdp."');";
			$query = $this->db->query($req);
			return ($query);
		}
		
		// fonction de récupération d'une actualité
		// param $numero = id actualite
		public function get_actualite($numero){
			$query = $this->db->query("select * from T_actualite_actu where actu_id_actualite = ".$numero.";");
			return $query->row();
		}
		
		// fonction de récupération des actualites
		public function get_all_actualite(){
			$query = $this->db->query("select * from T_actualite_actu join T_contes_cmp using(cmp_id_compte) order by actu_date_actualite desc limit 5;");
			return $query->result_array();
		}
		
		// fonction de test d'existence d'un match
		public function check_match(){
			$code = htmlspecialchars(addslashes($this->input->post('code')));
			$mch = $this->db->query("select mch_code from T_match_mch where mch_code like '".$code."';");
			$match = $mch->row();
			if( isset($match->mch_code) ){
				return true;
			}
			return false;
		}
		
		// fonction de récupération d'un match
		public function join_match(){
			$code = htmlspecialchars(addslashes($this->input->post('code')));
			$query = $this->db->query("select qtn_id_question, qtn_texte_question, rpn_libelle_reponse, rpn_id_reponse, qtn_active, mch_intitule, qiz_intitule_quiz, qiz_id_quiz, mch_correction, rpn_valide from T_match_mch join T_quiz_qiz using (qiz_id_quiz) join T_question_qtn using (qiz_id_quiz) join T_reponse_rpn using (qtn_id_question) where mch_code like '".$code."' and qtn_active = 1;");
			return $query->result_array();
		}

		//  ancienne fonction d'insertion d'un pseudo
		public function pseudo_match(){
			$pseudo = htmlspecialchars(addslashes($this->input->post('pseudo')));
			$code = htmlspecialchars(addslashes($this->input->post('code')));
			$query = $this->db->query("insert into T_joueur_jer values (null, '". $pseudo ."', 0, '". $code ."');");
		}
		
		// fonction d'insertion d'un pseudo
		public function insert_match(){
			$pseudo = htmlspecialchars(addslashes($this->input->post('pseudo')));
			$code = htmlspecialchars(addslashes($this->input->post('code')));
			$liste_pseudo = $this->db->query("select jer_pseudo from T_joueur_jer where mch_code like '".$code."';");
			$existe = 0;
			foreach( $liste_pseudo->result_array() as $liste ){
				if(strcmp($liste['jer_pseudo'], $pseudo) == 0){
					$existe = 1;
				}
			}
			if( $existe == 0 ){
				$this->db->query("call inpseudo('".$pseudo."', '".$code."');");
				return true;
			}
			return false;
		}
		
		// fonction de récupération d'un match
		// param $code = code match
		public function get_match($code){
			$query = $this->db->query("select * from T_match_mch join T_quiz_qiz using (qiz_id_quiz) join T_question_qtn using (qiz_id_quiz) join T_reponse_rpn using (qtn_id_question) where mch_code like '".$code."' and qtn_active = 1;");
			return $query->result_array();
		}
		
		// fonction de test de connexion
		public function connect_compte($username, $password){
			$query =$this->db->query("select cmp_pseudo, cmp_mot_de_passe from T_contes_cmp join T_profil_pfl using (cmp_id_compte) where cmp_pseudo = '".$username."' and cmp_mot_de_passe ='".$password."' and pfl_validite = 1;");
			if($query->num_rows() > 0){
				return true;
			} else {
				return false;
			}
		}

		// fonction de récupération des infos d'un compte
		// @param $username = nom d'utilisateur du compte
		public function info_compte($username){
			$query = $this->db->query("select * from T_profil_pfl join T_contes_cmp using(cmp_id_compte) where cmp_pseudo like '".$username."';");
			return $query->row();
		}
		
		// fonction de récupération des informations des matchs
		public function get_all_match(){
			$query = $this->db->query("select qiz_intitule_quiz, mch_intitule, mch_correction, pseudo_cmp(T_match_mch.cmp_id_compte) as a_match, pseudo_cmp(T_quiz_qiz.cmp_id_compte) as auteur_quiz, mch_code, T_match_mch.cmp_id_compte as auteur_match, qiz_id_quiz, mch_activation from T_quiz_qiz left outer join T_match_mch using (qiz_id_quiz) order by qiz_intitule_quiz;");
			return $query->result_array();
		}
		
		// fonction de modification de mot de passe
		public function update_password($password, $id){
			$query = $this->db->query("update T_contes_cmp set cmp_mot_de_passe = '".$password."' where cmp_id_compte = ".$id.";");
		}
		
		// fonction de calcul du score moyen en %
		// @param $code = code du match dont on récupère le score
		public function avg_score($code){
			$query = $this->db->query("select calcul_score('".$code."') as score;");
			return $query->row();
		}
		
		// fonction pour réinitialiser un match, déclenchement d'un trigger dans la base
		// @param $code = code du match à reset
		public function reset_match($code){
			$this->db->query("update T_match_mch set mch_date_debut = NOW(), mch_date_fin = NULL where mch_code like '".$code."';");
		}
		
		// fonction pour récupérer les réponses d'un quiz
		// @param $id = id du quiz dont on veut les réponses
		public function get_answer_quizz($id){
			$query = $this->db->query("select * from T_quiz_qiz join T_question_qtn using (qiz_id_quiz) join T_reponse_rpn using (qtn_id_question) where qiz_id_quiz = ".$id.";");
			return $query->result_array();
		}
		
		// fonction pour activer un match
		// @param $code = code du match à activer
		public function start_match($code){
			$this->db->query("update T_match_mch set mch_activation = 1 where mch_code like '".$code."'");
		}
		
		// fonction pour désactiver un match
		// @param $code = code du match à désactiver
		public function stop_match($code){
			$this->db->query("update T_match_mch set mch_activation = 0  where mch_code like '".$code."'");
		}
		
		// fonction pour supprimer un match
		// @param $code = code du match à supprimer
		public function delete_match($code){
			$this->db->query("delete from T_joueur_jer where mch_code like '".$code."'");
			$this->db->query("delete from T_match_mch where mch_code like '".$code."'");
		}

		// fonction pour modifier la visibilé de la correction d'un match
		// @param $code = code du match
		public function correct_match($code){
			$query = $this->db->query("select mch_correction from T_match_mch where mch_code like '".$code."';");
			$correct = $query->row();
			if( $correct->mch_correction == 1 ){
				$this->db->query("update T_match_mch set mch_correction = 0 where mch_code like '".$code."';");
			} else {
				$this->db->query("update T_match_mch set mch_correction = 1 where mch_code like '".$code."';");
			}
		}
		
		// fonction pour récupérer les quiz avec au moins une question
		public function get_quizz(){
			$query = $this->db->query("select qiz_intitule_quiz, qiz_id_quiz from T_quiz_qiz join nb_qtn_quiz using (qiz_id_quiz) where nb_question > 0;");
			return $query->result_array();
		}
		
		// fonction pour insérer un quiz
		public function create_match( $id_quiz, $nom){
			$this->load->helper('string');
			$code = random_string('alnum', 8);
			$this->db->query("insert into T_match_mch values ( '".$code."', '".$nom."', 0, NOW(), NULL, ".$id_quiz.", ".$this->session->userdata('id').", 0);");
		}
		
		// fonction pour terminer un match
		// @param $code = code pour terminer le match
		public function end_match($code){
			$this->db->query("update T_match_mch set mch_date_fin = NOW(), mch_activation = 0 where mch_code like '".$code."';");
		}

		// fonction pour vérifier qu'une réponse est correcte
		// @param $id = id de la question à vérifier
		public function correct_answer($id){
			$valide = $this->db->query("select rpn_valide from T_reponse_rpn where rpn_id_reponse = ".$id.";");
			$v = $valide->row();
			if( $v->rpn_valide == 1 ){
				return true;
			}
			return false;
		}

		// fonction pour calculer le score d'un joueur
		// @param $score = score du joueur
		// @param $id_quiz = id du quiz dont on veut le score
		public function player_score( $score, $id_quiz ){
			$pseudo = $this->input->post('pseudo');
			$code = $this->input->post('code');
			$this->db->query("update T_joueur_jer set jer_score = ".$score." where jer_pseudo = '".$pseudo."' and mch_code = '".$code."';");
			$query = $this->db->query("select score_joueur (".$score.", ".$id_quiz.") as score;");
			return $query->row();
		}
		
	}
?>
