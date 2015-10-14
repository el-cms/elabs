# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

  - [ ] **Auth mechanism**
    - [ ] **User registration**
      - [ ] Creation of a new user
        - [ ] Better fields validation (usernames mainly)
        - [x] Simple creation from form
      - [ ] Account activation
    - [ ] **Login**
      - [ ] Persistent login (for a week/month/year ?)
      - [x] Simple login
    - [ ] **Close account*
      - [ ] Proper messages on login
      - [x] Lock and deactivate user
    - [ ] Auth check on actions (via `$this->Auth->allow()` for now)
    - [x] User logout
  - [ ] **Flow control mechanism** (_Acts_, may be changed for something more understandable, as _Activities_)
    - [ ] Handle deleted/unpublished items
    - [x] Component to add items to flow
  - [ ] **Article management**
    - [ ] Filters for indexes
    - [ ] Markdown support
      - [ ] File export from DB
      - [ ] Tool to link to projects and/or files
      - [x] Render markdown properly (almost)
    - [ ] ...
  - [ ] **Projects management**
    - [ ] Team management
    - [ ] ...
  - [ ] **Files management**
    - [ ] Create a dir for new users
    - [ ] Create a Component to handle the different filetypes on add
    - [ ] Create a Helper to handle the different filetypes in views
  - [ ] **Licenses management**
  - [ ] **Tags management**
  - [ ] **Report management**
  - [ ] **General ideas**
    - [ ] **NSFW mechanism**
    - [ ] **Anon posting**
    - [ ] **...**
  - [ ] :red_circle: Make this CHANGELOG following Semantic versioning as soon as possible
  