#Pygmyfoto

Pygmyfoto is a crude solution for maintaining a no-frills photography blog.

##Usage

Grab the latest release of software, unpack the downloaded archive, and move the resulting *pygmyfoto* directory to the document root of your server. Copy photos  to the directory, and run the *pygmyfoto-publish.py* script in the terminal.  Point then your browser to *http://127.0.0.1/pygmyfoto/* (replace *127.0.0.1* with the actual IP address or domain name of your server). To manage published photos, use the *pygmyfoto-manage.py* script.

##Limitations

* Photos must reside in the *pygmyfoto* directory.
* The *pygmyfoto-publish.py* can handle only one photo at a time.