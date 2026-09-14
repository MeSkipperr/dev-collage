-- =========================================
-- CREATE DATABASE
-- =========================================
CREATE DATABASE IF NOT EXISTS meeting_room_booking;
USE meeting_room_booking;

-- =========================================
-- BUILDING
-- =========================================
CREATE TABLE IF NOT EXISTS building (
    building_id INT AUTO_INCREMENT PRIMARY KEY,
    building_name VARCHAR(100) NOT NULL UNIQUE,
    address VARCHAR(255),
    total_floor INT NOT NULL
);

-- =========================================
-- ROOM
-- =========================================
CREATE TABLE IF NOT EXISTS room (
    room_id INT AUTO_INCREMENT PRIMARY KEY,
    building_id INT NOT NULL,
    room_name VARCHAR(100) NOT NULL,
    floor INT NOT NULL,
    capacity INT NOT NULL,
    status ENUM('Available','Maintenance') DEFAULT 'Available',

    CONSTRAINT fk_room_building
        FOREIGN KEY (building_id)
        REFERENCES building(building_id),

    CONSTRAINT uq_room UNIQUE(building_id, room_name)
);

-- =========================================
-- FACILITY
-- =========================================
CREATE TABLE IF NOT EXISTS facility (
    facility_id INT AUTO_INCREMENT PRIMARY KEY,
    facility_name VARCHAR(100) NOT NULL UNIQUE,
    description VARCHAR(255)
);

-- =========================================
-- ROOM FACILITY
-- =========================================
CREATE TABLE IF NOT EXISTS room_facility (
    room_id INT NOT NULL,
    facility_id INT NOT NULL,

    PRIMARY KEY(room_id, facility_id),

    CONSTRAINT fk_rf_room
        FOREIGN KEY(room_id)
        REFERENCES room(room_id)
        ON DELETE CASCADE,

    CONSTRAINT fk_rf_facility
        FOREIGN KEY(facility_id)
        REFERENCES facility(facility_id)
        ON DELETE CASCADE
);

-- =========================================
-- BOOKING
-- =========================================
CREATE TABLE IF NOT EXISTS booking (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    room_id INT NOT NULL,
    meeting_title VARCHAR(150) NOT NULL,
    organizer VARCHAR(100) NOT NULL,
    meeting_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    participant_count INT,
    status ENUM('Scheduled','Completed','Cancelled')
        DEFAULT 'Scheduled',

    CONSTRAINT fk_booking_room
        FOREIGN KEY(room_id)
        REFERENCES room(room_id)
);

-- =========================================
-- USER
-- =========================================
CREATE TABLE IF NOT EXISTS user (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- =========================================
-- DUMMY DATA
-- =========================================

-- BUILDING
INSERT INTO building (building_name,address,total_floor)
SELECT * FROM (
    SELECT 'Gedung Utama','Jl. Merdeka No.10',5
) AS tmp
WHERE NOT EXISTS (
    SELECT 1 FROM building
    WHERE building_name='Gedung Utama'
);

INSERT INTO building (building_name,address,total_floor)
SELECT * FROM (
    SELECT 'Gedung Teknologi','Jl. Sudirman No.20',8
) AS tmp
WHERE NOT EXISTS (
    SELECT 1 FROM building
    WHERE building_name='Gedung Teknologi'
);

-- =========================================
-- ROOM
-- =========================================

INSERT INTO room(building_id,room_name,floor,capacity,status)
SELECT * FROM(
SELECT
    (SELECT building_id FROM building WHERE building_name='Gedung Utama'),
    'Orchid',
    2,
    10,
    'Available'
) x
WHERE NOT EXISTS(
SELECT 1 FROM room WHERE room_name='Orchid'
);

INSERT INTO room(building_id,room_name,floor,capacity,status)
SELECT * FROM(
SELECT
    (SELECT building_id FROM building WHERE building_name='Gedung Utama'),
    'Lotus',
    3,
    20,
    'Available'
) x
WHERE NOT EXISTS(
SELECT 1 FROM room WHERE room_name='Lotus'
);

INSERT INTO room(building_id,room_name,floor,capacity,status)
SELECT * FROM(
SELECT
    (SELECT building_id FROM building WHERE building_name='Gedung Teknologi'),
    'Sakura',
    5,
    8,
    'Maintenance'
) x
WHERE NOT EXISTS(
SELECT 1 FROM room WHERE room_name='Sakura'
);

-- =========================================
-- FACILITY
-- =========================================

INSERT INTO facility(facility_name,description)
SELECT * FROM(
SELECT 'Projector','LCD Projector'
) x
WHERE NOT EXISTS(
SELECT 1 FROM facility WHERE facility_name='Projector'
);

INSERT INTO facility(facility_name,description)
SELECT * FROM(
SELECT 'Whiteboard','Magnetic Whiteboard'
) x
WHERE NOT EXISTS(
SELECT 1 FROM facility WHERE facility_name='Whiteboard'
);

INSERT INTO facility(facility_name,description)
SELECT * FROM(
SELECT 'Video Conference','Conference Camera'
) x
WHERE NOT EXISTS(
SELECT 1 FROM facility WHERE facility_name='Video Conference'
);

INSERT INTO facility(facility_name,description)
SELECT * FROM(
SELECT 'Smart TV','75 Inch Smart TV'
) x
WHERE NOT EXISTS(
SELECT 1 FROM facility WHERE facility_name='Smart TV'
);

-- =========================================
-- ROOM FACILITY
-- =========================================

INSERT IGNORE INTO room_facility(room_id,facility_id)
SELECT
    r.room_id,
    f.facility_id
FROM room r
JOIN facility f
WHERE r.room_name='Orchid'
AND f.facility_name='Projector';

INSERT IGNORE INTO room_facility(room_id,facility_id)
SELECT
    r.room_id,
    f.facility_id
FROM room r
JOIN facility f
WHERE r.room_name='Orchid'
AND f.facility_name='Whiteboard';

INSERT IGNORE INTO room_facility(room_id,facility_id)
SELECT
    r.room_id,
    f.facility_id
FROM room r
JOIN facility f
WHERE r.room_name='Lotus'
AND f.facility_name='Projector';

INSERT IGNORE INTO room_facility(room_id,facility_id)
SELECT
    r.room_id,
    f.facility_id
FROM room r
JOIN facility f
WHERE r.room_name='Lotus'
AND f.facility_name='Video Conference';

INSERT IGNORE INTO room_facility(room_id,facility_id)
SELECT
    r.room_id,
    f.facility_id
FROM room r
JOIN facility f
WHERE r.room_name='Sakura'
AND f.facility_name='Smart TV';

-- =========================================
-- BOOKING
-- =========================================

INSERT INTO booking
(room_id,meeting_title,organizer,meeting_date,start_time,end_time,participant_count,status)
SELECT * FROM(
SELECT
    (SELECT room_id FROM room WHERE room_name='Orchid'),
    'Sprint Planning',
    'Divisi IT',
    '2026-07-10',
    '09:00:00',
    '10:30:00',
    8,
    'Scheduled'
) x
WHERE NOT EXISTS(
SELECT 1
FROM booking
WHERE meeting_title='Sprint Planning'
AND meeting_date='2026-07-10'
);

INSERT INTO booking
(room_id,meeting_title,organizer,meeting_date,start_time,end_time,participant_count,status)
SELECT * FROM(
SELECT
    (SELECT room_id FROM room WHERE room_name='Lotus'),
    'Monthly Evaluation',
    'HR Department',
    '2026-07-11',
    '13:00:00',
    '15:00:00',
    15,
    'Scheduled'
) x
WHERE NOT EXISTS(
SELECT 1
FROM booking
WHERE meeting_title='Monthly Evaluation'
AND meeting_date='2026-07-11'
);

INSERT INTO booking
(room_id,meeting_title,organizer,meeting_date,start_time,end_time,participant_count,status)
SELECT * FROM(
SELECT
    (SELECT room_id FROM room WHERE room_name='Sakura'),
    'Vendor Meeting',
    'Procurement',
    '2026-07-12',
    '10:00:00',
    '11:00:00',
    6,
    'Cancelled'
) x
WHERE NOT EXISTS(
SELECT 1
FROM booking
WHERE meeting_title='Vendor Meeting'
AND meeting_date='2026-07-12'
);

-- =========================================
-- USER
-- =========================================

INSERT INTO user (username, password)
SELECT * FROM(
SELECT 'admin','$2y$10$4lcqfbpXo2neIPFdDZOFF.MzIl.fDiOkoRMh0sDAvsVE9fVJHVG.y'
) x
WHERE NOT EXISTS(
SELECT 1 FROM user WHERE username='admin'
);