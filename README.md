# gamer-net
Provides a place for people to find others to play their favorite games with and make new friends!

### Installation Instructions
####Prerequisites
Ubuntu 14.04 Server with LAMP stack installed
####Database Setup
run MYSQL table setup statements (in Wiki) 
####Database Credentials
Create a file in /var/www called ".credentials" using the following format:
```
host
username
password
databaseName
```
####Enable .htaccess
.htaccess must be enabled for the website to work, and need to be able to rewrite urls; these instructions may vary depending on how you have apache2 setup.

######apache2.conf
`sudo vim /etc/apache2/apache2.conf`

Around line 164, look for where it says `<Directory /var/www>` 

Change the line below that where it says `AllowOverride None` to `AllowOverride All`

Then at the very bottom of the file, add the following line:
`Servername localhost`
This should prevent apache2 from complaining about not knowing the hostname.

######000-default.conf

`sudo vim /etc/apache2/sites-enabled/000-default.conf`

Near the bottom of the file, but before `</VirtualHost>` add the following:
```
<Directory /var/www/html>
  Options Indexes FollowSymLinks MultiViews
  Order allow,deny
  allow from all
</Directory>
```

In order for all of these changes to take affect, you have to restart apache:
`sudo service apache2 restart`

####Git Clone
Change to /var/www/html/
Create a new folder and name it whatever you want.
Change into your new folder, then type the following command:
`git clone https://github.com/joemelt101/gamer-net`

You should now be able to access the website via http://yourDomainName/yourFolderName/gamer-net

####Optional
The following prevents users from being able to look at the file structure of the site via a browser and instead shows the user a custom "error" page.

Change to /var/www/html/ and create a new file called ".htaccess"
Write the following lines and then save the file.
```
Options -Indexes
ErrorDocument 403 /yourFolderName/gamer-net/view/views/404.html
ErrorDocument 404 /yourFolderName/gamer-net/view/views/404.html
```
The ErrorDocument 403 line is for redirecting when a user tries to look at an actual directory via the browser.
The ErrorDocument 404 line is for redirecting a user when they try to access a page that doesn't exist, technically this is handled in
page.php, but if users try to access http://domainName/yourFolderName/fileThatDoesntExist, they will still be taken to the custom 404 page.

####End of Install Instructions

## Group 12 - Members:
- Homer Gaidarski
- Benjamin Liu
- Arthur Martin
- Carlos Martinez
- Kean Mattingly
- Jared Melton

# Workflow Instructions
1. Find issue assigned to you
2. Create a branch **from the premaster branch** named 'yourfirstname_work'
3. Clone repository to Desktop
4. **VERY IMPORTANT** Switch to your work branch before making changes: `git checkout yourfirstname_work`
5. Make changes on desktop until issue resolved
6. Push your updated **branch** changes to GitHub: `git push origin yourfirstname_work`
7. **Create a Pull Request** into the **premaster** branch from 'yourfirstname_work' branch and mention the issue resolved
8. The build meister(s) will pull the request, test it, and mark the issue complete or give feedback on what needs to be fixed
9. Repeat the process
