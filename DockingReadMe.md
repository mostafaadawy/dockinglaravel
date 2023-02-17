# Using Docker with Laravel
in this project we will create rest api application based docker

we can do this in many ways the most forwarded is to use `curl -s https://laravel.build/example-app | bash` asd explained in laravel [documentation](https://laravel.com/docs/9.x/installation#laravel-and-docker)

we  will use other methodology which is step by step

- create new laravel project `composer create-project laravel/laravel dockinglaravel`
- to dock our laravel project we can make it using `docker-compose.yml` and creating `dockerfile`then use `docker-compose up` or we can use sail package to help us docking our project
- we will use [sail](https://laravel.com/docs/9.x/sail) where it is not prevented using normal docking methods and it helps us creating template for our project 
- require sail `composer require laravel/sail --dev`
- After Sail has been installed, you may run the sail:install Artisan command. This command will publish Sail's docker-compose.yml file to the root of your application `php artisan sail:install`
- it require from us to select which actually the required services beside web from database mysql redes or other for our issue we select mysql `0`
- 

