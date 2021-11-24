# Compcust

## The task

Make a simple CRM system based on AdminLTE:
1. Authentication with login and password;
2. CRM must have a list of companies, ability to create, edit and delete them. Data for creation and editing must be validated;
3. CRM must have a list of customers, ability to create, edit and delete them. Data for creation and editing must be validated;
4. Database customer and client records should be bound;
5. Database tables must be described with migrations;
6. Database customer and client records could be generated automatically;
7. Implement three REST API methods:
    1. get_companies - returns a list of companies in JSON format with ability to paginate;
    2. get_customers - returns a list of company's customers by its unique ID in JSON format with ability to paginate;
    3. get_customer_companies - returns a list of customer's companies by his unique ID in JSON format with ability to paginate;
8. API endpoints must be accessed with a bearer authorization 

## Preview info

The project was altered for self-educational purpose and now has more complicated structure with separate frontend and 
self-sufficient API.

## Local project setup

1. Set a database password. There are two ways:
    1. Automatic. Run bash script file `./passetup.sh`  
    OR 
    2. Manual: 
        - run:
            ```bash
            cp ./docker-compose.yml.example ./docker-compose.yml
            cp ./frontend.end.example ./frontend/.env
            cp ./backend/.env.example ./backend/.env
            ```
        - set a password for `MYSQL_ROOT_PASSWORD` variable in `docker-compose.yml` file;
        - set the same password for `DB_PASSWORD` variable in `backend/.env` file


2. Start Docker:
```bash
docker-compose up -d
```

3. Install packages and run migrations:
```bash
docker-compose exec -w /var/www/frontend compcust composer update
docker-compose exec -w /var/www/backend compcust composer update
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
See api.yaml

## Other info
**Notice:** If you want to restart Docker with --build flag and get "PermissionError: [Errno 13]", execute:
```bash
sudo chown $USER:$USER -R dbdata
```
