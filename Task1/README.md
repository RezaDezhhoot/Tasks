# Task1

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
Put some images in public or default storage  , then run
````bash
php artisan schedule:run
````
Or
````bash
php artisan image:resize
````
