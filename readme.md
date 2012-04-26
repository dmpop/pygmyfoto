Pygmyfoto is a crude solution for publishing a photo roll on the web.
The current version of Pygmyfoto is a proof of concept and should be treated as such.

##Requirements

* Python 2.6
* Python Image Library
* pyexiv2
* Apache server with PHP

##Installation and Usage

Install the required dependencies. On Debian and Ubuntu, this can be done using the `apt-get install python-imaging pyexiv2` command as root.

Install and enable the PDO SQLite driver in Apache. To do this on Ubuntu or Debian-based Linux distributions, install the *php5-sqlite* package by running the `apt-get install php5-sqlite` command as root. Open then the *php.ini* file for editing in a text editor:

	nano /etc/php5/apache2/php.ini

Add then the following lines at the end of the file:

	extension=pdo.so
	extension=pdo_sqlite.so 
	extension=sqlite.so

Restart then Apache using the `/etc/init.d/apache2 restart` command.

Grab the latest release of software, unpack the downloaded archive, and move the resulting *pygmyfoto* directory to the document root of your server. Create the *pygmyfoto/photos* directory. Add photos  to that directory, and run the `./pygmyfoto-publish.py [foo.jpg]` command in the terminal (replace *foo.jpg* which the actual file name of the photo you want to publish).  Point then your browser to *http://127.0.0.1/pygmyfoto/* (replace *127.0.0.1* with the actual IP address or domain name of your server). To quickly manage published photos, use the `./pygmyfoto-manage.py` command (type `h` for help). Point the browser to *http://127.0.0.1/pygmyfoto/phpliteadmin.php*  to access and manage the *pygmyfoto.sqlite* database.

##Limitations

* The *pygmyfoto-publish.py* script can handle only one photo at a time.