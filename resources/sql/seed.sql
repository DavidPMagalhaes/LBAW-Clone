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
        ON DELETE CASCADE,
	bookcover TEXT 
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
    timeposted Time WITH TIME ZONE not null default CURRENT_TIMESTAMP,
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
    booktype text not null check (booktype  in ('physical', 'e-book')),
    bookcontentid int not null references book_content(bookid)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);
    

DROP TABLE IF EXISTS user_order cascade;
CREATE TABLE user_order(
    orderid serial PRIMARY KEY,
    orderdate Time WITH TIME ZONE not null  default CURRENT_TIMESTAMP ,
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
    notificationTime time WITH TIME ZONE not null  default CURRENT_TIMESTAMP,
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


INSERT INTO author(authorid, authorname) VALUES  (1,'Ayanna Stephens'),
  (2,'Stacy Hoffman'),
  (3,'Hall Oliver'),
  (4,'Anne Herrera'),
  (5,'Felix Velasco'),
  (6,'Marah Kowalski'),
  (7,'Diana Lawrence'),
  (8,'Hall Serrano'),
  (9,'Fredericka Arias'),
  (10,'Owen Strauß'),
  (11,'Maris Wenzler'),
  (12,'Hadley Fernandez'),
  (13,'Wallace Wright'),
  (14,'Vielka Howard'),
  (15,'Mona Prieto'),
  (16,'Caleb Marshall'),
  (17,'Kitra Wenzler'),
  (18,'Cade Merkle'),
  (19,'Christen Ford'),
  (20,'Teagan Moreno'),
  (21,'Tucker Bravo'),
  (22,'Nora Cook'),
  (23,'Keelie Merino'),
  (24,'Maite Schubert'),
  (25,'Edan Hanson'),
  (26,'Brock Fink'),
  (27,'Aurelia Weber'),
  (28,'Magee Martin'),
  (29,'Hilel Muñoz'),
  (30,'Nehru Pietsch');

INSERT INTO registered_user (userid, email, username, userpassword, isBlocked, isAdmin) VALUES
(1,'Malcolm Pratt','malcolmpratt9095@protonmail.com','FXL66AEP1CP4','False','False'),
  (2,'Inez Newton','ineznewton6225@protonmail.org','AKB72VUA3JM1','True','False'),
  (3,'Jena French','jenafrench@outlook.couk','DMI81FCZ1QQ3','False','False'),
  (4,'Nichole Wright','nicholewright8299@hotmail.ca','UFX55VWC9GL0','True','False'),
  (5,'Zahir Craft','zahircraft7246@yahoo.ca','TXD78IMK2OX7','True','True'),
  (6,'Lev Mccarthy','levmccarthy@outlook.org','RGO41XKX6NB6','False','True'),
  (7,'Hashim Madden','hashimmadden7128@google.edu','WZO45WKG0BX4','False','False'),
  (8,'Jessica Ochoa','jessicaochoa5418@icloud.ca','QJW41SKY8PJ2','False','True'),
  (9,'Savannah Dixon','savannahdixon2572@protonmail.ca','KXM46YVK5NQ8','False','True'),
  (10,'Jaden Kane','jadenkane@outlook.org','QIV75SFQ1JU6','True','True'),
  (11,'Lewis Michael','lewismichael7278@outlook.net','ZPP03GYI2RO7','True','True'),
  (12,'Malachi Waller','malachiwaller2036@yahoo.edu','WOL24AGT6KJ6','False','True'),
  (13,'Daquan Marks','daquanmarks@google.com','AWB18RRZ2OI6','True','False'),
  (14,'Amir Washington','amirwashington@google.ca','RZM35MZH7YG1','False','True'),
  (15,'Wanda Pennington','wandapennington4865@aol.edu','KCC88PQS3LM5','True','False'),
  (16,'Melvin Glenn','melvinglenn@yahoo.net','OJD26QHI8JV7','False','True'),
  (17,'Dean Baird','deanbaird5809@yahoo.com','OJL38PRG7FW8','False','False'),
  (18,'Eleanor Byrd','eleanorbyrd@hotmail.org','MMD45INE8IT2','True','False'),
  (19,'Ursa Rosa','ursarosa4328@icloud.com','RXQ37AMV7XM8','False','True'),
  (20,'Mason Peters','masonpeters@outlook.net','NEI07RHX8OY5','False','True'),
  (21,'Jared Atkins','jaredatkins4278@hotmail.couk','IIB86COT8YE8','False','False'),
  (22,'Randall Alexander','randallalexander2597@google.ca','XDO47QJI2ZZ2','False','True'),
  (23,'Natalie Rosa','natalierosa6697@icloud.net','RKA81HWP5EY3','False','True'),
  (24,'Richard Mcguire','richardmcguire6079@outlook.ca','MLP35NXL2MQ5','True','False'),
  (25,'Cooper Flores','cooperflores@outlook.couk','KJO31ACX7FP9','False','False'),
  (26,'Keaton Bush','keatonbush@outlook.ca','OXR51WOE2DS0','True','True'),
  (27,'Gemma Fleming','gemmafleming4125@protonmail.com','IDJ32IYH7JL7','True','True'),
  (28,'Shannon Hampton','shannonhampton4653@icloud.ca','QYK75JKS5GP8','False','True'),
  (29,'Tyrone Deleon','tyronedeleon5301@aol.com','MPI03MGQ4HT8','True','True'),
  (30,'Jacqueline Stevens','jacquelinestevens9551@yahoo.ca','QEJ70FFW1CY5','True','True'),
  (31,'Xyla Contreras','xylacontreras8390@outlook.com','QEY56PME4OW4','True','False'),
  (32,'Zephania Hooper','zephaniahooper8316@aol.ca','AUC05ENP6VL8','False','True'),
  (33,'Jermaine Hutchinson','jermainehutchinson@outlook.net','NYD97KLQ7RW5','True','False'),
  (34,'Gay Velez','gayvelez3464@yahoo.com','IPC32JWK0SS3','False','False'),
  (35,'Mariko Orr','marikoorr2280@google.org','UAF86NXP4PT2','False','False'),
  (36,'Yuri Dale','yuridale@icloud.couk','SNP45VPX6TV6','False','True'),
  (37,'Rhonda Graves','rhondagraves6791@hotmail.org','VYX13ZRO9NA4','False','False'),
  (38,'Claire French','clairefrench@hotmail.edu','TEN56YFI3IJ4','False','True'),
  (39,'Carol Benson','carolbenson@outlook.edu','ITQ48XWB2WD6','True','True'),
  (40,'Nero Estes','neroestes@protonmail.couk','GYD25RUK2NC8','False','False'),
  (41,'Tanisha Short','tanishashort2488@yahoo.couk','EDG19UCE0JK5','False','False'),
  (42,'Forrest Gill','forrestgill3331@protonmail.net','YEE83OBS6CF2','False','False'),
  (43,'Hedley Compton','hedleycompton@google.org','IWN16IWC2BR9','False','True'),
  (44,'Chloe Mckay','chloemckay@google.ca','LOZ54CSO1WW8','False','False'),
  (45,'Nevada Frost','nevadafrost@protonmail.com','VSK09FQP8LC9','False','False'),
  (46,'Hope Barlow','hopebarlow@protonmail.com','YFT27BJT6FY3','False','False'),
  (47,'Erica Howell','ericahowell@icloud.edu','HJN53VLJ4ZP4','True','False'),
  (48,'Cailin Brooks','cailinbrooks6961@hotmail.edu','SFH72VOV6BT4','True','True'),
  (49,'Josiah Watson','josiahwatson4219@protonmail.edu','JTS34FUI8IT8','False','False'),
  (50,'Herman Hamilton','hermanhamilton1778@outlook.edu','KSU35BPX4EH4','True','False');
 
 
 INSERT INTO credit_card (cardid, ownername, cardnumber, securitycode, userid) VALUES
(1, 'João Pinto', '4701470123', 214, 1),
(2, 'Maria Pinto', '8910103817', 311,2),
(3, 'Maria Pinto', '2428193713', 311,2);


INSERT INTO book_content (bookid, title, bookyear, average, authorid, bookcover) VALUES
 (1,'woman of glory',2010,'1.9',20, 'https://i.ebayimg.com/images/g/yT0AAOSwScBf~elE/s-l500.jpg'),
  (2,'king of the prison',1989,'2.8',21,'https://images-na.ssl-images-amazon.com/images/I/51ysBE+VPKL.jpg'),
  (3,'blacksmiths with sins',1970,'3.4',29, 'https://images-na.ssl-images-amazon.com/images/I/415CuPjYppL._SX342_SY445_QL70_ML2_.jpg'),
  (4,'robots without faith',2003,'2.0',9, 'https://images-na.ssl-images-amazon.com/images/I/51xie+PczKL._SY344_BO1,204,203,200_.jpg'),
  (5,'bandits and knights',1988,'2.7',26,'https://images-na.ssl-images-amazon.com/images/I/51lnGa8RUQS._SX311_BO1,204,203,200_.jpg'),
  (6,'traitors and robots',2016,'3.2',29, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1420944735l/22929546.jpg'),
  (7,'ruins without desire',1982,'2.6',29, 'https://upload.wikimedia.org/wikipedia/en/thumb/8/8e/Ruins_Smith.jpg/220px-Ruins_Smith.jpg'),
  (8,'inception without sin',1999,'2.9',24, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1628213328l/58710332._SY475_.jpg'),
  (9,'clinging to the immortals',1993,'2.3',6, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1443023859l/25746707.jpg'),
  (10,'escape my futuretraitor of gold',1994,'3.8',9, 'https://images-na.ssl-images-amazon.com/images/I/71ODoJm2YuL.jpg'),
  (11,'tortoise of next year',1979,'1.3',19, 'https://m.media-amazon.com/images/I/51JsJKXkkqL.jpg'),
  (12,'Adam Lindsay',1998,'1.9',2, 'https://images-na.ssl-images-amazon.com/images/I/31DW6gKFg-L._SX313_BO1,204,203,200_.jpg'),
  (13,'guardians of hope',1971,'2.3',29, 'https://images-na.ssl-images-amazon.com/images/I/41aVMHg4%2BTL._AC_UL600_SR384,600_.jpg'),
  (14,'traitors of joy',1972,'3.2',13, 'https://m.media-amazon.com/images/I/41CtM8+im0L.jpg'),
  (15,'rats and hunters',1994,'2.7',27, 'https://images-na.ssl-images-amazon.com/images/I/41GKCBQK15L._SX302_BO1,204,203,200_.jpg'),
  (16,'witches and friends',1991,'3.2',29, 'https://images-na.ssl-images-amazon.com/images/I/81Ql7Oy80EL.jpg'),
  (17,'history of the nation',1983,'2.4',14, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1347621762l/13723762.jpg'),
  (18,'Odessa Copeland',1982,'2.5',19, 'https://images-na.ssl-images-amazon.com/images/I/31-YytYMtPL._SX342_SY445_QL70_ML2_.jpg'),
  (19,'birth of the river',1984,'1.8',29, 'https://thumbs.worthpoint.com/zoom/images1/1/0314/19/birth-river-thomas-donnell-signed-1st_1_e56bf56512a785cc1b8636249261e59f.jpg'),
  (20,'whispers in the west',1980,'3.7',24 , 'https://images-na.ssl-images-amazon.com/images/I/71PCHuzIcnL.jpg'),
  (21,'robot of the solstice',1995,'2.1',4, 'https://images-na.ssl-images-amazon.com/images/I/719HYP216HS.jpg'),
  (22,'hiding the end',1994,'4.0',21, 'https://kbimages1-a.akamaihd.net/36756681-cef7-4797-82b9-aea3e6443207/353/569/90/False/after-the-world-ends-hide-book-2.jpg'),
  (23,'defender of secrets',1992,'3.0',18, 'https://images-na.ssl-images-amazon.com/images/S/cmx-images-prod/Item/19577/OCT110586._SX360_QL80_TTD_.jpg'),
  (24,'Ciara Compton',1996,'3.7',21, 'https://images-na.ssl-images-amazon.com/images/I/81cpnlo5FeS.jpg'),
  (25,'Genevieve Moon',1998,'3.3',9, 'https://images-na.ssl-images-amazon.com/images/I/81jjm5C9tKL.jpg'),
  (26,'excellent imagination',1973,'2.6',23, 'http://www.amreading.com/wp-content/uploads/my-grandmother-asked-me-to-tell-you-shes-sorry-9781501115066_hr-600x901.jpg'),
  (27,'love of nature',1998,'2.9',15, 'https://images-na.ssl-images-amazon.com/images/I/41bJ7Urlg6L._SX331_BO1,204,203,200_.jpg'),
  (28,'clans of the swamp',1982,'3.0',5, 'https://images-na.ssl-images-amazon.com/images/I/817-Al99HUL.jpg'),
  (29,'paintings per realm',2001,'2.4',25, 'http://www.psupress.org/images/covers/294wide/978-0-271-07103-9md_294.jpg'),
  (30,'pests and ancients',2007,'1.8',25,'https://m.media-amazon.com/images/I/41fA8shHWCL.jpg'),
  (31,'insects and moons',1981,'5.0',19, 'https://www.moonstoystore.com/wp-content/uploads/2020/05/2456INSB.jpg'),
  (32,'angels per continent',1979,'2.5',10, 'https://images-na.ssl-images-amazon.com/images/I/816u9mlA0DL.jpg'),
  (33,'deafened by the worldspiders of tomorrow',1971,'3.2',23, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1547966857l/43422483.jpg'),
  (34,'pirates and priests',2012,'3.6',23, 'https://m.media-amazon.com/images/I/412CrRpC-yL.jpg'),
  (35,'figures of a painting',2000,'3.1',29, 'https://images-na.ssl-images-amazon.com/images/I/5153B177FYL.jpg'),
  (36,'defenders of outer space',1999,'2.3',15, 'https://images-na.ssl-images-amazon.com/images/I/513fgAb3C0L._SX324_BO1,204,203,200_.jpg'),
  (37,'gangster of the void',1973,'3.3',2, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1481203033l/30039018.jpg'),
  (38,'vampires and fish',2017,'2.7',5, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1348094753l/7634106.jpg'),
  (39,'owls of destruction',1999,'3.2',17, 'https://images-na.ssl-images-amazon.com/images/I/71yv6CGxbcL.jpg'),
  (40,'Buckminster Shepherd',2011,'4.6',24, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1348263390l/574916.jpg');
 
 
 
 
 
INSERT INTO category (categoryid, label) VALUES
(1,'Romance'),(2,'Comedy'),(3,'Biography'),(4,'Sport'),(5,'Drama'),
(6,'Sci-Fi'),(7,'Western'),(8,'War'),(9,'Adventure'),(10,'Horror'),
(11,'Fantasy'),(12,'Mystery'),(13,'Crime'),(14,'Family'),(15,'History');


INSERT INTO belongs_to_category(bookid, categoryid) VALUES  (1,11),
  (2,4),
  (2,6),
  (3,4),
  (3,8),
  (4,2),
  (4,4),
  (5,10),
  (6,8),
  (6,3),
  (7,2),
  (7,3),
  (8,11),
  (9,8),
  (9,9),
  (9,3),
  (10,3),
  (10,2),
  (11,10),
  (12,8),
  (12,3),
  (13,10),
  (13,2),
  (14,11),
  (15,2),
  (15,10),
  (16,11),
  (16,2),  
  (17,2),
  (17,10),
  (18,1),
  (18,3),
  (19,8),
  (19,7),
  (20,7),
  (20,11),
  (22,9),
  (23,5),
  (24,2),
  (24,3),
  (25,7),
  (25,2),
  (26,5),
  (26,6),
  (27,5),
  (27,4),
  (28,6),
  (28,7),
  (29,1),
  (29,5),
  (30,5),
  (31,4),
  (32,7),
  (33,2),
  (33,5),
  (34,5),
  (35,9),
  (36,10),
  (37,5),
  (38,9),
  (38,7),
  (39,10),
  (40,6),
  (40,7),
  (40,1);
 
 
INSERT INTO review (reviewid, reviewcomment, rating, timeposted, userid, bookid) VALUES
(1,'very cool', 4, '2001-01-01 01:01:01',1,2),
(2,null, 2, '2011-11-21 22:01:01',2,1),
(3,'life changing', 5, '2020-11-21 22:01:01',2,1);



INSERT INTO book_product (bookid, price, stock, publisher, edition, booktype, bookcontentid) VALUES
  (1,'7.59','449','Euismod Est Arcu Ltd',2,'physical',16),
  (2,'28.08','518','Aenean Eget Incorporated',6,'physical',35),
  (3,'10.49','661','Aliquet Libero PC',7,'physical',29),
  (4,'15.64','535','Sapien Cras Dolor Associates',8,'physical',19),
  (5,'10.09','732','Rhoncus Incorporated',9,'physical',32),
  (6,'10.29','577','Non PC',8,'e-book',22),
  (7,'25.84','441','Mollis Integer Tincidunt LLC',5,'e-book',17),
  (8,'16.74','580','Tincidunt Nunc Corp.',5,'e-book',11),
  (9,'20.32','789','Sem Semper Institute',3,'e-book',24),
  (10,'20.63','428','Ultrices Posuere Cubilia LLC',6,'physical',15),
  (11,'7.61','627','Tellus Sem Mollis Corp.',8,'physical',22),
  (12,'18.52','409','Ipsum Phasellus Vitae PC',2,'physical',33),
  (13,'21.24','498','Nullam Ut Nisi Corporation',8,'e-book',32),
  (14,'9.77','325','Ullamcorper Velit Inc.',3,'physical',34),
  (15,'15.39','351','Mi Enim Consulting',2,'e-book',21),
  (16,'14.65','567','Cras Interdum Nunc Associates',4,'e-book',8),
  (17,'21.40','600','Semper Cursus LLP',4,'e-book',35),
  (18,'14.95','534','Nibh Sit Associates',6,'e-book',8),
  (19,'17.19','286','Ut Odio Incorporated',8,'e-book',40),
  (20,'19.71','599','Suspendisse Incorporated',2,'physical',26),
  (21,'23.52','602','Amet Risus Associates',3,'e-book',23),
  (22,'23.59','391','Phasellus Nulla PC',3,'physical',24),
  (23,'29.79','240','Penatibus Corporation',8,'e-book',14),
  (24,'24.69','402','Magna Sed LLC',8,'physical',35),
  (25,'14.14','696','Non Lacinia At PC',7,'physical',24),
  (26,'7.45','533','Donec Inc.',2,'e-book',7),
  (27,'8.55','389','Tincidunt Nunc Industries',4,'e-book',18),
  (28,'10.70','411','Nunc Mauris Inc.',5,'e-book',30),
  (29,'5.84','421','Ipsum Nunc Id Inc.',6,'physical',18),
  (30,'5.98','733','Phasellus Incorporated',3,'e-book',23),
  (31,'8.48','520','Leo Cras Foundation',6,'physical',12),
  (32,'28.19','633','Elit Pede Malesuada Institute',4,'e-book',35),
  (33,'21.07','584','Eget Metus LLC',3,'physical',37),
  (34,'5.34','553','Curabitur Ut Odio LLP',6,'e-book',5),
  (35,'22.18','701','Mi Lorem Industries',2,'e-book',35),
  (36,'11.42','535','In Institute',5,'e-book',24),
  (37,'19.01','599','Proin Nisl Associates',7,'physical',16),
  (38,'26.36','339','Amet Metus Associates',6,'e-book',27),
  (39,'10.00','260','Auctor Mauris Vel LLP',5,'e-book',7),
  (40,'24.31','329','Cras Dictum Ultricies Limited',8,'e-book',24),
  (41,'16.57','371','Adipiscing Corporation',7,'e-book',27),
  (42,'14.41','381','Facilisis Consulting',1,'physical',1),
  (43,'25.74','471','Gravida Praesent Eu LLC',5,'e-book',17),
  (44,'14.12','723','Egestas Fusce Inc.',9,'e-book',4),
  (45,'16.51','799','Dapibus Foundation',1,'e-book',8),
  (46,'27.58','523','Pretium PC',8,'e-book',35),
  (47,'12.24','614','Id Ante Institute',6,'physical',8),
  (48,'29.09','473','Duis Incorporated',10,'e-book',33),
  (49,'29.06','535','Tincidunt PC',10,'e-book',27),
  (50,'25.30','536','Vitae Semper Consulting',6,'e-book',5),
  (51,'15.00','550','Ridiculus Mus LLP',2,'e-book',2),
  (52,'8.56','373','Velit Cras Lorem Corp.',5,'physical',7),
  (53,'26.75','551','Quam Vel Institute',8,'e-book',35),
  (54,'24.49','37','Aliquam Institute',5,'e-book',32),
  (55,'24.30','319','Morbi Neque Tellus Foundation',4,'physical',20),
  (56,'19.47','837','Elit Erat Vitae Corp.',5,'physical',11),
  (57,'12.15','640','Amet Diam Institute',9,'e-book',15),
  (58,'19.53','513','Vestibulum Nec Euismod Incorporated',6,'e-book',29),
  (59,'10.59','505','Gravida Aliquam Foundation',9,'physical',16),
  (60,'21.04','516','Quis Diam Foundation',9,'physical',3);
 
 
 
    
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


INSERT INTO notification( notificationMessage, notificationTime, userid, orderid, bookid ) VALUES
('Status changed', '2021-01-01 21:42:01', 1,1,3 ),
('Status changed', '2021-01-10 22:12:01', 3,1,2 ),
('Status changed', '2021-01-04 11:34:01', 4, 1,4);


INSERT INTO report (reportid, description, isHandeled, userid, adminid) VALUES
(1, 'Website is lagging ', 'WAITING FOR ADMIN', 1, null),
(2, 'Website is lagging ', 'WAITING FOR ADMIN', 3, null),
(3, 'Wrong order ', 'DEALT WITH', 14, 2);
