Pygmyfoto is a crude solution for publishing a photo roll on the web.
The current version of Pygmyfoto is a proof of concept and should be treated as such.

##Requirements

* Python 2.6
* Python Image Library (On Debian, install using the `apt-get install python-imaging` command)
* Apache server with PHP

##Usage

Grab the latest release of software, unpack the downloaded archive, and move the resulting *pygmyfoto* directory to the document root of your server. Create the *pygmyfoto/photos* directory. Add photos  to that directory, and run the `./pygmyfoto-publish.py [foo.jpg]` command in the terminal (replace *foo.jpg* which the actual file name of the photo you want to publish).  Point then your browser to *http://127.0.0.1/pygmyfoto/* (replace *127.0.0.1* with the actual IP address or domain name of your server). To quickly manage published photos, use the `./pygmyfoto-manage.py` command (type `h` for help). Point the browser to *http://127.0.0.1/pygmyfoto/phpliteadmin.php*  to access and manage the *pygmyfoto.sqlite* database.

##Limitations

* The *pygmyfoto-publish.py* script can handle only one photo at a time.