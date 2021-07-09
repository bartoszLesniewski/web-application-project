<?php
require_once 'business.php';
require_once 'images_functions.php';
require_once 'users_functions.php';

function dodajZdjecie(&$model)
{	
	$model['errors'] = array();
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['add']))
	{	
		$image = $_FILES['image'];
		$watermark = $_POST['watermark'];
		$title = $_POST['title'];
		$author = $_POST['author'];
		$status = "publiczne";
		
		if (isset($_POST['status']) && $_POST['status'] == 'prywatne')
			$status = $_SESSION['logged'];
		
		if (uploadValidation($image, $watermark, $title, $author, $status, $model) === true)
			return 'redirect:sukces';
	}
	
	if (isset($_SESSION['logged']))
	{
		$model['logged'] = true;
		$model['login'] = getLoginById($_SESSION['logged']);
	}
	else
	{
		$model['logged'] = false;
		$model['login'] = '';
	}
	
	return 'dodaj-zdjecie_view';
}

function galeria(&$model)
{
	$options = pagination($model);
	$images = getAllImages($options);
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['rememberSubmit']) && isset($_POST['remember']))
	{
		$rememberedImages = $_POST['remember'];
		if (rememberImages($rememberedImages) === true)
			return 'redirect:sukces';
	}
	
	if ($images === false)
	{
		$model['blad'] = true;
		http_response_code(500);
	}
	else
	{
		foreach ($images as $image)
		{
			if (isset($_SESSION['remember']) && in_array($image['_id'], $_SESSION['remember']))
				$image['check'] = 'checked';
			else
				$image['check'] = '';
		}
		
		$model['images'] = $images;
		$model['total'] = count(getAllImages());
	}
	
	return 'galeria_view';
}

function index(&$model)
{
	return 'index_view';
}

function logowanie(&$model)
{
	if (isset($_SESSION['logged']))
		return 'redirect:/';
	
	$model['errors'] = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['loginSubmit']))
	{
		$login = $_POST['login'];
		$pass = $_POST['pass'];
		
		if (checkLoginData($login, $pass, $model) === true)
			return 'redirect:sukces';
	}
	
	return 'logowanie_view';
}

function rejestracja(&$model)
{
	if (isset($_SESSION['logged']))
		return 'redirect:/';
	
	$model['errors'] = array();
	$model['tmpEmail'] = '';
	$model['tmpLogin'] = '';

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['registerSubmit']))
	{
		$email = $_POST['email'];
		$login = $_POST['login'];
		$pass = $_POST['pass'];
		$repeatedPass = $_POST['repeatedPass'];	
		
		$model['tmpEmail'] = $email;
		$model['tmpLogin'] = $login;	
		
		$result = checkRegistrationData($login, $email, $pass, $repeatedPass, $model);
		
		if ($result)
		{
			$hashPassword = password_hash($pass, PASSWORD_DEFAULT);
			
			if (addUser($email, $login, $hashPassword) === false)
				array_push ($model['errors'], 'Coś poszło nie tak :( Spróbuj ponownie za chwilę lub skontaktuj się z administratorem');
			else
			{
				$_SESSION['success'] = 'Rejestracja przebiegła pomyślnie. Możesz zalogować się na swoje konto.';
				return 'redirect:sukces';
			}
		}
	}
	
	return 'rejestracja_view';
}

function sukces(&$model)
{
	if (isset($_SESSION['success']))
	{
		$model['success'] = $_SESSION['success'];
		unset ($_SESSION['success']);
		return 'sukces_view';
	}
	
	return 'redirect:/';
}

function error(&$model)
{	
	http_response_code(404);	
	return 'error_view';
}

function szukaj(&$model)
{
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		$reg = $_POST['reg'];

		if (isset($_SESSION['logged']))
		{
			$query = [
				'title' => ['$regex' => $reg, '$options' => 'i'],
				'$or' => [
					['status' => 'publiczne'],
					['status' => $_SESSION['logged']]
				]
			];
		}
		else
			$query = [
			'title' => ['$regex' => $reg, '$options' => 'i'],
			'status' => 'publiczne'
		];
		
		if (getImagesByReg($query) === false)
			$model['blad'] = "Coś poszło nie tak :( Spróbuj ponownie za chwilę lub skontaktuj się z administratorem";
		else
			$model['images'] = getImagesByReg($query);
		
		return 'partial/ajax_view';
	}
	
	return 'redirect:/';
}

function wylogowanie(&$model)
{
	session_destroy();
	$params = session_get_cookie_params();
	setcookie(session_name(),'', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
	return 'redirect:/';
}

function wyszukiwarka(&$model)
{
	return 'wyszukiwarka_view';
}

function zapamietane(&$model)
{
	
	if ($_SERVER['REQUEST_METHOD'] == "POST" && isset ($_POST['deleteSubmit']) && isset($_POST['delete']))
	{
		$imagesToDelete = $_POST['delete'];
		deleteRemembered($imagesToDelete);
		
		return 'redirect:sukces';
	}
	
	$options = pagination($model);
	if (getRememberedImages($options) === false)
		$model['blad'] = 'Coś poszło nie tak :( Spróbuj ponownie za chwilę lub skontaktuj się z administratorem';
	else
	{
		$model['images'] = getRememberedImages($options);
		$model['total'] = count(getRememberedImages());
	}
	
	return 'zapamietane_view';
}
