# Simran Hates Meetings

> A web application to publicly shame a coworker who is constantly pushing meetings.

## To Run Locally

SSH:

```
git clone git@github.com:fylzero/simran-hates-meetings.git
```

HTTPS:

```
git clone https://github.com/fylzero/simran-hates-meetings.git
```

```
npm install
composer install
touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan serve
```
