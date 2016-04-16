# get user ?s password
SELECT salt, hash_pass FROM user WHERE user_id=?;