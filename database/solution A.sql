-- solution_a.sql: Truy vấn người dùng

-- 1. Lấy danh sách người dùng theo thứ tự tên theo Alphabet (A->Z)
SELECT * FROM users ORDER BY user_name ASC;

-- 2. Lấy ra 07 người dùng theo thứ tự tên theo Alphabet (A->Z)
SELECT * FROM users ORDER BY user_name ASC LIMIT 7;

-- 3. Lấy danh sách người dùng theo thứ tự tên theo Alphabet (A->Z), trong đó tên người dùng có chữ 'a'
SELECT * FROM users WHERE user_name LIKE '%a%' ORDER BY user_name ASC;

-- 4. Lấy danh sách người dùng trong đó tên người dùng bắt đầu bằng chữ 'm'
SELECT * FROM users WHERE user_name LIKE 'm%' ORDER BY user_name ASC;

-- 5. Lấy danh sách người dùng trong đó tên người dùng kết thúc bằng chữ 'i'
SELECT * FROM users WHERE user_name LIKE '%i' ORDER BY user_name ASC;

-- 6. Lấy danh sách người dùng trong đó email người dùng là Gmail
SELECT * FROM users WHERE user_email LIKE '%@gmail.com';

-- 7. Lấy danh sách người dùng trong đó email là Gmail và tên bắt đầu bằng chữ 'm'
SELECT * FROM users WHERE user_email LIKE '%@gmail.com' AND user_name LIKE 'm%';

-- 8. Lấy danh sách người dùng có email Gmail, tên có chữ 'i' và tên dài hơn 5 kí tự
SELECT * FROM users WHERE user_email LIKE '%@gmail.com' AND user_name LIKE '%i%' AND LENGTH(user_name) > 5;

-- 9. Lấy danh sách người dùng có chữ 'i', tên dài từ 5 đến 9, email Gmail, và email có chứa chữ 'I'
SELECT * FROM users WHERE user_email LIKE '%@gmail.com' AND user_email LIKE '%I%' AND user_name LIKE '%i%' AND LENGTH(user_name) BETWEEN 5 AND 9;

-- 10. Lấy danh sách người dùng có chữ 'i', tên dài từ 5 đến 9 hoặc hơn 9, email Gmail, và email có chữ 'i'
SELECT * FROM users WHERE user_email LIKE '%@gmail.com' AND user_email LIKE '%i%' AND (LENGTH(user_name) BETWEEN 5 AND 9 OR LENGTH(user_name) > 9);