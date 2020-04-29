drop database if exists staem;

create database staem
	DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

use staem;

create table player (
	tag int primary key auto_increment,
    ign varchar(20) NOT NULL,
    balance float(4) default 0.0,
    email varchar(50),
    pw varchar(200)
    );
    
insert into player (ign,balance,email) values ('Goldan',9.91,'duni@toxicmail.com');
insert into player (ign,balance,email) values ('Koren',-4.3,'kor@toxicmail.com');
insert into player (ign,balance,email) values ('TMoore',9.91,'tumas@toxicmail.com');
insert into player (ign,balance,email) values ('Pocok',100,'somma@toxicmail.com');
insert into player (ign,balance,email) values ('sirwilliander',0,'mathe@toxicmail.com');
insert into player (ign,balance,email) values ('Randotron',2.45,'kiki@toxicmail.com');
insert into player (ign,balance,email) values ('petize',0.01,'ocsem@bromail.com');
    

create table game (
id int primary key auto_increment,
title nvarchar(50) not null,
score float(3),
pic text ,
summary text not null
);

insert into game (title,score,summary) values ('League of Legends',2,'This game is about...');
insert into game (title,score,summary) values ('Counter Strike - Global Offensive',5,'This game is about...');   
insert into game (title,score,summary) values ('Rocket League',9.5,'This game is about...');   
insert into game (title,score,summary) values ('PUBG',4,'This game is about...');   
insert into game (title,score,summary) values ('Overwatch',7.3,'This game is about...'); 
insert into game (title,score,summary) values ('Rainbow Six: Siege',1,'This game is about...');


create table possession (
id int primary key auto_increment,
playertag int,
gameid int,
buytime datetime,
playhours int default 0,
foreign key (playertag) references player(tag),
foreign key (gameid) references game(id)
);

insert into possession (playertag,gameid,buytime,playhours)  values (1,1,'2011-09-12 10:23',2000);
insert into possession (playertag,gameid,buytime,playhours)  values (1,2,'2018-11-02 10:23',1200);
insert into possession (playertag,gameid,buytime,playhours)  values (1,3,'2017-10-30 21:00',650);
insert into possession (playertag,gameid,buytime,playhours)  values (1,4,'2016-05-17 03:25',204);
insert into possession (playertag,gameid,buytime,playhours)  values (1,5,'2018-04-01 08:53',120);
insert into possession (playertag,gameid,buytime,playhours)  values (1,6,'2015-06-12 22:23',731);
insert into possession (playertag,gameid,buytime,playhours)  values (4,2,'2018-12-12 09:55',1823);
insert into possession (playertag,gameid,buytime,playhours)  values (4,3,'2019-01-08 11:21',370);
insert into possession (playertag,gameid,buytime,playhours)  values (4,6,'2017-09-12 17:13',804);
insert into possession (playertag,gameid,buytime,playhours)  values (6,2,'2014-10-08 21:01',1354);
insert into possession (playertag,gameid,buytime,playhours)  values (6,5,'2015-05-31 14:42',340);
insert into possession (playertag,gameid,buytime,playhours)  values (5,1,'2013-07-18 05:38',971);
insert into possession (playertag,gameid,buytime,playhours)  values (5,5,'2015-05-31 13:50',451);
insert into possession (playertag,gameid,buytime,playhours)  values (2,2,'2020-01-31 00:00',180);
insert into possession (playertag,gameid,buytime,playhours)  values (3,1,'2012-01-02 8:15',3654);
insert into possession (playertag,gameid,buytime,playhours)  values (3,2,'2013-11-11 19:34',1423);


  
  create table item (
  id int primary key auto_increment,
  playertag int,
  itemname nvarchar(30) not null,
  uname nvarchar(40),
  price float(12),
  foreign key (playertag) references player(tag)
  );
  
  insert into item (playertag,itemname,uname,price) values (1,'Infinity edge','long-shlong',38.12);
  insert into item (playertag,itemname,uname,price) values (1,'M4-A4|Nuclear fallout','M4-A4|Oh shit!',9.92);
  insert into item (playertag,itemname,uname,price) values (3,'Plunger',NULL,0.01);
  insert into item (playertag,itemname,uname,price) values (6,'Gut knife','stabby stabby',1200);
  insert into item (playertag,itemname,uname,price) values (6,'Zippy','wierdcar',2.00);
  insert into item (playertag,itemname,uname,price) values (4,'Pan','lvl3 sword',100);
  insert into item (playertag,itemname,uname,price) values (1,'dva','call the police',17.0);
  
  create table team (
  tag int primary key auto_increment,
  gameid int not null,
  teamname nvarchar(40),
  sname varchar(3),
  foreign key (gameid) references game(id)
  );
  
  insert into team (gameid,teamname,sname) values (2,'Negev for life','N4L');
  insert into team (gameid,teamname,sname) values (1,'hasakii','HSK');

  
  create table teammember (
  id int primary key auto_increment,
  playertag int not null,
  teamtag int not null,
  jointime datetime,
  position nvarchar(20),
  foreign key (playertag) references player(tag),
  foreign key (teamtag) references team(tag)
  );
  
  insert into teammember (playertag,teamtag,jointime,position) values (1,1,'2016-09-22 7:30','lurk');
  insert into teammember (playertag,teamtag,jointime,position) values (4,1,'2016-09-22 8:00','awp');
  insert into teammember (playertag,teamtag,jointime,position) values (3,1,'2016-09-22 8:00','entry');
  insert into teammember (playertag,teamtag,jointime,position) values (5,1,'2016-09-22 8:00','random');
  insert into teammember (playertag,teamtag,jointime,position) values (6,1,'2016-09-22 8:00','first death');
  insert into teammember (playertag,teamtag,jointime,position) values (1,2,'2013-04-12 18:32','jungle');
  insert into teammember (playertag,teamtag,jointime,position) values (7,2,'2020-01-02 05:19','feed');
  insert into teammember (playertag,teamtag,jointime,position) values (3,2,'2018-12-07 13:41','lurk');

  
  
  
  
  
    
    
    