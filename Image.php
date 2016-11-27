<?php
	class Image {
		function editData($url,$ht,$id=1) {
			$pdo = new PDO("mysql:dbname=test_imgup;host=127.0.0.1","root","");
			$query = "UPDATE image SET ".$ht."='".$url."' WHERE id_data=".$id;
			return $pdo->query($query);
		}
		function getImage() {
			$pdo = new PDO("mysql:dbname=test_imgup;host=127.0.0.1","root","");
			$query = "SELECT * FROM image WHERE id_data=1";
			return $pdo->query($query);
		}
		function uploadImage($files,$ht) {
			$check = 1;
			if (!empty($files[$ht]["tmp_name"])) {
				$dir = "uploads/";
				$img = $dir.$ht.round(microtime(true)*1000)."-".basename($_FILES[$ht]['name']);
				$imgtype = pathinfo($img,PATHINFO_EXTENSION);
				if(!getimagesize($_FILES[$ht]["tmp_name"])) $check = 0;
				if(file_exists($img)) $check = 0;
				if ($_FILES[$ht]["size"] > 50000000) $check = 0;
				if($imgtype != "jpg" && $imgtype != "png" && $imgtype != "jpeg" && $imgtype != "gif" ) $check = 0;
				if ($check==1) {
					if (move_uploaded_file($_FILES[$ht]["tmp_name"], $img)) {
						$this->editData($img,$ht);
						return true;
					} else {
						return false;
					}
				} else {
					return false;
				}
			}
		}
	}
?>