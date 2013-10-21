<?php

// db --> PDO = PHP Data Objects
//public PDO::__construct() ( string $dsn [, string $username [, string $password [, array $driver_options ]]] )

$db = new PDO('mysql:host=localhost;dbname=webannonces','webannonces','webannonces');

//DB connection + requests
function connect_webannonces_db()
	{
		$connect = new PDO('mysql:host=localhost;dbname=webannonces','webannonces','webannonces');
		return $connect;
	}

function is_username_already_exists($db, $username)
	{
		$query_prepare = 'SELECT * FROM `users` WHERE username= :username';
		$query= $db->prepare($query_prepare);
		$query->bindParam(':username', $username, PDO::PARAM_STR);
		$query->execute();
		$count = $query->rowCount();
		if ($count == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

function is_email_already_exists($db, $email)
	{
		$query_prepare = 'SELECT * FROM `users` WHERE email= :email';
		$query= $db->prepare($query_prepare);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->execute();
		$count = $query->rowCount();
		if ($count == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	
//form
function error_by_field($errors, $field)
	{
		$result = array();
		foreach($errors as $error)
		{
			if ($error['field']=== $field)
			{
				$result[]=$error['message'];
			}
		}
		return $result;
	}
	
function save_origin_value_from_form($form, $field)
	{
		$result = '';
		if(isset($form[$field]))
		{
			$result = stripslashes($form[$field]);
		}
		return $result;
	}

function add_newuser($db, $username, $pwd, $email)
	{
		$query_prepare = 'INSERT INTO users (username, password, email, date_inscription)
			VALUES (:username, :password, :email, :date_inscription)';
		$requete= $db->prepare($query_prepare);
		$date_inscription = new DateTime();
		$requete->execute(array(
							'username' => $username,
							'password' => $pwd,
							'email' => $email,
							'date_inscription' => $date_inscription->format('Y-m-d H:i:s')
							  ));
	}

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