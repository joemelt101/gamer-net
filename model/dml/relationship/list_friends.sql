#show user ?’s friend/pending friend list
SELECT friend_id, user.alias AS friend, type FROM relationship
JOIN user ON relationship.friend_id = user.user_id
WHERE relationship.user_id=? AND type != 3 AND type != 4
ORDER BY friend;