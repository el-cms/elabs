#!/bin/bash -   
#title          :setup.sh
#description    :Downloads extra plugins not available with Composer
#author         :Manuel Tancoigne
#date           :20160808
#version        :1
#usage          :./setup.sh
#notes          :
#bash_version   :4.3.30(1)-release
#============================================================================
# Some fancy stuff
EL_BOX_SHADOW_LIGHT="\xE2\x96\x91";
EL_BOX_SHADOW_DARK="\xE2\x96\x93";
EL_BOX_TOP_LINE="  ${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}${EL_BOX_SHADOW_LIGHT}";

export EL_BOX_SHADOW_LIGHT;
export EL_BOX_SHADOW_DARK;
export EL_BOX_TOP_LINE;

# Get the absolute path to current dir:
pushd `dirname .` > /dev/null;
ELABS_DIR=`pwd`;
popd > /dev/null;
# Make ELABS_DIR available in other scripts
export ELABS_DIR


echo ""
echo -e "${EL_BOX_TOP_LINE}";
echo -e "+-------------------------------------------------------------------+${EL_BOX_SHADOW_LIGHT}"
echo -e "|                                                                   |${EL_BOX_SHADOW_LIGHT}"
echo -e "|  \e[33mExperimentsLabs Updater\e[39m                                          |${EL_BOX_SHADOW_LIGHT}"
echo -e "|  \e[33m=======================\e[39m                                          |${EL_BOX_SHADOW_LIGHT}"
echo -e "|                                                                   |${EL_BOX_SHADOW_LIGHT}"
echo -e "+- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -+${EL_BOX_SHADOW_LIGHT}"
echo -e "|                                                                   |${EL_BOX_SHADOW_LIGHT}"
echo -e "| \e[34mNow, the installer will download some js and css files.\e[39m           |${EL_BOX_SHADOW_LIGHT}"
echo -e "| -------------------------------------------------------           |${EL_BOX_SHADOW_LIGHT}"
# Css/JS sources
./Sources/Sass/setup.sh update;

echo "";
echo -e "${EL_BOX_TOP_LINE}";
echo -e "+-------------------------------------------------------------------+${EL_BOX_SHADOW_LIGHT}"
echo -e "|                                                                   |${EL_BOX_SHADOW_LIGHT}"
echo -e "| \e[34mInstalling dependencies...\e[39m                                        |${EL_BOX_SHADOW_LIGHT}"
echo -e "| \e[34m--------------------------\e[39m                                        |${EL_BOX_SHADOW_LIGHT}"
echo -e "|                                                                   |${EL_BOX_SHADOW_LIGHT}"
echo -e "+-------------------------------------------------------------------+";
echo "";

cd $ELABS_DIR;

# Install dev ?
read -p "Do you want to update/install the development dependencies ? [Y/n]" INSTALLDEV;

while [[ ! "$INSTALLDEV" =~ ^(y|Y|n|N|)$ ]]; do
    read -p " > Please, choose 'y' or 'n' or nothing to use defaults." INSTALLDEV;
done;

case $INSTALLDEV in
    [yY]) INSTALLDEV='y';;
    [nN]) INSTALLDEV='n';;
    '') INSTALLDEV='y';;
esac;

if [ 'y' == "$INSTALLDEV" ]; then
    composer update;
elif [ 'n' == "$INSTALLDEV" ]; then
    composer update --no-dev;
fi;

echo -e "${EL_BOX_TOP_LINE}";
echo -e "+-------------------------------------------------------------------+${EL_BOX_SHADOW_LIGHT}"
echo -e "|                                                                   |${EL_BOX_SHADOW_LIGHT}"
echo -e "| \e[34mUpdating database...\e[39m                                              |${EL_BOX_SHADOW_LIGHT}"
echo -e "| \e[34m--------------------\e[39m                                              |${EL_BOX_SHADOW_LIGHT}"
echo -e "|                                                                   |${EL_BOX_SHADOW_LIGHT}"
echo -e "+-------------------------------------------------------------------+";
echo ""
bin/cake Migrations migrate

echo ""
echo -e "${EL_BOX_TOP_LINE}";
echo -e "+-------------------------------------------------------------------+${EL_BOX_SHADOW_LIGHT}"
echo -e "|                                                                   |${EL_BOX_SHADOW_LIGHT}"
echo -e "| \e[34mUpdate proccess is over.\e[39m                                          |${EL_BOX_SHADOW_LIGHT}"
echo -e "| \e[34m------------------------\e[39m                                          |${EL_BOX_SHADOW_LIGHT}"
echo -e "|                                                                   |${EL_BOX_SHADOW_LIGHT}"
echo -e "| Useful links:                                                     |${EL_BOX_SHADOW_LIGHT}"
echo -e "|   - Github: https://github.com/el-cms/elabs                       |${EL_BOX_SHADOW_LIGHT}"
echo -e "|   - Issues: https://github.com/el-cms/elabs/issues                |${EL_BOX_SHADOW_LIGHT}"
echo -e "|   - News: http://experimentslabs.com                              |${EL_BOX_SHADOW_LIGHT}"
echo -e "|                                                                   |${EL_BOX_SHADOW_LIGHT}"
echo -e "+-------------------------------------------------------------------+";
