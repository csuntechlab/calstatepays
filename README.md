# CalStatePays

[![Build Status](https://travis-ci.com/csun-metalab/calstatepays.svg?token=e9qZAYzzq9K9MQ8bgdpF&branch=dev)](https://travis-ci.com/csun-metalab/calstatepays) [![Build Status](https://travis-ci.com/csun-metalab/calstatepays.svg?token=e9qZAYzzq9K9MQ8bgdpF&branch=demo)](https://travis-ci.com/csun-metalab/calstatepays) [![Build Status](https://travis-ci.com/csun-metalab/calstatepays.svg?token=e9qZAYzzq9K9MQ8bgdpF&branch=master)](https://travis-ci.com/csun-metalab/calstatepays)

CalStatePays is a visualization application for discovering, exploring, and analyzing your potential financial earnings after graduation from 7 different Cal State Universities.  Californiate State employment records associated with the alumini from these CSU campus is the used as the bases for the information that is presented.

* Our production website for CalStatePays is located at: https://calstatepays.org
* Our sandbox website for CalStatePays is located at: https://www.sandbox.csun.edu/calstatepays


## Table of Contents
<!-- TOC -->
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
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

- Install [Git](https://git-scm.com/downloads) to access the software repository
- Install [Docker](https://docs.docker.com/install/) desktop to run containers on your development machine
- Install [Docker-Compose](https://docs.docker.com/compose/install/) to manage a set of containers
- Select and Install you Favorite Text Editor or IDE
- Ensure you meet the [Laravel 5.4 requirements](https://laravel.com/docs/5.4) to perform development work

## Installation

There are several different installation options for the CalStatePays software.  The only option that is provided by these instructions is the development option.


### Development Installation
As a developer, you will find it useful to install the application, in total, on your local machine.  These development installation creates four containers used to setup a working environment. This environment contains a webserver, a database, and two supporting containers.  The webserver mounts the home directory of your cloned project. This allows the developer to use their favorite development tools outside of the containers, with updates to software being made directly.

The steps you need to perform to install this sofware are as follows:
```
  $ git clone https://github.com/csuntechlab/calstatepays.git
  $ cd calstatepays
  $ cp .env.dev .env
  $ docker-compose up --detach
  $ docker-compose exec webserver php artisan key:generate
  $ docker-compose exec webserver php artisan migrate --seed
```

⚠️ This process is driven by the .env.dev file.  Container names, etc, are derived from the COMPOSE_PROJECT_NAME which has been set to "calstatepays". You may want to review the contents of this file prior to running the docker-compose command referenced above, and make appropriate changes.  E.g., you might want to change the default password for the database.

You may may launch your favorite web browser and access your version of the calstatepays application:
  * The application is reachable at: http://localhost:8080/    # The port number can be changed via the WEB_PORT environment variable
  * The database GUI is reachable at: http://localhost:8081/   # The port number can be changed via the ADMIR_PORT environment variable

You can reset your docker environment via the following command:
```
$ docker-compose down
$ docker volume rm calstatepays_volume           # Assuming $COMPOSE_PROJECT_NAME == calstatepays
$ docker-compose up --detach --force-recreate
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
