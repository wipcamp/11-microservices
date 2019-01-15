# 11-microservices


## Setting up Project for Development

1. Install vendor
```
composer install
```

2. Generate JWT Secret in `AuthenticateService`
```
php artisan jwt:secret
> yes
```

3. copy .env.example in `AuthenticateService` and `RegistrantService` to .env

4. Copy env `JWT_SECRET` from `AuthenticateService` to `RegistrantService`

5. Set env `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

6. Run `AuthenticateService`
```
php artisan serve
```

7. Run `RegistrantService`
```
php artisan serve --port 8001
```

## Migration Database 

cd AuthenticateService 
and
cd RegistrantService

```
php artisan migrate
```

Second migrate
```
php artisan migrate:fresh
php artisan migrate:refresh
```

## Seeding Database

```
php artisan seed
```
