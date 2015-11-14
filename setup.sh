#!/bin/bash -   
#title          :setup.sh
#description    :Downloads extra plugins not available with Composer
#author         :Manuel Tancoigne
#date           :20151015
#version        :0      
#usage          :./setup.sh
#notes          :       
#bash_version   :4.3.30(1)-release
#============================================================================

# Gravatar plugin
cd plugins
wget https://github.com/LowG33kDev/cakephp-gravatar-plugin/archive/Cake-3.X.zip 
unzip Cake-3.X.zip
mv cakephp-gravatar-plugin-Cake-3.X Gravatar
rm Cake-3.X.zip
#./../bin/cake plugin load Gravatar

# Update autoloader
cd ../
composer dumpautoload

echo "Done"

