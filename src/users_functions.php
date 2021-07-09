<?php
function checkRegistrationData($login, $email, $pass, $repeatedPass, &$model)
{
	$ok = true;
	
	if (!isset($email) || empty(trim($email)) || !isset($login) || empty(trim($login)) || !isset($pass) || empty(trim($pass)) || !isset($repeatedPass) || empty(trim($repeatedPass)))
	{
		$ok = false;
		array_push($model['errors'], 'Żadne z pól nie może być puste');
	}
	
	if (strlen($login) < 5)
	{
		$ok = false;
		array_push($model['errors'], 'Login musi zawierać co najmniej 5 znaków');
	}
	
	if (ctype_alnum($login) == false)
	{
		$ok = false;
		array_push($model['errors'], 'Login może składać się tylko z liter i cyfr');
	}
	
	if (strlen($pass) < 8)
	{
		$ok = false;
		array_push ($model['errors'], 'Hasło musi zawierać co najmniej 8 znaków');
	}
	
	if ($pass != $repeatedPass)
	{
		$ok = false;
		array_push ($model['errors'], 'Podane hasła muszą być identyczne');
	}
	
	$loginQuery = [
		'login' => $login
	];
	
	$emailQuery = [
		'email' => $email
	];
	
	$resultLogin = findUser($loginQuery);
	$resultEmail = findUser($emailQuery);
	
	if ($resultLogin === false || $resultEmail === false)
	{
		$ok = false;
		array_push ($model['errors'], 'Coś poszło nie tak :( Spróbuj ponownie za chwilę lub skontaktuj się z administratorem');
	}
	else
	{
		if ($resultLogin != null)
		{
			$ok = false;
			array_push ($model['errors'], 'Podany login jest już zajęty');
		}
		
		if ($resultEmail != null)
		{
			$ok = false;
			array_push ($model['errors'], 'Użytkownik o podanym adresie e-mail już istnieje');
		}
	}
	
	return $ok;
}

function checkLoginData($login, $pass, &$model)
{
	$query = [
		'login' => $login
	];
		
	$user = findUser($query);
	
	if ($user === false)
		array_push($model['errors'], 'Coś poszło nie tak :( Spróbuj ponownie za chwilę lub skontaktuj się z administratorem');
	
	else if ($user == null)
		array_push($model['errors'], 'Użytkownik o podanym loginie nie istnieje');
		
	else if ($user != null && password_verify($pass, $user['password']))
	{
		session_regenerate_id();
		$_SESSION['logged'] = $user['_id'];
		$_SESSION['success'] = 'Zalogowano pomyślnie';
	}
	else
		array_push($model['errors'], 'Podane hasło jest nieprawidłowe');
	
	if (count($model['errors']) == 0)
		return true;
	
	return false;
	
}