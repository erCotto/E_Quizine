<!--

Auteur : COTTO Erwan
Date de création : 16 Novembre 2022
Sprint : 1
Nom du fichier : menu.php

-----------------------------------------------------------------

Vue menu :
- affiche la barre de navigation

-----------------------------------------------------------------

Bug(s) :
- aucun repertorié

-->

<!-- BARRE DE NAVIGATION -->
	
<div class="mt-3 mb-5">
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top sticky-navigation">
                	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        	<span class="navbar-toggler-icon"></span>
                        </button>

                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                	<ul class="navbar-nav mr-auto">
                                        	<li class="nav-item active">
                                            		<a class="nav-link" href="<?php echo $this->config->base_url(); ?>index.php/accueil/afficher">Accueil <span class="sr-only">(current)</span></a>
                                        	</li>
                                        	<li class="nav-item">
                                        		<?php
								if( isset($_SESSION['valide']) ){
									echo "<li class='nav-item'>";
									echo "<a class='nav-link'>".$this->session->userdata('username')."</a>";
									echo "</li>";
									echo "<li class='nav-item'>";
									echo "<a class='nav-link' href='".$this->config->base_url()."index.php/compte/info_personne"."'>Profil</a>";
									echo "</li>";
									if( strcmp($this->session->userdata('role'), 'F') == 0 ){
										echo "<li class='nav-item'>";
										echo "<a class='nav-link' href='".$this->config->base_url()."index.php/compte/menu_forma"."'>Espace formateur</a>";
										echo "</li>";
									} else {
										echo "<li class='nav-item'>";
										echo "<a class='nav-link' href='".$this->config->base_url()."index.php/compte/menu_admin"."'>Espace administrateur</a>";
										echo "</li>";
									}
									echo "<li class='nav-item'>";
									echo "<a class='nav-link' href='".$this->config->base_url()."index.php/compte/deconnecter"."'>Se déconnecter</a>";
									echo "</li>";
								} else {
									echo "<a class='nav-link' href='".$this->config->base_url()."index.php/compte/connecter"."'>Se connecter</a>";
								}
							?>
                                        	</li>
                                    	</ul>
                                </div>
	</nav>
</div>
