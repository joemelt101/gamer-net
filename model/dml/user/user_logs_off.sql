# user logs off
UPDATE user SET availability=0 WHERE user_id=?;