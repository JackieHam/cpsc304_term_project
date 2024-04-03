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
	PID varchar(30),
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