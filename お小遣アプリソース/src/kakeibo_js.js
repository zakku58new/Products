$(function() {

  // button
  // class名でとってくる
  var btn_clone = $('.btn-clone');  // 追加ボタン
  var btn_remove = $('.btn-remove');  // 削除ボタン

  // clone
  btn_clone.click(function() {

      var useyen = $('.useyen').last();  // 最後尾にあるinput
      var product = $('.product').last();  // 最後尾にあるinput

      useyen
        .clone()  // クローン
        .val('0')  // valueもクローンされるので削除する
        .insertAfter(useyen);  // inputを最後尾に追加
        product
        .clone()  // クローン
        .val('')  // valueもクローンされるので削除する
        .insertAfter(product);  // inputを最後尾に追加

        document.getElementById("br").disabled = false;

      if (product.length >= 2) {
          // inputが2つ以上あるときに削除ボタンを活性
          document.getElementById("br").disabled = false;
      }

  });

  // remove
  btn_remove.click(function() {

      $('.useyen').last().remove();
      $('.product').last().remove();

      if ($('.product').length < 2) {
          // inputが2つ未満のときに削除ボタンを非活性
          document.getElementById("br").disabled = true;

      }

  });
});