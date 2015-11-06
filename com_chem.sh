#!/bin/bash

echo "Copy files to admin directory";
cp -R /home/nkorbut/www/chem/www/administrator/components/com_chem/* /home/nkorbut/www/chem/www/ins/com_chem/admin/
mv /home/nkorbut/www/chem/www/ins/com_chem/admin/com_chem.xml /home/nkorbut/www/chem/www/ins/com_chem

echo "Copy files to site directory";
cp -R /home/nkorbut/www/chem/www/components/com_chem/* /home/nkorbut/www/chem/www/ins/com_chem/site/

echo "Zip files to archive com_chem.zip";
cd /home/svit/www/chem/www/ins/com_chem
zip -r com_chem.zip .

#mv /home/nkorbut/www/chem/www/ins/com_chem.zip /home/nkorbut/www/chem/www/ins/com_chem

echo "Done";


