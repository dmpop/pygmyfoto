Pygmyfoto is a crude solution for publishing a photo roll on the web.

##Requirements

* Apache server with PHP5
* ImageMagick
* ExifTool

##Installation and Usage

1. Install the required packages. On Debian and Ubuntu, this can be done by running the following command as root: *apt-get install apache2 php5 sqlite3 php5-sqlite imagemagick libimage-exiftool-perl git*

2. Grab the latest release of Pygmyfoto, unpack the downloaded archive, and move the resulting *pygmyfoto* directory to the root of your server.
3. Open the *phpliteadmin.config.php*  file in a text editor and replace the default password by editing the *$password = "admin";* line.
4. Modify the default values in the *config.php* file, if necessary.
5. Add photos  to the *pygmyfoto/photos* directory, run the `./pygmyfoto.sh` command in the terminal, and provide the required info.
6. Point the browser to *http://127.0.0.1/pygmyfoto/* (replace *127.0.0.1* with the actual IP address or domain name of your server).
7. To access and manage the *pygmyfoto.sqlite* database, point the browser to *http://127.0.0.1/pygmyfoto/phpliteadmin.php* .

##Unpublish and Publish

To move a photo to the **Archive** section (i.e., unpublish the photo) using the *http://127.0.0.1/pygmyfoto/unpublish.php?id=1&psw=password* URL, where *1* is the actual ID number of the photo and *password* in the *psw* value specified in the *unpublish.php* file.

To move a photo from the **Archive** section back to the main page (i.e., publish the photo), use the *http://127.0.0.1/pygmyfoto/publish.php?id=1&psw=password* URL.

##Known issues

* The *publish.php* and *unpublish.php* scripts have very weak password protection.
