#!/bin/bash
mkdir ./assets -m 777
chmod a+w ./assets/ -R
mkdir ./protected/runtime -m 777
chmod a+w ./protected/runtime -R
chmod a+w -R ./uploads
chmod a+w protected/data/
chmod a+w protected/config/ -R

