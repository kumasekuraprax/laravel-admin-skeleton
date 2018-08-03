#!/bin/bash

sudo sysctl -w vm.max_map_count=262144
ln -sf ./env/dev.env .env
sudo docker-compose up --build
