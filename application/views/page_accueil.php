<!--

Auteur : COTTO Erwan
Date de création : 11 Novembre 2022
Sprint : 1
Nom du fichier : page_accueil.php

-----------------------------------------------------------------

vue page_accueil :
- affiche la page d'accueil
- affiche une redirection vers la page pour televerser une image

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

<!-- Image accueil -->
		
        <section class="bg-hero">
            <div class="container">
                <div class="row vh-100">
                    <div class="col-sm-12 my-auto text-center">
                        <h1>Net' Schola</h1>
                        <p class="lead text my-4">
                            Vous pensiez tout savoir sur l'Empire Romain ? Venez le vérifier !
                        </p>
                    </div>
                </div>
            </div>
        </section>

</br>

<!-- TABLEAU DES ACTUALITÉS -->
<div class="mt-3 mb-5">
	<h3><center><?php echo $titre; ?></h3>
	</br>
				<?php
					if($actu != NULL) {
					        echo "<table class='table'>
                						<thead class='thead-dark'>
                        						<tr>
                                						<th>Titre</th>
                                       						<th>Auteur</th>
                                        					<th>Date de publication</th>
                                					</tr>
                        					</thead>
                       					 	<tbody>";
						foreach($actu as $actualite){
							echo "<tr>";
							echo "<th>";
							echo "<a href =".$this->config->base_url()."index.php/actualite/afficher/".$actualite['actu_id_actualite'].">";
							echo $actualite["actu_titre"];
							echo "</a>";
							echo "</th>";
							echo "<th>";
							echo $actualite["cmp_pseudo"];
							echo "</th>";
							echo "<th>";
							echo $actualite["actu_date_actualite"];
							echo "</th>";
							echo "</tr>";
						}
						echo "</tbody>
                				      </table>";
					} else {
						echo "<br />";
							echo "<h4><center>Aucune actualité !</h4>";
					}
				?>
 </div>
</br>
