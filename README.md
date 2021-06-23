# Laravel CRUD API with secure-by-default config demo

This is a demo of how you can use `https://gitlab.outlandish.com/harry/php-crud-api-secure` to bootstrap a CRUD API
using Laravel.

## Installation

### Grab a copy of this repo and change into the directory:

```bash
git clone git@gitlab.outlandish.com:harry/php-crud-api-secure-demo.git
cd php-crud-api-secure-demo
```

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
