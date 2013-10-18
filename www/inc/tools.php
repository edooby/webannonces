<?php

// db --> PDO = PHP Data Objects
//public PDO::__construct() ( string $dsn [, string $username [, string $password [, array $driver_options ]]] )

$db = new PDO('mysql:host=localhost;dbname=webannonces','webannonces','webannonces');

//compteur
	$file_handler = fopen('compteur.txt', 'r+');
	$compteur = fgets($file_handler);
	if(isset($_SESSION['visiteur'])==false)
	{
		$compteur = $compteur  +1; // $compteur ++;
		fseek($file_handler, 0);
		fputs($file_handler, $compteur);
		$_SESSION['visiteur']=true;
		
	}
	fclose($file_handler);
	//fin de compteur
?>