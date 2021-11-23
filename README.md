# Compcust

##The task

Необходимо реализовать простую CRM систему на основе AdminLTE:
1. Вход осуществляется с помощью логина и пароль;
2. В CRM должен быть список компаний, возможность создать, изменить, удалить.
Должны быть валидаторы входящих данных;
3. Должен быть список клиентов компаний, возможность создать, изменить, удалить. Должны
быть валидаторы входящих данных;
4. Клиенты в базе данных должны быть связаны с компаниями;
5. Таблицы должны быть описаны с помощь миграций;
6. Таблицы должны наполняться тестовыми данными (возможность сгенерировать записи компаний и клиентов автоматически);
7. Реализовать три rest api метода:
   1. get_companies - должен возвращать список компаний в формате json с возможностью
      пагинации;
   2. get_clients - принимает айди компании, возвращает список клиентов в json с возможностью пагинации;
   3. get_client_companies - принимает айди клиента, возвращает список компаний связанных с клиентом.
8. При доступе к API должна происходить bearer авторизация.

## Preview info

The project was altered for self-educational purpose and now has more complicated structure with separate frontend and 
self-sufficient API.

## Local project setup

1. Set a database password. There are two ways:
    1. Automatic. Run bash script file `./passetup.sh`  
    OR 
    2. Manual: 
       - Set a password for `MYSQL_ROOT_PASSWORD` variable in `docker-compose.yml` file.
       - Set the same password for `DB_PASSWORD` variable in `backend/.env` file.


2. Start Docker and run migrations:
```bash
docker-compose up -d
docker-compose exec -w /var/www/backend compcust php artisan migrate
```

## Companies and customers autogeneration
To generate random companies and customers run command:
```bash
docker-compose exec -w /var/www/backend compcust php artisan db:seed
```
and follow instructions.


## Using frontend/backend command line
To be able to use frontend command line type in:
```bash
docker-compose exec -w /var/www/frontend compcust bash
```
Backend command line:
```bash
docker-compose exec -w /var/www/backend compcust bash
```

## Api docs
See api.yaml.
