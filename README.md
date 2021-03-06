### Sample Search Microservice

A Dockerized sample microservice for search comes with Symfony 4

Installlation:

Copy `.env.dist` to `.env`

Start docker:

```
docker-compose up
```

Go to php container, install composer and make database migrations:

```
docker ps
```

```
docker exec -it {php_container_id} bash
```

```
/app# composer install
/app# console doctrine:migrations:migrate
```

Follow instructions to create .pem files for API authentication (use pass phrase from the env file while creating the files!)

https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md#generate-the-ssh-keys

Configure it in `.env` file

Add this to `/etc/hosts` file

```
127.0.0.1 search.service
```

Browse to api doc

```
http://search.service
```

Test User:
```
username: test
password: test
```


