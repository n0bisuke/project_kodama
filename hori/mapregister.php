<?php 
$money = $_POST['money'];
$placename = $_POST['placename']; 
$latdata = $_POST['latdata']; 
$lngdata = $_POST['lngdata']; 

//DBへ接続
$pdo = new PDO('mysql:dbname=mapdatasample;host=localhost','root','');
//文字コードを指定
$stmt = $pdo->query('SET NAMES utf8');
//データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO data_table(id,usemoney,placename,lat,lng,nowdate)VALUES(NULL,:usemoney,:placename,:lat,:lng,sysdate())");
$stmt->bindValue(':usemoney',$money);
$stmt->bindValue(':placename',$placename);
$stmt->bindValue(':lat',$latdata);
$stmt->bindValue(':lng',$lngdata);


//SQL実行

$flag = $stmt->execute();

?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
	<style>
		body{
			font-family: 'Noto Sans Japanese', serif;
		}
	</style>
</head>
<body>
	<p>下記のデータを挿入しました。</p>
	<?php 
	echo $money."円<br>";
	echo "地点名：".$placename."<br>";
	echo "緯度：".$latdata."<br>";
	echo "経度：".$lngdata."<br>";
	?>
</body>
</html>