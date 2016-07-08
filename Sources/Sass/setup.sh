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

# Notes about Prism js/css
# 
# As prism is not directly downloadable, a version is included in the repo.
# To update it, simply go to this page (also in the comments of the included js file):
# http://prismjs.com/download.html?themes=prism&languages=markup+css+clike+javascript+apacheconf+bash+batch+c+cpp+coffeescript+ruby+css-extras+diff+fortran+git+go+http+java+latex+lolcode+makefile+markdown+pascal+perl+php+php-extras+powershell+python+rest+sass+scss+smalltalk+sql+twig+vim+wiki+yaml&plugins=line-numbers+autolinker+show-language
# Then download both JS/CSS

webroot=$(realpath "../../webroot" -m)
cd common/


# jQuery
wget -nv "http://code.jquery.com/jquery-1.11.3.min.js" -O "$webroot/js/lib/jquery.min.js"

# MomentJS
# wget -nv "http://momentjs.com/downloads/moment-with-locales.min.js" -O "$webroot/js/moment-with-locales.min.js"

# TBS3
wget -nv "https://github.com/twbs/bootstrap-sass/archive/v3.3.5.tar.gz"
tar zxf v3.3.5.tar.gz
rm -f v3.3.5.tar.gz
mv -f "bootstrap-sass-3.3.5" "bootstrap-sass"
cp -f "bootstrap-sass/assets/javascripts/bootstrap.min.js" "$webroot/js/"

# FontAwesome
wget -nv "https://github.com/FortAwesome/Font-Awesome/archive/master.zip"
unzip -u -q master.zip
rm master.zip -f
cp -f Font-Awesome-master/fonts/* "$webroot/fonts/"

# CodeMirror
wget -nv "http://codemirror.net/codemirror.zip"
unzip -u -q codemirror.zip
rm -f codemirror.zip
mv -f codemirror-* codemirror
# Main files
cp -f "codemirror/lib/codemirror.css" "$webroot/css/"
cp -f "codemirror/lib/codemirror.js" "$webroot/js/lib/"
# Addons
cp -f "codemirror/addon/edit/matchbrackets.js" "$webroot/js/lib/codemirror/"
cp -f "codemirror/addon/selection/active-line.js" "$webroot/js/lib/codemirror/"
# Modes
cp -f "codemirror/mode/markdown/markdown.js" "$webroot/js/lib/codemirror/modes/"
cp -f "codemirror/mode/xml/xml.js" "$webroot/js/lib/codemirror/modes/"

# BootFlat (TBS theme)
wget -nv "https://github.com/bootflat/bootflat.github.io/archive/master.zip"
unzip master.zip
rm master.zip -f

# Typeahead
wget -nv "http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js" -O "$webroot/js/lib/typeahead.bundle.js"

# TagInput
wget -nv "https://codeload.github.com/bootstrap-tagsinput/bootstrap-tagsinput/zip/latest"
unzip -u -q latest
rm -f latest
mv "bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css" "bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.scss"
cp "bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.min.js" "$webroot/js/"
