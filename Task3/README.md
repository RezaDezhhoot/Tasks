# Task3

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
For seeding users , run (20,000 users per run)
````bash
php artisan db:ssed
````
Then run
````bash
php artisan queue:listen --timeout=0
php artisan schedule:run
````
