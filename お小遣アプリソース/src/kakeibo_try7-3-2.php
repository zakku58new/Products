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

// 日付が入力されていないときは実行しない
if(empty($_POST['date'])) {
	echo "<a href='kakeibo_try8.php'>家計簿登録ページ</a>←こちらのページからどうぞ";
	exit();
}else{
    try{
    $stmt = $dbh->prepare('UPDATE kakeibo_tb SET date = :date, getyen = :getyen, useyen = :useyen, product = :product WHERE id = :id');
    //プリペアドステートメント
    $stmt->execute(array(':date' => $_POST['date'], ':getyen' => $_POST['getyen'], ':useyen' => $_POST['useyen'], ':product' => $_POST['product'], ':id' => $_POST['id']));
    echo "情報を更新しました。";

    } catch (PDOException $e) {
      echo 'エラーが発生しました。:' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>編集テスト</title>
</head>
<body>
    <p>
        id：<?php if (!empty($_POST['id'])) echo(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8')); else echo ':id取得エラー:';?>の情報を更新しました
    </p>
    <p>
        <input type="button" onclick="location.href='kakeibo_try8.php'" value="登録画面">
    </p>
</body>
</html>