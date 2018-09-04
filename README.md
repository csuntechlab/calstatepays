<!-- <p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p> -->

# CalStatePays

A data visualization application for discovering, exploring, and analyzing your potential financial earnings after graduation from 7 different CalState Universities. 

## Get Up and Running

### Prerequisites
```
Please have docker && docker-compose installed
```

### List of set up commands (General):
#### To build the project (build the containers),
In the project root run the following:
```
docker-compose up -d
```
This will build and run 3 containers
- The laravel web service, named **csumetro**
- Composer service, which installs composer and runs composer install
- MySQL service, named **csumetro_db**

#### To enter the web service shell:
```
docker exec -it csumetro /bin/bash 
```
#### To seed the application,
After entering the laravel web service shell:
```
php artisan migrate:refresh --seed
```

### Front end commands:
In your project root,
#### To build UI changes:
```
yarn run dev
``` 
#### To watch for new UI changes:
```
yarn run watch
```

## Bugs and issues:

If you discover a bug and or issue within the application, please create a JIRA ticket with the BUG prefix. In addition, please list the necessary steps to reproduce the bug in the description.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
