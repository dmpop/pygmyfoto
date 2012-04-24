#!/usr/bin/env python
# -*- coding: utf-8 -*-
   
#       This program is free software; you can redistribute it and/or modify
#       it under the terms of the GNU General Public License as published by
#       the Free Software Foundation; either version 2 of the License, or
#       (at your option) any later version.
#       
#       This program is distributed in the hope that it will be useful,
#       but WITHOUT ANY WARRANTY; without even the implied warranty of
#       MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#       GNU General Public License for more details.
#       
#       You should have received a copy of the GNU General Public License
#       along with this program; if not, write to the Free Software
#       Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
#       MA 02110-1301, USA.

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
size = 500, 500

photo = raw_input("Photo: ")
ph = Image.open(PHOTOS + photo)
ph.thumbnail(size,Image.ANTIALIAS)
ph.save(PHOTOS +  "t_" + photo, "JPEG")

title = raw_input("Title: ")
header = "<h2>"+title+"</h2>"
description = raw_input("Text: ")
photourl = escapechar("<a href='"+PHOTOS + photo+"'>"+"<img src='"+ PHOTOS + "t_"+photo+"'"+"></a>")
article = header + "<p> " + description + "</p> " + photourl
tags= raw_input("Tags: ")
pub = "1"
sqlquery = "INSERT INTO photos (article, tags, added, pub) VALUES ('%s', '%s', '%s', '%s')" % (article, tags, added, pub)

cursor.execute(sqlquery)
conn.commit()

print "All done!"

cursor.close()
conn.close()