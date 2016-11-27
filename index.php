<?php
	include_once 'Image.php';
	$image = new Image();

	if (isset($_POST['id'])) {
		if (!empty($_FILES["gh"]["tmp_name"]) && !empty($_FILES["gt"]["tmp_name"])) {
			if($image->uploadImage($_FILES,'gh') && $image->uploadImage($_FILES,'gt')){
				echo "true";
			} else {
				exit("false");
			}
		} else {
			exit("false");
		}
	}
	$datas = $image->getImage();
	$data = $datas->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
<body>
	<h2>Contoh edit Gambar</h2>
	<form action="" method="post" enctype="multipart/form-data">
		<p>
			ID : <input type="text" name="id" value="1">
		</p>
		<div id="thumbh">
			<img src="<?=$data->gh;?>" id="gh" height="200">
		</div>
		<p>
			Pilih File Gambar : <input type="file" name="gh" onchange="readHewan(this)" accept="image/*">
		</p>
		<div id="thumbt">
			<img src="<?=$data->gt;?>" id="gt" height="200">
		</div>
		<p>
			Pilih File Gambar : <input type="file" name="gt" onchange="readTumbuhan(this)" accept="image/*">
		</p>
		<p>
			<input type="submit" name="button" id="button" value="Upload">
		</p>
	</form>
	<script type="text/javascript">
		function readHewan(input) {
			var files = input.files;
			for (var i = 0; i < files.length; i++) {
				var file = files[i];
				if (!file.type.match(/image.*/)) continue;
				var img = document.getElementById("gh");
				document.getElementById("thumbh").classList.remove("hide");
				img.file = file;
				var reader = new FileReader();
				reader.onload = (function(aImg){return function(e){aImg.src = e.target.result;}})(img);
				reader.readAsDataURL(file);
			};
		}
		function readTumbuhan(input) {
			var files = input.files;
			for (var i = 0; i < files.length; i++) {
				var file = files[i];
				if (!file.type.match(/image.*/)) continue;
				var img = document.getElementById("gt");
				document.getElementById("thumbt").classList.remove("hide");
				img.file = file;
				var reader = new FileReader();
				reader.onload = (function(aImg){return function(e){aImg.src = e.target.result;}})(img);
				reader.readAsDataURL(file);
			};
		}

	</script>
</body>
</html>