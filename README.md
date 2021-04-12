## Install

- composer install
- php artisan migrate
- php artisan engez:migrate

## Configuration

set this keys in env file

- MOVIE_DB_API_KEY=YOUR_ACCOUNT_KEY
- MOVIE_API_PAGES=NUMBER_OF_PAGES

## To fetch data from api 
- php artisan Movie:cron
- php artisan queue:work

## run server
- php artisan serve

## api endpoint
run server to use endpoint
- /api/genres
- /api/movies
