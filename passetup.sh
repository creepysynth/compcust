#!/bin/sh

passwrd=$(tr -dc A-Za-z0-9 </dev/urandom | head -c 12)

if [ ! -s ./docker-compose.yml.example ]
then
  echo "ERROR: File ./docker-compose.yml.example does not exist or empty."
  exit 1
fi

if [ ! -s ./backend/.env.example ]
then
  echo "ERROR: File ./backend/.env.example does not exist or empty."
  exit 1
fi

if [ ! -s ./frontend/.env.example ]
then
  echo "ERROR: File ./frontend/.env.example does not exist or empty."
  exit 1
fi

sed "s/MYSQL_ROOT_PASSWORD:.*[[:space:]]*/MYSQL_ROOT_PASSWORD: $passwrd/" ./docker-compose.yml.example > ./docker-compose.yml
sed "s/DB_PASSWORD=.*[[:space:]]*/DB_PASSWORD=$passwrd/" ./backend/.env.example > ./backend/.env
cp frontend/.env.example frontend/.env

exit 0