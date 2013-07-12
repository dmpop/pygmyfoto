Pygmyfoto is a crude solution for publishing a photo roll on the web. The application allows you to give a brief description and assign tags for each published photo. In addition to that, Pygmyfoto automatically processes and displays key EXIF data (exposure, aperture, and ISO), adds a link to the full-size version of the photo, and generates a map URL. The latter lets you view the exact place where the photo was taken using the OpenStreetMap service (provided the photo has been geotagged). Pygmyfoto features a few creature comforts, including the search by tags functionality, rating capabilities, and simple view statistics.

##Requirements

* Apache server with PHP5
* ImageMagick
* ExifTool

##Installation and Usage

1. Install the required packages. On Debian and Ubuntu, this can be done by running the following command as root: `apt-get install apache2 php5 sqlite3 php5-sqlite imagemagick libimage-exiftool-perl git`

2. Switch then to the /var/www directory and clone Pygmyfoto’s GitHub repository: `sudo git clone https://github.com/dmpop/pygmyfoto.git`

3. Use the sudo `chown www-data:www-data -R pygmyfoto` command to change the directory's owner and group.

5. Switch to the *pygmyfoto* directory, open the *phpliteadmin.config.php* file in a text editor, and replace the default password by editing the *$password = “admin”;* line. Modify the default values in the *config.php* file, if necessary.

6. Add photos to the pygmyfoto/photos directory, run the `./pygmyfoto.sh` command in the terminal, and provide the required info.

7. Point the browser to *http://127.0.0.1/pygmyfoto* (replace *127.0.0.1* with the actual IP address or domain name of your server) to access Pygmyfoto.

8. To access and manage the *pygmyfoto.sqlite* database, make it writable using the `sudo chmod 600 pygmyfoto.sqlite` command. Point then the browser to *http://127.0.0.1/pygmyfoto/phpliteadmin.php* and log in using the password specified in the *phpliteadmin.config.php* file.

##Unpublish and Publish

To move a photo to the **Archive** section (i.e., unpublish the photo) using the *http://127.0.0.1/pygmyfoto/unpublish.php?id=1&psw=password* URL, where *1* is the actual ID number of the photo and *password* is the *psw* value specified in the *config.php* file.

To move a photo from the **Archive** section back to the main page (i.e., publish the photo), use the *http://127.0.0.1/pygmyfoto/publish.php?id=1&psw=password* URL.

##Known issues

* The *publish.php* and *unpublish.php* scripts have very weak password protection.
