#!/bin/bash

if [ ! -f pygmyfoto.sqlite ];
	then
	sqlite3 pygmyfoto.sqlite "CREATE TABLE photos (id INTEGER PRIMARY KEY UNIQUE NOT NULL, title VARCHAR, description VARCHAR, tags VARCHAR, exif VARCHAR, osm VARCHAR, dt DATE, original VARCHAR, published VARCHAR(1), count INTEGER DEFAULT 0);"
fi

echo "File path (e.g., photos/foo.jpeg):"
read FPATH

if [ ! -f $FPATH ];
	then
	echo "File doesn't exist!"
	exit 1
fi

FNAME=$(basename $FPATH)
FDIR=$(dirname $FPATH)
ORIGDIR=$FDIR/originals/$FNAME

echo $ORIGDIR

if [ ! -d $FDIR/originals ];
      then
      mkdir $FDIR/originals
fi

cp $FPATH $ORIGDIR

echo "Title:"
read TITLE
echo "Description:"
read DESCRIPTION
echo "Tags:"
read TAGS

APERTURE=$(exiftool -S -t -fnumber $FPATH)
if [ -z $APERTURE ];
      then
      APERTURE=" - "
      else APERTURE="f/"$APERTURE
fi
ISO=$(exiftool -S -t -iso $FPATH)
if [ -z $ISO ];
      then
      ISO=" - "
fi
SHUTTERSPEED=$(exiftool -S -t -shutterspeed $FPATH)
if [ -z $SHUTTERSPEED ];
      then
      SHUTTERSPEED=" - "
      else SHUTTERSPEED=$SHUTTERSPEED" sec."
fi
DATE=$(date "+%F")

GPSLAT=$(exiftool -S -t -n -gpslatitude $FPATH)
GPSLON=$(exiftool -S -t -n -gpslongitude $FPATH)

EXIF="Shutter speed: $SHUTTERSPEED Aperture: $APERTURE ISO: $ISO Date: $DATE"

PHOTOURL="<a rel=''lightbox'' href=''$FPATH''><img class=''dropshadow'' src=''$FPATH""_''></a>"
DESCRIPTION="<p>$DESCRIPTION</p> $PHOTOURL"
OSM="http://www.openstreetmap.org/index.html?mlat=$GPSLAT&mlon=$GPSLON&zoom=18"

sqlite3 pygmyfoto.sqlite "INSERT INTO photos (title, description, tags, exif, osm, dt, original, published) VALUES ('$TITLE', '$DESCRIPTION', '$TAGS', '$EXIF', '$OSM', '$DATE', '$ORIGDIR', '1');"

convert $FPATH -resize "500x500>" $FPATH"_"
convert $FPATH -resize "1024x1024>" $FPATH

echo "All done!"
