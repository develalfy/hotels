## Hotels for Tajawal

 - This app build with [ Laravel 5.4 ].
 - These must be on your system:-
	 - you must use `PHP 7.1` to run this on your machine, if you faced any problems related to `doctrine/instantiator` update to `PHP 7.1` or check [This link](https://github.com/laravel/framework/issues/20255).
	 - PHPUnit must be installed also on your system if using **Arch**`sudo pacman -S phpunit`, if **Ubuntu** `sudo apt-get install phpunit` ...etc
	 - Also check these if there is any problem [Server Requirements](https://laravel.com/docs/5.4/installation#server-requirements).
 - Follow these steps to run smoothly:-
	 - Clone the app:-
		 -`git clone git@github.com:develalfy/hotels.git` .
		 - Enter project directory
		 - run `cp .env.example .env`.
		 - run `php artisan key:generate`
		 - run `chmod -R 777 storage bootstrap/cache` .
		 - run `composer install` .
	 - run this command to serve the app `php artisan serve`  .
	 - head to `http://localhost:8000/api/hotels` to check if running correctly. 
		 - [optional] you can use your path like this. [Server Link](http://elalfi.me/hotels/public/api/hotels)

----------
## URLS
- main URL like this `http://localhost:8000/api/hotels`
	- Use these parameters (one or all): `name, city, price_from, price_to, date_from, date_to, sort, sort_type` :-
		- Example:`http://localhost:8000/api/hotels?price_to=100&sort=price&sort_type=desc`.
		- Demo:-`http://elalfi.me/hotels/public/api/hotels?price_to=100&sort=price&sort_type=desc`.

----------
## PHPUnit
run `vendor/bin/phpunit`

----------

**Thank you**