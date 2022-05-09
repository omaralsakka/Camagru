<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>blob file</title>
	</head>
	<body>
		<?php
		ini_set('display_errors', '1');
		ini_set('display_startup_errors', '1');
		error_reporting(E_ALL);
		$dbh = new PDO("mysql:host=localhost;dbname=mydata", "root", "123456");

		if(isset($_POST['btn'])){
			$name = $_FILES['myfile']['name'];
			$type = $_FILES['myfile']['type'];
			$data = file_get_contents($_FILES['myfile']['tmp_name']);
			$stmt = $dbh->prepare("INSERT INTO myblob(`name`, `mime`, `data`) VALUES(:name, :type, :data)");
			$stmt->bindParam('name',$name);
			$stmt->bindParam('type',$type);
			$stmt->bindParam('data',$data);
			$stmt->execute();
		}
		?>
		<form method="post" enctype="multipart/form-data">
			<input type="file" name="myfile" />
			<button name="btn">Upload</button>
		</form>
		<p></p>
		<ol>
			<?php
			
			$stat = $dbh->prepare("SELECT * FROM myblob");
			$stat->execute();
			while($row = $stat->fetch()){
				echo "<br/>
				<embed src='data:".$row['mime']. ";base64,".base64_encode($row['data'])."'width='200'/>";
			}
			?>
		</ol>
	</body>
</html>