<?php
	session_start(); 
	$cnx->connection = require("connexion.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>visiteurs</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css"/>
</head>
<body>
	<header>
		
		<div class="bloc-header">
			<img class="img-profil" src="assets/images(2)/profil.png"  alt="profil" title="Profil Visiteur"/>
		
		
			<form method="post" action="deconnexion.php">
					 <button id="deconnexion" type="submit">Déconnexion</button>
			</form>
		</div>
		
	</header>


<main>	

	<section class="main-container">

	<?php
		echo "<h1>Bienvenue ".$_SESSION['username']."</h1>";
	 
	?>
		
		<h2 class="visiteurs-title">Rechercher des vidéos</h2>
			<div class="recherche">	

					
					
					<form class="search-form" method="post">
					
						<input class="search" id="recherche-video" name="recherche" type="text" placeholder=" Entrez un titre, un réalisateur ou une année"/>
						
						 <button class="search-button" type="submit">
						 <img class="search-img" src="assets/images(2)/rechercher.png" alt="" title=""/></button>
					
						
				
						<div class="php-visiteur">
					
						<?php
							
							$i=0;
						
						
								//vérification de la donnée envoyée par le formulaire
							if(array_key_exists('recherche',$_POST) && !empty($_POST['recherche']) && gettype($_POST['recherche']== 'string'))
							{
								$recherche=$_POST['recherche'];
								
								//sécurisation de la donnée
								$recherche=strip_tags($recherche);
								
								$requete=$cnx->query('SELECT * from video WHERE`existe`=1');

								// $sql1="SELECT * from video WHERE`existe`=1";
								// $requete=mysqli_query($cnx,$sql1);
								// $sqlAllVideo=mysqli_fetch_all($requete);
								// print_r($sqlAllVideo);
								
								//s'il n'existe pas création d'un tableau  pour récuperer les videos de la recherche.
								if ( !array_key_exists('search',$_SESSION))
																		
								{
										$_SESSION['search'] = array();
										echo '<br>';	
								}
									 //on verifie si la recherche correspond à une donnée dans la base.
									while($data=$requete->fetch_assoc())
									{
										
										
												 //on compare si chaînes de charactères sont egales. la casse n'est pas respectée.
												
												if (strcasecmp($recherche,$data['titre'])==0 OR strcasecmp($recherche,$data['realisateur'])==0 OR strcasecmp($recherche,$data['annee_sortie'])==0 )
												{
													$i++;
													
													if(array_key_exists('search',$_SESSION))
													{
														$video_recherche=array(
																		'titre' => $data['titre'],
																		'realisateur' =>$data['realisateur'],
																		'annee' =>$data['annee_sortie'],
																		);
													
														array_push($_SESSION['search'],$video_recherche);
													}
												
												}
															
										
													
									
								    }
										
								// $requete->closeCursor();
							
							
													if ($i==0)
													{
														echo 'Aucune donnée ne correspond à votre recherche.';
													}
													else 
													{
														
														echo 'Resultat de la recherche : ' .$i. ' vidéo(s) trouvée(s) :';
														
								
													}										
										
							}
							
					
						//on affiche les données du tableau si elles existent.
				if ( array_key_exists('search',$_SESSION))		
				{
					
					foreach($_SESSION as $keys =>$values)
					{
						if ($keys=='search')
						{
							foreach($values as $keys2 =>$values2)
							
							{
								echo '<br>';
								foreach($values2 as $keys3 =>$values3)
								
								{
									echo $values3.' ';
									
								}
							}
							
						}
					
			
			}
					}	
			//on remet à 0 la base.
		$_SESSION['search'] = array();

				?>
					</form>
					
					</div>
			</div>
		
	
	</section>
<main>
	
</body>
</html>