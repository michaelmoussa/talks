# Job Queues with Gearman

Demo / example code from my **Job Queues with Gearman** talk at the SoFloPHP user group.

## Initial Setup

This repository provides a pair of Vagrant VM configurations for running the sample code and playing with an "isolated" web application using an "isolated" Gearman worker. Run `vagrant up` to provision them, then run either `vagrant ssh web` or `vagrant ssh worker` to SSH into the web application server or the Gearman worker, respectively.
