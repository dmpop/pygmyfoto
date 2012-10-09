Pygmyfoto is a crude solution for publishing a photo roll on the web.

##Requirements

* Apache server with PHP5
* ImageMagick
* ExifTool

##Installation and Usage

Install the required packages. On Debian and Ubuntu, this can be done by running the following command as root:

	apt-get install apache2 php5 sqlite3 php5-sqlite imagemagick libimage-exiftool-perl

Enable the PDO SQLite driver in Apache. To do this on Ubuntu or Debian-based Linux distributions, open then the *php.ini* file for editing in a text editor:

	nano /etc/php5/apache2/php.ini

Add then the following lines at the end of the file:

	extension=pdo.so
	extension=pdo_sqlite.so 
	extension=sqlite.so

Restart then Apache using the `/etc/init.d/apache2 restart` command.

Grab the latest release of Pygmyfoto, unpack the downloaded archive, and move the resulting *pygmyfoto* directory to the root of your server. Open the *phpliteadmin.php*  file in a text editor and replace the default password by editing the *$password = "admin";* line. Add photos  to the *pygmyfoto/photos* directory, and run the `./pygmyfoto.sh` command in the terminal and provide the required info. Point then your browser to *http://127.0.0.1/pygmyfoto/* (replace *127.0.0.1* with the actual IP address or domain name of your server).  To access and manage the *pygmyfoto.sqlite* database, point the browser to *http://127.0.0.1/pygmyfoto/phpliteadmin.php* .

##Known issues

When using the *pygmyfoto.sh* script, single quotes must be escaped manually. For example: *It''s complicated* instead of *It's complicated*.