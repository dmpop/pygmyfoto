#!/bin/bash

apt-get update

apt-get install apache2 php5 sqlite3 php5-sqlite imagemagick libimage-exiftool-perl git

echo "extension=pdo.so" >> /etc/php5/apache2/php.ini
echo "extension=pdo_sqlite.so" >> /etc/php5/apache2/php.ini
echo "extension=sqlite.so" >> /etc/php5/apache2/php.ini

/etc/init.d/apache2 restart

cd /var/www/
sudo git clone git://github.com/dmpop/pygmyfoto.git
sudo chmod 777 -R pygmyfoto/

echo "All done!"