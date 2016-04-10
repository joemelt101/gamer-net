/*search for user by username and email
this will be used whenever a new user registers
users should not be able to register with an email or username
that already exists in the database
*/
SELECT username, email FROM user WHERE username=? OR email=?;