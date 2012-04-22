#Pygmyfoto

Pygmyfoto is a crude solution for maintaining a no-frills photography blog. Pygmyfoto consists of several core components:

* The *pygmyfoto.sqlite* SQLite database for storing photo articles
* The *pygmyfoto.py* Python script that resizes photos, prompts the user to enter relevant info (title, description, tags), and saves the data in the database. The script automatically generates the database if it doesn't exist.
* The *pygmyfoto.php* PHP script that pulls articles from the *pygmyfoto.sqlite* database and renders them as a web page.
* The *pfarchive.php* page containing archived photos ( i.e., *pub* field set to 0).
* The *style.css* stylesheet that controls the appearance of web page rendered by the *pygmyfoto.php* script.

The current version of Pygmyfoto is a proof of concept and should be treated as such.

##Usage

Grab the latest release of software, unpack the downloaded archive, and move the resulting *pygmyfoto* directory to the document root of your server. Copy photos  to the directory, and run the *pygmyfoto.py* script in the terminal.  Point then your browser to *http://127.0.0.1/pygmyfoto/pygmyfoto.php* (replace *127.0.0.1* with the actual IP address or domain name of your server).

##Limitations

* Photos must reside in the *pygmyfoto* directory.
* The *pygmyfoto.py* can handle only one photo at the time.
* There is no easy way to mark specific photos as archived.