DROP TABLE IF EXISTS registered_user cascade;
CREATE TABLE registered_user(
  userid serial PRIMARY KEY ,
  email TEXT NOT NULL,
  username TEXT NOT NULL,
  userpassword TEXT NOT NULL,
  isBlocked Bool Not NULL,
  isAdmin Bool Not NULL
) ;

DROP TABLE IF EXISTS credit_card cascade;
CREATE TABLE credit_card(
	cardid serial  PRIMARY KEY,
	ownername text not null,
	cardnumber text not null,
	securitycode int not null,
	userid int not null references registered_user(userid)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);


DROP TABLE IF EXISTS author cascade;
CREATE TABLE author(
	authorid serial PRIMARY KEY,
	authorname   TEXT NOT NULL
);


DROP TABLE IF EXISTS book_content cascade;

CREATE TABLE book_content (
  	bookid serial PRIMARY KEY,
  	title TEXT NOT NULL,
  	bookyear int NOT NULL,
  	average float ,
	authorid int NOT NULL REFERENCES author(authorid)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ;



DROP TABLE IF EXISTS category cascade;
CREATE TABLE category (
  categoryid serial PRIMARY KEY,
  label varchar(64) UNIQUE NOT NULL
);


DROP TABLE IF EXISTS belongs_to_category cascade;
CREATE TABLE belongs_to_category (
  bookid serial not null REFERENCES book_content(bookid) 
	    ON UPDATE CASCADE
		ON DELETE CASCADE,
  categoryid int NOT NULL REFERENCES category(categoryid)
	   ON UPDATE CASCADE
		ON DELETE CASCADE,
  PRIMARY KEY ( bookid,categoryid)
) ;

DROP TABLE IF EXISTS review cascade;
CREATE TABLE review (
	reviewid serial PRIMARY KEY,
	reviewcomment text,
	rating int default 1 check (rating >0 and rating <= 5),
	timeposted date not null default CURRENT_TIMESTAMP,
	userid int not null references registered_user(userid)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	bookid int not null references book_content(bookid)
	ON UPDATE CASCADE
	ON DELETE CASCADE
	);


DROP TABLE IF EXISTS book_product cascade;
CREATE TABLE book_product(
	bookid serial PRIMARY KEY,
	price Float not null check (price > 0),
	stock int not null default 0 check (stock>=0),
	publisher text ,
	edition int,
	booktype text not null check (booktype  in ('physical book', 'ebook')),
	bookcontentid int not null references book_content(bookid)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);
	

DROP TABLE IF EXISTS user_order cascade;
CREATE TABLE user_order(
	orderid serial PRIMARY KEY,
	orderdate  date not null  default CURRENT_TIMESTAMP ,
	creditcardid int not null references credit_card(cardid)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	userid int not null references registered_user(userid)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

	


DROP TABLE IF EXISTS order_information cascade;
CREATE TABLE order_information(
	orderid serial not null references user_order(orderid)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	bookid int not null references book_product(bookid)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	priceBought Float not null,
	orderStatus text not null check (orderStatus in ('PROCESSING' , 'ON TRANSIT', 'ARRIVED')),
	quantity int not null default 1,
	PRIMARY KEY(orderid, bookid)
);


DROP TABLE IF EXISTS cart cascade;
CREATE TABLE cart(
	bookid serial not null references book_product(bookid)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	userid int not null references registered_user(userid)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	quantity int not null default 1 check (quantity>0),
	PRIMARY KEY (bookid, userid)
);
DROP TABLE IF EXISTS wishlist cascade;
CREATE TABLE wishlist(
	bookid serial not null references book_product(bookid)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	userid int not null references registered_user(userid)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	PRIMARY KEY (bookid, userid)
);


DROP TABLE IF EXISTS notification cascade;
CREATE TABLE notification(
	notificationid serial PRIMARY KEY,
	notificationMessage text not null,
	notificationTime date not null  default CURRENT_TIMESTAMP,
	userid int not null,
	orderid int not null,
	bookid int not null,
	FOREIGN KEY (userid) references registered_user(userid)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY (orderid, bookid) references order_information(orderid, bookid)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

DROP TABLE IF EXISTS report cascade;
create table report(
	reportid serial PRIMARY KEY,
	description text not null,
	isHandeled text check (isHandeled in ('WAITING FOR ADMIN', 'IN PROCESS',  'DEALT WITH')),
	userid int not null references registered_user(userid)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	adminid int references registered_user(userid)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);




INSERT INTO author(authorid, authorname) VALUES (1, 'Marta Mariz'),
(2, 'JK ROWLING'), (3,'José Saramago'), (4, 'Fernado Pessoa'), (5, 'Sally Rooney'), (6, 'Milan Kundera');

INSERT INTO registered_user (userid, email, username, userpassword, isBlocked, isAdmin) VALUES
 (1,'joaopinto@mail.com','passdojoao','João Pinto',True, False),
 (2,'xaviersemedo@mail.com','passdoxavier','Xavier Semedo',False, True),
 (3,'filipamendes@mail.com','passdafilipa','Filipa Mendes', False, False),
 (4,'evamendes@mail.com','passdaeva','Eva Mendes', False, False),
 (5,'pedrosimoes@mail.com','passdopedro','Pedro Simões', False, False),
 (6,'mariasilva@mail.com','passdamaria','Maria Silva', False, False),
 (7,'josesantos@mail.com','passdojose','José Santos', False, False),
 (8,'filipamagalhães@mail.com','passdafilipa','Filipa Magalhães', False, False),
 (9,'joaosantorini@mail.com','passdojoao','João Santorini', False, False),
 (10,'joanamoreira@mail.com','passdajoana','Joana Moreira', False, False),
 (11,'augustosousa@mail.com','passdoaugusto','Augusto Sousa', False, False),
 (12,'alexandraromeu@mail.com','passdaalexandra','Alexandra Romeu', False, False),
 (13,'fabiocruz@mail.com','passdofabio','Fábio Cruz', False, False),
 (14,'antoniomota@mail.com','passdoantonio','António Mota', False, False),
 (15,'feliciaantunes@mail.com','passdafelicia','Felícia Antunes', False, False),
 (16,'gabrielsilva@mail.com','passdogabriel','Gabriela Silva', False, False),
 (17,'gastaopinto@mail.com','passdogastão','Gastão Pinto', False, True);
 
 
 INSERT INTO credit_card (cardid, ownername, cardnumber, securitycode, userid) VALUES
(1, 'João Pinto', '4701470123', 214, 1),
(2, 'Maria Pinto', '8910103817', 311,2),
(3, 'Maria Pinto', '2428193713', 311,2);


INSERT INTO book_content (bookid, title, bookyear, average, authorid) VALUES
(1,'Harry Potter e a pedra filosofal',1968, 4.7, 2),
(2,'Normal People',2018, 4.7, 5),
(3,'O ano da morte de Ricardo Reis', 1998, 4.9,3),
(4,'A insustentável leveza do ser', 1980,4.5, 6),
(5,'Harry Potter e a câmara dos segredos',2001, 4.7, 2);


 
 
INSERT INTO category (categoryid, label) VALUES
(1,'Romance'),(2,'Comedy'),(3,'Biography'),(4,'Sport'),(5,'Drama'),
(6,'Sci-Fi'),(7,'Western'),(8,'War'),(9,'Adventure'),(10,'Horror'),
(11,'Fantasy'),(12,'Mystery'),(13,'Crime'),(14,'Family'),(15,'History');


INSERT INTO belongs_to_category(bookid, categoryid) VALUES
(1,11), (1,14),(1,9),(2,1),(2,5),(3,1),(4,15),(5,6);
 
 
INSERT INTO review (reviewid, reviewcomment, rating, timeposted, userid, bookid) VALUES
(1,'very cool', 4, '2001-01-01 01:01:01',1,2),
(2,null, 2, '2011-11-21 22:01:01',2,1),
(3,'life changing', 5, '2020-11-21 22:01:01',2,1);



INSERT INTO book_product (bookid, price, stock, publisher, edition, booktype, bookcontentid) VALUES
(1, 15.99, 10000, 'Porto-Editora', 4, 'physical book', 1),
(2, 7.99, 0, 'Porto-Editora', 2,'ebook', 1),
(3, 12.99, 12,'ASA', 1, 'physical book', 2),
(4, 12.99, 0,'Porto-Editora', 4, 'ebook', 2),
(5, 12.99, 2,'NY', 1, 'physical book', 2);
	
	

	
INSERT INTO user_order (orderid, orderdate, creditcardid, userid) VALUES
(1,'2021-01-01 21:42:01', 2, 2),
(2,'2021-10-31 04:32:56', 2, 2),
(3,'2021-11-12 02:48:12', 3, 2),
(4,'2021-08-04 22:24:41', 1, 1);
	
	

INSERT INTO order_information (orderid, bookid, priceBought, orderStatus, quantity) VALUES
(1,2, 15.99, 'ON TRANSIT', 1),
(1, 3, 10.99, 'PROCESSING', 2),
(1, 4, 10.99, 'PROCESSING', 1),
(2, 3, 6.09, 'ARRIVED', 1),
(3, 1, 10.99, 'PROCESSING', 1),
(4, 3, 11.99, 'PROCESSING', 1);


INSERT INTO cart(bookid, userid, quantity) VALUES 
(1, 1, 2),(2,1,1),(4,1,1),(2,2,1),(1,3,1),(3,3,1);


INSERT INTO wishlist(bookid, userid) VALUES 
(4,1),(5,1),(3,2),(4,2),(2,2),(1,4);	


INSERT INTO notification(notificationMessage, notificationTime, userid, orderid, bookid ) VALUES
('Status changed', '2021-01-01 21:42:01', 1,1,3 ),
('Status changed', '2021-01-10 22:12:01', 3,1,2 ),
('Status changed', '2021-01-04 11:34:01', 4, 1,4);


INSERT INTO report (reportid, description, isHandeled, userid, adminid) VALUES
(1, 'Website is lagging ', 'WAITING FOR ADMIN', 1, null),
(2, 'Website is lagging ', 'WAITING FOR ADMIN', 3, null),
(3, 'Wrong order ', 'DEALT WITH', 14, 2);