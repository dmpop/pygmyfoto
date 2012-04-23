Pygmyfoto is a crude solution for maintaining a no-frills photography blog.
The current version of Pygmyfoto is a proof of concept and should be treated as such.

##Usage

Grab the latest release of software, unpack the downloaded archive, and move the resulting *pygmyfoto* directory to the document root of your server. Create the *pygmyfoto/photos* directory. Add photos  to that directory, and run the *pygmyfoto-publish.py* script in the terminal.  Point then your browser to *http://127.0.0.1/pygmyfoto/* (replace *127.0.0.1* with the actual IP address or domain name of your server). To quickly manage published photos, use the *pygmyfoto-manage.py* script (type `h` for help). Point the browser to *http://127.0.0.1/pygmyfoto/phpliteadmin.php*  to access and manage the *pygmyfoto.sqlite* database.

##Limitations

* The *pygmyfoto-publish.py* can handle only one photo at a time.