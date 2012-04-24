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

import sys, os

try:
	import sqlite3 as sqlite
except ImportError:
	from pysqlite2 import dbapi2 as sqlite

DB = "pygmyfoto.sqlite"
command = ""

try:
	conn = sqlite.connect(DB)
	cursor = conn.cursor()
except:
	sys.exit("Connection to the SQLite database failed!")

cursor.execute ("SELECT id, article FROM photos WHERE pub = '1' ORDER BY id ASC")
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

	elif command == "a":
		recordid = raw_input("Record id: ")
		pub = "0"
		cursor.execute("UPDATE photos SET pub='"  +  pub +  "' WHERE id='"  +  recordid  +  "'")
		conn.commit()
		print "\nRecord has been archived."

	elif command == "s":
		cursor.execute ("SELECT id, article FROM photos WHERE pub = '0' ORDER BY id ASC")
		for row in cursor:
			print "\n%s -- %s" % (row[0], row[1])

	elif command == "r":
		recordid = raw_input("Record id: ")
		pub = "1"
		cursor.execute("UPDATE photos SET pub='"  +  pub +  "' WHERE id='"  +  recordid  +  "'")
		conn.commit()
		print "\nRecord has been re-published."

	elif command == "d":
		recordid = raw_input("Record ID: ")
		cursor.execute("DELETE FROM photos WHERE ID='"  +  recordid  +  "'")
		print '\nRecord has been deleted.'
		conn.commit()

cursor.close()
conn.close()