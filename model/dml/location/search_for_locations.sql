# search for location(s) by city, state, or zip code
SELECT * FROM location WHERE city LIKE ? OR state LIKE ? OR zip_code LIKE ?;