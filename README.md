# Wodo GameHub Platform
Game Hub is an online social arena where wodo community members players play online Wodo games with other community members, join tournaments, and earn instant cryptocurrencies and NFTs while playing.
Plenty of games developed by Wodo Team and other game developers/companies are playable on the Wodo game hub.

---
## Requirements
- [PHP 8.1](https://www.php.net/releases/8.1/en.php)
- [MySQL 8](https://dev.mysql.com/doc/relnotes/mysql/8.0/en/)
- [Node](https://nodejs.org/en/)
- [NPM](https://www.npmjs.com)
- [Redis](https://redis.io)
- [php composer](https://getcomposer.org)
- [Soketi](https://soketi.app)

---
## Packages and Frameworks used in Wodo Gamehub
- [Laravel PHP Framework](https://laravel.com)
- [TailwindCSS](https://tailwindcss.com)
- [VueJS](https://vuejs.org)
- [InertiaJS](https://inertiajs.com)

---
## Local development on Mac
You can install [Laravel Valet](https://laravel.com/docs/9.x/valet) on your machine, By default it will install [Nginx](https://www.nginx.com), [Dnsmasq](https://en.wikipedia.org/wiki/Dnsmasq) using [Homebrew](https://brew.sh)

### Laravel valet usage
if your application located in `~/Dev/wg-game-hub` then go to `~/Dev` and run `valet park`
after that you access the web application from the browser `http://wg-game-hub.test`

> NOTE: Valet TLD is `.test` which means all laravel applications under `~/Dev` will be accessible automatically by `http://{PROJECT_NAME}.test` without editing your hosts file.

---
## Soketi Installation
```shell
npm install -g @soketi/soketi
```
---

## Steps to run the application for development (Valet, [Laravel Sail](https://laravel.com/docs/9.x/sail))
- Copy `.env.example` to `.env` and fill it with proper values
- Run database migrations `php artisan migrate`
- Seed the database with dummy data by running `php artisan wodo:gamehub-demo-seed`
- Run soketi in separate terminal `soketi start`
- Install and compile JS, CSS and UI Assets `npm install && npm run dev`

---
## Production Deployment
There is a `Dockerfile` ready in the root of the project.

// TODO: Add production deployment commands

