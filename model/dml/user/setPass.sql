# set user ?s password
UPDATE user SET salt=?, hash_pass=? WHERE user_id=?;