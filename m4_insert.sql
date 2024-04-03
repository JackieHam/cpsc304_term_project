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
	INTO 		Player_Info 
	VALUES 		('P7', 'R7', 'N7', 'Davu Abebe', 'Africa', TO_DATE ('2015-07-02', 'YYYY-MM-DD'), 100, TO_DATE ('2015-07-02', 'YYYY-MM-DD'), 99);
