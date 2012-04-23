#!/usr/bin/env python

__author__ = "Dmitri Popov [dmpop@linux.com]"
__copyright__ = "Copyleft 2012 Dmitri Popov"
__license__ = "GPLv3"
__version__ = "0.0.3"
__URL__ = "http://www.github.com/dmpop"

import os, sys, time, Image

try:
	import sqlite3 as sqlite
except ImportError:
	from pysqlite2 import dbapi2 as sqlite

DB = "pygmyfoto.sqlite"
PHOTOS = "photos/"

if os.path.exists(DB):
	print "The database already exists."
	CREATE = False
else:
	print "A new database has been created."
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
		added DATE,\
		pub VARCHAR(1));"
	cursor.execute(CREATE_SQL)
	conn.commit()

def escapechar(sel):
	sel=sel.replace("\'", "\''")
	sel=sel.replace("\"", "\"""")
	return sel

added = time.strftime('%Y-%m-%d')

conn = sqlite.connect(DB)
cursor = conn.cursor()

size = 500, 500

photo = raw_input("Photo: ")
ph = Image.open(PHOTOS + photo)
ph.thumbnail(size,Image.ANTIALIAS)
ph.save(PHOTOS +  "t_" + photo, "JPEG")

title = raw_input("Title: ")
header = "<h1>"+title+"</h1>"
description = raw_input("Text: ")
photourl = escapechar("<a href='"+PHOTOS + photo+"'>"+"<img src='"+ PHOTOS + "t_"+photo+"'"+"></a>")
article = header + "<p> " + description + "</p> " + photourl
tags= raw_input("Tags: ")
pub = "+"
sqlquery = "INSERT INTO photos (article, tags, added, pub) VALUES ('%s', '%s', '%s', '%s')" % (article, tags, added, pub)
cursor.execute(sqlquery)
conn.commit()
print "All done!"