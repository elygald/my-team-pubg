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

``` bash
+--------+----------+----------------------------------------------+----------------------+------------------------------------------------------------------------+--------------+
| Domain | Method   | URI                                          | Name                 | Action                                                                 | Middleware   |
+--------+----------+----------------------------------------------+----------------------+------------------------------------------------------------------------+--------------+
|        | POST     | api/acceptinviteplayer/{invite_to_team_id}   | acceptInvitePlayer   | App\Http\Controllers\Api\InviteController@acceptInvitePlayer           | api,auth:api |
|        | POST     | api/acceptinviteteam/{invite_to_player_id}   | acceptInviteTeam     | App\Http\Controllers\Api\InviteController@acceptInviteTeam             | api,auth:api |
|        | POST     | api/inviteplayer                             | createInvitePlayer   | App\Http\Controllers\Api\InviteController@createInvitePlayer           | api,auth:api |
|        | POST     | api/inviteteam                               | createInviteTeam     | App\Http\Controllers\Api\InviteController@createInviteTeam             | api,auth:api |
|        | POST     | api/login                                    | login                | App\Http\Controllers\Api\RegisterController@login                      | api          |
|        | POST     | api/player                                   | create               | App\Http\Controllers\Api\PlayerController@create                       | api          |
|        | POST     | api/player/isInvite/{player_id}              | isInvite             | App\Http\Controllers\Api\PlayerController@isInvite                     | api,auth:api |
|        | POST     | api/player/{id}                              | update               | App\Http\Controllers\Api\PlayerController@update                       | api          |
|        | GET|HEAD | api/player/{name}                            | find                 | App\Http\Controllers\Api\PlayerController@find                         | api          |
|        | POST     | api/register/{player_id}                     | create               | App\Http\Controllers\Api\RegisterController@create                     | api          |
|        | POST     | api/rejectedinviteplayer/{invite_to_team_id} | rejectedInvitePlayer | App\Http\Controllers\Api\InviteController@rejectedInvitePlayer         | api,auth:api |
|        | POST     | api/rejectedinviteteam/{invite_to_player_id} | rejectedInviteTeam   | App\Http\Controllers\Api\InviteController@rejectedInviteTeam           | api,auth:api |
|        | POST     | api/team                                     | create               | App\Http\Controllers\Api\TeamController@create                         | api,auth:api |
|        | POST     | api/team/isInvite/{team_id}                  | isInvite             | App\Http\Controllers\Api\TeamController@isInvite                       | api,auth:api |
|        | GET|HEAD | api/team/{team_id}                           | show                 | App\Http\Controllers\Api\TeamController@show                           | api          |
|        | GET|HEAD | api/teams/{name}                             | find                 | App\Http\Controllers\Api\TeamController@find                           | api          |
|        | POST     | api/token/{id}                               | token                | App\Http\Controllers\Api\ApiTokenController@token                      | api          |
|        | POST     | api/update/{id}                              | update               | App\Http\Controllers\Api\RegisterController@update                     | api          |
|        | GET|HEAD | home                                         | home                 | App\Http\Controllers\HomeController@index                              | web,auth     |
|        | GET|HEAD | login                                        | login                | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST     | login                                        |                      | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | POST     | logout                                       | logout               | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | POST     | password/email                               | password.email       | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    |
|        | GET|HEAD | password/reset                               | password.request     | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    |
|        | POST     | password/reset                               | password.update      | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    |
|        | GET|HEAD | password/reset/{token}                       | password.reset       | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    |
|        | GET|HEAD | register                                     | register             | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
|        | POST     | register                                     |                      | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
+--------+----------+----------------------------------------------+----------------------+------------------------------------------------------------------------+--------------+
```

if everything is working, just access this route:

[localhost/api](http://localhost/api/)

and you rebreed this message 
``` bash
My team API version 0.0.1
```

You can test the api at this url

[My-Team API](http://myteamcsgo.com/api/)


###
