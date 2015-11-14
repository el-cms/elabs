# ELabs
CMS for ExperimentsLabs.com based on CakePHP 3

## What is it ?
It's a small website made to make a presentation of projects, files and some articles... for now.

**In any case, that's not a modular CMS, with plugins and lot of stuff** (as [Croogo](http://croogo.org))

This structure allows :

  - multiple users
  - a simple "project management system" (a page about your project)
  - a simple article management system
  - a simple file upload system.
  - a report system for the visitors/users to report pages or items (may be extended as a way to leave comments to users too)
  - licenses support for any item published on the site

This structure does **not** have comments system (and will never have publicly shown comments)

## Why ?

I know there are a lot of tools existing around to make this kind of thing, but 
that was a way for me to approach CakePHP3 and finally make my own website.

## Get started, IRC way :
The SQL creation script is in the "Sources" folder
```irc
[20:45] <elcms> the first thing is to lauch composer to download the deps, run the setup.sh if you're under Linux (it will download a plugin wich is not available with composer)... create your db and complete an config/app.php file
[20:45] <elcms> that's reaaly user-friendly, I assure you :P
[20:45] * elcms gets out...
[20:58] <sitex_rus_> it works!
[20:59] <elcms> really ?
[20:59] <elcms> XD yeah !
[21:01] <elcms> you may have to create an user at first, then change its status to 1 in db
[21:01] <sitex_rus_> done)
[21:01] <sitex_rus_> is it possible to add project? <.<
[21:02] <elcms> sure
[21:03] <elcms> you should create a license first
[21:03] <elcms> as you will bind your projects to licenses
[21:03] <elcms> (as files and posts)
[21:04] <elcms> all the text contents should be written in markdown
[21:04] <elcms> to create a license, go to admin/licenses/add
[21:05] <sitex_rus_> done
[21:06] <elcms> then once you're logged, use the "user menu" (top right), then "add a project"
```

## Future evolutions ?
You're welcome to use/reuse the code, fork, make pull requests...

I don't know yet how the website will evolve, but it will.

**Translations** are welcome :)

**Design improvements** are really welcome

**New ideas are welcome**

**If you want to help**, check the TODO.md, and look at all the amount of work there is...
