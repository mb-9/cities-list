Laravel Cities parser 
========================
This is a laravel application that scrapes a website for data about cities.

Requirements
------------

* PHP 8.2.4 or higher;

Installation
------------

```bash
# clone the code repository and install its dependencies
$ git clone https://github.com/mb-9/cities-list.git my_project
$ cd my_project/
$ composer install
```

Database
--------
Create database and set up connection string in .env, then run

```bash
php artisan migrate
```

Running the parser
--------

You can run parsing data with the following command 

```bash
 php artisan data:import
```
