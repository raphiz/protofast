#!/usr/bin/env bash

# test if dir is empty...
if [[ -z "$1" ]]; then
  TARGET="./"
else
  TARGET=$1
fi
if [ "$(ls -A $TARGET)" ]; then
     echo "The target directory ($TARGET) is not empty!"
     exit 1
fi

# Create directories
mkdir -p "$TARGET/protofast"
mkdir -p "$TARGET/templates"
mkdir -p "$TARGET/js"
mkdir -p "$TARGET/css"


# download the latest stabile
#curl -o protofast.php https://github.com/raphiz/protofast/...
echo "Downloading...."
cp protofast.php "$TARGET/protofast/"

# Create empty protofast.ini
cp quickstart/protofast.ini "$TARGET"

# create example index.php
cp quickstart/index.php "$TARGET"

# create example base.html
cp quickstart/templates/base.html "$TARGET/templates/"

# create example index.html
cp quickstart/templates/index.html "$TARGET/templates/"


echo "Done! You can now run \"php -S localhost:8000\" in the target directory to get started!"
