# Тестовое задание от Mind4.me

## Запуск проекта

1. git clone git@github.com:Tmoiseenko/Mind4me.git 
2. composer install 
3. cp -a vendor/swagger-api/swagger-ui/dist public/swagger-ui-assets 
4. cp .env.example .env 
5. php artisan swagger-lume:publish 
6. php artisan swagger-lume:generate 
7. docker-compose up -d 
8. php artisan migrate:install 
9. php artisan migrate 
10. php -S localhost:8000 -t public 
11. переходим по [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)

[описание задания](https://docs.google.com/document/d/17UdW6dKeHSMtWE7zGK3bQzhFMYRyQAeIjark85TBKjs/edit#heading=h.owcnn53oqkjk)

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
