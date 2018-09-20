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
### To Run the python Script,
After opening the CsuMetro file run commands:
```
cd python_parser/python_parser_work_in_progress/
python python_parser_main.py
```
Note:
- Python script will change the structure of the JSON but the data values will be consistent.  


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
