# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

  - [ ] **Auth mechanism**
    - [ ] **User registration**
      - [ ] Account activation
    - [ ] **Login**
      - [ ] Persistent login (for a week/month/year ?)
      - [x] Simple login
    - [ ] **Close account*
      - [ ] Proper messages on login
      - [x] Lock and deactivate user
    - [x] Auth check on actions (via `$this->Auth->allow()` for now)
    - [x] User logout
  - [x] **Flow control mechanism** (_Acts_, may be changed for something more understandable, as _Activities_)
    - [x] Handle deleted/unpublished items
    - [x] Component to add items to flow
  - [ ] **Article management**
    - [x] Filters for indexes
    - [ ] Markdown support
      - [ ] File export from DB
      - [x] Render markdown properly (almost)
    - [ ] Tool to link to projects and/or files
  - [ ] **Projects management**
    - [ ] Team management
  - [ ] **Files management**
  - [ ] **Licenses management**
  - [ ] **Tags management**
  - [ ] **Report management**
  - [ ] **General ideas**
    - [ ] **NSFW mechanism**
    - [ ] **...**
  - [ ] :red_circle: Make this CHANGELOG follow Semantic versioning as soon as possible
  