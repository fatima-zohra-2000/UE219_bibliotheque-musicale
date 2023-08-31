<?php
	session_start(); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>admin-index</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css"/>
</head>
<body>

	
			
			<header>
				
				<div class="bloc-header">
					<img class="img-profil" src="assets/images(2)/profil.png"  alt="profil" title="Profil Administrateur"/>
				
					<form method="post" action="deconnexion.php">
					 <button id="deconnexion" type="submit">Déconnexion</button>
					</form>
				</div>
				
			</header>


		<main>	
		
		<?php
			
			echo "<h1>Bienvenue ".$_SESSION['username']."</h1>";
	 
	?>
			<section class="main-container">
				<p class="choix-index-text"> Que souhaitez-vous faire ?</p>
				
				
				<div class="links-container" >
				
					<form action="admin-add.php">
						
						 <button class="shape-buttons add-link links-text" type="submit"><img class="img-index" src="assets/images(2)/ajouter.png"  alt="profil" title=""/><br>Ajouter des vidéos</button>
					</form>
					<form action="admin-bdd.php">
						
						<button class="shape-buttons bdd-link links-text" type="submit"><img class="img-index" src="assets/images(2)/bdd.png"  alt="profil" title=""/><br>Voir la Base de données</button>
					</form>
					<form action="admin-supp.php">
						
						<button class="shape-buttons supp-link links-text" type="submit"><img class="img-index" src="assets/images(2)/supprimer.png"  alt="profil" title=""/><br>Supprimer des vidéos</button>
					</form>
				  
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