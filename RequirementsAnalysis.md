#Exercise 2: Requirements Analysis CS4320
###Software Engineering
###Group 12 


1.) Identify Users 
  a.) Users
  b.) Guests
  c.) Admins

2.) For each user identify the activities they will perform
  a.) Users 
    Users will be able to register/login via login form
    Users will be able to search through a database of games
    Users will be able to create a profile that holds info about their gaming habits
    Users will be able to connect with other users via “friends list”
    Users can search through users based on games / locations
    Users will be able to flag games as owned
  b.) Guests
    Guests can search through users, but data is limited based on privacy settings
    Guests can search through games
    Guests cannot connect to other users without first registering
    Guests can search by location, game, and user, but data is restricted based on privacy and access
  c.) Admin
    Admin privileges can be given / taken
    Admins can view all users and their respective profiles
    Admins can change sensitive data, on a case-by-case basis

3.) Relevant Data / Constraints 
  a.) Users
    (Relevant Data) 
    Users will be able to log in via username or email
    The users games will be stored on the database, so queries can be made on the games they own
    (Constraints)
    Login requests will need to be made quickly and efficiently, within xxx amount of time.
    Database must have enough space allocated to store all user information, including profile info and all the users games
    Queries to the database need to be made / completed within xxx amount of time. b.) Guests
    (Relevant Data)
    Guests will have cookies stored on their system, so even if they don’t create an account, our system will remember where and what they were doing
    Guests can flag games for their inventories, but nothing will be made public until an account is made.
    (Constraints)
    Any requests made to the server will be made within xxx amount of time, but number of requests are limited to guests (guests spamming search functionality)
    Guest accounts will only be allowed access to certain pages c.) Admin
    (Relevant Data)
    Administrators will have sudo privileges to the VM and web app and this would be done by an engineer or staff.
    Admins would have advanced editing controls, in addition to normal user account options.
    (Constraints)


    Administrators would need their credentials directly added to the database
    Advanced controls could be limited on a admin to admin basis
