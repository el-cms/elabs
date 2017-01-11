[![ExperimentsLabs CMS](https://img.shields.io/badge/elabs-0.1.0-blue.svg)](https://github.com/el-cms/elabs/) [![Travis](https://img.shields.io/travis/el-cms/elabs.svg)](https://travis-ci.org/el-cms/elabs) [![Codecov](https://img.shields.io/codecov/c/github/el-cms/elabs.svg)](https://codecov.io/gh/el-cms/elabs) [![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/el-cms/elabs/master/LICENSE) [![Gitter](https://img.shields.io/gitter/room/nwjs/nw.js.svg)](https://gitter.im/elabs-cms/Lobby)

# ELabs
CMS for ExperimentsLabs.com created with [CakePHP 3](https://cakephp.org)

## What is it ?
It's a small website made to make a presentation of projects, files and some articles...

**In any case, that's not a modular CMS, with plugins and lot of stuff** (as [Croogo](http://croogo.org))

## Features in  v0.0.1
First notable version with all base features working:

  - User management
  - Administration section
  - User section to
    - Manage albums (groups of _files_)
    - Manage files (images, text, video, sounds)
    - Manage notes (short texts)
    - Manage posts (articles)
    - Manage projects (a project can have related albums, files, notes and posts)
  - "Safe For Work" state for the above items
  - Tagging system
  - Content reporting
  - Comments (private only)
  - Internationalization support
  - Licenses support

## Get started:

### Dependencies
  - A web server wich can serve PHP files
  - You will need the following PHP dependencies:
    - gd
    - intl
    - xml
    - mbstring
    - gd
  - A database server. The following have been tested
    - MySql was used during development
    - Sqlite is used for tests, so it should _work_
  - [Composer](https://getcomposer.org/)

For now there is no package for Composer.

There are many ways to get started with this CMS, i'll present two of them:

### The easy way: A virtual machine
I call this method the _easy way_ as there is nothing 

To get started quickly if you have a good internet connection and some coffee to relax:

#### Quick install
For people who know how it works.

  - Download this [PuPHPet configuration](https://github.com/mtancoigne/cake3-puphpet-vm) for vagrant
  - Configure it if you want.
  - Create the `data/html` subfolder
  - Launch `vagrant up`
  - Delete `data/html/index.php` and download/clone this repository in `data/html/`
  - Login on the machine and head to `/var/www/html`
  - Run `./setup.sh`
  - Configure the db access with: 
    ```php
    'username' => 'root, 
    'password' => '123', 
    'database' => 'vagrant',
    ```
  - Done. Access `https://192.168.6.200`.

### Step by step:
  - Download and install [Virtualbox](http://www.virtualbox.org/) and Vagrant(https://www.vagrantup.com/) and check that Vagrant is in your PATH variable (accessible from everywhere in a console) by running `vagrant -v`.
  - Download the [box configuration](https://github.com/mtancoigne/cake3-puphpet-vm) created with PuPHPet(https://puphpet.com/) and extract it somewhere.
  - Edit the `puphet/config.yml` to fit your needs:
    - Change all occurrences of `my-cake3-project` by something else (`elabs` is a nice choice). You'll have to change it on every new project with this vm.
    - If your system is a 32bit OS, change lines 6 and 7 by `puphpet/ubuntu1604-i386`
    - Change the `private_network` (line 26) value to something else.
    - **Note:** The vm is configured to have 768Mb memory (line 31). You can lower it to 512 if you have issues.
  - Create a `data` folder, in wich you will create an `html` one. This folder will be shared with the virtual machine. It's your project base.
  - Open a console in the vm folder and run `vagrant up`. It will download the virtual machine image and configure it. Here comes the coffee time.
  - When vagrant finished, remove the `data/html/index.html` file that has been created.
  - Clone or download this repository in `data/html`. `index.php` should be directly under `html/`.
  - Login on the virtual machine: `vagrant ssh`. You're in a linux machine, so now, it's linux commands.
  - Go to the webserver root directory: `cd /var/www/html`.
  - Launch the setup: `./setup.sh` and follow the instructions.
    - _Do you want to keep the sources needed to build the css ? [Y/n]_: If you select no, Sass sources will be deleted. This step downloads some JS files.
    - _Do you want to install the development dependencies ? [Y/n]_: If you select no, composer won't download the dev. dependencies. This step runs `composer install`.
    - Database setup: from your OS, edit `data/html/config/app.php` and change from the line 232:
      ```php
      'username' => 'root, 
      'password' => '123', 
      'database' => 'vagrant',
      ```
    - When it's done, hit return. The tables will be created with a default admin.
  - Open a browser to `https://192.168.6.200` if you haven't changed the IP address.

**Notes**: I had some trouble with :
  - `phpcbf` in the vm: it changes the file mode of the fixed files.
  - git in the vm: Don't use it. Every file is marked as changed. Use git from your host.

### The not so hard way: Locally under a Linux system

  - Check if your server have the good requirements.
  - For the setup to work, you should have [Composer](https://getcomposer.org/) installed globally.
  - Download/clone this repository in a folder accessible by your webserver
  - Edit `.htaccess` and `webroot/.htaccess` to add a [rewriteBase](https://httpd.apache.org/docs/current/mod/mod_rewrite.html#RewriteBase) option if needed.
  - Launch the setup: `./setup.sh` and follow the instructions.
    - _Do you want to keep the sources needed to build the css ? [Y/n]_: If you select no, Sass sources will be deleted. This step downloads some JS files.
    - _Do you want to install the development dependencies ? [Y/n]_: If you select no, composer won't download the dev. dependencies. This step runs `composer install`.
    - Database setup: edit `data/html/config/app.php` and change from the line 232:
      ```php
      'username' => 'root, 
      'password' => '123', 
      'database' => 'vagrant',
      ```
    - When it's done, hit return. The tables will be created with a default admin.
  - Done.

### The insane way: Install under Windows
  - Check if your server have the good requirements.
  - Download/clone this repository in a folder accessible by your webserver
  - Edit `.htaccess` and `webroot/.htaccess` to add a [rewriteBase](https://httpd.apache.org/docs/current/mod/mod_rewrite.html#RewriteBase) option if needed.
  - If you want all the SCSS dependencies to build your css:
    - Follow step by step the content of `Sources/Sass/setup.sh`. And do it manually.
      - Strings with $XXX are variables. Check the first lines of the script, they are defined here. They are used for folder references.
      - _wget xxx_ = download xxx
      - _cp xxx yyy_ = copy xxx to yyy
      - _mv xxx yyy_ = move xxx to yyy (also used to rename the files) 
  - Launch `composer install` to install the dependencies. Use the `--no-dev` option to ignore development dependencies.
  - Once it's done, edit `config/app.php` for the db configuration (line 232):
    ```php
    'username' => 'root, 
    'password' => '123', 
    'database' => 'vagrant',
    ```
  - Create the tables and the default user:
    - `bin/cake migrations migrate`
    - `bin/cake migrations seed`
  - Done.

I'm sorry for you, windows user, as there is no _easy_ way for now.

## Update
As there is no composer package for elabs now, all you can do is run the `update.sh` script from the virtual machine or your linux system. It will clean and re-download sass/js files and run `composer update`.

Again, for Windows, sorry.

## Configuration

Some configuration can be made in the files in `config/` folder:
  - app.php : is a file with CakePHP configuration 
  - site_config.php : basic configuration for the CMS

## Testing

You can run the PHPUnit tests if you have installed the dev dependencies: `composer phpunit`.
You can run the CodeSniffer tests too: `composer phpcs`.
To automatically fix some of the CodeSniffer errors you can run `composer phpcbf`. But it may change the file mode too (orininally `644` on all files except the dirs: `bin/`, `log/`, `tmp/` and `vendor/bin`).

## How to contribute

### New ideas
Ideas are welcome. Just open an issue to describe it.

### Translations
Translations of the cms are welcome. The translation system is the same as [CakePHP](https://book.cakephp.org/3.0/en/core-libraries/internationalization-and-localization.html) and located in `src/Locales`.

All the files in this folder are extracted from the source files using `bin/cake i18n extract`:
  - Message from the core are extracted (file `cake.pot`)
  - Domain strings are **not** merged (other files)

If you want to start a new translation:
  - Create a folder in `src/Locale` with the language name (i.e.: _fr_FR_)
  - Copy the `.pot` files in it.
  - Change the extension to `.po`.
  - Edit the translations with your preferred editor ([Virtaal](http://virtaal.translatehouse.org/) and [PoEdit](http://www.poedit.net/) are my choices).
  - Commit your changes with all new `.mo` files generated by the editor.

### Design improvements
Well... Design is not really my cup of tea. For now the website is not responsive (at least not _totally_). If you want to do something about that, it uses [Twitter Bootstrap v3.x](http://getbootstrap.com/), [BootFlat](https://bootflat.github.io/), [Font Awesome](http://fontawesome.io/) icons, [Bootstrap Tagsinput](http://bootstrap-tagsinput.github.io/), [Codemirror](http://codemirror.net/) and [Prism](http://prismjs.com/).

#### CSS: Created with SCSS
All the CSS is generated from custom scss files located in `Sources/Sass/`. The entry point is `style.scss`. No other files should be generated if you want to modify the core CSS. But if you want to create other CSS files, no problem, explain it. 

I usually use [Koala](http://koala-app.com/) to generate the CSS and there is a configuration file for it; all you have to do is to drag'n'drop the `Sources/Sass` folder in Koala. (**Notes:** Sometimes, Koala will tell you the build failed, but as long as there is no error message about this, it didn't. And sometimes, Koala will not build anything on file change, so you have to manually do it.)

#### Templates
All the templates are located in `src/Template`. For the majority of the folders, they represent a controller, except for the following (If you're familiar with CakePHP, you'll have no problem to understand):

```text
src/Template/
│
│ [ CakePHP Prefixes: ]
│
├── Admin/                Views for the admin workspace
│   └── <Controller>/     Views for admin/<controller>/<action> views
│       └── .ctp files
├── User/                 Views for the user workspace
│   └── <Controller>/     Views for user/<controller>/xxx views
│       └── .ctp files
│
│ [ Other folders: ]
│
├── Cell/                 Views for cells (special elements with their own controller-like logic)
│   └── <Cell>/
│       └── .ctp files    Views for the cell
├── Element/              Small chunks of templates, included in other views
│   ├── Flash/            Flash messages
│   ├── layout/           Layout elements (menus, blocks that are not controller/action specific)
│   ├── layouts/          Specific layouts (as a standard form, a standard index, ...)
│   └── ...Other dirs/    Other elements related to controllers
├── Email/                Email templates
├── Error/                Error pages templates
├── Layout/               Layouts for the public, user and admin workspaces
├── Plugin/               Views to override plugins default views
│
│ [ Other folders: ]
│
└── <Controller>/         Views for the public workspace
    └── .ctp files
```

For basic informations about the CakePHP templates, you should look in the [CakePHP Cookbook](https://book.cakephp.org/3.0/en/views.html).

### Other

All notable changes to this project will be documented in `CHANGELOG.md` :
  - The format is based on [Keep a Changelog](http://keepachangelog.com/) 
  - This project adheres to [Semantic Versioning](http://semver.org/).

You can check the issues too.

## License
The code is licensed under the MIT license except for files that have their own licenses.

## Why ?

This tool was created for the pleasure to make [experiments labs](https://experimentslabs.com) and use CakePHP.