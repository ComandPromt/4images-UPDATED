#!/bin/bash

echo -e
echo "CREATE USER 'root'@'%' WITH mysql.native_password BY 'root'";
echo -e 
echo "Reiniciar el servidor con systemctl restart mysql";
echo -e 

sudo mysql -u root -p
