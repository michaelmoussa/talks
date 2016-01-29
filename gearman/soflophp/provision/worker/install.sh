#!/bin/bash

apt-get update
apt-get install -y php5-cli php5-dev libgearman-dev gearman-job-server supervisor

cp /vagrant/provision/worker/demo_worker.conf /etc/supervisor/conf.d
supervisorctl update

pecl install gearman

echo "extension=gearman.so" > /etc/php5/cli/conf.d/gearman.ini
