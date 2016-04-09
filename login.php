<?php

	//echo $_REQUEST["usuario"];
	//echo $_REQUEST["contrasena"];

	// echo $_POST["usuario"];
	// echo $_POST["contrasena"];

	// if ($_POST['usuario']==''){
	// 	echo 'esta vacio';
	// }


	if($_POST['usuario'] !='' && $_POST['contrasena'] !=''){
		session_start();
		require_once 'conexion.php';
		$usuario = $_POST['usuario'];
		//$password = $_POST['contrasena'];
		$password = crypt($_POST['contrasena'], 'benji');
		//echo $passwordC;

		$query = 'SELECT password FROM usuario WHERE matricula = ? ;';
		$prep_query= $db->prepare($query);
		$prep_query->bind_param('s', $usuario);
		$prep_query->execute();
		$prep_query->bind_result($passwordInput);
		$prep_query->fetch();

		printf('%s es la contraseña ingresada\n', $passwordInput);
		$prep_query->close();
		$db->close();

		printf('\n\n\n\n%s es la contraseña en la bd.\n', $password);
		printf('%s es la contraseña ingresada.\n', $passwordInput);


		if($password != $passwordInput){
			// $_SESSION["loginErr"] = "Usuario o Contraseña incorrectos";
			header("location: sesion.php?msg=failed");
		}
		else {
			header("location: donaciones.html");
		}
	}
	// else if($_POST['usuario']==''&& $_POST['contrasena']!='') {
	// 	echo 'falta usuario';
	// }
	// else if($_POST['usuario']!='' && $_POST['contrasena']==''){
	// 	echo 'falta password';
	// }
	// else 
	// 	echo 'No hay nada';
		


	// if(isset($_POST["usuario"], $_POST["contrasena"])){
	// 	session_start();
	// 	require_once 'conexion.php';
	// 	$usuario = $_POST['usuario'];
	// 	$password = $_POST['contrasena'];

	// 	$query = 'SELECT password FROM usuario WHERE matricula = ? ;';
	// 	$prep_query= $db->prepare($query);
	// 	$prep_query->bind_param('s', $usuario);
	// 	$prep_query->execute();
	// 	$prep_query->bind_result($password);
	// 	$prep_query->fetch();

	// 	printf('%s es la contraseña\n', $password);
	// 	$prep_query->close();

	// 	$db->close();
	// }
	// else if(!isset($_POST["usuario"]) && isset($_POST['contrasena'])) {
	// 	echo 'falta usuario';
	// }
	// else if(isset($_POST["usuario"]) && !isset($_POST['contrasena'])){
	// 	echo 'falta password';
	// }
	// else 
	// 	echo 'No hay nada';


?>