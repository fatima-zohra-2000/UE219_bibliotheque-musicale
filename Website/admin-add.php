<?php
	session_start(); 
	$cnx->connection = require("connexion.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>admin-ajout</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css"/>
</head>
<body>

	
			<header>
				<a class="retour" href="admin-index.php">Retour à l'accueil</a>
				<div class="bloc-header">
					<img class="img-profil" src="assets/images(2)/profil.png"  alt="profil" title="Profil Administrateur"/>
				
					<form method="post" action="deconnexion.php">
					 <button id="deconnexion" type="submit">Déconnexion</button>
					</form>
				</div>
				
			</header>


		<main>	

			<section class="main-container">
						<h2> Ajouter des vidéos :</h2>

							<div class="flex-container">
						

									<form method="post" class="add-form">
									
									<?php
									
									// on verifie que les données des formulaires sont bien envoyées .
	
		if (array_key_exists('titre',$_POST)&& array_key_exists('realisateur',$_POST)&& array_key_exists('annee',$_POST))
		{
				// si elles existent nous les mettons dans des variables pour proceder au controle de la sécurité.
				
				$titre=$_POST['titre'];
				$realisateur=$_POST['realisateur'];
				$annee=$_POST['annee'];
				
			
			// on verifie si les champs envoyés ne sont pas vides et on envoie un message d'erreur en fonction du champ vide.

			if(empty($titre) && empty($realisateur) && empty($annee))
			
			{
				echo "<h4 class='msg-erreur'>Tous les champs sont vides!</h4>";
				
			}
			
				//s'il y'au moins  un des champ vide,  on envoie un message d'erreur!
				
				else

				{

					if (empty($titre))
						
						{
							echo "<p class='msg-erreur'>Aucun titre de film n\'est entré !</p>";
							echo '<br>';
						}

							if (empty($realisateur))
						
						{
							
							echo "<p class='msg-erreur'>Aucun réalisateur de film n\'est entré !</p>";
							echo '<br>';
							
						}
				
							if (empty($annee))
						
						{
							echo "<p class='msg-erreur'>Aucune date de film n\'est entrée !</p>";
							echo '<br>';
							
						}
					}

			//si tous les champs sont bien remplies on contrôle l'intégrité des données et on les sécurise.
			
			if(!empty($titre) && !empty($realisateur) && !empty($annee))		
			{
					// echo 'données tranmises avc succès! ';
					
					//permet de verifier si la chaine contient uniquement que des charactères alphanumériques.
				
				if (gettype($titre)=='string' )
					{
					
						//suppression des balises si présent
						
						$titre=strip_tags($titre);
						
						// si après suppression des balises la chaine est vide, on demande une nouvelle saisie valide !
						if($titre=="")
						
						{
							echo "<p class='msg-erreur'>veuillez saisir un titre valide !</p>";
							echo '<br>';
						}
					}
							//on utilse le même code utilisé pour le titre.
					
							if (gettype($realisateur)==='string')
							{
								$realisateur=strip_tags($realisateur);
							
									if($realisateur=="")
						
									{
										echo "<p class='msg-erreur'> veuillez saisir un nom de réalisateur valide !<p>";
										
									}
							}
							
							//on verifie que l'année comporte uniquement 4 chiffres  et que la sortie du film n'est pas inférieur à l'invention du cinema, 
							//et supérieur à l'année en cours pour plus de réalisme.
							
							if (strlen($annee)==4 && is_numeric($annee) && ($annee>= 1895 && $annee<= 2021))
							{
							
									$annee=strip_tags($annee);
									
									$_resultat=true;
									
								
							}
								else
								
								{
									$_resultat="false";
									echo "<p class='msg-erreur'>veuillez saisir une année valide !</p>";
									echo '<br>';
									
								}
								
							//si toutes les données sont valides on commence le traitement.
							
							if($titre !="" && $realisateur !="" && $_resultat =='true')
							
							{
								echo "<p class='msg-correct'>Les données sont valides</p>";
								echo '<br>';
								
								if ( !array_key_exists('films',$_SESSION))
									
									{
											$_SESSION['films'] = array();
											echo '<br>';	
									}
									 if(array_key_exists('films',$_SESSION))
										{
											$_film_new=array(
											'titre' => $titre,
											'realisateur' =>$realisateur,
											'annee' =>$annee,
										
											);
										
											array_push($_SESSION['films'],$_film_new);
											
											//si on ajoute un film, on se connecte à la base de données pour faire l'insertion de ce dernier.

											$requete="INSERT INTO `video` (titre,realisateur,annee_sortie,existe) VALUES('$titre','$realisateur','$annee','1');";
											mysqli_query($cnx,$requete);
										}
											
							}
			}
		}
										?>
								
												<input class="add-input" type="text" name="titre" placeholder="Titre" required>
												<input class="add-input"type="text" name="realisateur"  placeholder="Réalisateur" required  >
												<input class="add-input"type="text"  name="annee" placeholder="Année"required >
												<div class="grp-button">
													<button id="add-button" type="submit" >Ajouter</button>
													<button id="add-button" type="reset" >Annuler</button>
												</div>
									
									</form>
								
								<div class="blocs-images">
									<img  src="assets/images(2)/add-media.svg" alt="" title=""/>
								</div>
							</div>
							
							<h2 class="visiteurs-title">  Listes des vidéos que vous avez ajoutés  </h2>
									<div class="visiteurs-container">			
											<table class="tab-visiteurs">
												<thead class="thead" >
													<tr >
														<th>Numéro</th>
														<th>Titre</th>
														<th>Réalisateur</th>
														<th>Année de sortie</th>
													</tr>
												</thead>
												
												<tbody>
												
													<?php
													
														if(array_key_exists('films',$_SESSION))
														{
																foreach($_SESSION['films'] as $keys => $_values)
																{
																			echo '
																				<tr>
																					<td>
																						'.($keys+1).'
																					</td>
																					<td>
																						'.$_values['titre'].'
																					</td>
																					<td>	
																						'.$_values['realisateur'].'
																					</td>
																					<td>
																						'.$_values['annee'].'
																					</td>
																				</tr>
																			';
																			
														
																}
																
														}
	  
									  
													?>
												</tbody>
									 
											</table>
										</div>
					
			</section>
			
			
		</main>
	

<footer>
		<?php
			
							  
				$date = date("d/m/Y");
				$heure = date("H:i");
				echo "<p style='color:#fff; display:flex; justify-content:flex-end; text-align:center; margin-right:1rem;'> 
							$heure <br> $date
					</p>";

		?>
	
	<p class="para1">Par Fatima-Zohra Bakali et Kaori Pierelli</p>
	
	<div class="footer-text">	
		<a class="para2" href="#"> mentions légales | </a>
		<a class="para2" href="#"> politiques de confidentialité</a>
	</div>

</footer>
	
</body>


</html>