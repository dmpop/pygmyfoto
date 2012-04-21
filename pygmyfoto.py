#!/usr/bin/env python

__author__ = "Dmitri Popov [dmpop@linux.com]"
__copyright__ = "Copyleft 2012 Dmitri Popov"
__license__ = "GPLv3"
__version__ = "0.0.1"
__URL__ = "http://www.github.com/dmpop"

import os, sys
import Image
import sqlite3 as sqlite

DB = "pygmyfoto.sqlite"
ENC = 'utf-8'

if os.path.exists(DB):
	print "The database already exists."
	CREATE = False
else:
	print "Creating a new database."
	CREATE = True

try:
	conn = sqlite.connect(DB)
	cursor = conn.cursor()
except:
	sys.exit("Connection to the SQLite database failed!")

if CREATE == True:
	CREATE_SQL = \
		"CREATE TABLE photos (\
		id INTEGER PRIMARY KEY UNIQUE NOT NULL,\
		article VARCHAR(1024),\
		tags VARCHAR(256),\
		pub INTEGER);"
	cursor.execute(CREATE_SQL)
	conn.commit()

def escapechar(sel):
	sel=sel.replace("\'", "\''")
	sel=sel.replace("\"", "\"""")
	return sel

try:
	conn = sqlite.connect(DB)
	cursor = conn.cursor()

	size = 500, 500

	photo = raw_input("Photo: ")
	ph = Image.open(photo)
	ph.thumbnail(size,Image.ANTIALIAS)
	ph.save("t_"+photo, "JPEG")

	title = raw_input("Title: ")
	header = "<h1>"+title+"</h1>"
	description = raw_input("Text: ")
	photolink = escapechar("<a href='"+photo+"'>"+"<img src='"+"t_"+photo+"'"+"></a>")
	article = header + "<p> " + description + "</p> " + photolink
	tags= raw_input("Tags: ")
	pub = 1
	sqlquery = "INSERT INTO photos (article, tags, pub) VALUES ('%s', '%s', '%s')" % (article, tags, pub)
	cursor.execute(sqlquery)
	conn.commit()
	print "All done!"
except:
	sys.exit("Something went wrong! Please try again.")