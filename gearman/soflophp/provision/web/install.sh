#!/bin/bash

apt-get update
apt-get install -y apache2 php5 php5-dev libgearman-dev

pecl install gearman
echo "extension=gearman.so" > /etc/php5/apache2/conf.d/gearman.ini

cp /vagrant/provision/web/files/zzz-custom.ini /etc/php5/apache2/conf.d
cp /vagrant/provision/web/files/000-default.conf /etc/apache2/sites-available

service apache2 restart
