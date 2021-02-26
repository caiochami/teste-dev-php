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

Acesse a pasta server executando os comandos
cd server && cp .env.example .env && composer install && php artisan key:generate && php artisan migrate --seed && php artisan serve

Acesse a pasta client e executando os comandos;
npm install && npm run dev

## Tests

Para realizar os testes unitários e de integração, acesse a pasta server e execute o comando:
php artisan test
