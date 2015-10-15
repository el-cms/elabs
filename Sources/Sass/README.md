# Sass

## Command line
To get almost everything up :
```bash
# Assuming you're in the 'common' dir
wget https://github.com/Daemonite/material/archive/master.zip
unzip master.zip
rm master.zip

wget https://github.com/FortAwesome/Font-Awesome/archive/master.zip
unzip master.zip
rm master.zip

wget http://codemirror.net/codemirror.zip
unzip codemirror.zip
rm codemirror.zip
```

## The files

### Material

Elabs uses a "material" a material-design-like adapatation of Twitter Bootstrap 3.

 - Download the [files](https://github.com/Daemonite/material/archive/master.zip)
 - Extract in a material folder in order to have the following directories :
```
common/
  material/
    assets/
    css/
    ...
```
 - Copy `common/material/css/fonts` to `/webroot/font` those are some icons
 - Generate `backend.scss` as `webroot/css/admin_style.min.css`
 - Generate `frontend.scss` as `webroot/css/style.min.css`

### Fontawesome

Elabs uses fontawesome icons.

 - Download the [files](https://github.com/FortAwesome/Font-Awesome/archive/master.zip)
