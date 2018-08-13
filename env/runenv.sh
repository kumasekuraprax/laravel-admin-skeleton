#!/bin/bash

ln -sf ./env/dev.env .env
sudo docker-compose up --build
