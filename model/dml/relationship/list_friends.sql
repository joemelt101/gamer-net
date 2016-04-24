#show user ?’s friend/pending friend list
SELECT friend_id, type FROM relationship
JOIN user ON relationship.friend_id = user.user_id
WHERE relationship.user_id=?
ORDER BY user.alias;