#!/bin/bash

apt-get update

apt-get install apache2 sqlite3 php5 python python-imaging python-pyexiv2 php5-sqlite

echo "extension=pdo.so" >> /etc/php5/apache2/php.ini
echo "extension=pdo_sqlite.so" >> /etc/php5/apache2/php.ini
echo "extension=sqlite.so" >> /etc/php5/apache2/php.ini

/etc/init.d/apache2 restart