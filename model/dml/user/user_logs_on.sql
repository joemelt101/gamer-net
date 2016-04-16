# user logs on
SELECT user_id, username, email, alias, salt, hash_pass, gender, age, availability, is_admin FROM user WHERE username=? OR email=?;