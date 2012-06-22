#!/usr/bin/env python
# -*- coding: utf-8 -*-
   
#       This program is free software; you can redistribute it and/or modify
#       it under the terms of the GNU General Public License as published by
#       the Free Software Foundation; either version 3 of the License, or
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

import os, sys, time, Image, pyexiv2

# Import the appropriate sqlite module

try:
	import sqlite3 as sqlite
except ImportError:
	from pysqlite2 import dbapi2 as sqlite

# Specify a database

DB = "pygmyfoto.sqlite"

# Check whether the database exists

if os.path.exists(DB):
	CREATE = False
else:
	print "A new database has been created."
	CREATE = True

# Try to connect to the database

try:
	conn = sqlite.connect(DB)
	cursor = conn.cursor()
except:
	sys.exit("Connection to the SQLite database failed!")

# If the database doesn't exist, create it

if CREATE == True:
	CREATE_SQL = \
		"CREATE TABLE photos (\
		id INTEGER PRIMARY KEY UNIQUE NOT NULL,\
		title VARCHAR(512),\
		description VARCHAR(1024),\
		tags VARCHAR(256),\
		exif VARCHAR(1024),\
		dt DATE,\
		published VARCHAR(1));"
	cursor.execute(CREATE_SQL)
	conn.commit()

# Define a function for escaping " and '  in SQL queries

def escapechar(sel):
	sel=sel.replace("\'", "\''")
	sel=sel.replace("\"", "\"""")
	return sel

# Specify date format and resizing dimensions

dt = time.strftime('%Y-%m-%d')
rsize = 1024, 1024
thumbsize = 500, 500

try:
	# Resize the specified file

	photo = Image.open(sys.argv[1])
	photo.thumbnail(thumbsize,Image.ANTIALIAS)
	photo.save(sys.argv[1] + "_", "JPEG")

	# Retrieve and process EXIF metadata

	try:
		metadata = pyexiv2.ImageMetadata(sys.argv[1])
		metadata.read()
		exposure = metadata['Exif.Photo.ExposureTime']
		fnumber= metadata['Exif.Photo.FNumber']
		iso = metadata['Exif.Photo.ISOSpeedRatings']
		foclen = metadata['Exif.Photo.FocalLength']
		date = metadata['Exif.Photo.DateTimeOriginal']

		# Extract and format values from Exif.Photo.ExposureTime and Exif.Photo.FocalLength

		fnr1 = str(fnumber.value)
		fnr2 = fnr1.split("/")
		aperture = float(fnr2[0])/float(fnr2[1])
		f = str(foclen.value)
		f2 = f.split("/")
		focallength = float(f2[0])/float(f2[1])

		# Put all retrieved and formatted EXIF values together

		exif = "Shutter speed: " + str(exposure.value) + " sec. " + "Aperture: " + str(aperture) + " Focal length: " + str(focallength) + "mm " + "ISO: " + str(iso.value) + " Timestamp: " + str(date.value)
	except:
		exif = "No EXIF  metadata available"

	# Prompt the user to enter title and description, then add a dash of HTML formatting to them

	title = escapechar(raw_input("Title: "))
	description = escapechar(raw_input("Text: "))
	photourl = escapechar("<a rel='lightbox' href='"+sys.argv[1]+"'>"+"<img class='dropshadow' src='"+ sys.argv[1] +"_" +"'"+"></a>")
	description = "<h2>"+title+"</h2>" + "<p> " + description + "</p> " + photourl
	tags= raw_input("Tags: ")
	published = "1"

	# Insert all the pieces into the appropriate fields of the 'photos' table, commit the  insert, and close the database connection

	sqlquery = "INSERT INTO photos (title, description, tags, exif, dt, published) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')" % (title, description, tags, exif, dt, published)
	cursor.execute(sqlquery)
	conn.commit()
	cursor.close()
	conn.close()

	photo = Image.open(sys.argv[1])
	photo.thumbnail(rsize,Image.ANTIALIAS)
	photo.save(sys.argv[1] , "JPEG")

	# And we are done!
	
	print "All done!"
except:
	sys.exit("Something went wrong. Please try again.")