# delete user; this will also delete user's gamelist, contact info, anything
# that is dependent on the user's user id
DELETE FROM user WHERE username = 'usernamehere';

# create user
# example for 21 year old male with username 'bob'
INSERT INTO user(username, salt, hash_pass, gender, age)
	VALUES('bob', '', '', 0, 21);

# create game
# example for bungie video game
INSERT INTO game(developer, year, name, genre, type, platform)
	VALUES('Bungie', 2001, 'Halo: Combat Evolved', 'FPS', 0, 'Xbox');

#add game 1 into user 1's games
INSERT INTO user_games(user_id, game_id) VALUES(1, 1);

#delete game 1 from user 1's games
DELETE FROM user_games WHERE user_id='1' AND game_id='1';

#add contact info tag for user 1
INSERT INTO contactInfo(user_id, platform, username)
	VALUES('1', 'Xbox Gamertag', 'X420noscopeX');
#delete contact info tag for user 1
DELETE FROM contactInfo WHERE user_id='1' AND platform='Xbox Gamertag';



#add/delete/block people/friends
type
0 = requester
1 = requestee
2 = currently friends
3 = blocker
4 = blockee

#user 1 sends user 2 a friend request
INSERT INTO relationship(user_id, friend_id, type) VALUES(1, 2, 0);
INSERT INTO relationship(user_id, friend_id, type) VALUES(2, 1, 1);

#user 2 accepts user 1's friend request
UPDATE relationship
	SET type='2' WHERE user_id='1' AND friend_id='2';
UPDATE relationship
	SET type='2' WHERE user_id='2' AND friend_id='1';

#user 2 declines user 1's friend request or user 2 deletes user 1 as a friend
DELETE FROM relationship WHERE user_id='1' AND friend_id='2';
DELETE FROM relationship WHERE user_id='2' AND friend_id='1';

#user 2 blocks user 1
UPDATE relationship
	SET type='3' WHERE user_id='2' AND friend_id='1';
UPDATE relationship
	SET type='4' WHERE user_id='1' AND friend_id='2';
