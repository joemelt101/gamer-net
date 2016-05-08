# update user info
UPDATE user SET alias=?, email=?, age=?, gender=?, about=? WHERE user_id=?;
UPDATE location SET city=?, state=?, zip_code=? WHERE user_id=?;