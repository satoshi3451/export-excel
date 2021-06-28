# dg_forex_scraper

### デプロイ方法
Dockerが動作している状態で、ターミナルを開き(Windows VScodeは Ctrl+Shift+Pキー)  

> docker-compose up -d --build  
docker exec -it xxxxx_php bash  

を実行。  
続いて下記のコマンドを実行

> cd laravel  
composer install  
cp .env.docker .env  
php artisan key:generate  
chmod -R a+w storage/ bootstrap/cache  

### 動作確認
ブラウザで  
http://localhost/  
へアクセス

### コンテナの停止
> docker-compose stop

### コンテナの再開
> docker-compose up -d
  
以上
