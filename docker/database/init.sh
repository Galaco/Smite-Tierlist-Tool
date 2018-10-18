#!/bin/bash
echo "Creating database..."
mysql -u root -ppassword -e "DROP DATABASE IF EXISTS smite"
mysql -u root -ppassword -e "CREATE DATABASE smite"
# mysql -u root -ppassword Passw0rd! < /tmp/dump.sql

echo "Database created!"