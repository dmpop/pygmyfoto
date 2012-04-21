#Pygmyfoto

Pygmyfoto is a crude solution for maintaining a no-frills photography blog. Pygmyfoto consists of three core components:

* The *pygmyfoto.sqlite* SQLite database for storing photo articles
* The *pygmyfoto.py* Python script that resizes photos, prompts the user to enter relevant info (title, description, tags), and saves the data in the database. The script automatically generates the database if it doesn't exist.
* The *pygmyfoto.php* PHP script that pulls articles from the *pygmyfoto.sqlite* database and renders them as a web page.

The current version of Pygmyfoto is a proof of concept and should be treated as such.