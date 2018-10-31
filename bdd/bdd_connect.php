<?php

    setlocale(LC_ALL, 'fr_FR');

	$host = 'localhost';

	$bdd = 'commerce';

	$user = 'root';

	$pwd = '';

	try 

	{

		$pdo = new PDO('mysql:host='.$host.';dbname='.$bdd,$user,$pwd);

		$pdo->exec("set character set utf8");

	}

	catch (PDOException $e)

	{

		echo 'Connexion échouée :'.$e-> getMessage();

		exit();

    }
