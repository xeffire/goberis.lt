CREATE TABLE  shopUsers (
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    cartId INT(10)
);

CREATE TABLE carts (
    cartId INT(10) NOT NULL,
    itemId INT(10) NOT NULL
);

CREATE TABLE items (
    id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    price INT(10) NOT NULL,
    img VARCHAR(255) NOT NULL
);

INSERT INTO items (name, price, img) VALUES 
('apple', 299, 'images/apple.jpg'),
('cherry', 449, 'images/cherry.jpg'),
('orange', 199, 'images/orange.jpg'),
('pineapple', 489, 'images/pineapple.jpg'),
('strawberry', 599, 'images/strawberry.jpg'),
('watermelon', 469, 'images/watermelon.jpg');