<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>集計テスト</title>
  <!-- <link href="css/style.css" rel="stylesheet"> -->
</head>
<body>
<div id="title">
  <h1>集計結果</h1>
  <!-- 直前のページに戻る -->
  <input type="button" onclick="history.back()" value="戻る">
</div>
<div id="syukei_tuki">
  <h2>月次集計結果</h2>
  <?php
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
  try{
    // 月次で集計するためにDATE_FORMAT関数とGROUPBY句を使用
    // DATE_FORMAT関数で書式に「’%Y%m’」として、年月を指定、GROUP BY句で年月で集計するように指定
    // SELECTとGROUP BYの'%Y-%m'は両方同じ書き方にしないとエラー
    $sql = "SELECT DATE_FORMAT(date, '%Y-%m') as date, SUM(getyen) as getyen, SUM(useyen) as useyen
            FROM kakeibo_tb
            WHERE product != '銀行'
            GROUP BY DATE_FORMAT(date, '%Y-%m')
            ORDER BY date DESC;";
    $stmt = $dbh->query($sql);
    #レコード件数の取得
    $row_count = $stmt->rowCount();

    while($row = $stmt->fetch()){
      $rows[] = $row;
    }
  #クエリー失敗
  } catch (PDOException $e) {
    echo 'データベースにアクセスできません！'.$e->getMessage();
  }
  ?>
  <!-- テーブルとして取得したレコードを表示する -->
  <table border='1'>
  <!-- カラム名を表示する -->
  <tr><td>日付</td><td>もらったお金</td><td>使ったお金</td></tr>
  <?php
  foreach($rows as $row){
  ?>
  <tr>
    <!-- htmlspecialcharsとは？ -->
    <!-- 特殊文字をHTMLエンティティに変換する -->
    <!-- htmlspecialcharsを使用しない形で書いても動く -->
    <td><?php echo htmlspecialchars($row['date'],ENT_QUOTES,'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($row['getyen'],ENT_QUOTES,'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($row['useyen'],ENT_QUOTES,'UTF-8'); ?></td>
  </tr>
  <?php
  }
  ?>
  </table>
</div>

<div id="syukei_syumoku">
  <h2>買ったもの集計結果</h2>
  <?php
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
  try{
    // もらった金額のレコードを表示しないため条件WHERE product != ''を記述
    $sql = "SELECT product, SUM(useyen) as useyen
            FROM kakeibo_tb
            WHERE product != '' AND product != '銀行' AND product != '？' AND product != '?'
            GROUP BY product
            ORDER BY useyen DESC;";
    $stmt = $dbh->query($sql);
    #レコード件数の取得
    $row_count = $stmt->rowCount();
    while($productRow = $stmt->fetch()){
      $productRows[] = $productRow;
    }
    #データベースの接続終了
    $dbh = null;

  #クエリー失敗
  } catch (PDOException $e) {
    echo 'データベースにアクセスできません！'.$e->getMessage();
  }
  ?>
  <!-- レコード件数の表示 -->
  レコード件数：<?php echo $row_count; ?>
  <!-- テーブルとして取得したレコードを表示する -->
  <table border='1'>
  <!-- カラム名を表示する -->
  <tr><td>買ったもの</td><td>使ったお金</td></tr>
  <?php
  foreach($productRows as $row){
  ?>
  <tr>
    <td><?php echo htmlspecialchars($row['product'],ENT_QUOTES,'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($row['useyen'],ENT_QUOTES,'UTF-8'); ?></td>
  </tr>
  <?php
  }
  ?>
  </table>
</div>

</body>
</html>