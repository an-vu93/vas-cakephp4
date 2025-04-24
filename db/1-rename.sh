
#!/bin/bash
for file in *.sql; do
    table_name="${file%.sql}"  # Extract table name from filename
    sed -i "s/\`$table_name\`/\`tmp_$table_name\`/g" "$file"
done
