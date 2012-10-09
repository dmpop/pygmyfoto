#!/bin/bash

if [ ! -f pygmyfoto.sqlite ];
	then
	sqlite3 pygmyfoto.sqlite "CREATE TABLE photos (id INTEGER PRIMARY KEY UNIQUE NOT NULL, title VARCHAR(512), description VARCHAR(1024), tags VARCHAR(256), exif VARCHAR(1024), osm VARCHAR(1024), dt DATE, published VARCHAR(1), count INTEGER DEFAULT 0);"
fi

echo "File path (e.g., photos/foo.jpeg):"
read FNAME

if [ ! -f $FNAME ];
	then
	echo "File doesn't exist!"
	exit 1
fi

echo "Title:"
read TITLE
echo "Description:"
read DESCRIPTION
echo "Tags:"
read TAGS

APERTURE=$(exiftool -S -t -fnumber $FNAME)
ISO=$(exiftool -S -t -iso $FNAME)
SHUTTERSPEED=$(exiftool -S -t -shutterspeed $FNAME)
DATE=$(date "+%F")

GPSLAT=$(exiftool -S -t -n -gpslatitude $FNAME)
GPSLON=$(exiftool -S -t -n -gpslongitude $FNAME)

EXIF="Shutter speed: $SHUTTERSPEED sec. Aperture: f/$APERTURE ISO: $ISO Date: $DATE"

convert $FNAME -resize "500x500>" $FNAME"_"
convert $FNAME -resize "1024x1024>" $FNAME

PHOTOURL="<a rel=''lightbox'' href=''$FNAME''><img class=''dropshadow'' src=''$FNAME""_''></a>"
DESCRIPTION="<h2>$TITLE</h2><p> $DESCRIPTION</p> $PHOTOURL"
OSM="http://www.openstreetmap.org/index.html?lat=$GPSLAT&lon=$GPSLON&zoom=18"

sqlite3 pygmyfoto.sqlite "INSERT INTO photos (title, description, tags, exif, osm, dt, published) VALUES ('$TITLE', '$DESCRIPTION', '$TAGS', '$EXIF', '$OSM', '$DATE', '1');"

echo "All done!"