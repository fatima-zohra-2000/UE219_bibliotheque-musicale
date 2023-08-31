<?php
	session_start(); 
	$cnx->connection = require("connexion.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>admin-supp</title>
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
		<h2> Supprimer des vidéos</h2>
		
		<div class="flex-container row">				
			<div class="visiteurs-container">	
				<?php if(!empty($_SESSION['message'])){
				echo '<p class="msg-erreur">'.$_SESSION['message'].'</p>';
				$_SESSION['message']=''; //pour vider le msg d'erreur
				}
				?>
				<?php
				$sql1="SELECT * from video WHERE`existe`=1";
				$requete=mysqli_query($cnx,$sql1);
				$sqlAllVideo=mysqli_fetch_all($requete);
				$counter1=0;
				?>

			<p class="suppression-video">Sélectionner la vidéo à supprimer :</p>
			<form method="post">
				
				<table class="tab-visiteurs">
					<thead class="thead" >
						<tr >
							<th>Titre</th>
							<th>Réalisateur</th>
							<th>Année de sortie</th>
							<th>Supprimer</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($sqlAllVideo as $keys => $values){ ?>
								<tr>
									<?php
									echo '<td>
											'.$values[1].'
											</td>
											<td>
											'.$values[2].'
											</td>
											<td>
											'.$values[3].'
											</td>';
									?>
									<td><a onclick="return(confirm('Etes-vous sûr de vouloir supprimer?'));" 
										href="admin-supp.php?delete=<?php echo $sqlAllVideo[$counter1][0]; $counter1++;?>"> 
										<img src="assets/images/delete.png" alt="delete_icon" class="table_icones"></a>
									</td>
							</tr> 
						<?php } ?>
					</tbody>
				</table> 
					
				<?php 
					if (isset($_GET['delete'])){
						@$id= $_GET['delete'];
						$sql2="UPDATE video SET `existe`= '0' WHERE `id`=$id";
						mysqli_query($cnx, $sql2);
						header("Location: admin-supp.php"); 
						$_SESSION['message']= "Titre bien supprimé !";
						array_push($_SESSION['id_delete'], $id);
						}
				?>	
			</form>
		</div>
 
				
								
		  
		<div class="blocs-images">
			<img  src="assets/images(2)/supp-media.svg" alt="" title=""/>
		</div>
	</div>
			
			
						
			
	<h2 class="trash-title"> <img class="img-trash" src="assets/images(2)/delete.png"  alt="profil" title="Profil Administrateur"/> Récement supprimé :  </h2>
	<div class="visiteurs-container">			
		<table class="tab-visiteurs">
			<thead class="thead" >
				<tr >
					<th>Titre</th>
					<th>Réalisateur</th>
					<th>Année de sortie</th>
				</tr>
			</thead>
			
			<tbody>
			
				<?php
					if(isset($_SESSION['id_delete'])){
						$counter2=0;
						
						foreach($_SESSION['id_delete'] as $value_id){
							$sql3="SELECT * from video WHERE`id`='".$_SESSION['id_delete'][$counter2]."'";
							$requete=mysqli_query($cnx,$sql3);
							$counter2++;
							
							// $sqlDeletedVideo=mysqli_fetch_assoc($requete);
							// print_r($sqlDeletedVideo);
							while ($sqlDeletedVideo=mysqli_fetch_assoc($requete)){?>
								<tr>
									<td><?php echo $sqlDeletedVideo['titre'];?></td>
									<td><?php echo $sqlDeletedVideo['realisateur'];?></td>
									<td><?php echo $sqlDeletedVideo['annee_sortie'];?></td>
								</tr>
					<?php }
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
				echo "<p style='color:#fff; display:flex; justify-content:flex-end; text-align:center; margin-right:1rem; padding-top: 2rem'> 
							$heure <br> $date
					</p>";

		?>
	<div>
	<p class="para1">Par Fatima-Zohra Bakali et Kaori Pierelli</p>
	
	<div class="footer-text">	
		<a class="para2" href="#"> mentions légales | </a>
		<a class="para2" href="#"> politiques de confidentialité</a>
	</div>
	</div>
</footer>
	
</body>


</html>