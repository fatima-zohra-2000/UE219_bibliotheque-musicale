<?php
	session_start(); 
	//on se connecte à la base.
	$cnx->connection = require("connexion.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>admin-bdd</title>
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
				<h2>Vidéos contenues dans votre base de données :</h2>

					<div class="flex-reverse-container">
						
						
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
									
							//si la base est vide on affiche un message d'erreur et on arrête l'execution du programme.
							$requete=$cnx->query('SELECT * FROM `video` WHERE `existe`=1');
							
							if ($requete=='')
							
							{
								echo 'La base de données ne contient aucun films !';
							
								exit();
							}
							
								else
								{
								
										while($data= mysqli_fetch_assoc($requete))
										
										
										{
											
									echo '
											<tr>
												<td>
													'.$data['id'].'
												</td>
												<td>
													'.$data['titre'].'
												</td>
												<td>	
													'.$data['realisateur'].'
												</td>
												<td>
													'.$data['annee_sortie'].'
												</td>
											</tr>
										';
								
										}
								}
							
									
									
								
									?>
								</tbody>
					 
							</table>
						</div>	

							
							<div class="blocs-images">
								<img  src="assets/images(2)/save-media.svg" alt="" title=""/>
							</div>
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