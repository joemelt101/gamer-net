#update contact info tag for user
UPDATE contactInfo
SET username=?
WHERE user_id=? AND platform=?;