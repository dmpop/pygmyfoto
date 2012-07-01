Pygmyfoto is a crude solution for publishing a photo roll on the web.

##Requirements

* Python 2.6
* Python Image Library
* pyexiv2
* Apache server with PHP5

##Installation and Usage

Install the required packages. On Debian and Ubuntu, this can be done by running the following command as root:

	apt-get install apache2 php5 sqlite3 php5-sqlite python python-imaging pyexiv2

Enable the PDO SQLite driver in Apache. To do this on Ubuntu or Debian-based Linux distributions, open then the *php.ini* file for editing in a text editor:

	nano /etc/php5/apache2/php.ini

Add then the following lines at the end of the file:

	extension=pdo.so
	extension=pdo_sqlite.so 
	extension=sqlite.so

Restart then Apache using the `/etc/init.d/apache2 restart` command.

Grab the latest release of software, unpack the downloaded archive, and move the resulting *pygmyfoto* directory to the document root of your server. Open the *phpliteadmin.php*  in a text editor and replace the default password by editing the *$password = "admin";* line. Add photos  to the *pygmyfoto/photos* directory, and run the `./pygmyfoto-publish.py photos/[foo.jpg]` command in the terminal (replace *foo.jpg* which the actual file name of the photo you want to publish).  Point then your browser to *http://127.0.0.1/pygmyfoto/* (replace *127.0.0.1* with the actual IP address or domain name of your server).  To access and manage the *pygmyfoto.sqlite* database, point the browser to *http://127.0.0.1/pygmyfoto/phpliteadmin.php* .