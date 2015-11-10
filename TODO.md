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
  Index        [x] [x]   [ ] [ ]   [ ] [ ]   [ ] [ ] | [x] Modal to add
  View         [x] [x]   [ ] [ ]   [ ] [ ]   [ ] [ ] | [x] Helper

```

### Site config
  - [15/11/09] UUIDS instead of int Ids for
    - [15/11/09] Users
    - [15/11/09] Projects
    - [15/11/09] Posts
    - [15/11/09] Files

### Before going public
  - [ ] Review all paginator links and add a \__d() translation on them
  - [ ] Add icons on action buttons
  - [ ] Add text where there is no element to display
  - [ ] Translate menus (proper __d() use)
  - [ ] Review error messages on login
  - [ ] Check for all licenses links created using the license helper
  - [ ] Add default order in $this->paginate when retrieving data
  - [ ] Create a simple captchas system
  - [15/11/10] Review ALL page titles to follow Material guidelines (My/Your,...)
  - [15/11/10]] Check for admin page titles (should be <controller>/<action>/<optionnal title>
  - [15/11/10] Add an icon in the paginator links when active (d39482f5c3a730565f7a88331a8d99fbacfb2844)
  - [15/11/10] Revert all user/<controler>/manage() to index()
  - [??/??/??] Delete unused views
  - [??/??/??] Create reports support
  - [??/??/??] Add a dl-horizontal style for definition lists
  - [??/??/??] Better style for filter links
  - [??/??/??] Simple authorization handling

### On free time
  - [ ] Check if add() action don't have unecessary find()
  - [ ] WRITE TESTS
  - [ ] Tests on tablet
  - [ ] Tests on mobile
  - [??/??/??] Check for fields in models comments

### Things to do often as there is still many changes:
  - [??/??/??] Reformat code for PSR-2
    - Errors remains, mostly line breaks after classes opening brackets
  - [??/??/??] Add a h() method for every db output
    - [??/??/??] Check if that's usefull on things parsed with mdown (now, see #4)
  - [??/??/??] Remove short tags <?= being deprecated in PHP6
  - [??/??/??] Review \__d('elabs','...') and change their respective modules
  - [ ] Add a db dump for database creation
    - [15/11/09] Sync a SQL file with Mysql Workbench schema
    - [ ] Add Mysql Workbench file
## Notes

### Acts
  - [15/11/09] Complete associations to change queries type. Leads to #6... (fc02fd07884d09568a3c2dadc862f13e32f586fa and 2033393bd3a2fc98679600aba1b969ebd026fcaf)

### Posts
  - [ ] Create proper filters, not shown in filter list, but used by links in 
    user or license cards : filter on license and filter on user.
  - [ ] Add filters on admin/index views

### Projects
  - [ ] Create proper filters, not shown in filter list, but used by links in 
    user or license cards : filter on license and filter on user.

### Files
  - [ ] Create proper filters, not shown in filter list, but used by links in 
    user or license cards : filter on license and filter on user.
  - [ ] Create an empty index.html in created dirs (UpManagerComponent)
  - [ ] Use File::mime() to get mimetype of an uploaded file
  - [??/??/??] Save the mimetype

### Users
  - [ ] Add a captcha on register
  - [ ] Add a captcha on login
  - [15/11/09] Index view, related elements : - Add a block for empty lists
  - [15/11/09]                                - Add the files cards

### Licenses

### Tags

### Reports
  - [ ] Add a captcha for anonymous reports
  - [ ] Make a component to get number of reports
    - [ ] Add a read/unread state in db

### Auth
  - [??/??/??] Deny non-users, non-admins
