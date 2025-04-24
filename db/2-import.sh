#!/bin/bash

# Set MySQL credentials
DB_USER="root"
DB_NAME="vasdatabase_2"
DB_HOST="localhost"  

# Loop through all .sql files in the current directory
for file in *.sql; do
    echo "Importing $file into $DB_NAME..."
    mysql -h "$DB_HOST" -u "$DB_USER" -p "$DB_NAME" < "$file"
    
    if [ $? -eq 0 ]; then
        echo "$file imported successfully."
    else
        echo "Error importing $file!"
    fi
done

echo "All SQL files have been processed."
