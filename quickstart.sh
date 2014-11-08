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

# Create quickstart directories
mkdir -p "$TARGET/protofast"
mkdir -p "$TARGET/templates"
mkdir -p "$TARGET/js"
mkdir -p "$TARGET/css"


# download the latest stabile quickstart files
echo "Downloading...."
curl -o "$TARGET/protofast/protofast.php" https://raw.githubusercontent.com/raphiz/protofast/master/protofast.php
curl -o "$TARGET/protofast.ini" https://raw.githubusercontent.com/raphiz/protofast/master/quickstart/protofast.ini
curl -o "$TARGET/index.php" https://raw.githubusercontent.com/raphiz/protofast/master/quickstart/index.php
curl -o "$TARGET/templates/base.html" https://raw.githubusercontent.com/raphiz/protofast/master/quickstart/templates/base.html
curl -o "$TARGET/templates/index.html" https://raw.githubusercontent.com/raphiz/protofast/master/quickstart/templates/index.html

# Print status message
echo "Done! You can now run \"php -S localhost:8000\" in the target directory to get started!"
