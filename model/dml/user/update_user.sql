# update user
UPDATE user
SET alias=?, salt=?, hash_pass=?
WHERE user_id=?;