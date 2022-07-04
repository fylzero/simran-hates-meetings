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
cp .env.example .env
touch database/database.sqlite
composer install
npm install
php artisan migrate:fresh --seed
npm run dev (to start Vite)
```
