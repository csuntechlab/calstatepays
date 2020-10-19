# CalStatePays

[![Build Status](https://travis-ci.com/csun-metalab/calstatepays.svg?token=e9qZAYzzq9K9MQ8bgdpF&branch=dev)](https://travis-ci.com/csun-metalab/calstatepays) [![Build Status](https://travis-ci.com/csun-metalab/calstatepays.svg?token=e9qZAYzzq9K9MQ8bgdpF&branch=demo)](https://travis-ci.com/csun-metalab/calstatepays) [![Build Status](https://travis-ci.com/csun-metalab/calstatepays.svg?token=e9qZAYzzq9K9MQ8bgdpF&branch=master)](https://travis-ci.com/csun-metalab/calstatepays)

CalStatePays is a visualization application for discovering, exploring, and analyzing your potential financial earnings after graduation from 7 different Cal State Universities.  Californiate State employment records associated with the alumini from these CSU campus is the used as the bases for the information that is presented.

* Our production website for CalStatePays is located at: https://calstatepays.org
* Our sandbox website for CalStatePays is located at: https://www.sandbox.csun.edu/calstatepays


## Table of Contents
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

There are several different installation options for the CalStatePays software.  The only option that is provided by these instructions is the development option.


### Development Installation
As a developer, you will find it useful to install the application, in total, on your local machine.  These development installation creates four containers used to setup a working environment. This environment contains the CalStatePays Application, the CalStatePays Database, and two supporting containers.  The CalStatePays Applicattions also mounts the current working directory.  This allows the developer to use their favorite development tools outside of the containers, with updates to software being made directly.

The steps you need to perform to install this sofware are as follows:
```
  $ git clone https://github.com/csuntechlab/calstatepays.git
  $ cd calstatepays
  $ docker-compose --env-file .env.dev  up --detach
  $ docker exec -it csumetro php artisan key:generate
  $ docker exec -it csumetro php artisan migrate --seed  
```

⚠️ This process is driven by the .env.dev file.  You may want to review the contents of this file prior to running the docker-compose command referenced above.

You may may launch your favorite web browser and access your version of the calstatepays application via the following URL: http://localhost:8080/calstatepays.

You can remove your docker enviornment via the following command:
```
docker-compose down
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
