# 概要
[【AI + pygame】pygameで作るインベーダー風ゲーム 第4回 強化学習編その1（必要なメソッドの実装）](https://blog.formzu.com/pygame-invader-4)と[【AI + pygame】pygameで作るインベーダー風ゲーム 第5回 強化学習編その2（ゲーム画面から学習させる）](https://blog.formzu.com/pygame-invader-5)
を参考にしてインベーダー風ゲームの機械学習を行った。

# 説明
学習に使用するインベーダー風ゲームは、上記のサイトからダウンロードしたものを使用させてもらった。また、実際のインベーダーゲームに近いものにするために、いくつか改造を加えた。  
強化学習時のエピソード数やステップ数そして報酬やペナルティは、サイトの実行結果を参考にしながら、学習結果を分析して自分で変更を加えていった。

# インベーダー風ゲームの改造箇所
・自機の保持数を５機から３機に変更  
・自機の真上にいる敵だけが攻撃をするように変更  
・倒した敵の数に応じて、敵の移動速度が速くなるように変更  

# 報酬・ペナルティの設定
報酬を与える場合  
・自機の残機数に変化がないとき  
・敵の数が減ったとき  
・ゲームクリアしたとき  
ペナルティを与える場合  
・自機の残機数が減ったとき  
・一定時間敵の数が減らなかったとき  
・ゲームオーバーしたとき  
