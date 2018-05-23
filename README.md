# Domain Diary
Handy tool to keep records of your domains and track their expiration dates and DNS records.

# Installation

Step 1. Install PHP 7.1 or greater with MySql and Setup Composer

Step 2. Clone this repo to a desired location

```
git clone https://github.com/eyuva/domain-diary.git
```

Step 3. Configure basic environment variables

```
cp .env.example .env
``````

Step 4. Install dependencies using composer
```
composer install
```
Step 5. Generate a unique app key

```
php artisan key:generate
```

Step 5. Migrate database schema

```
php artisan migrate --seed
```
Step 6. Locally serve app using Valet or PHP's built-in development server

```
php artisan serve
```


# Contributions
Contributions are welcome and will be fully credited. We accept contributions via Pull Requests on [GitHub](https://github.com/eyuva/domain-diary).

# Loveware
This project can be used freely and if you **Love It** then **Star It**

# Credits
* [Vishal Sancheti](https://github.com/v1shky)

# License

The code in this repo and **The Laravel framework** are open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
