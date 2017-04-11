
# rm database.db
cat schema.sql | sqlite3 database.db
php insertproblem.php
sudo chmod 0777 -R .
