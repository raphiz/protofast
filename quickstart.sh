#!/usr/bin/env bash

# Check if a target dir is given. If not, use cwd.
if [[ -z "$1" ]]; then
  TARGET="./"
else
  TARGET=$1
fi

# If the current directory is not empty, abort.
if [ "$(ls -A $TARGET)" ]; then
     echo "The target directory ($TARGET) is not empty!"
     exit 1
fi

# Ask if composer shall be used
read -p "Do you want to use composer? (y/N) " -n 1 -r
USE_COMPOSER=false
if [[ $REPLY =~ ^[Yy]$ ]]; then
  USE_COMPOSER=true
fi


# download the latest stabile quickstart files
VERSION=$(curl -s -i "https://github.com/raphiz/protofast/releases/latest/" | grep -Fi Location | sed 's/Location:.*\/tag\///g')
VERSION=${VERSION%?}
echo "Latest version is $VERSION"

# Create quickstart directories
mkdir -p "$TARGET/templates"
mkdir -p "$TARGET/js"
mkdir -p "$TARGET/css"

echo "Downloading...."
#BASE_URL="https://raw.githubusercontent.com/raphiz/protofast/$VERSION"
BASE_URL="file:///home/rzi/Projects/protofast"

curl -s -o "$TARGET/protofast.ini" $BASE_URL/quickstart/composer.json
curl -s -o "$TARGET/protofast.ini" $BASE_URL/quickstart/protofast.ini
curl -s -o "$TARGET/templates/base.html" $BASE_URL/quickstart/templates/base.html
curl -s -o "$TARGET/templates/index.html" $BASE_URL/quickstart/templates/index.html

if [ "$USE_COMPOSER" = true ] ; then
  curl -s -o "$TARGET/composer.json" $BASE_URL/quickstart/composer.json
  curl -s -o "$TARGET/index.php" $BASE_URL/quickstart/index_composer.php
  echo "Done! Modify the composer.json file and then run \"composer install\""
  echo "After that, you can run \"php -S localhost:8000\" in the target directory to get started!"
else
  mkdir -p "$TARGET/protofast"
  curl -s -o "$TARGET/protofast/HTMLPage.php" $BASE_URL/lib/HTMLPage.php
  curl -s -o "$TARGET/index.php" $BASE_URL/quickstart/index.php
  echo "Done! You can run \"php -S localhost:8000\" in the target directory to get started!"
fi
