--
-- 	Database Table Creation
--  First drop any existing tables. Any errors are ignored.
--
drop table Record_Player_Ally cascade constraints;
drop table NPC_Ally1 cascade constraints;
drop table NPC_Ally2 cascade constraints;
drop table Player_Record1 cascade constraints;
drop table Player_Record2 cascade constraints;
drop table Mission_Chosen cascade constraints;
drop table Mission1 cascade constraints;
drop table Mission2 cascade constraints;
drop table Area1 cascade constraints;
drop table Area2 cascade constraints;
drop table Battle cascade constraints;
drop table Boss1 cascade constraints;
drop table Boss2 cascade constraints;
drop table Minion cascade constraints;
drop table Badge1 cascade constraints;
drop table Badge2 cascade constraints;
drop table Achievement_Unlocked1 cascade constraints;
drop table Achievement_Unlocked2 cascade constraints;

--
-- Now, add each table.
--
CREATE TABLE Record_Player_Ally 
	(PID varchar PRIMARY KEY, 
	RID varchar UNIQUE,
	NID varchar UNIQUE,
	playerName varchar, 
	region varchar, 
	joinDate date, 
	inGameHour int DEFAULT 0
	FOREIGN KEY (RID) references Player_Record,
	FOREIGN KEY (NID) references NPC_Ally)




--
-- done adding all of the tables, now add in some tuples
--  first, add in the Record_Player_Ally
	INSERT INTO Record_Player_Ally
	VALUES		('P1', 'R1', 'N1', 'John Smith', 'North America', 2024-02-02, 0, 2024-02-02, 3)

	INSERT INTO Record_Player_Ally
	VALUES 		('P2', 'R2', 'N2', 'David Thompson', 'Asia', 2024-01-01, 50, 2024-03-01, 4)

	INSERT INTO Record_Player_Ally
	VALUES 		('P3', 'R3', 'N3', 'Jane Doe', 'Oceania', 2018-08-05, 300, 2018-08-05, 30)

	INSERT INTO Record_Player_Ally
	VALUES 		('P4', 'R4', 'N4', 'Tammy Na', 'Asia', 2020-10-28, 195, 2021-10-29, 16)

	INSERT INTO Record_Player_Ally
	VALUES 		('P5', 'R5', 'N5', 'Charleze Hernandez', 'South America', 2021-09-30, 88, 2021-10-30, 17)

	INSERT INTO Record_Player_Ally 
	VALUES 		('P6', 'R6', 'N6', 'Diego Garcia', 'South America', 2019-05-22, 250, 2019-05-22, 79)

	INSERT INTO Record_Player_Ally 
	VALUES 		('P7', 'R7', 'N7', 'Davu Abebe', 'Africa', 2015-07-02, 100, 2015-07-03, 99)