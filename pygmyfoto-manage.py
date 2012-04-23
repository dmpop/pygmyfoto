#!/usr/bin/env python

__author__ = "Dmitri Popov [dmpop@linux.com]"
__copyright__ = "Copyleft 2012 Dmitri Popov"
__license__ = "GPLv3"
__version__ = "0.0.3"
__URL__ = "http://www.github.com/dmpop"

import sys, os, time

try:
	import sqlite3 as sqlite
except ImportError:
	from pysqlite2 import dbapi2 as sqlite

DB = "pygmyfoto.sqlite"

try:
	conn = sqlite.connect(DB)
	cursor = conn.cursor()
except:
	sys.exit("Connection to the SQLite database failed!")

command = ""

cursor.execute ("SELECT id, article FROM photos WHERE pub = '+' ORDER BY id ASC")
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
d	Delete record
h	Help
q	Quit"""

	elif command == "d":
		recordid = raw_input("Delete note ID: ")
		cursor.execute("DELETE FROM photos WHERE ID='"  +  recordid  +  "'")
		print '\nRecord has been deleted.'
		conn.commit()
	elif command == "a":
		recordid = raw_input("Record id: ")
		pub = "-"
		cursor.execute("UPDATE photos SET pub='"  +  pub +  "' WHERE id='"  +  recordid  +  "'")
		conn.commit()
		print "\nRecord has been archived."

cursor.close()
conn.close()