<?php

	define('PAGINATION_COUNT', 10);
	define('PAGINATION_COUNT_FRONT', 10);


	if (!function_exists('uploadImage')) {
		function uploadImage($photo, $folder)
		{
			$destinationPath = 'admin/assets/images/' . $folder . '/'; 
			$fileName = time() . '_' . $photo->hashName(); 
			$photo->move(public_path($destinationPath), $fileName);
			return $destinationPath . $fileName; 
			// return url($destinationPath . $fileName);
		}
	}

	if (!function_exists('uploadFile')) {
		function uploadFile($file, $folder)
		{
			$destinationPath = 'admin/assets/documents/' . $folder . '/';
			$fileName = time() . '_' . $file->hashName(); 
			$file->move(public_path($destinationPath), $fileName); 
			return $destinationPath . $fileName; 

			// return url($destinationPath . $fileName);
		}
	}
	

	function uploadIamges($photos, $folder){
		$images = [];
		$destinationPath = 'admin/assets/images/' . $folder . '/'; // upload path
		foreach ($photos as $photo){
			// $extension = $photo->getClientOriginalExtension(); // getting image extension
			$fileName = time() . $photo->hashName();
			$photo_move = $photo->move(public_path($destinationPath), $fileName);
			$images[] = $destinationPath . $fileName;
		}
		$files = implode(",", $images);
		return $files;
	}
	if (!function_exists('uploadFiles')) {
		function uploadFiles($files, $folder)
		{
			$filePaths = [];
			$destinationPath = 'admin/assets/files/' . $folder . '/'; 

			foreach ($files as $file) {
				$fileName = time() . '_' . $file->hashName(); 
				$file->move(public_path($destinationPath), $fileName);  
				$filePaths[] = $destinationPath . $fileName; 
			}

			return implode(",", $filePaths);  
		}
	}

	function responseJson($status, $msg, $data = null)
	{
		$response = [
			'status' => $status,
			'msg' => $msg,
			'data' => $data
		];
		return response()->json($response);
	}
