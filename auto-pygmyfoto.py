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

from PIL import Image
import time, glob, os, pyexiv2, shutil

dt = time.strftime('%Y-%m-%d')
rsize = 1024, 1024
thumbsize = 500, 500

# Define a function for escaping " and '  in SQL queries

def escapechar(sel):
	sel=sel.replace("\'", "\''")
	sel=sel.replace("\"", "\"""")
	return sel

try:
	import sqlite3 as sqlite
except ImportError:
	from pysqlite2 import dbapi2 as sqlite

# Specify a database

DB = "pygmyfoto.sqlite"

# Connect to the database

conn = sqlite.connect(DB)
cursor = conn.cursor()

# For all .jpeg files in the uploads directory...

for infile in glob.glob("uploads/*.jpeg"):

	# Obtain the file path and the file name

	file, ext = os.path.splitext(infile)
	fname = os.path.basename(file)

	#Generate a thumbnail
	
	photo = Image.open(infile)
	photo.thumbnail(thumbsize, Image.ANTIALIAS)
	photo.save("photos/" + fname + ext + "_", "JPEG")
	
	# Retrieve and process EXIF metadata

	metadata = pyexiv2.ImageMetadata(infile)
	metadata.read()
	exposure = metadata['Exif.Photo.ExposureTime']
	fnumber= metadata['Exif.Photo.FNumber']
	iso = metadata['Exif.Photo.ISOSpeedRatings']
	date = metadata['Exif.Photo.DateTimeOriginal']

	# Extract and format values from Exif.Photo.FNumber

	try:
		fnr1 = str(fnumber.value)
		fnr2 = fnr1.split("/")
		aperture = float(fnr2[0])/float(fnr2[1])
	except:
		aperture = fnr1

	# Put all retrieved and formatted EXIF values together

	exif = "Shutter speed: " + str(exposure.value) + " sec. " + "Aperture: f/" + str(aperture) + " ISO: " + str(iso.value) + " Timestamp: " + str(date.value)

	photourl = escapechar("<a rel='lightbox' href='"+ "photos/" + fname + ext +"'>"+"<img class='dropshadow' src='"+ "photos/" + fname + ext + "_" + "'" + "></a>")
	description = "<h2>" + fname +"</h2>" + "<p> " + "Processed and uploaded automatically." + "</p> " + photourl
	tags = "automatic upload"
	published = "1"

	# Insert all the pieces into the appropriate fields of the 'photos' table, commit the  insert, and close the database connection

	sqlquery = "INSERT INTO photos (title, description, tags, exif, dt, published) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')" % (fname, description, tags, exif, dt, published)
	cursor.execute(sqlquery)
	conn.commit()
	cursor.close()
	conn.close()

	# Resize the original to fit in the lightbox overlay

	file, ext = os.path.splitext(infile)
	photo = Image.open(infile)
	photo.thumbnail(rsize, Image.ANTIALIAS)
	photo.save("photos/" + fname + ext, "JPEG")

# Empty the uploads directory

files = glob.glob('uploads/*')
for f in files:
	os.remove(f)