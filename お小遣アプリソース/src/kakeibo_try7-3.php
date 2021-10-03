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
	echo "<a href='kakeibo_try8.php'>家計簿登録ページ</a>←こちらのページからどうぞ";
	exit();
}else{
		//プリペアドステートメント
    $id = $_POST['id'];
    try{
      // 削除のSQL実行の準備
    $stmt = $dbh->prepare('SELECT * FROM kakeibo_tb WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $result = 0;
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <div class="contact-form">
        <h1>編集</h1>
        <form action="kakeibo_try7-3-2.php" method="post">
                <!-- id項目は表示しない -->
                <input type="hidden" name="id" value="<?php if (!empty($result['id'])) echo(htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8'));?>">
            <!-- ＜P＞タグを使うことで一行に表示する -->
            <!-- 表示する文字数によってずれる -->
            <!-- →<table>をtukauto使うとそろえて表示させることができる -->
            <p>
                <label>日付：</label>
                <input type="date" name="date" value="<?php if (!empty($result['date'])) echo(htmlspecialchars($result['date'], ENT_QUOTES, 'UTF-8'));?>">
            </p>
            <p>
                <label>もらった金額：</label>
                <input type="number" name="getyen" value="<?php if (!empty($result['getyen'])) echo(htmlspecialchars($result['getyen'], ENT_QUOTES, 'UTF-8')); else echo 0;?>">
            </p>
            <p>
                <label>使った金額：</label>
                <input type="number" name="useyen" value="<?php if (!empty($result['useyen'])) echo(htmlspecialchars($result['useyen'], ENT_QUOTES, 'UTF-8')); else echo 0;?>">
            </p>
            <p>
                <label>買ったもの：</label>
                <input type="text" name="product" value="<?php if (!empty($result['product'])) echo(htmlspecialchars($result['product'], ENT_QUOTES, 'UTF-8'));?>">
            </p>
            <!-- 編集ボタン -->
            <input type="submit" value="編集する">
            <!-- 直前のページに戻る -->
            <input type="button" onclick="history.back()" value="戻る">
        </form>
    </div>
</body>
</html>