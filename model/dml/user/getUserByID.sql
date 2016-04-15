# get user ?s data
SELECT username, email, alias, gender, age, availability, is_admin FROM user WHERE user_id=?;
