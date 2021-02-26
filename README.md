## Requisitos

- PHP >= 8.0
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- composer
- npm
- node
- Mysql Server

## Instalação

Criar banco de dados com o nome puzlplacedb
cd server && composer install && php artisan key:generate && php artisan migrate --seed && php artisan serve
cd client && npm install && npm run dev

## Tests

cd /server
php artisan test
