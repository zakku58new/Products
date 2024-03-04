<?php
error_reporting(-1);
// $id = $_POST['id'];
// echo $id;

/* データベース設定 */
define('DB_DNS', 'mysql:host=localhost; port=8889; dbname=kakeibo; charset=utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');

/* データベースへ接続 */
try {
  $dbh = new PDO(DB_DNS, DB_USER, DB_PASSWORD);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e){
    echo $e->getMessage();
    exit;
}

if(empty($_POST)) {
	echo "<a href='kakeibo_index.php'>家計簿登録ページ</a>←こちらのページからどうぞ";
	exit();
}else{
	if (!isset($_POST['id']) || !is_numeric($_POST['id']) ){
		echo "IDエラー";
		exit();
	}else{
		//プリペアドステートメント
		// $stmt = $dbh->prepare("DELETE FROM kakeibo_tb WHERE id=?");
    $id = $_POST['id'];
    // 削除のSQL実行の準備
    $stmt = $dbh->prepare('DELETE FROM kakeibo_tb WHERE id = :id');
		
		if($stmt){
			//プレースホルダへ実際の値を設定する
      $stmt->bindParam(':id', $id, PDO::PARAM_STR);
			// $stmt->bind_param('i', $id);
			$stmt->execute();
      echo "削除されました";
			//ステートメント切断
			// $stmt->close();
		}else{
			echo $dbh->errno . $dbh->error;
		}
	}
}
// データベース切断
// $dbh->close();
// ステートメントとデータベースを切断するとhitmが表示されなくなる、なぜ？
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>削除テスト</title>
</head>
<body>
  <p>
    <input type="button" onclick="location.href='kakeibo_index.php'" value="登録画面">
  </p>
</body>
</html>