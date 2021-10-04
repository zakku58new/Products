<?php
error_reporting(-1);

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

/* データベースへ登録 */
#PHPでデータを受け取り、DBに登録
#条件：$_POST['date']というデータが有れば
if(!empty($_POST['date'])){
  $cunt = 0;
  // 先に日付ともらった金額を受け取る
  $date = $_POST['date'];
  $getyen = $_POST['getyen'];
  while(true){
    // !empty()は０の時もfalseになる
    if($getyen > 0 or !empty($_POST['useyen'][$cunt])){
      try{
        # 最新レコードの合計のデータを取得
        $sql = 'SELECT total FROM kakeibo_tb ORDER BY id DESC LIMIT 1';
        $stmt = $dbh->query($sql);
        $oldTotal = 0;
        foreach ($stmt as $row){
          $oldTotal = $row['total'];
        }
        //input_post.phpの値を取得
        $useyen = $_POST['useyen'][$cunt];
        // useyenの入力がある時だけproductを登録する
        if(!empty($_POST['useyen'][$cunt])){
          $product = $_POST['product'][$cunt];
        }else{
          $product = '';
        }
        #計算
        #現在の合計金額＝前回の合計＋もらった金額ー使った金額
        $total = $oldTotal + $getyen - $useyen;
        // echo '前回の合計'.$oldTotal."\t";
        // echo '現在の合計'.$total;
    
        // INSERT文を変数に格納。:nameはプレースホルダという、値を入れるための単なる空箱
        $sql = "INSERT INTO kakeibo_tb(date,getyen,useyen,product,total) VALUES (:date,:getyen,:useyen,:product,:total)";
        //挿入する値は空のまま、SQL実行の準備をする
        $stmt = $dbh->prepare($sql); 
        // 挿入する値を配列に格納する
        // 例）$params = array(':name' => $name, ':category' => $category,':description' => $description); 
        $params = array(':date'=>$date,':getyen'=>$getyen,':useyen'=>$useyen,':product'=>$product,':total'=>$total); 
        //挿入する値が入った変数をexecuteにセットしてSQLを実行
        $stmt->execute($params); 
    
      } catch (PDOException $e) {
          echo 'データベースにアクセスできません！'.$e->getMessage();
      }
    }else{
      break;
    }
    $cunt++;
    // 2回目以降はもらった金額を0円として計算する
    $getyen = 0;
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>登録テスト</title>
  <!-- <link href="form_testcss.css" rel="stylesheet"> -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <!-- 追加・削除ボタンの制御 -->
  <script type="text/javascript" src="kakeibo_js.js"></script>
</head>
<body>
  <div id="wrapper">

    <div id="input_form">
      <!-- POSTを使ってデータを渡す -->
      <form action="kakeibo_index.php" method="POST">
        <table>
          <!-- name=" "のクオーテーション部分が連想配列のラベル名。$_POST['ラベル名'] -->
          <tr><th>日付（必須）</th>
          <td><input type="date" name="date" id="date"></td></tr>
          <tr><th>もらった金額</th>
          <td><input type="number" name="getyen" value="0"></td></tr>
          <tr><th>使った金額</th>
          <td><input type="number" name="useyen[]" class="useyen" value="0"></td></tr>
          <tr><th>買ったもの</th>
          <td><input type="text" name="product[]" class="product"></td></tr>
        </table>
        <div>
          <!-- 使った金額、買ったもの入力欄の追加ボタン -->
          <button type="button" class="btn-clone">追加</button>
          <!-- 初期値は使用不可　jsで制御 -->
          <button type="button" id="br" class="btn-remove" disabled>削除</button>
        </div>
        <p>
        <!-- submit：フォームの送信ボタンを作成 -->
        <input type="submit" value="登録">
        <!-- inputタグで画面遷移ボタンを作成 -->
        <input type="button" onclick="location.href='kakeibo_total.php'" value="集計">
        </p>
      </form>
    </div>

    <!-- データベースの表示 -->
    <div id="drag-area">
      <!-- <PRE>～</PRE>で囲まれた範囲のソースに記述されたスペース・改行などを、そのまま等幅フォントで表示 -->
      <!-- <pre> -->
      <?php
      try{
        $sql = 'SELECT * FROM kakeibo_tb ORDER BY id DESC';
        $stmt = $dbh->query($sql);
        #レコード件数の取得
        $row_count = $stmt->rowCount();
        while($row = $stmt->fetch()){
          $rows[] = $row;
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
        <tr>
          <td>id</td>
          <td>日付</td>
          <td>もらったお金</td>
          <td>使ったお金</td>
          <td>買ったもの</td>
          <td>合計金額</td>
        </tr>

        <?php
        foreach($rows as $row){
        ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <!-- htmlspecialcharsとは？ -->
          <!-- 特殊文字をHTMLエンティティに変換する -->
          <!-- htmlspecialcharsを使用しない形で書いても動く -->
          <td><?php echo htmlspecialchars($row['date'],ENT_QUOTES,'UTF-8'); ?></td>
          <td><?php echo htmlspecialchars($row['getyen'],ENT_QUOTES,'UTF-8'); ?></td>
          <td><?php echo htmlspecialchars($row['useyen'],ENT_QUOTES,'UTF-8'); ?></td>
          <td><?php echo htmlspecialchars($row['product'],ENT_QUOTES,'UTF-8'); ?></td>
          <td><?php echo htmlspecialchars($row['total'],ENT_QUOTES,'UTF-8'); ?></td>
          <td>
            <form action="kakeibo_edit.php" method="post">
            <input type="submit" value="編集する">
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            </form>
          </td>
          <td>
            <form action="kakeibo_delete.php" method="post">
            <input type="submit" value="削除する">
            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
            </form>
          </td>
        </tr>
        <?php
        }
        ?>
      </table>
      <!-- </pre> -->
    </div>

  </div>
</body>
</html>