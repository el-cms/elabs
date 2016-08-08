#!/bin/bash -   
#title          :setup.sh
#description    :Downloads sources to build css
#author         :Manuel Tancoigne
#date           :20151112
#version        :0      
#usage          :./setup.sh
#notes          :       
#bash_version   :4.3.30(1)-release
#============================================================================

WEBROOT=$ELABS_DIR"/webroot";

echo -e "|                                                                   |${EL_BOX_SHADOW_LIGHT}";
echo -e "| \e[34mNotes about Prism js/css\e[39m                                          |${EL_BOX_SHADOW_LIGHT}";
echo -e "| \e[34m------------------------\e[39m                                          |${EL_BOX_SHADOW_LIGHT}";
echo -e "| As prism is not directly downloadable, a version is included in   |${EL_BOX_SHADOW_LIGHT}";
echo -e "| this repo. To update it, go to the adress in commented in the     |${EL_BOX_SHADOW_LIGHT}";
echo -e "| file webroot/js/lib/prism.js and download both JS/CSS             |${EL_BOX_SHADOW_LIGHT}";
echo -e "|                                                                   |${EL_BOX_SHADOW_LIGHT}";
echo -e "| \e[34mNotes about the sources\e[39m                                           |${EL_BOX_SHADOW_LIGHT}";
echo -e "| \e[34m-----------------------\e[39m                                           |${EL_BOX_SHADOW_LIGHT}";
echo -e "| The installer is going to download some packages to take some js  |${EL_BOX_SHADOW_LIGHT}";
echo -e "| files in them. Those packages are also used to generate the       |${EL_BOX_SHADOW_LIGHT}";
echo -e "| custom css files. You can keep these sources if you plan to       |${EL_BOX_SHADOW_LIGHT}";
echo -e "| change the styles of the app by yourself.                         |${EL_BOX_SHADOW_LIGHT}";
echo -e "|                                                                   |${EL_BOX_SHADOW_LIGHT}";
echo -e "| \e[34mNotes about this installer\e[39m                                        |${EL_BOX_SHADOW_LIGHT}";
echo -e "| \e[34m--------------------------\e[39m                                        |${EL_BOX_SHADOW_LIGHT}";
echo -e "| If you don't run this tool for the first time, please MANUALLY    |${EL_BOX_SHADOW_LIGHT}";
echo -e "| REMOVE THE EXISTING DIRECTORIES FROM Sources/Sass/common/.        |${EL_BOX_SHADOW_LIGHT}";
echo -e "| You should ONLY have the 'custom' dir and some scss files.        |${EL_BOX_SHADOW_LIGHT}";
echo -e "|                                                                   |${EL_BOX_SHADOW_DARK}";
echo -e "+-------------------------------------------------------------------+";
echo '';

# Keep the sources ?
read -p "Do you want to keep the sources needed to build the css ? [Y/n]" KEEPSOURCES;

while [[ ! "$KEEPSOURCES" =~ ^(y|Y|n|N|)$ ]]; do
    read -p " > Please, choose 'y' or 'n' or nothing to use defaults." KEEPSOURCES;
done;

case $KEEPSOURCES in
    [yY]) KEEPSOURCES='y';;
    [nN]) KEEPSOURCES='n';;
    '') KEEPSOURCES='y';;
esac;
echo "";

cd $ELABS_DIR"/Sources/Sass/common/";

echo -e "\e[34m Downloading...\e[39m";
echo -e "\e[34m --------------\e[39m";

# TBS3
# ====
echo " > Getting latest Bootstrap files";
wget -q "https://github.com/twbs/bootstrap-sass/archive/v3.3.5.tar.gz"
tar zxf v3.3.5.tar.gz
rm -f v3.3.5.tar.gz
mv -f "bootstrap-sass-3.3.5" "bootstrap-sass"
# Needed file
cp -f "bootstrap-sass/assets/javascripts/bootstrap.min.js" "$WEBROOT/js/"

# FontAwesome
# ===========
echo " > Getting latest FontAwesome files";
wget -q "https://github.com/FortAwesome/Font-Awesome/archive/master.zip"
unzip -u -q master.zip
rm master.zip -f
# Needed files
cp -f Font-Awesome-master/fonts/* "$WEBROOT/fonts/"

# jQuery
# ======
echo " > Getting latest jQuery script";
wget -q "http://code.jquery.com/jquery-1.11.3.min.js" -O "$WEBROOT/js/lib/jquery.min.js"

# MomentJS
#echo " > Getting latest MomentJS script";
#wget -q "http://momentjs.com/downloads/moment-with-locales.min.js" -O "$WEBROOT/js/moment-with-locales.min.js"


# CodeMirror
# ==========
echo " > Getting latest CodeMirror files and extensions";
wget -q "http://codemirror.net/codemirror.zip"
unzip -u -q codemirror.zip
rm -f codemirror.zip
mv -f codemirror-* codemirror
# Needed files:
# Main files
cp -f "codemirror/lib/codemirror.css" "$WEBROOT/css/"
cp -f "codemirror/lib/codemirror.js" "$WEBROOT/js/lib/"
# Addons
cp -f "codemirror/addon/edit/matchbrackets.js" "$WEBROOT/js/lib/codemirror/"
cp -f "codemirror/addon/selection/active-line.js" "$WEBROOT/js/lib/codemirror/"
# Modes
cp -f "codemirror/mode/markdown/markdown.js" "$WEBROOT/js/lib/codemirror/modes/"
cp -f "codemirror/mode/xml/xml.js" "$WEBROOT/js/lib/codemirror/modes/"

# BootFlat (TBS theme)
# ====================
echo " > Getting latest BootFlat files";
wget -q "https://github.com/bootflat/bootflat.github.io/archive/master.zip"
unzip -u -q master.zip
rm master.zip -f
cp bootflat.github.io-master/bootflat/js/jquery.fs.selecter.min.js $WEBROOT/js/lib

# Typeahead
# =========
# wget -q "http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js" -O "$WEBROOT/js/lib/typeahead.bundle.js"

# TagInput
# ========
# wget -q "https://codeload.github.com/bootstrap-tagsinput/bootstrap-tagsinput/zip/latest"
# unzip -u -q latest
# rm -f latest
# mv "bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css" "bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.scss"
# cp "bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.min.js" "$WEBROOT/js/"

# Remove the sources
# ==================
if [ 'n' == $KEEPSOURCES ]; then
    echo -e "";
    echo "...Removing downloaded sources";
    rm -rf "bootstrap-sass";
    rm -rf "Font-Awesome-master";
    rm -rf "codemirror";
    rm -rf "bootflat.github.io-master";
    # rm -rf "bootstrap-tagsinput-latest";
fi;
echo -e "";
echo -e "\e[34mDone.\e[39m";
echo -e "";
