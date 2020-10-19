# CalStatePays

[![Build Status](https://travis-ci.com/csun-metalab/calstatepays.svg?token=e9qZAYzzq9K9MQ8bgdpF&branch=dev)](https://travis-ci.com/csun-metalab/calstatepays) [![Build Status](https://travis-ci.com/csun-metalab/calstatepays.svg?token=e9qZAYzzq9K9MQ8bgdpF&branch=demo)](https://travis-ci.com/csun-metalab/calstatepays) [![Build Status](https://travis-ci.com/csun-metalab/calstatepays.svg?token=e9qZAYzzq9K9MQ8bgdpF&branch=master)](https://travis-ci.com/csun-metalab/calstatepays)

CalStatePays is a visualization application for discovering, exploring, and analyzing your potential financial earnings after graduation from 7 different Cal State Universities.  Californiate State employment records associated with the alumini from these CSU campus is the used as the bases for the information that is presented.

* Our production website for CalStatePays is located at: https://calstatepays.org
* Our sandbox website for CalStatePays is located at: https://www.sandbox.csun.edu/calstatepays


## [Table of Contents](#table-of-contents)
<!-- TOC -->
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
    - [Additional project set-up](#additional-project-set-up)
        - [Seeding the application](#seeding-the-application)
    - [Development cycle commands](#development-cycle-commands)
        - [Back end](#back-end)
            - [Running the python script](#running-the-python-script)
            - [Seeding or Re-seeding the application,](#seeding-or-re-seeding-the-application)
        - [Front end](#front-end)
            - [Building UI changes](#building-ui-changes)
            - [Watching UI changes](#watching-ui-changes)
    - [Bugs and issues:](#bugs-and-issues)
    - [License](#license)

<!-- /TOC -->

## Prerequisites

- [Git](https://git-scm.com/downloads)
- [Docker](https://docs.docker.com/install/)
- [Docker-Compose](https://docs.docker.com/compose/install/)
- Favorite Text Editor or IDE
- Meet [Laravel 5.4 requirements](https://laravel.com/docs/5.4)

## Installation

 To begin, navigate to the project root on your favorite terminal and run the following:

```
$ docker-compose up -d
```

This will build and run the following containers:

- The Laravel web service, named **csumetro**
- Composer service, which installs composer and runs `$ composer install`
- A database administration GUI - Adminer, named **csumetro_adminer**
- MySQL service, named **csumetro_db**

⚠️ **Important** Inside the `docker-compose.yml` file, you will find the database configuration that needs to be included in the project's `.env` file. After you have done this you should be able to type `localhost:8080` on your favorite browser and see the application's landing page.

### Seeding the application

Once you have successfully served the application, you will need to seed the database. In order to do that you need to navigate to the project root on your favorite terminal and run the following:

```
$ docker exec -it csumetro /bin/bash 
```

This will drop you into the `csumetro` container which allows you to run any commands inside the web server. Since we are seeding the database for the very first time, we want to run the following command:

```
$ php artisan migrate --seed
```

## Development cycle commands

### Back end

#### Running the python script
After accessing the `csumetro` container run commands:

```
$ cd python_parser/python_parser_work_in_progress/
$ python python_parser_main.py
```

Note:
- Python script will change the structure of the JSON but the data values will be consistent.  


#### Seeding or Re-seeding the application,

After entering the Laravel web service shell run this command if you want to drop all of the current tables and re-seed:

```
$ php artisan migrate:refresh --seed
```

or run this command if you are seeding for the very first time

```
$ php artisan migrate --seed
```

### Front end

Drop inside the docker container by running the following command on your favorite terminal on the root of this project.

```
$ docker exec -it csumetro /bin/bash 
```
and run either of the two following commands.

#### Building UI changes

If you want yarn to re-compile all of the front end resources then run the following:

```
$ yarn run dev
```

**Note:** Any changes after you run the command have to be re-compiled. In order to not have to constantly re-compile all of the front end resources you should run the following command instead:

#### Watching UI changes

```
$ yarn run watch
```

**Note:** When you run this command on the terminal it starts a process that will continuously watch for front end resource changes. If you want to stop the process then simply issue `Ctrl+C`.

⚠️ **Important:** Make sure you terminate the watch process before you start switching into different branches!

## Bugs and issues:

If you discover a bug and or issue within the application, please create a JIRA ticket with the BUG prefix. In addition, please list the necessary steps to reproduce the bug in the description.

## License
CalStatePays is open-sourced software licensed under the GNU General Public License v3+. A copy can be found in the `COPYING` file.

The [Laravel](https://laravel.com/) framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
