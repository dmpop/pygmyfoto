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

import sys, os

# Import the appropriate sqlite module

try:
	import sqlite3 as sqlite
except ImportError:
	from pysqlite2 import dbapi2 as sqlite

# Specify a database and reset the command variable

DB = "pygmyfoto.sqlite"
command = ""

# Try to connect to the database

try:
	conn = sqlite.connect(DB)
	cursor = conn.cursor()
except:
	sys.exit("Connection to the SQLite database failed!")

# Retrieve all records where published = 1

cursor.execute ("SELECT id, title FROM photos WHERE published = '1' ORDER BY id ASC")
for row in cursor:
	print "\n%s -- %s" % (row[0], row[1])

while command != "q":
	
	command = raw_input('\n>')

	if command == 'h':
			print """
===================
Commands:
===================

a	Archive record
s	Show archived records
r	Re-publish record
d	Delete record
h	Help
q	Quit"""

# This part is self-explanatory

	elif command == "a":
		recordid = raw_input("Record id: ")
		published = "0"
		cursor.execute("UPDATE photos SET published='"  +  published +  "' WHERE id='"  +  recordid  +  "'")
		conn.commit()
		print "\nRecord has been archived."

	elif command == "s":
		cursor.execute ("SELECT id, title FROM photos WHERE published = '0' ORDER BY id ASC")
		for row in cursor:
			print "\n%s -- %s" % (row[0], row[1])

	elif command == "r":
		recordid = raw_input("Record id: ")
		published = "1"
		cursor.execute("UPDATE photos SET published='"  +  published +  "' WHERE id='"  +  recordid  +  "'")
		conn.commit()
		print "\nRecord has been re-published."

	elif command == "d":
		recordid = raw_input("Record ID: ")
		cursor.execute("DELETE FROM photos WHERE ID='"  +  recordid  +  "'")
		print '\nRecord has been deleted.'
		conn.commit()

cursor.close()
conn.close()