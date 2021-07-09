<?php
function imagecreatefromfile ($path, $mimeType)
{
	if ($mimeType == 'image/jpeg' || $mimeType == 'image/jpg')
		return imagecreatefromjpeg("$path");
	else
		return imagecreatefrompng("$path");
}

function saveImage ($image, $path, $mimeType)
{
	if ($mimeType == 'image/jpeg' || $mimeType == 'image/jpg')
		return imagejpeg($image, $path);
	else
		return imagepng($image, $path);
}

function createThumbnail ($name, $path, $mimeType)
{
	$thumbnailPath = 'thumbnails/' . $name;
	$thumbnailWidth = 200;
	$thumbnailHeight = 125;
	list($bigWidth, $bigHeight) = getimagesize($path);

	$thumbnail = imagecreatetruecolor($thumbnailWidth, $thumbnailHeight);
	$bigImage = imagecreatefromfile($path, $mimeType);

	imagecopyresampled($thumbnail, $bigImage, 0, 0, 0, 0, $thumbnailWidth, $thumbnailHeight, $bigWidth, $bigHeight);

	$result = saveImage ($thumbnail, $thumbnailPath, $mimeType);
	
	imagedestroy($bigImage);
	imagedestroy($thumbnail);
	
	return $result;
	
}

function addWatermark ($name, $path, $mimeType, $text)
{
	$newPath = 'watermarks/' . $name;
	$font = 'static/fonts/LucyTheCatRegular.ttf';

	$newImage = imagecreatefromfile($path, $mimeType);
	
	$fontColor = imagecolorallocate($newImage, 245, 233, 7);
	
	$box = imagettfbbox(70, 0, $font, $text);
	$width = abs($box[4] - $box[0]);
	$height = abs($box[5] - $box[1]);
	
	imagettftext($newImage, 50, 0, imagesx($newImage)-$width, imagesy($newImage) - 40, $fontColor, $font, $text);
	
	$result = saveImage ($newImage, $newPath, $mimeType);

	imagedestroy($newImage);
	
	return $result;
}

function uploadValidation ($image, $watermark, $title, $author, $status, &$model)
{
	if ($image['error'] == 4) // 4 - no file was uploaded (from PHP documentation)
		array_push($model['errors'], 'Nie wybrano żadnego pliku do przesłania');
	else if ($image['error'] != 0) // 0 - no error
		array_push($model['errors'], 'Wystąpił błąd podczas obłsugi przesłanego pliku');
	else
	{
		if (empty(trim($title)))
			$title = "Bez tytułu";
		if (empty(trim($author)))
			$author = "Anonim";
		
		$max_rozmiar = 1024*1024;
		$path = 'images/';
		$name = time() . basename($image['name']);
		$targetPath = $path . $name;
		$tempPath = $image['tmp_name'];
		
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mimeType = finfo_file($finfo, $tempPath);
		
		if (empty(trim($watermark)))
			array_push($model['errors'], 'Pole "Znak wodny" nie może być puste');
		
		if (strlen($watermark) > 18)
			array_push($model['errors'], 'Znak wodny może składać się maksymalnie z 18 znaków');
		
		if ($mimeType !== 'image/jpeg' && $mimeType !== 'image/png') 
			array_push ($model['errors'], 'Niepoprawny format pliku!');
		
		if ($image['size'] > $max_rozmiar)
			array_push($model['errors'], 'Plik, który próbujesz przesłać, jest za duży!');
		
		if (count($model['errors']) == 0)
		{
			if (move_uploaded_file($tempPath, $targetPath))
			{
				if (addWatermark ($name, $targetPath, $mimeType, $watermark) === false || createThumbnail ($name, $targetPath, $mimeType) === false)
					array_push($model['errors'], 'Wystąpił nieoczekiwany błąd.');
					
				if (saveImageInDatabase ($name, $title, $author, $status) === false)
					array_push($model['errors'], 'Coś poszło nie tak :( Spróbuj ponownie za chwilę lub skontaktuj się z administratorem');
			}
			else
				array_push($model['errors'], 'Dodawanie zdjęcia nie powiodło się.');
			
			if (count($model['errors']) == 0)
			{
				$_SESSION['success'] = 'Dodawanie zdjęcia przebiegło pomyślnie!';
				return true;
			}
		}
	}
	
	return false;
}

function pagination(&$model)
{
	$allPages = ceil(count(getAllImages()) / 3);
	
	if (isset($_GET['page']))
	{
		if ($_GET['page'] <= $allPages)
			$model['page'] = $_GET['page'];
		else
			$model['page'] = 1;
	}
	else
		$model['page'] = 1;
	
	$model['limit'] = 3;
	$skip  = ($model['page'] - 1) * $model['limit'];
	$model['next']  = ($model['page'] + 1);
	$model['prev']  = ($model['page'] - 1);
	
	$options = [
		'skip' => $skip,
		'limit' => $model['limit']
	];
	
	return $options;
}

function rememberImages($rememberedImages)
{
	$change = false;
	
	if (!isset($_SESSION['remember']) || empty($_SESSION['remember']))
	{
		$_SESSION['remember'] = $rememberedImages;
		$change = true;
	}
	
	else
	{
		$before = $_SESSION['remember'];
		
		for ($i = 0; $i < count($rememberedImages); $i++)
		{
			if (!in_array($rememberedImages[$i], $_SESSION['remember']))
				array_push($_SESSION['remember'], $rememberedImages[$i]);
		}
		
		if ($before !== $_SESSION['remember'])
			$change = true;
	}
	
	if ($change == true)
		$_SESSION['success'] = 'Twój wybór został zapisany pomyślnie'; 
	
	return $change;
}

function deleteRemembered($imagesToDelete)
{
	$rememberedImages = $_SESSION['remember']; 
	$newImagesArray = [];
	
	for ($i = 0; $i < count($rememberedImages); $i++)
	{
		if (!in_array($rememberedImages[$i], $imagesToDelete))
			array_push($newImagesArray, $rememberedImages[$i]);
	}
	 
	$_SESSION['remember'] = $newImagesArray;
	$_SESSION['success'] = 'Usuwanie przebiegło pomyślnie';
}