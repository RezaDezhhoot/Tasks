# Task4

### Get started

After receiving the project, run
````bash
cp .env.example .env 
````

In the next step execute the following command to get dependencies
````bash
composer install
````
Now run
````bash
php artisan key:generate
````
And migrate
````bash
php artisan migrate 
````
Then
````bash
php artisan serve
````
For seeding , run
````bash
php artisan db:ssed
````
For testing , run
````bash
vendor/bin/phpunit tests/Feature/Table1Test.php
````
