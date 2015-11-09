# Todo

## Main

```
               Users     Posts     Projects  Files     Acts
Validations    [ ]       [ ]       [ ]       [ ]
                C   V     C   V     C   V     C   V     C   V
Public
  Index        [x] [x]   [x] [x]   [x] [x]   [x] [x]   [x] [x]
    SFW                  [x] [x]   [x] [x]   [x] [x]     N/A
    Published            [x] [x]
    Filters    [ ]       [ ] [ ]   [ ] [ ]   [ ] [ ]   [x] [x]
    Order      [x]       [x] [x]   [x] [x]   [x] [x]   [x] [x]
  View         [x] [x]   [x] [x]   [x] [x]   [x] [x]
    SFW                  [x] [x]   [x] [x]   [x] [x]
    Published            [x] [x]

User
  Add                    [x] [x]   [x] [x]   [x] [x]
    Self                 [x]       [x]       [x]
    Markdown Ed.   [x]       [x]       [x]       [x]
    Act                  [X]       [x]       [x]
  Edit         [x] [x]   [x] [x]   [x] [x]   [x] [x]
    Self       [x]       [x]       [x]       [x]
    Markdown Ed.   [x]       [x]       [x]       [x]
    Act                  [x]       [x]       [x]
  Index/Manage           [x] [x]   [x] [x]   [x] [x]
    Self                 [x]       [x]       [x]
  Delete       [x]       [x]       [x]       [x]
    Self       [x]       [x]       [x]       [x]
    Act        [x]       [x]       [x]       [x] !File is not removed

Admin
  Lock         [x]       [x]       [x]       [x]
  Index        [x] [x]   [x] [x]   [x] [x]   [x] [x]
  View         [x] [x]   [x] [x]   [x] [x]   [x] [x]
  Lock/Del.    [x]       [x]       [x]       [x]
```

## Others

```
               Licenses  item/file item/post item/tag  Reports
Validations    [ ]
                C   V     C   V     C   V     C   V     C   V
Admin
  Add          [x]
  Edit         [x] [x]   [ ] [ ]   [ ] [ ]   [ ] [ ]   
  Index        [x] [x]   [ ] [ ]   [ ] [ ]   [ ] [ ]   [x] [x]
  View                   [ ] [ ]   [ ] [ ]   [ ] [ ]   [x] [x]
  Delete       [x]       [ ]       [ ]       [ ]       [x] [x] 
Public
  Index        [ ] [ ]   [ ] [ ]   [ ] [ ]   [ ] [ ] | [x] Modal to add
  View         [ ] [ ]   [ ] [ ]   [ ] [ ]   [ ] [ ] | [x] Helper

```

### Site config
  - [x] UUIDS instead of int Ids for
    - [x] Users
    - [x] Projects
    - [x] Posts
    - [x] Files
### Before going public
  - [ ] Add a db dump for database creation
    - [x] Sync a SQL file with Mysql Workbench schema
    - [ ] Add Mysql Workbench file
  - [x] Reformat code for PSR-2
    - Errors remains, mostly line breaks after classes opening brackets
  - [x] Remove short tags <?= being deprecated in PHP6
  - [x] Review \__d('elabs','...') and change their respective modules
  - [ ] Review ALL page titles to follow Material guidelines (My/Your,...)
  - [x] Add a dl-horizontal style for definition lists
  - [ ] Review all paginator links and add a \__d() translation on them
  - [ ] Add icons on action buttons
  - [ ] Add text where there is no element to display
  - [x] Better style for filter links
  - [ ] Tests on tablet
  - [ ] Tests on mobile
  - [ ] Translate menus
  - [ ] Delete unused views
  - [ ] Review error messages on login
  - [ ] Create reports support
  - [ ] Check for all licenses links using the helper
  - [x] Add a h() method for every db output (now, see #4)
    - [x] Check if that's usefull on things parsed with mdown
  - [x] Simple authorization handling

### On free time
  - [x] Check for fields in models comments
  - [ ] Check if add() action don't have unecessary find()
  - [ ] Write tests

## Notes

### Posts
  - [ ] Add filters on admin/index views

### Projects

### Files
  - [ ] Create an empty index.html in created dirs (UpManagerComponent)
  - [ ] Use File::mime() to get mimetype of an uploaded file
  - [x] Save the mimetype

### Users
  - [ ] Index view, related elements : - Add a block for empty lists
  - [ ]                                - Add the files cards

### Licenses

### Tags

### Reports
  - [ ] Make a component to get number of reports
    - [ ] Add a read/unread state in db

### Auth
  - [ ] Deny non-users, non-admins
