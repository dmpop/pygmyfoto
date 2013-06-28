#!/bin/bash

apt-get update

apt-get install apache2 php5 sqlite3 php5-sqlite imagemagick libimage-exiftool-perl git

cd /var/www/
sudo git clone git://github.com/dmpop/pygmyfoto.git
sudo chmod 777 -R pygmyfoto/

echo "All done!"
