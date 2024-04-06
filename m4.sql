drop table Player_Info cascade constraints;
drop table NPC_Ally1 cascade constraints;
drop table NPC_Ally2 cascade constraints;
drop table Player_Record1 cascade constraints;
drop table Player_Record2 cascade constraints;
drop table Mission2 cascade constraints;
drop view Temp;


CREATE TABLE NPC_Ally1 (
	perk varchar(30) PRIMARY KEY, 
	pointDeduction integer DEFAULT 0
);

CREATE TABLE NPC_Ally2 (
	NID varchar(30) PRIMARY KEY,
	perk varchar(100)
);

CREATE TABLE Player_Record1 (
	totalPoints integer PRIMARY KEY,
	overallRanking integer DEFAULT -1
);

CREATE TABLE Player_Record2 (
	RID varchar(30) PRIMARY KEY,
	totalPoints integer
);

CREATE TABLE Player_Info (
	PID varchar(30) PRIMARY KEY, 
	RID varchar(30) UNIQUE,
	NID varchar(30) UNIQUE,
	playerName varchar(60), 
	region varchar(60), 
	joinDate date, 
	inGameHour integer DEFAULT 0,
	formDate date,
	numMissions integer,
	FOREIGN KEY(RID) references Player_Record2 ON DELETE CASCADE,
	FOREIGN KEY(NID) references NPC_Ally2 ON DELETE CASCADE
);

CREATE TABLE Mission2 (
    MID varchar(30) PRIMARY KEY, 
    RID varchar(30),
    missionName varchar(60), 
    completionStatus integer, 
    numAttemptM integer DEFAULT 0, 
    durationInMinutes integer DEFAULT 0,
    FOREIGN KEY (RID) references Player_Record2 ON DELETE CASCADE
);



	INSERT
	INTO 		NPC_Ally1 (perk, pointDeduction)
	VALUES		('Firebreathing', 4);

	INSERT
	INTO 		NPC_Ally1 (perk, pointDeduction)
	VALUES		('Invisibility', 3);

	INSERT
	INTO 		NPC_Ally1 (perk, pointDeduction)
	VALUES		('Teleportation', 5);

	INSERT
	INTO 		NPC_Ally1 (perk, pointDeduction)
	VALUES		('Flying', 3);

	INSERT
	INTO 		NPC_Ally1 (perk, pointDeduction)
	VALUES		('Superspeed', 4);

	INSERT
	INTO 		NPC_Ally1 (perk, pointDeduction)
	VALUES		('Defense Boost', 2);

	INSERT
	INTO 		NPC_Ally1 (perk, pointDeduction)
	VALUES		('Offense Boost', 2);

	INSERT
	INTO 		NPC_Ally2 (NID, perk)
	VALUES		('N1', 'Firebreathing');

	INSERT
	INTO 		NPC_Ally2 (NID, perk)
	VALUES		('N2', 'Invisibility');


	INSERT
	INTO 		NPC_Ally2 (NID, perk)
	VALUES		('N3', 'Teleportation');

	INSERT
	INTO 		NPC_Ally2 (NID, perk)
	VALUES		('N4', 'Flying');

	INSERT
	INTO 		NPC_Ally2 (NID, perk)
	VALUES		('N5', 'Superspeed');

	INSERT
	INTO 		NPC_Ally2 (NID, perk)
	VALUES		('N6', 'Defense Boost');

	INSERT
	INTO 		NPC_Ally2 (NID, perk)
	VALUES		('N7', 'Defense Boost');

	INSERT
	INTO 		Player_Record1 (totalPoints,  overallRanking)
	VALUES		(100, 1);

	INSERT
	INTO 		Player_Record1 (totalPoints,  overallRanking)
	VALUES		(99, 2);

	INSERT
	INTO 		Player_Record1 (totalPoints,  overallRanking)
	VALUES		(88, 3);

	INSERT
	INTO 		Player_Record1 (totalPoints,  overallRanking)
	VALUES		(77, 4);

	INSERT
	INTO 		Player_Record1 (totalPoints,  overallRanking)
	VALUES		(66, 5);


	INSERT
	INTO 		Player_Record1 (totalPoints,  overallRanking)
	VALUES		(55, 6);

	INSERT
	INTO 		Player_Record1 (totalPoints,  overallRanking)
	VALUES		(44, 7);

	INSERT
	INTO 		Player_Record2 (RID, totalPoints)
	VALUES		('R1', 44);
	
	INSERT
	INTO 		Player_Record2 (RID, totalPoints)
	VALUES		('R2', 55);

	INSERT
	INTO 		Player_Record2 (RID, totalPoints)
	VALUES		('R3', 66);

	INSERT
	INTO 		Player_Record2 (RID, totalPoints)
	VALUES		('R4', 77);

	INSERT
	INTO 		Player_Record2 (RID, totalPoints)
	VALUES		('R5', 88);

	INSERT
	INTO 		Player_Record2 (RID, totalPoints)
	VALUES		('R6', 99);

	INSERT
	INTO 		Player_Record2 (RID, totalPoints)
	VALUES		('R7', 100);

	INSERT 
	INTO 		Player_Info
	VALUES		('P1', 'R1', 'N1', 'John Smith', 'North America', TO_DATE ('2024-02-02', 'YYYY-MM-DD'), 0, TO_DATE ('2024-02-02', 'YYYY-MM-DD'), 3);

	INSERT 
	INTO 		Player_Info
	VALUES 		('P2', 'R2', 'N2', 'David Thompson', 'Asia', TO_DATE ('2024-01-01', 'YYYY-MM-DD'), 50, TO_DATE ('2024-03-01', 'YYYY-MM-DD'), 4);

	INSERT 
	INTO 		Player_Info
	VALUES 		('P3', 'R3', 'N3', 'Jane Doe', 'Oceania', TO_DATE ('2018-08-05', 'YYYY-MM-DD'), 300, TO_DATE ('2018-08-05', 'YYYY-MM-DD'), 30);

	INSERT 
	INTO 		Player_Info
	VALUES 		('P4', 'R4', 'N4', 'Tammy Na', 'Asia', TO_DATE ('2020-10-28', 'YYYY-MM-DD'), 195, TO_DATE ('2021-10-29', 'YYYY-MM-DD'), 16);

	INSERT 
	INTO 		Player_Info
	VALUES 		('P5', 'R5', 'N5', 'Charleze Hernandez', 'South America', TO_DATE ('2021-09-30', 'YYYY-MM-DD'), 88, TO_DATE ('2021-10-30', 'YYYY-MM-DD'), 17);

	INSERT 
	INTO 		Player_Info 
	VALUES 		('P6', 'R6', 'N6', 'Diego Garcia', 'South America', TO_DATE ('2019-05-22', 'YYYY-MM-DD'), 250, TO_DATE ('2019-05-22', 'YYYY-MM-DD'), 79);


    INSERT
	INTO 		Mission2 (MID, RID, missionName, completionStatus, numAttemptM, durationInMinutes)
	VALUES	    ('M1', 'R1', 'Nest', 67, 12, 340);

	INSERT
	INTO 		Mission2 (MID, RID, missionName, completionStatus, numAttemptM, durationInMinutes)
	VALUES	    ('M2', 'R1', 'Angus', 45, 42, 240);

	INSERT
	INTO 		Mission2 (MID, RID, missionName, completionStatus, numAttemptM, durationInMinutes)
	VALUES	    ('M3', 'R1', 'HEBB', 34, 15, 350);

	INSERT
	INTO 		Mission2 (MID, RID, missionName, completionStatus, numAttemptM, durationInMinutes)
	VALUES	    ('M4', 'R4', 'Nest', 47, 52, 123);

    INSERT
	INTO 		Mission2 (MID, RID, missionName, completionStatus, numAttemptM, durationInMinutes)
	VALUES	    ('M5', 'R4', 'HEBB', 47, 52, 123);

	INSERT
	INTO 		Mission2 (MID, RID, missionName, completionStatus, numAttemptM,  durationInMinutes)
	VALUES	    ('M6', 'R5', 'Angus', 97, 12, 100);

        INSERT
	INTO 		Mission2 (MID, RID, missionName, completionStatus, numAttemptM, durationInMinutes)
	VALUES	    ('M7', 'R4', 'Angus', 47, 52, 123);
