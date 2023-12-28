# Permission Management System
> System to manage ecommerce permissions


## Requeriments

* PHP 8.2
* Laravel 10
* Mysql 8


## Install

1 - Rodar composer
```sh
 composer install
```

2 - Configurar .env
```sh
 Configurar infos do BD
```

3 - Rodar migrations
```sh
 php artisan migrate
```

4 - Instalar chaves da aplicação com passport
```sh
 php artisan passport:install
```


## Execução Local
APP_PORT=80

Laravel Sail
```sh
 sail up -d
```

ou 

Docker
```sh
 docker-compose up -d
```

## Mailpit - email box
```sh
 http://localhost:8025/
```

