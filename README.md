# gamer-net
Provides a place for people to find others to play their favorite games with and make new friends!

# Workflow Instructions
1. Find issue assigned to you
2. Create a branch **from the premaster branch** named 'yourfirstname_work'
3. Clone repository to Desktop
4. **VERY IMPORTANT** Switch to your work branch before making changes
5. Make changes on desktop until issue resolved
6. **Pull changes one last time** from the **premaster** branch and merge to make sure it still works with your new code
7. Push your updated **branch** changes to GitHub
8. **Create a Pull Request** into the **premaster** branch from 'yourfirstname_work' branch and mention the issue resolved
9. The build meister(s) will pull the request, test it, and mark the issue complete or give feedback on what needs to be fixed
10. Repeat the process

Note: The premaster branch will be merged into the master branch from time to time when it is determined stable. Probably once at the end of every sprint.

## DIRECTORY

gamer-net/
|
|--documentation...
|
|--views/
|  |    
|  |--navbar.php
|  |--dashboard.php
|  |--friends.php
|  |--register.php
|  |--search.php
|  |--settings.php
|  |--viewfriend.php
|  |--login.php
|  |
|  |--CSS/
|  |  |--headers
|  |  |  |--bootstrap
|  |  |
|  |  |--navbar.css
|  |  |--dashboard.css
|  |  |--friends.css
|  |  |--register.css
|  |  |--search.css
|  |  |--settings.css
|  |  |--register.css
|  |  |--viewfriend.css
|  |  |--login.css
|  |
|  |--js/
|     |
|     |--jquery-2.2.2.min.js
|     |--bootstrap.min.js
|
|--controller/
|  |
|  |--dashboard_controller.php
|  |--friends_controller.php
|  |--register_controller.php
|  |--search_controller.php
|  |--settings_controller.php
|  |--viewfriend_controller.php
|  |--login_controller.php
|
|
|--model/
|  |
|  |--model_interface.php
|  |--DBconnection.php
|  |--DML
|     |--contact_info
|     |--game
|     |--location
|     |--relationship
|     |--user
|     |--user_games

|--README.md
|--.htacces
|--index.php
|--page.php
|--.gitignore
