create schema if not exists lbaw2131;
SET search_path TO lbaw2131;


DROP TABLE IF EXISTS users cascade;
CREATE TABLE users(
  id serial PRIMARY KEY ,
  name TEXT NOT NULL,
  email TEXT NOT NULL,
  password TEXT NOT NULL,
  isBlocked Bool default False,
  isAdmin Bool default False,
  profilePicture text default 'https://i.stack.imgur.com/l60Hf.png'
) ;

DROP TABLE IF EXISTS credit_card cascade;
CREATE TABLE credit_card(
    cardid serial  PRIMARY KEY,
    ownername text not null,
    cardnumber text not null,
    securitycode int not null,
    userid int not null references users(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);


DROP TABLE IF EXISTS author ;
CREATE TABLE author(
    authorid serial PRIMARY KEY,
    authorname   TEXT NOT NULL,
    description text,
    picture text default 'https://i.stack.imgur.com/l60Hf.png'
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
  label text UNIQUE NOT NULL
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
    userid int not null references users(id)
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
    userid int not null references users(id)
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
    userid int not null references users(id)
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
    userid int not null references users(id)
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
    FOREIGN KEY (userid) references users(id)
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
    userid int not null references users(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
    adminid int references users(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);


INSERT INTO author( authorname, description, picture) VALUES  ('Ayanna Stephens', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Stacy Hoffman', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Hall Oliver', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Anne Herrera', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Felix Velasco', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Marah Kowalski',null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Diana Lawrence', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Hall Serrano', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Fredericka Arias', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Owen Strauß', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Maris Wenzler', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Hadley Fernandez', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Wallace Wright', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Vielka Howard', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Mona Prieto'),null, 'https://i.stack.imgur.com/l60Hf.png',
  ('Caleb Marshall',null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Kitra Wenzler', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Cade Merkle', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Christen Ford'), null, 'https://i.stack.imgur.com/l60Hf.png',
  ('Teagan Moreno', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Tucker Bravo',null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Nora Cook', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Keelie Merino', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Maite Schubert',null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Edan Hanson', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Brock Fink', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Aurelia Weber', null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Magee Martin'),null, 'https://i.stack.imgur.com/l60Hf.png',
  ('Hilel Muñoz',null, 'https://i.stack.imgur.com/l60Hf.png'),
  ('Nehru Pietsch', null, 'https://i.stack.imgur.com/l60Hf.png');

INSERT INTO users (name, email, password, isBlocked, isAdmin, profilePicture) VALUES
('Malcolm Pratt','malcolmpratt9095@protonmail.com','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','False', 'https://image.shutterstock.com/mosaic_250/2936380/640011838/stock-photo-handsome-unshaven-young-dark-skinned-male-laughing-out-loud-at-funny-meme-he-found-on-internet-640011838.jpg'),
  ('Inez Newton','ineznewton6225@protonmail.org','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','True','False', 'https://media.istockphoto.com/photos/young-woman-portrait-in-the-city-picture-id1009749608?k=20&m=1009749608&s=612x612&w=0&h=3bnVp0Y1625uKkSwnp7Uh2_y_prWbgRBH6a_6jRew3g='),
  ('Jena French','jenafrench@outlook.couk','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','False', 'https://st.depositphotos.com/1771835/2038/i/600/depositphotos_20380765-stock-photo-happy-man-portrait-real-high.jpg'),
  ('Nichole Wright','nicholewright8299@hotmail.ca','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','True','False', 'https://photo-cdn2.icons8.com/YJC2iz1UStJU0PKDNg1DE_b4gBHgzdKbMena3tvjSbo/rs:fit:576:432/czM6Ly9pY29uczgu/bW9vc2UtcHJvZC5h/c3NldHMvYXNzZXRz/L3NhdGEvb3JpZ2lu/YWwvMzQ4LzI5OTQz/NDk4LWU1ZGItNDI4/NC04YmY2LTc2NGIx/MDBmZjZjNS5qcGc.jpg'),
  ('Zahir Craft','zahircraft7246@yahoo.ca','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','True','True', 'https://www.elitelisbon.com/media//1/FOTOS/1034/21082979687370d.jpg'),
  ('Hashim Madden','hashimmadden7128@google.edu','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','False', 'https://images.mubicdn.net/images/cast_member/406770/cache-134070-1461597796/image-w856.jpg?size=800x'),
  ('Jessica Ochoa','jessicaochoa5418@icloud.ca','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','True','https://scontent.fopo3-2.fna.fbcdn.net/v/t31.18172-8/24297477_10212261735477507_7956367575064930791_o.jpg?_nc_cat=100&ccb=1-5&_nc_sid=174925&_nc_ohc=JKT0nxAWIv4AX_kz3K-&tn=ku_8x6ySDPZOyApb&_nc_ht=scontent.fopo3-2.fna&oh=00_AT_yctG9T_ueq2Ap6b0ILa2codDz0DJ8KHh28mw-Sd007A&oe=61F278DB'),
  ('Savannah Dixon','savannahdixon2572@protonmail.ca','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','True', 'https://scontent.fopo3-2.fna.fbcdn.net/v/t31.18172-8/471981_3164191782673_1569719874_o.jpg?_nc_cat=102&ccb=1-5&_nc_sid=de6eea&_nc_ohc=UcRIGl1GERIAX_QLbQ6&_nc_ht=scontent.fopo3-2.fna&oh=00_AT-isk8hoolMoREN7katjqj9GKqeU_cqhIxUWMMO8VWWKg&oe=61F3A61D'),
  ('Jaden Kane','jadenkane@outlook.org','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','True','False', 'https://scontent.fopo3-2.fna.fbcdn.net/v/t31.18172-8/175794_1982701566156_1227336_o.jpg?_nc_cat=102&ccb=1-5&_nc_sid=de6eea&_nc_ohc=vRUmOmtKXeAAX_YnWlM&_nc_ht=scontent.fopo3-2.fna&oh=00_AT9RliYZwsIi8qT82m2DLXoOx1Dwqx20ZPaXaFMP8AxXBA&oe=61F40608'),
  ('Lewis Michael','lewismichael7278@outlook.net','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','True','False' , 'https://scontent.fopo3-1.fna.fbcdn.net/v/t31.18172-8/210716_1719226499444_5687395_o.jpg?_nc_cat=106&ccb=1-5&_nc_sid=de6eea&_nc_ohc=tOgOvlZ73rwAX_8EEzG&_nc_ht=scontent.fopo3-1.fna&oh=00_AT_FGToj3Zh-GiwHur-v23R0sq4J5a5ty37qkzKMFXfTnw&oe=61F271D8'),
  ('Malachi Waller','malachiwaller2036@yahoo.edu','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','False', 'https://studiosol-a.akamaihd.net/uploadfile/letras/fotos/e/f/8/a/ef8a0cb94166d9830af93aad8092fbe5.jpg'),
  ('Daquan Marks','daquanmarks@google.com','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','True','False', 'https://capricho.abril.com.br/wp-content/uploads/2019/09/harry-styles-e1568916476418.jpg'),
  ('Amir Washington','amirwashington@google.ca','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','False', 'https://cdn1.newsplex.pt/fotos/2021/11/12/799431.jpg?type=Artigo'),
  ('Wanda Pennington','wandapennington4865@aol.edu','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','True','False','https://www.meme-arsenal.com/memes/7e25ad21a23cbe76792c2232fbbbb149.jpg'),
  ('Melvin Glenn','melvinglenn@yahoo.net','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','True', 'https://www.istockphoto.com/resources/images/PhotoFTLP/1035146258.jpg'),
  ('Dean Baird','deanbaird5809@yahoo.com','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','False', 'https://www.istockphoto.com/resources/images/PhotoFTLP/1035146258.jpg'),
  ('Eleanor Byrd','eleanorbyrd@hotmail.org','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','True','False', 'https://media.istockphoto.com/photos/happy-smiling-man-looking-away-picture-id1158245623?k=20&m=1158245623&s=612x612&w=0&h=rGmn02kNdoQySPEoQmbbDBxOayL4sdW3QWqP9rjgxCg='),
  ('Ursa Rosa','ursarosa4328@icloud.com','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','True', 'https://media.istockphoto.com/photos/happy-smiling-man-looking-away-picture-id1158245623?k=20&m=1158245623&s=612x612&w=0&h=rGmn02kNdoQySPEoQmbbDBxOayL4sdW3QWqP9rjgxCg='),
  ('Mason Peters','masonpeters@outlook.net','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','True', 'https://image.shutterstock.com/mosaic_250/2936380/640011838/stock-photo-handsome-unshaven-young-dark-skinned-male-laughing-out-loud-at-funny-meme-he-found-on-internet-640011838.jpg'),
  ('Jared Atkins','jaredatkins4278@hotmail.couk','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','False', 'https://image.shutterstock.com/mosaic_250/2936380/640011838/stock-photo-handsome-unshaven-young-dark-skinned-male-laughing-out-loud-at-funny-meme-he-found-on-internet-640011838.jpg'),
  ('Randall Alexander','randallalexander2597@google.ca','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','True', 'https://image.shutterstock.com/image-photo/portrait-beautiful-redhead-girl-smiling-260nw-657764164.jpg'),
  ('Natalie Rosa','natalierosa6697@icloud.net','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','True', 'https://image.shutterstock.com/image-photo/portrait-beautiful-redhead-girl-smiling-260nw-657764164.jpg'),
  ('Richard Mcguire','richardmcguire6079@outlook.ca','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','True','False', 'https://image.shutterstock.com/image-photo/portrait-beautiful-redhead-girl-smiling-260nw-657764164.jpg'),
  ('Cooper Flores','cooperflores@outlook.couk','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','False', 'https://image.shutterstock.com/image-photo/portrait-beautiful-redhead-girl-smiling-260nw-657764164.jpg'),
  ('Keaton Bush','keatonbush@outlook.ca','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','True','True', 'https://image.shutterstock.com/image-photo/portrait-beautiful-redhead-girl-smiling-260nw-657764164.jpg'),
  ('Gemma Fleming','gemmafleming4125@protonmail.com','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','True','True', 'https://image.shutterstock.com/image-photo/portrait-beautiful-redhead-girl-smiling-260nw-657764164.jpg'),
  ('Shannon Hampton','shannonhampton4653@icloud.ca','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','False','True', 'https://image.shutterstock.com/image-photo/portrait-beautiful-redhead-girl-smiling-260nw-657764164.jpg'),
  ('Tyrone Deleon','tyronedeleon5301@aol.com','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','True','True', 'https://image.shutterstock.com/image-photo/portrait-beautiful-redhead-girl-smiling-260nw-657764164.jpg'),
  ('Jacqueline Stevens','jacquelinestevens9551@yahoo.ca','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','True','True', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Xyla Contreras','xylacontreras8390@outlook.com','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','True','False', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Zephania Hooper','zephaniahooper8316@aol.ca','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','False','True', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Jermaine Hutchinson','jermainehutchinson@outlook.net','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','True','False', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Gay Velez','gayvelez3464@yahoo.com','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','False','False', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Mariko Orr','marikoorr2280@google.org','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','False','False', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Yuri Dale','yuridale@icloud.couk','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','False','True', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Rhonda Graves','rhondagraves6791@hotmail.org','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','False','False', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Claire French','clairefrench@hotmail.edu','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','False','True', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Carol Benson','carolbenson@outlook.edu','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','True','True', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Nero Estes','neroestes@protonmail.couk','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','False','False', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Tanisha Short','tanishashort2488@yahoo.couk','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','False','False', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Forrest Gill','forrestgill3331@protonmail.net','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','False','False', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Hedley Compton','hedleycompton@google.org','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','False','True', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Chloe Mckay','chloemckay@google.ca','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','False','False', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Nevada Frost','nevadafrost@protonmail.com','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','False','False', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Hope Barlow','hopebarlow@protonmail.com','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','False','False', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Erica Howell','ericahowell@icloud.edu','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','True','False', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Cailin Brooks','cailinbrooks6961@hotmail.edu','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','True','True', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Josiah Watson','josiahwatson4219@protonmail.edu','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','False','False', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Herman Hamilton','hermanhamilton1778@outlook.edu','$2y$10$erEEpBNDdgr6FZuvO0BmFe/S6RPfeJ/.tZx8sd1OqZ9CWOW7yx.ti','True','False', 'https://i.stack.imgur.com/l60Hf.png'),
  ('Ana Mariz', 'aismariz@gmailcom', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'False', 'False', 'https://scontent.fopo3-1.fna.fbcdn.net/v/t1.6435-9/81563614_10218175164349533_9188962932132675584_n.jpg?_nc_cat=106&ccb=1-5&_nc_sid=174925&_nc_ohc=_GGIJLs20CgAX-BnsH_&_nc_ht=scontent.fopo3-1.fna&oh=00_AT83lyeUqfNhWSebt6GJNj7hg4m3NA0CC94pK5df_4mTUA&oe=61F28EFC' );
 
 
 INSERT INTO credit_card ( ownername, cardnumber, securitycode, userid) VALUES
('João Pinto', '4701470123', 214, 1),
( 'Maria Pinto', '8910103817', 311,2),
('Maria Pinto', '2428193713', 311,2);


INSERT INTO book_content ( title, bookyear, average, authorid, bookcover) VALUES
 ('woman of glory',2010,'1.9',20, 'https://i.ebayimg.com/images/g/yT0AAOSwScBf~elE/s-l500.jpg'),
  ('king of the prison',1989,'2.8',21,'https://images-na.ssl-images-amazon.com/images/I/51ysBE+VPKL.jpg'),
  ('blacksmiths with sins',1970,'3.4',29, 'https://images-na.ssl-images-amazon.com/images/I/415CuPjYppL._SX342_SY445_QL70_ML2_.jpg'),
  ('robots without faith',2003,'2.0',9, 'https://images-na.ssl-images-amazon.com/images/I/51xie+PczKL._SY344_BO1,204,203,200_.jpg'),
  ('bandits and knights',1988,'2.7',26,'https://images-na.ssl-images-amazon.com/images/I/51lnGa8RUQS._SX311_BO1,204,203,200_.jpg'),
  ('traitors and robots',2016,'3.2',29, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1420944735l/22929546.jpg'),
  ('ruins without desire',1982,'2.6',29, 'https://upload.wikimedia.org/wikipedia/en/thumb/8/8e/Ruins_Smith.jpg/220px-Ruins_Smith.jpg'),
  ('inception without sin',1999,'2.9',24, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1628213328l/58710332._SY475_.jpg'),
  ('clinging to the immortals',1993,'2.3',6, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1443023859l/25746707.jpg'),
  ('escape my futuretraitor of gold',1994,'3.8',9, 'https://images-na.ssl-images-amazon.com/images/I/71ODoJm2YuL.jpg'),
  ('tortoise of next year',1979,'1.3',19, 'https://m.media-amazon.com/images/I/51JsJKXkkqL.jpg'),
  ('Adam Lindsay',1998,'1.9',2, 'https://images-na.ssl-images-amazon.com/images/I/31DW6gKFg-L._SX313_BO1,204,203,200_.jpg'),
  ('guardians of hope',1971,'2.3',29, 'https://images-na.ssl-images-amazon.com/images/I/41aVMHg4%2BTL._AC_UL600_SR384,600_.jpg'),
  ('traitors of joy',1972,'3.2',13, 'https://m.media-amazon.com/images/I/41CtM8+im0L.jpg'),
  ('rats and hunters',1994,'2.7',27, 'https://images-na.ssl-images-amazon.com/images/I/41GKCBQK15L._SX302_BO1,204,203,200_.jpg'),
  ('witches and friends',1991,'3.2',29, 'https://images-na.ssl-images-amazon.com/images/I/81Ql7Oy80EL.jpg'),
  ('history of the nation',1983,'2.4',14, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1347621762l/13723762.jpg'),
  ('Odessa Copeland',1982,'2.5',19, 'https://images-na.ssl-images-amazon.com/images/I/31-YytYMtPL._SX342_SY445_QL70_ML2_.jpg'),
  ('birth of the river',1984,'1.8',29, 'https://thumbs.worthpoint.com/zoom/images1/1/0314/19/birth-river-thomas-donnell-signed-1st_1_e56bf56512a785cc1b8636249261e59f.jpg'),
  ('whispers in the west',1980,'3.7',24 , 'https://images-na.ssl-images-amazon.com/images/I/71PCHuzIcnL.jpg'),
  ('robot of the solstice',1995,'2.1',4, 'https://images-na.ssl-images-amazon.com/images/I/719HYP216HS.jpg'),
  ('hiding the end',1994,'4.0',21, 'https://kbimages1-a.akamaihd.net/36756681-cef7-4797-82b9-aea3e6443207/353/569/90/False/after-the-world-ends-hide-book-2.jpg'),
  ('defender of secrets',1992,'3.0',18, 'https://images-na.ssl-images-amazon.com/images/S/cmx-images-prod/Item/19577/OCT110586._SX360_QL80_TTD_.jpg'),
  ('Ciara Compton',1996,'3.7',21, 'https://images-na.ssl-images-amazon.com/images/I/81cpnlo5FeS.jpg'),
  ('Genevieve Moon',1998,'3.3',9, 'https://images-na.ssl-images-amazon.com/images/I/81jjm5C9tKL.jpg'),
  ('excellent imagination',1973,'2.6',23, 'http://www.amreading.com/wp-content/uploads/my-grandmother-asked-me-to-tell-you-shes-sorry-9781501115066_hr-600x901.jpg'),
  ('love of nature',1998,'2.9',15, 'https://images-na.ssl-images-amazon.com/images/I/41bJ7Urlg6L._SX331_BO1,204,203,200_.jpg'),
  ('clans of the swamp',1982,'3.0',5, 'https://images-na.ssl-images-amazon.com/images/I/817-Al99HUL.jpg'),
  ('paintings per realm',2001,'2.4',25, 'http://www.psupress.org/images/covers/294wide/978-0-271-07103-9md_294.jpg'),
  ('pests and ancients',2007,'1.8',25,'https://m.media-amazon.com/images/I/41fA8shHWCL.jpg'),
  ('insects and moons',1981,'5.0',19, 'https://www.moonstoystore.com/wp-content/uploads/2020/05/2456INSB.jpg'),
  ('angels per continent',1979,'2.5',10, 'https://images-na.ssl-images-amazon.com/images/I/816u9mlA0DL.jpg'),
  ('deafened by the worldspiders of tomorrow',1971,'3.2',23, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1547966857l/43422483.jpg'),
  ('pirates and priests',2012,'3.6',23, 'https://m.media-amazon.com/images/I/412CrRpC-yL.jpg'),
  ('figures of a painting',2000,'3.1',29, 'https://images-na.ssl-images-amazon.com/images/I/5153B177FYL.jpg'),
  ('defenders of outer space',1999,'2.3',15, 'https://images-na.ssl-images-amazon.com/images/I/513fgAb3C0L._SX324_BO1,204,203,200_.jpg'),
  ('gangster of the void',1973,'3.3',2, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1481203033l/30039018.jpg'),
  ('vampires and fish',2017,'2.7',5, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1348094753l/7634106.jpg'),
  ('owls of destruction',1999,'3.2',17, 'https://images-na.ssl-images-amazon.com/images/I/71yv6CGxbcL.jpg'),
  ('Buckminster Shepherd',2011,'4.6',24, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1348263390l/574916.jpg');
 
 
 
 
 
INSERT INTO category ( label) VALUES
('Romance'),('Comedy'),('Biography'),('Sport'),('Drama'),
('Sci-Fi'),('Western'),('War'),('Adventure'),('Horror'),
('Fantasy'),('Mystery'),('Crime'),('Family'),('History');


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
 
 
INSERT INTO review ( reviewcomment, rating, timeposted, userid, bookid) VALUES
('very cool', 4, '2001-01-01 01:01:01',1,2),
(null, 2, '2011-11-21 22:01:01',2,1),
('life changing', 5, '2020-11-21 22:01:01',2,1);



INSERT INTO book_product (price, stock, publisher, edition, booktype, bookcontentid) VALUES
  ('7.59','449','Euismod Est Arcu Ltd',2,'physical',16),
  ('28.08','518','Aenean Eget Incorporated',6,'physical',35),
  ('10.49','661','Aliquet Libero PC',7,'physical',29),
  ('15.64','535','Sapien Cras Dolor Associates',8,'physical',19),
  ('10.09','732','Rhoncus Incorporated',9,'physical',32),
  ('10.29','577','Non PC',8,'e-book',22),
  ('25.84','441','Mollis Integer Tincidunt LLC',5,'e-book',17),
  ('16.74','580','Tincidunt Nunc Corp.',5,'e-book',11),
  ('20.32','789','Sem Semper Institute',3,'e-book',24),
  ('20.63','428','Ultrices Posuere Cubilia LLC',6,'physical',15),
  ('7.61','627','Tellus Sem Mollis Corp.',8,'physical',22),
  ('18.52','409','Ipsum Phasellus Vitae PC',2,'physical',33),
  ('21.24','498','Nullam Ut Nisi Corporation',8,'e-book',32),
  ('9.77','325','Ullamcorper Velit Inc.',3,'physical',34),
  ('15.39','351','Mi Enim Consulting',2,'e-book',21),
  ('14.65','567','Cras Interdum Nunc Associates',4,'e-book',8),
  ('21.40','600','Semper Cursus LLP',4,'e-book',35),
  ('14.95','534','Nibh Sit Associates',6,'e-book',8),
  ('17.19','286','Ut Odio Incorporated',8,'e-book',40),
  ('19.71','599','Suspendisse Incorporated',2,'physical',26),
  ('23.52','602','Amet Risus Associates',3,'e-book',23),
  ('23.59','391','Phasellus Nulla PC',3,'physical',24),
  ('29.79','240','Penatibus Corporation',8,'e-book',14),
  ('24.69','402','Magna Sed LLC',8,'physical',35),
  ('14.14','696','Non Lacinia At PC',7,'physical',24),
  ('7.45','533','Donec Inc.',2,'e-book',7),
  ('8.55','389','Tincidunt Nunc Industries',4,'e-book',18),
  ('10.70','411','Nunc Mauris Inc.',5,'e-book',30),
  ('5.84','421','Ipsum Nunc Id Inc.',6,'physical',18),
  ('5.98','733','Phasellus Incorporated',3,'e-book',23),
  ('8.48','520','Leo Cras Foundation',6,'physical',12),
  ('28.19','633','Elit Pede Malesuada Institute',4,'e-book',35),
  ('21.07','584','Eget Metus LLC',3,'physical',37),
  ('5.34','553','Curabitur Ut Odio LLP',6,'e-book',5),
  ('22.18','701','Mi Lorem Industries',2,'e-book',35),
  ('11.42','535','In Institute',5,'e-book',24),
  ('19.01','599','Proin Nisl Associates',7,'physical',16),
  ('26.36','339','Amet Metus Associates',6,'e-book',27),
  ('10.00','260','Auctor Mauris Vel LLP',5,'e-book',7),
  ('24.31','329','Cras Dictum Ultricies Limited',8,'e-book',24),
  ('16.57','371','Adipiscing Corporation',7,'e-book',27),
  ('14.41','381','Facilisis Consulting',1,'physical',1),
  ('25.74','471','Gravida Praesent Eu LLC',5,'e-book',17),
  ('14.12','723','Egestas Fusce Inc.',9,'e-book',4),
  ('16.51','799','Dapibus Foundation',1,'e-book',8),
  ('27.58','523','Pretium PC',8,'e-book',35),
  ('12.24','614','Id Ante Institute',6,'physical',8),
  ('29.09','473','Duis Incorporated',10,'e-book',33),
  ('29.06','535','Tincidunt PC',10,'e-book',27),
  ('25.30','536','Vitae Semper Consulting',6,'e-book',5),
  ('15.00','550','Ridiculus Mus LLP',2,'e-book',2),
  ('8.56','373','Velit Cras Lorem Corp.',5,'physical',7),
  ('26.75','551','Quam Vel Institute',8,'e-book',35),
  ('24.49','37','Aliquam Institute',5,'e-book',32),
  ('24.30','319','Morbi Neque Tellus Foundation',4,'physical',20),
  ('19.47','837','Elit Erat Vitae Corp.',5,'physical',11),
  ('12.15','640','Amet Diam Institute',9,'e-book',15),
  ('19.53','513','Vestibulum Nec Euismod Incorporated',6,'e-book',29),
  ('10.59','505','Gravida Aliquam Foundation',9,'physical',16),
  ('21.04','516','Quis Diam Foundation',9,'physical',3);
 
 
 
    
INSERT INTO user_order ( orderdate, creditcardid, userid) VALUES
('2021-01-01 21:42:01', 2, 2),
('2021-10-31 04:32:56', 2, 2),
('2021-11-12 02:48:12', 3, 2),
('2021-08-04 22:24:41', 1, 1);
    
    

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


INSERT INTO report ( description, isHandeled, userid, adminid) VALUES
( 'Website is lagging ', 'WAITING FOR ADMIN', 1, null),
('Website is lagging ', 'WAITING FOR ADMIN', 3, null),
('Wrong order ', 'DEALT WITH', 14, 2);
