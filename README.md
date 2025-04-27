# daktari_app

use this sql to populate tables

-- Insert into users
INSERT INTO users (full_name, email, password) VALUES
('Dr. Alice Kare', 'alice@example.com', '$2y$10$VKjR9vU5h9Iip3xZyR6P5.cB1W0iK9GZkRJzMv8jltqSxxi7rnb9G'),
('Dr. Bob Mwangi', 'bob@example.com', '$2y$10$VKjR9vU5h9Iip3xZyR6P5.cB1W0iK9GZkRJzMv8jltqSxxi7rnb9G'),
('Dr. Carol Wanjiku', 'carol@example.com', '$2y$10$VKjR9vU5h9Iip3xZyR6P5.cB1W0iK9GZkRJzMv8jltqSxxi7rnb9G');

-- Note: Password is hashed version of 'password123' for all users.

------------------------------------------------------

-- Insert into clients
INSERT INTO clients (full_name, gender, date_of_birth, phone, address, created_at) VALUES
('John Doe', 'Male', '1990-05-10', '0700123456', 'Nairobi, Kenya', NOW()),
('Jane Smith', 'Female', '1985-07-20', '0700654321', 'Mombasa, Kenya', NOW()),
('Michael Otieno', 'Male', '1995-12-01', '0700987654', 'Kisumu, Kenya', NOW());

------------------------------------------------------

-- Insert into programs
INSERT INTO programs (name, description, created_at) VALUES
('HIV Program', 'Care and support for people living with HIV.', NOW()),
('TB Program', 'Tuberculosis prevention and treatment.', NOW()),
('Malaria Program', 'Malaria diagnosis and treatment.', NOW());

------------------------------------------------------

-- Insert into enrollments
INSERT INTO enrollments (client_id, program_id, enrolled_at) VALUES
(1, 1, NOW()),  -- John Doe enrolled in HIV Program
(1, 2, NOW()),  -- John Doe enrolled in TB Program
(2, 3, NOW()),  -- Jane Smith enrolled in Malaria Program
(3, 2, NOW());  -- Michael Otieno enrolled in TB Program

