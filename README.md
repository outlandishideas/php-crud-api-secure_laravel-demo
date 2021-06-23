# Laravel CRUD API with secure-by-default config demo

This is a demo of how you can use `https://gitlab.outlandish.com/harry/php-crud-api-secure` to bootstrap a CRUD API
using Laravel.

## Installation

### Grab a copy of this repo and change into the directory:

```bash
git clone git@gitlab.outlandish.com:harry/php-crud-api-secure-demo.git
cd php-crud-api-secure-demo
```
This is a project started with the `composer create-project laravel/laravel {directory} 4.2 --prefer-dist` 
command. It's almost all boilerplate. TODO: delete unneeded boilerplate 

The main files you're interested are:
* `composer.json` which includes the `harry/php-crud-api-secure` library
* `routes/api.php` which boostraps the php-crud-api with the SecureConfig from `harry/php-crud-api-secure`

### Install the requirements

```bash
composer install
```

### Seed the sqlite database

```bash
php artisan db:seed
```
This loads data from `database/animals_source_data.sql` 
into `database/animals.sqlite` 
via `database/seeders/DataSeeder.php`

### Serve the app

```bash
php artisan serve
```

### Check it's working 

If all is well then you should get a JSON response
from http://127.0.0.1:8000/api/records/users?join=pets
along the lines of:

```json

{
    "records": [
        {
            "id": 1,
            "display_name": "harry",
            "pets": [
                {
                    "id": 1,
                    "name": "timmy",
                    "favourite_food": "lettuce",
                    "species": "snail",
                    "owner": 1
                },
                {
                    "id": 2,
                    "name": "jimbo",
                    "favourite_food": "sugar",
                    "species": "ant",
                    "owner": 1
                }
            ]
        },
        {
            "id": 2,
            "display_name": "randomMan",
            "pets": [
                {
                    "id": 3,
                    "name": "fido",
                    "favourite_food": "snails",
                    "species": "dog",
                    "owner": 2
                }
            ]
        }
    ]
}

```

## Permissions
The app defines a set of permissions that allow you to:

* read all properties from teh `pets` table
* read some properties from the `users` table
* write data to the `pets` table


### Check that you can read the users table
```bash
curl http://localhost:8000/api/records/users
```
### Check that you can't write to the users table
```bash

curl --header "Content-Type: application/json" \
--request POST \
--data '{"id":"8","password":"123Password"}' \
http://localhost:8000/api/records/users
```

### Check that you can read the pets table
```bash
curl http://localhost:8000/api/records/pets
```

### Check that you can write to the pets table
```bash
curl --header "Content-Type: application/json" \
--request POST \
--data '{ 
"name": "gnasher", 
"favourite_food": "softies", 
"species": "cartoon_dog", 
"owner": 1 
}' \
http://localhost:8000/api/records/pets
```

### Check that your new entry is in the pets table
```bash
curl http://localhost:8000/api/records/pets
```
