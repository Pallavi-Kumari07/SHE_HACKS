<?php

require_once "C:/xampp/htdocs/SHE_HACKS/database/database.php";
function clearTable($dbo, $tableName) {
    $c = "DELETE FROM $tableName";
    $s = $dbo->conn->prepare($c);
    try {
        $s->execute();
    } catch (PDOException $oo) {
        echo "<br>Error clearing table $tableName: " . $oo->getMessage();
    }
}


$dbo = new Database();
$dbo->conn->exec("USE she_hacks;");


// user_details
$c = "create table user_details
(
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    user_name varchar(30) NOT NULL,
    password varchar(20) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    date_of_birth DATE,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(15),
    address VARCHAR(100) DEFAULT 'NA',
    user_type ENUM('admin', 'customer') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
    echo("<br>user_details created!");
}catch(PDOException $o){
    echo("<br>user_details not created...");
}
$c = "insert into user_details
(user_id, user_name,password,first_name, last_name, date_of_birth, email, phone_number,address,user_type)
values
(1,'jn','123','Joy', 'Nguenhat', '1985-05-12', 'joy.nguenhat@gmail.com', '123-456-7890','Bangkok, Thailand','customer'),
(2,'jd','234','Jim', 'Dong', '1990-03-25', 'jim.dong@gmail.com', '234-567-8901','Hanoi, Vietnam','customer'),
(3,'rn','134','Ramya', 'Nandan', '1995-07-08', 'ramya.nandan@gmail.com', '345-678-9012','Delhi, India','customer'),
(4,'jh','1234','James Zhi', 'Huan', '2002-01-07', 'james.huan@gmail.com', '315-878-9772','Shanghai, China','customer'),
(5,'en','1344','Eva', 'Nhyat', '1999-08-18', 'eva.nhyat@gmail.com', '125-668-9912','An Giang, Vietnam','customer'),
(6,'rs','111','Ren', 'Sung', '1995-07-08', 'ren.sung@gmail.com', '458-777-5412','Chiang Mai, Thailand','customer'),
(7,'ng','345','Nima', 'Guong', '1995-07-08', 'nima.guong@gmail.com', '333-678-2112','Sikkim, India','customer')
";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
}catch(PDOException $o){
    echo("<br>DUPLICATE ENTRY!". $o->getMessage());
}


// Destinations
$c = "create table Destinations(
    destination_id INT PRIMARY KEY AUTO_INCREMENT,
    dest_name VARCHAR(60) NOT NULL,
    descr VARCHAR(200),
    dest_location VARCHAR(100),
    direction VARCHAR(100) NOT NULL,
    image_url VARCHAR(200));";
$st = $dbo->conn->prepare($c);
try {
    $st->execute();
    echo("<br>Destinations table created!");
} catch (PDOException $o) {
    echo("<br>Destinations not created... " . $o->getMessage());
}
    
$c = "insert into Destinations (destination_id, dest_name, descr, dest_location, direction, image_url)
values
    (1, 'Delhi', 'A tour to the best tourist places in Delhi. Where timeless heritage meets vibrant modernity.', 'New Delhi', 'north', 'resources/img51.png'),
    (2, 'Bangalore', 'The perfect blend of innovation and garden city charm is waiting for you!', 'Karnatka', 'south', 'resources/img52.png'),
    (3, 'Chennai', 'A coastal haven where tradition meets contemporary allure.', 'Tamil Nadu', 'south', 'resources/img54.png'),
    (4, 'Nainital', 'A serene escape nestled in the lap of emerald lakes and majestic mountains.','Uttarakhand', 'north','resources/img3.png'),
    (5, 'Mussoorie', 'The Queen of Hills, where nature\'s beauty meets timeless charm.', 'Uttarakhand', 'north', 'resources/img4.png'),
    (6, 'Manali', 'A picturesque paradise where adventure meets tranquility in the Himalayas.', 'Himachal Pradesh', 'north', 'resources/img5.png'),
    (7, 'Shimla', 'A charming hill station where colonial elegance meets breathtaking Himalayan vistas.', 'Himachal Pradesh', 'north', 'resources/img6.png'),
    (8, 'Kasauli', 'A quaint retreat where tranquility and scenic beauty create a timeless escape.', 'Himachal Pradesh', 'north', 'resources/img7.png'),
    (9, 'Varanasi', 'The spiritual heart of India, where the Ganges flows through timeless traditions.', 'Uttar Pradesh', 'north', 'resources/img9.png'),
    (10, 'Vrindavan', 'A divine abode where every corner resonates with tales of Lord Krishna\'s love and devotion.', 'Uttar Pradesh', 'north', 'resources/img11.png'),
    (11, 'Haridwar', 'A sacred city where the Ganges river purifies the soul and the spirit.', 'Uttarakhand', 'north', 'resources/img10.png'),
    (12, 'Jagannath Puri', 'A holy destination where devotion to Lord Jagannath takes center stage.', 'Odisha', 'east', 'resources/img12.png'),
    (13, 'Badrinath', 'A revered pilgrimage site nestled in the Himalayas, dedicated to Lord Vishnu.', 'Uttarakhand', 'north', 'resources/img13.png'),
    (14, 'Tirupati', 'A spiritual hub where the blessings of Lord Venkateswara await every devotee.', 'Andhra Pradesh', 'south', 'resources/img14.png'),
    (15, 'Taj Mahal', 'A symbol of eternal love, an architectural marvel in white marble.', 'Uttar Pradesh', 'north', 'resources/img15.png'),
    (16, 'Ajanta Caves', 'A masterpiece of ancient art and architecture, carved into the hillsides of Maharashtra.', 'Maharashtra', 'central', 'resources/img16.png'),
    (17, 'Red Fort', 'A majestic historical monument that echoes India\'s royal past and rich heritage.', 'Delhi', 'north', 'resources/img17.png'),
    (18, 'Nalanda University', 'An ancient seat of learning that once attracted scholars from across the globe.', 'Bihar', 'east', 'resources/img18.png'),
    (19, 'Surya Mandir', 'A stunning temple dedicated to the Sun God, offering spiritual tranquility.', 'Uttar Pradesh', 'north', 'resources/img19.png'),
    (20, 'Mahabodhi Mandir', 'The sacred site where Lord Buddha attained enlightenment, a beacon of peace and wisdom.', 'Bihar', 'east', 'resources/img20.png'),
    (21, 'Jaipur', 'The Pink City, where royal palaces and vibrant culture blend seamlessly.', 'Rajasthan', 'west', 'resources/img21.png'),
    (22, 'Ladakh', 'A land of stark beauty, where the mountains meet the sky in an otherworldly expanse.', 'Jammu & Kashmir', 'north', 'resources/img22.png'),
    (23, 'Kashmir', 'A paradise on earth, with lush valleys, snow-capped mountains, and serene lakes.', 'Jammu & Kashmir', 'north', 'resources/img23.png'),
    (24, 'Udaipur', 'The City of Lakes, where stunning palaces and serene waters create a romantic atmosphere.', 'Rajasthan', 'west', 'resources/img24.png'),
    (25, 'Lotus Temple', 'A symbol of peace, where all paths of spirituality converge under the petals of unity.', 'Delhi', 'north', 'resources/img25.png'),
    (26, 'Amritsar', 'A spiritual and historical center, home to the Golden Temple and rich Sikh heritage.', 'Punjab', 'north', 'resources/img26.png'),
    (27, 'Shillong', 'A hill station known for its stunning landscapes, waterfalls, and vibrant culture.', 'Meghalaya', 'northeast', 'resources/img33.png'),
    (28, 'Gangtok', 'A serene city offering panoramic views of the Himalayas and rich Tibetan culture.', 'Sikkim', 'northeast', 'resources/img34.png'),
    (29, 'Tsomgo', 'A high-altitude lake surrounded by snow-capped mountains, a peaceful retreat.', 'Sikkim', 'northeast', 'resources/img35.png'),
    (30, 'Dzukou', 'A hidden gem with rolling hills and lush valleys, known for its pristine beauty.', 'Nagaland', 'northeast', 'resources/img36.png'),
    (31, 'Ziro Valley', 'A picturesque valley with lush rice fields, quaint villages, and vibrant tribal culture.', 'Arunachal Pradesh', 'northeast', 'resources/img37.png'),
    (32, 'Darjeeling', 'The Queen of Hills, where tea gardens and scenic views of Kanchenjunga abound.', 'West Bengal', 'east', 'resources/img38.png'),
    (33, 'Kochi', 'A coastal city that blends colonial history, vibrant art, and stunning backwaters.', 'Kerala', 'south', 'resources/img27.png'),
    (34, 'Madurai', 'A city of ancient temples and culture, with the majestic Meenakshi Temple at its heart.', 'Tamil Nadu', 'south', 'resources/img28.png'),
    (35, 'Wayanad', 'A tranquil escape with lush green landscapes, waterfalls, and rich wildlife.', 'Kerala', 'south', 'resources/img29.png'),
    (36, 'Pondicherry', 'A French-inspired coastal town with beautiful beaches, heritage architecture, and vibrant culture.', 'Puducherry', 'south', 'resources/img30.png'),
    (37, 'Hampi', 'An ancient kingdom\'s ruins, where history and stunning rock formations come together.', 'Karnataka', 'south', 'resources/img31.png'),
    (38, 'Gokarna', 'A peaceful coastal retreat with pristine beaches and ancient temples.', 'Karnataka', 'south', 'resources/img32.png'),
    (39, 'Bhubaneshwar', 'The City of Temples, where ancient architecture and modernity coexist harmoniously.', 'Odisha', 'east', 'resources/img39.png'),
    (40, 'Victoria Memorial', 'A grand monument and museum that celebrates British colonial history and India\'s heritage.', 'West Bengal', 'east', 'resources/img40.png'),
    (41, 'Jubilee Park', 'A lush green park offering relaxation and scenic views, inspired by the gardens of London.', 'Jharkhand', 'east', 'resources/img41.png'),
    (42, 'Bodh Gaya', 'A sacred Buddhist site where Lord Buddha attained enlightenment, a center for peace and meditation.', 'Bihar', 'east', 'resources/img42.png'),
    (43, 'Howrah Bridge', 'An iconic symbol of Kolkata, linking the city across the Hooghly River with grandeur.', 'West Bengal', 'east', 'resources/img43.png'),
    (44, 'Deoghar', 'A popular pilgrimage destination with ancient temples and serene landscapes.', 'Jharkhand', 'east', 'resources/img44.png'),
    (45, 'Ujjain', 'An ancient city with historical and religious significance, home to the famous Mahakaleshwar Temple.', 'Madhya Pradesh', 'central', 'resources/img45.png'),
    (46, 'Pachmarhi', 'A hill station nestled in the Satpura Range, known for its scenic beauty and historical caves.', 'Madhya Pradesh', 'central', 'resources/img46.png'),
    (47, 'Khajuraho Temple', 'A UNESCO World Heritage site famous for its stunning temples and intricate erotic sculptures.', 'Madhya Pradesh', 'central', 'resources/img47.png'),
    (48, 'Gwalior', 'A historic city known for its magnificent Gwalior Fort and rich cultural heritage.', 'Madhya Pradesh', 'central', 'resources/img48.png'),
    (49, 'Gateway of India', 'An iconic monument that symbolizes India\'s history and grandeur, overlooking the Arabian Sea.', 'Maharashtra', 'central', 'resources/img49.png'),
    (50, 'Chhatrapati Shivaji Terminus', 'A UNESCO World Heritage site and an architectural marvel, showcasing Victorian Gothic style.', 'Maharashtra', 'central', 'resources/img50.png'),
    (51, 'Mount Abu', 'A serene hill station where nature\'s beauty meets peaceful vibes.', 'Rajasthan', 'west', 'resources/img8.png'),
    (52, 'Jim Corbett National Park', 'Discover the wild beauty of Jim Corbett National Park—where adventure meets tranquility!', 'Uttarakhand', 'park', 'resources/img57.png'),
    (53, 'Ranthambore National Park', 'Explore the majestic wilderness of Ranthambore National Park—where tigers roam and nature thrives!', 'Rajasthan', 'park', 'resources/img58.png'),
    (54, 'Kaziranga National Park', 'Witness the iconic one-horned rhinos in the breathtaking landscapes of Kaziranga National Park!', 'Assam', 'park', 'resources/img59.png'),
    (55, 'Sundarban National Park', 'Venture into the mystical Sundarbans, home to the majestic Royal Bengal Tigers and lush mangroves!', 'West Bengal', 'park', 'resources/img60.png'),
    (56, 'Kanchenjunga National Park', 'Embark on a journey through Kanchenjunga National Park, where towering peaks and pristine nature await!', 'Sikkim', 'park', 'resources/img61.png'),
    (57, 'Nanda Devi National Park', 'Discover the serene beauty of Nanda Devi National Park, a paradise of untouched landscapes and majestic peaks!', 'Uttarakhand', 'park', 'resources/img62.png');";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
}catch(PDOException $o){
    echo("<br>DUPLICATE ENTRY!" . $o->getMessage());
}


// Packages
$c = "create table Packages (
    package_id INT AUTO_INCREMENT PRIMARY KEY,
    destination_id INT NOT NULL,
    title VARCHAR(40) NOT NULL,
    description VARCHAR(100),
    price DECIMAL(10, 2) NOT NULL,
    duration_days INT NOT NULL,
    inclusions TEXT,
    availability_status ENUM('available', 'unavailable') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (destination_id) REFERENCES Destinations(destination_id)
        ON DELETE CASCADE ON UPDATE CASCADE
);";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
    echo("<br>Packages created!");
}catch(PDOException $o){
    echo("<br>Packages not created...". $o->getMessage());
}
$c = "insert into Packages (package_id, destination_id, title, description, price, duration_days, inclusions) values 
(1, 1, 'Adventurous Delhi Getaway', 'A majestic tour of the best elements of the capital.', 1500.00, 5, 'hotel, meals, guide'),
(2, 2, 'Bangalore Luxury Retreat', 'Enjoy a luxury retreat in the Bangalore.', 2500.00, 7, 'resort, meals, spa'),
(3, 3, 'Chennai Express Tour', 'Explore the vibrant culture and sights of the Southern India.', 1200.00, 4, 'hotel, guide, transport'),
(4, 32, 'Darjeeling Delight Tour', 'Discover the beauty of tea gardens and the majestic Kanchenjunga in the Queen of Hills.', 1500.00, 4, 'hotel, guide, transport'),
(5, 14, 'Tirupati Temple Trail', 'Embark on a spiritual journey to the sacred hills and temples of Tirupati.', 1000.00, 4, 'hotel, guide, transport'),
(6, 33, 'Kochi Heritage Cruise', 'Experience the fusion of colonial history and vibrant culture on the coastal beauty of Kochi.', 1200.00, 4, 'hotel, guide, transport'),
(7, 37, 'Hampi Heritage Expedition', 'Uncover the ancient ruins and rich history of the Vijayanagar Empire in Hampi.', 1300.00, 4, 'hotel, guide, transport'),
(8, 36, 'Pondicherry Coastal Escape', 'Relax by the serene beaches and explore the French-inspired streets of Pondicherry.', 1100.00, 4, 'hotel, guide, transport'),
(9, 34, 'Madurai Temple Sojourn', 'Delve into the spirituality and grandeur of Madurai\'s ancient Meenakshi Temple.', 1000.00, 4, 'hotel, guide, transport'),
(10, 28, 'Gangtok Himalayan Adventure', 'Embark on an adventure through the beautiful landscapes and monasteries of Gangtok.', 1400.00, 4, 'hotel, guide, transport'),
(11, 35, 'Wayanad Wilderness Journey', 'Explore the lush green hills, waterfalls, and wildlife of Wayanad.', 1200.00, 4, 'hotel, guide, transport'),
(12, 40, 'Victoria Memorial Voyage', 'Take a historical tour of Kolkata\'s iconic Victoria Memorial and its surroundings.', 950.00, 4, 'hotel, guide, transport'),
(13, 47, 'Khajuraho Temples Trek', 'Marvel at the ancient temples and exquisite sculptures of Khajuraho.', 1100.00, 4, 'hotel, guide, transport')
";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
}catch(PDOException $o){
    echo("<br>DUPLICATE ENTRY!");
}

// AdminLogs
$c = "create table AdminLogs(
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action TEXT NOT NULL,
    action_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES user_details(user_id)
        ON DELETE CASCADE ON UPDATE CASCADE
);";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
    echo("<br>AdminLogs created!");
}catch(PDOException $o){
    echo("<br>AdminLogs not created...");
}
$c="insert into AdminLogs(log_id, admin_id, action, action_date) 
values 
(1, 3, 'Added a new destination : Jaipur', '2024-12-10 12:00:00'),
(2, 3, 'Updated package details for Chennai Tour', '2024-12-10 13:00:00');";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
}catch(PDOException $o){
    echo("<br>DUPLICATE ENTRY!");
}


// Bookings
$c = "create table Bookings(
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    package_id INT NOT NULL,
    user_id INT NOT NULL,
    booking_date DATE NOT NULL,
    travel_date DATE NOT NULL,
    status ENUM('confirmed', 'pending', 'canceled') DEFAULT 'pending',
    total_price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_details(user_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (package_id) REFERENCES Packages(package_id)
        ON DELETE CASCADE ON UPDATE CASCADE
);";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
    echo("<br>Bookings created!");
}catch(PDOException $o){
    echo("<br>Bookings not created...");
}

$c = "insert into Bookings
(booking_id, package_id, user_id, booking_date, travel_date, status, total_price)
values
(1, 1, 1, '2024-10-01', '2024-12-15', 'confirmed', 550.00),
(2, 2, 2, '2024-10-02', '2024-12-15', 'confirmed', 1200.00),
(3, 2, 3, '2024-10-04', '2024-12-15', 'confirmed', 900.00),
(4, 1, 2, '2024-10-06', '2024-12-15', 'pending', 440.00),
(5, 7, 2, '2024-10-02', '2024-12-15', 'confirmed', 1500.00),
(6, 4, 2, '2024-10-07', '2024-12-15', 'confirmed', 1000.00),
(7, 3, 3, '2024-10-10', '2024-12-15', 'pending', 600.00),
(8, 6, 2, '2024-10-12', '2024-12-15', 'pending', 530.00),
(9, 5, 2, '2024-10-01', '2024-12-15', 'confirmed', 420.00),
(10, 3, 3, '2024-10-03', '2024-12-15', 'confirmed', 1020.00),
(11, 4, 1, '2024-10-15', '2024-12-15', 'confirmed', 330.00),
(12, 3, 2, '2024-10-09', '2024-12-15', 'confirmed', 3100.00),
(13, 5, 1, '2024-10-11', '2024-12-15', 'pending', 200.00),
(14, 6, 3, '2024-10-04', '2024-12-15', 'confirmed', 280.00),
(15, 7, 1, '2024-10-22', '2024-12-15', 'confirmed', 500.00),
(16, 3, 1, '2024-10-08', '2024-12-15', 'pending', 2040.00),
(17, 1, 3, '2024-10-07', '2024-12-15', 'confirmed',  960.00),
(18, 3, 3, '2024-10-06', '2024-12-15', 'confirmed', 310.00);";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
}catch(PDOException $o){
    echo("<br>DUPLICATE ENTRY!");
}

// Tickets
$c = "create table Tickets
(
    ticket_id INT PRIMARY KEY AUTO_INCREMENT,
    booking_id INT,
    issue_date DATETIME,
    ticket_number VARCHAR(20) NOT NULL,
    status ENUM('confirmed', 'pending', 'canceled') DEFAULT 'pending',
    FOREIGN KEY (booking_id) REFERENCES Bookings(booking_id)
);";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
    echo("<br>Tickets created!");
}catch(PDOException $o){
    echo("<br>Tickets not created...");
}
$c = "insert into Tickets (ticket_id, booking_id, issue_date, ticket_number, status)
values
(1, 1, '2024-10-01 12:00:00', 'TCKT1001', 'confirmed'),
(2, 2, '2024-10-02 12:00:00', 'TCKT1002', 'confirmed'),
(3, 3, '2024-10-03 12:00:00', 'TCKT1003', 'confirmed'),
(4, 4, '2024-10-04 12:00:00', 'TCKT1004', 'pending'),
(5, 5, '2024-10-05 12:00:00', 'TCKT1005', 'confirmed'),
(6, 6, '2024-10-06 12:00:00', 'TCKT1006', 'confirmed'),
(7, 7, '2024-10-07 12:00:00', 'TCKT1007', 'pending'),
(8, 8, '2024-10-08 12:00:00', 'TCKT1008', 'pending'),
(9, 9, '2024-10-09 12:00:00', 'TCKT1009', 'confirmed'),
(10, 10, '2024-10-10 12:00:00', 'TCKT1010', 'confirmed'),
(11, 11, '2024-10-11 12:00:00', 'TCKT1011', 'confirmed'),
(12, 12, '2024-10-12 12:00:00', 'TCKT1012', 'confirmed'),
(13, 13, '2024-10-13 12:00:00', 'TCKT1013', 'pending'),
(14, 14, '2024-10-14 12:00:00', 'TCKT1014', 'confirmed'),
(15, 15, '2024-10-15 12:00:00', 'TCKT1015', 'confirmed'),
(16, 16, '2024-10-16 12:00:00', 'TCKT1016', 'pending'),
(17, 17, '2024-10-17 12:00:00', 'TCKT1017', 'confirmed'),
(18, 18, '2024-10-18 12:00:00', 'TCKT1018', 'confirmed');";

$st = $dbo->conn->prepare($c);
try {
    $st->execute();
} catch (PDOException $o) {
    echo("<br>DUPLICATE ENTRY!");
}



// Payments
$c = "create table Payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    amount DECIMAL(10, 2) NOT NULL,
    payment_method ENUM('Credit Card', 'Debit Card', 'UPI', 'Net Banking'),
    status ENUM('completed', 'pending', 'failed') DEFAULT 'pending',
    transaction_id VARCHAR(255) UNIQUE,
    FOREIGN KEY (booking_id) REFERENCES Bookings(booking_id)
        ON DELETE CASCADE ON UPDATE CASCADE)";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
    echo("<br>Payments created!");
}catch(PDOException $o){
    echo("<br>Payments not created...");
}
$c = "insert into Payments (payment_id, booking_id, payment_date, amount, payment_method, status, transaction_id)
values
(1, 1, '2024-10-01 12:00:00', 550.00, 'Credit Card', 'completed', 'TXN12345'),
(2, 2, '2024-10-02 13:00:00', 1200.00, 'UPI', 'pending', 'TXN12355'),
(3, 3, '2024-10-04 09:00:00', 900.00, 'Net Banking', 'completed', 'TXN12875'),
(4, 4, '2024-10-06 07:00:00', 440.00, 'Net Banking', 'failed', 'TXN1792345'),
(5, 5, '2024-10-02 13:00:00', 1500.00, 'Debit Card', 'pending', 'TXN1298745'),
(6, 6, '2024-10-07 15:00:00', 1000.00, 'UPI', 'completed', 'TXN1256345'),
(7, 7, '2024-10-10 22:00:00', 600.00, 'Debit Card', 'pending', 'TXN14992345'),
(8, 8, '2024-10-12 14:00:00', 530.00, 'Credit Card', 'completed', 'TXN1982345'),
(9, 9, '2024-10-01 15:00:00', 420.00, 'Debit Card', 'completed', 'TXN3412345'),
(10, 10, '2024-10-03 16:00:00', 1020.00, 'Net Banking', 'pending', 'TXN1298345'),
(11, 11, '2024-10-15 16:00:00', 330.00, 'Net Banking', 'pending', 'TXN12365445'),
(12, 12, '2024-10-09 20:00:00', 3100.00, 'Debit Card', 'completed', 'TXN12339645'),
(13, 13, '2024-10-11 14:00:00', 200.00, 'UPI', 'completed', 'TXN15282345'),
(14, 14, '2024-10-04 21:00:00', 280.00, 'UPI', 'failed', 'TXN10002345'),
(15, 15, '2024-10-22 14:00:00', 500.00, 'Debit Card', 'completed', 'TXN12555345'),
(16, 16, '2024-10-08 17:00:00', 2040.00, 'Debit Card', 'completed', 'TXN1237745'),
(17, 17, '2024-10-07 15:00:00', 960.00, 'Net Banking', 'completed', 'TXN1288345'),
(18, 18, '2024-10-06 15:00:00', 310.00, 'Net Banking', 'failed', 'TXN12222345')";

$st = $dbo->conn->prepare($c);
try{
    $st->execute();
}catch(PDOException $o){
    echo("<br>DUPLICATE ENTRY!");
}

// Reviews
$c = "create table Reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    package_id INT NOT NULL,
    rating TINYINT CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    review_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_details(user_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (package_id) REFERENCES Packages(package_id)
        ON DELETE CASCADE ON UPDATE CASCADE
);";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
    echo("<br>Reviews created!");
}catch(PDOException $o){
    echo("<br>Reviews not created...");
}
$c = "insert into Reviews (user_id, package_id, rating, comment)
values
(1, 1, 5, 'The Paris trip was amazing! Great service and organization.'),
(2, 2, 4, 'The Maldives retreat was luxurious, but the transport could have been better.')";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
}catch(PDOException $o){
    echo("<br>DUPLICATE ENTRY!");
}

// Inquiries
$c = "create table Inquiries (
    inquiry_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    inquiry_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    resolved_status ENUM('resolved', 'unresolved') DEFAULT 'unresolved'
);";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
    echo("<br>Inquiries created!");
}catch(PDOException $o){
    echo("<br>Inquiries not created...");
}
$c = "insert into Inquiries (first_name, last_name, email, message, inquiry_date, resolved_status) 
VALUES 
('Joy', 'Nguenhat', 'joy.nguenhat@gmail.com', 'I need more details about the Delhi package.', '2024-12-09 16:00:00', 'unresolved'),
('Ramya', 'Nandan', 'ramya.nandan@gmail.com', 'When will the package for Jammu be available?', '2024-12-07 15:00:00', 'unresolved'),
('Jim', 'Dong', 'jim.dong@gmail.com', 'Is there a discount for group bookings?', '2024-12-08 10:00:00', 'resolved')";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
}catch(PDOException $o){
    echo("<br>DUPLICATE ENTRY!");
}

// Wishlist
$c = "create table Wishlist (
    wishlist_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    package_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_details(user_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (package_id) REFERENCES Packages(package_id)
        ON DELETE CASCADE ON UPDATE CASCADE
);";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
    echo("<br>Wishlist created!");
}catch(PDOException $o){
    echo("<br>Wishlist not created...");
}
$c = "insert into Wishlist (user_id, package_id) 
VALUES 
(1, 2),
(2, 3);";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
}catch(PDOException $o){
    echo("<br>DUPLICATE ENTRY!");
}

// Coupons
$c = "create table Coupons (
    coupon_id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) UNIQUE NOT NULL,
    discount_percentage DECIMAL(5, 2) NOT NULL,
    expiry_date DATE NOT NULL
);";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
    echo("<br>Coupons created!");
}catch(PDOException $o){
    echo("<br>Coupons not created...");
}
$c = "insert into Coupons (code, discount_percentage, expiry_date) 
VALUES 
('WELCOME10', 10.00, '2024-12-31'),
('HOLIDAY15', 15.00, '2025-01-15');
";
$st = $dbo->conn->prepare($c);
try{
    $st->execute();
}catch(PDOException $o){
    echo("<br>DUPLICATE ENTRY!");
}


?>
