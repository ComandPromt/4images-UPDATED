
#!/bin/bash

echo -e
echo "use mysql;";
echo -e 
echo "CREATE USER 'root'@'%' WITH mysql.native_password BY 'root';"
echo -e 
echo "CREATE USER 'root'@'localhost' IDENTIFIED BY 'password';"
echo -e 
echo "GRANT ALL PRIVILEGES on *.* TO 'root'@'localhost' IDENTIFIED BY 'password';"
echo -e 
echo "Reiniciar el servidor con systemctl restart mysql";
echo -e 

sudo mysql -u root -p
