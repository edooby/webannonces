<?php
//compteur
	$file_handler = fopen('../compteur.txt', 'r+');
	$compteur = fgets($file_handler);
	$compteur = $compteur  +1; // $compteur ++;
	fseek($file_handler, 0);
	fputs($file_handler, $compteur);
	fclose($file_handler);
	//fin de compteur
?>