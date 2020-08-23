SELECT users.name, COUNT(phone) 
FROM phone_numbers 
JOIN users ON phone_numbers.user_id = users.id 
WHERE users.birth_date >= '1998-01-01 00:00:00' AND users.gender = 2 
GROUP BY users.name
