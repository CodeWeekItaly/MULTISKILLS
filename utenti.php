<html>
<head>
	<title>NEW IIS Mattei-Fortunato</title>
	<link rel="stylesheet" href="stileNews.css" type="text/css">
</head>

<body>	
	<div id="header">
		<img alt="Logo gestione News"	longdesc="Gestione NEWS IIS 'Mattei-Fortunato' Eboli (SA)"	src="immagini/header.png">		
	</div>
	
	<div class="rigavuota"></div>
	
	<div class="contenuto">	
		<?php 
		//CONNESSIONE
		$link = new mysqli("localhost", "root", "", "news");
		if (mysqli_connect_error())
			die('Errore di connessione n. '.mysqli_connect_errno().' - '.mysqli_connect_error());
		else
			{
			faimenu();
			//Visualizza elendo degli utenti
			intesta_tab();
			$query = 'SELECT * FROM utenti';
			$risultato = mysqli_query($link,$query);
			while ($dati = mysqli_fetch_array($risultato))
				{
				echo "<tr style='background-color:white'>";
					echo "<td>".$dati['cognome']." ".$dati['nome']."</td>";
					echo "<td>".$dati['email']."</td>";
					echo "<td style='text-align:center;'>";
					if ($dati['autore'])
						echo "SI</td>";
					else
						echo "NO</td>";
					echo "<td style='text-align:center;'>";
					if ($dati['redattore'])
						echo "SI</td>";
					else
						echo "NO</td>";
					
				echo "</tr>";
				}
			}
		?>
		</div>

	</div>
	
	<?php
	function faimenu()
		{
		echo '<div class="box4 sfondo_grigio"><p>HOME</p></div>';
		echo '<div class="box4 sfondo_blu"><p><a href="utenti.php">Archivio UTENTI</p></div>';
		echo '<div class="box4 sfondo_verde"><p><a href="categorie.php">Archivio CATEGORIE</p></div>';
		echo '<div class="box4 sfondo_celeste"><p><a href="articoli.php">Archivio ARTICOLI</p></div>';
		echo '<div class="box4 sfondo_grigio"><p><a href="report.php">REPORT</p></div>';
		}
		
	function intesta_tab()
		{
		//Intestazione tabella
		echo "<table style='border-top-right-radius: 10px;
							border-top-left-radius: 10px; 
							background-color:#6699cc;
							width: 1000px;
							border:0;
							padding:5;
							margin-left:auto;
							margin-right:auto;
							font-family:Cambria;
							font-size:16pt;'>";
		echo "<thead><caption><h1>Elenco utenti</h1></caption></thead>";
		echo "<tbody>";
		echo "<tr style='color:white'>";
		echo "<th scope='col' style='width:200px'>NOME E COGNOME</th>";
		echo "<th scope='col' style='width:150px'>EMAIL</th>";
		echo "<th scope='col' style='width:75px'>AUTORE</th>";
		echo "<th scope='col' style='width:75px'>EDITORE</th>";
		echo "</tr>";
		}
	?>	


</body>

</html>