<!--

Auteur : COTTO Erwan
Date de création : 15 Novembre 2022
Sprint : 1
Nom du fichier : score.php

-----------------------------------------------------------------

vue score :
- affiche le score d'un joueur et le corrigé si autorisé

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

</br>
</br>
</br>

<?php
    echo "<div class='container'><div class='jumbotron'>";
    echo "<h5><center>Votre score est de ";
    echo $score_pourcent->score."%</h5>";
    echo "</br>";
    echo "<div class='progress'>";
    if( $score_pourcent->score > 74){
        echo "<div class='progress-bar bg-success' role='progressbar' style='width: ".$score_pourcent->score."%' aria-valuenow='".$score_pourcent->score."' aria-valuemin='0' aria-valuemax='100'></div>";
    } else if( $score_pourcent->score > 49) {
        echo "<div class='progress-bar bg-warning' role='progressbar' style='width: ".$score_pourcent->score."%' aria-valuenow='".$score_pourcent->score."' aria-valuemin='0' aria-valuemax='100'></div>";
    } else {
        echo "<div class='progress-bar bg-danger' role='progressbar' style='width: ".$score_pourcent->score."%' aria-valuenow='".$score_pourcent->score."' aria-valuemin='0' aria-valuemax='100'></div>";
    }
    echo "</div>";
    echo "</div></div>";

    echo "</br></br>";

    foreach( $match as $m ){
        if( !isset($t)){
            if( $m['mch_correction'] == 1 ){
                echo "<h4><center>Correction :</h4>";
                echo "</br></br>";
                foreach($match as $qz){
                    if (!isset($traite[$qz["qtn_id_question"]])){
                        if( $qz['qtn_active'] != 0 ){
                            echo "<div class='container'><div class='jumbotron'>";
                            $q_id = $qz['qtn_id_question'];
                            echo "<h5><center>".$qz['qtn_texte_question']."</h5>";
                            echo "</br></br>";
                            echo "<center>";
                            foreach($match as $qiz){
                                if(strcmp($q_id,$qiz["qtn_id_question"])==0){
                                    echo "<h4>";
                                    if( $qiz['rpn_valide'] == 1 ){
                                        echo "<span class='badge badge-secondary badge-success'>";
                                    } else {
                                        echo "<span class='badge badge-secondary badge-danger'>";
                                    }
                                    echo $qiz['rpn_libelle_reponse'];
                                    echo "</span>";
                                    echo "</h4>";
                                }
                            
                            }
                            echo "</div></div>";
                            echo "</br></br>";
                        }
                        $traite[$qz["qtn_id_question"]]=1;
                    }
                }
            } else {
                echo "<h4><center>La correction n'est pas visible pour ce match.</h5>";
            }
        }
        $t = 1;
    }
?>

</br>
</br>
</br>