# タイトル：お金をどこで使っているか記録し、無駄遣いを可視化してくれるアプリ （仮）

---

## 内容

1.自分がお金を使っている場所、金額を記録していける。

2.自分がどこでお金を使っているのか、無駄遣いはどれくらい、どこで無駄遣いをしているのかをユーザーが把握できる。

3.無駄遣いが発生している場所に近づいたらプッシュ通知でアラートを出してくれる。

4.無駄遣いをした金額に応じて、「こんなものが買えた」リストを表示する


## 補足
####今回のアプリを作ろうと思った背景

無駄遣いをなくしたいと思うけど、そもそもどこでどのくらいお金を使っているのかを記録しないとその対策が打てないと思ったので。

あと、純粋に自分はライフログ系のアプリが好きで、作ってみたいと思った。

node.jsを使ってクローラーが作れるようなので、それを使ったアプリケーションを作ってみたいと思った。


####ターゲット

無駄遣いをなくしたいと思っているユーザー。

## 仕様言語・技術（予定）

- javascript（jQuery）： 動的操作のため
- Node.js：Amazonから情報をクローリングするため
- Amazon API：Amazonの商品を取ってくるため
- Google Maps API：位置情報の取得、登録などのため
- Places API：検索結果をスムーズに表示させるため
- PHP,MySQL：DBを使う場合には必須？
- Service Worker：プッシュ通知のため


## ユーザーのアプリ内での流れ

1.よく買い物をする場所を登録する（最低1箇所。複数可能。）

2.そこでいくら使ったのかを記録していく。

3.1週間に1回ほど、買い物が無駄だったかどうかの判断をしてもらい、無駄遣い仕分けをしてもらう。

4.以後、その場所に近づいた際にはプッシュ通知でユーザーにお知らせ。タップorクリックでサイトを表示する。飛び先は質問ページへ。無駄遣いをしそうな時に聞かれる質問が出てくる。

5.ユーザーはこの地点で「いくら使っているか」「いくら無駄なお金を使っているか」「何時にお金を使っているか」「何月にお金を使っているか」「何時に無駄なお金を使っているか」「何月に無駄なお金を使っているか」というデータも確認する。


## アプリで出来ること

1.自分がお金を使っている場所、金額を記録していける。

2.自分がどこでお金を使っているのか、無駄遣いはどれくらい、どこでしているのかをユーザーに把握できる。

3.無駄遣いをしそうになったらbotが質問を投げかけてくれて、無駄遣いをしないように誘導してくれる。

4.無駄遣いが発生している場所に近づいたらプッシュ通知でアラートを出してくれる。

5.ある地点で「いくら使っているか」「いくら無駄なお金を使っているか」「何時にお金を使っているか」「何月にお金を使っているか」「何時に無駄なお金を使っているか」「何月に無駄なお金を使っているか」というデータも確認する。


## 類似サービスとの違い

- 「お金を使う場所」のログを取るものはなさそう

- 無駄遣いしやすい場所を判断して、アラートを出してくれるものもなさそう


## TOPページの画面について
top.htmlにアップロード予定。

## メインページの画面について

main.phpにアップロード予定。