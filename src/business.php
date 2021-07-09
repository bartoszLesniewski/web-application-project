<?php
	require '../../vendor/autoload.php';

	use MongoDB\BSON\ObjectID;

	function get_db()
	{
		$mongo = new MongoDB\Client(
			"mongodb://localhost:27017/wai",
			[
				'username' => 'wai_web',
				'password' => 'w@i_w3b',
			]);

		$db = $mongo->wai;
		
		return $db;
	}

	function saveImageInDatabase ($name, $title, $author, $status)
	{
		$db = get_db();
		
		$image = [
			'image_name' => $name,
			'title' => $title,
			'author' => $author,
			'status' => $status
		];
		
		try
		{
			$db->images->insertOne($image);
			return true;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	function getAllImages($options=[])
	{
		$db = get_db();
		
		if (isset($_SESSION['logged']))
		{
			$query = [
				'$or' => [
					['status' => "publiczne"],
					['status' => $_SESSION['logged']]
				]
			];
		}
		else
			$query = ['status' => "publiczne"];
		
		try
		{
			$images = $db->images->find($query, $options)->toArray();
			return $images;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	function getRememberedImages($options=[])
	{
		$db = get_db();
		$images = [];
		$query = [];
		
		if (isset($_SESSION['remember']))
		{
			$array = $_SESSION['remember'];
			
			for ($i = 0; $i < count($array); $i++)
				$array[$i] = new ObjectID ($array[$i]);
			
			$query = [
				'_id' => array('$in' => $array)
			];
			
			try
			{
				$images = $db->images->find($query, $options)->toArray();
			}
			catch (Exception $e)
			{
				return false;
			}
			
		}
		
		return $images;
	}
	
	function getImagesByReg($query)
	{
		$db = get_db();
		
		try
		{
			$images = $db->images->find($query)->toArray();
			return $images;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	function findUser($query)
	{
		$db = get_db();
		
		try
		{
			$user = $db->users->findOne($query);
			return $user;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	function getLoginById($id)
	{
		$db = get_db();
		$query = [
			'_id' => $id
		];
		
		try
		{
			$user = $db->users->findOne($query);
			return $user['login'];
		}
		catch (Exception $e)
		{
			return null;
		}
	}
	
	function addUser ($email, $login, $hashPassword)
	{
		$db = get_db();
		
		$user = [
			'email' => $email,
			'login' => $login,
			'password' => $hashPassword
		];
		
		try
		{
			$db->users->insertOne($user);
			return true;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
