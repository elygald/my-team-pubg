### Starting

``` bash
# git clone 
git clone https://github.com/elygald/my-team-pubg.git

# access project directory
cd my-team-pubg

```
### Development Setup

the project using docker, with Laravel and Mysql

``` bash
# Config .env
it is necessary to rename the file '.env.exemple' to '.env'

mv .env.exemple .env

# Config Docker
cd docker 
docker-compose build 
docker-compose up -d  

# config Laravel 
docker exec my-team-pubg composer install

#run migrations
docker exec my-team-pubg php artisan migrate
```

#access the docker container
``` bash
docker exec -it my-team-pubg bash
```

#inside the container you can run laravel commands
``` bash
php artisan tinker
```

#list routes
``` bash
docker exec my-team-pubg php artisan route:list
```

if everything is working, just access this route:
``` bash
http://localhost/api/
```
and you rebreed this message 
``` bash
My team API version 0.0.1
```

###
