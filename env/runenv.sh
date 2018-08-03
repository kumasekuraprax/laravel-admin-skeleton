#!/bin/bash

sudo sysctl -w vm.max_map_count=262144
ln -sf .env.example .env
sudo docker start mmgroot_db
sudo docker-compose up
