#show user ?’s blocked users list
SELECT friend_id AS uid, user.alias AS blocked FROM relationship
JOIN user ON relationship.friend_id = user.user_id
WHERE relationship.user_id=? AND type=3
ORDER BY blocked;