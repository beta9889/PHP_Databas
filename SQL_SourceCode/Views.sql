-- Active: 1663691954105@@127.0.0.1@3306@a20behta
USE a20behta;
CREATE VIEW ViewWorkingDeer AS SELECT  WorkingDeer.deerNr AS DeerNr, 
        CONCAT(WorkingDeer.ClanName, " ",BaseRaces.RaceString) AS 'Name',
        CONV(WorkingDeer.Smell,2,10) AS Smell, WorkingDeer.Pay, WorkingDeer.DeerGroup 
        FROM WorkingDeer INNER JOIN BaseRaces ON WorkingDeer.BaseRace = BaseRaces.BitValue;

CREATE VIEW ViewRetiredDeer AS SELECT  RetiredDeer.DeerNr AS DeerNr, 
        CONCAT(RetiredDeer.ClanName," ",BaseRaces.RaceString) AS 'Name' ,
        CONV(RetiredDeer.Smell,2,10) AS "Smell", RetiredDeer.Pay, RetiredDeer.DeerGroup, 
        RetiredDeer.CanNr AS "Can Number", RetiredDeer.Factory, RetiredDeer.Taste 
        FROM `RetiredDeer` 
                INNER JOIN BaseRaces ON
                BaseRaces.BitValue = RetiredDeer.BaseRace;
				
CREATE VIEW ViewPrices AS SELECT GROUP_CONCAT(concat(Prices.PriceComment," " , Prices.Given, " \n ")) AS Price, 
	CONCAT(WorkingDeer.ClanName, " ",BaseRaces.RaceString) AS 'Name', Prices.DeerGivenTo
    FROM Prices INNER JOIN WorkingDeer ON Prices.DeerGivenTo = WorkingDeer.DeerNr 
                        INNER JOIN BaseRaces ON WorkingDeer.BaseRace = BaseRaces.BitValue
    GROUP BY WorkingDeer.deerNr;

CREATE VIEW ViewColdPrices AS SELECT GROUP_CONCAT(concat(ColdPrices.PriceComment," " ,ColdPrices.Given, " \n ")) AS Price, 
	CONCAT(RetiredDeer.ClanName, " ",BaseRaces.RaceString) AS 'name', ColdPrices.DeerGivenTo
    FROM ColdPrices INNER JOIN RetiredDeer ON ColdPrices.DeerGivenTo = RetiredDeer.DeerNr 
                        INNER JOIN BaseRaces ON RetiredDeer.BaseRace = BaseRaces.BitValue
    GROUP BY RetiredDeer.DeerNr;
	
CREATE VIEW ViewAllPrices AS SELECT ViewPrices.* FROM ViewPrices
	UNION (SELECT ViewColdPrices.* FROM ViewColdPrices);

CREATE VIEW ViewDeerConnections AS SELECT W1.Name AS 'Deer 1', W1.DeerNr AS "Deer 1 ID", W2.Name AS 'Deer 2',W2.DeerNr
                FROM ViewWorkingDeer AS W1, ViewWorkingDeer AS W2,DeerToDeer
                WHERE W1.DeerNr = DeerToDeer.FirstDeerNr AND W2.DeerNr = DeerToDeer.SecondDeerNr
        UNION  (SELECT W1.Name AS "Deer 1", W1.DeerNr, R1.Name AS "Deer 2", R1.DeerNr
                FROM ViewWorkingDeer AS W1, ViewRetiredDeer AS R1,DeerToDeer
                WHERE W1.DeerNr = DeerToDeer.FirstDeerNr AND R1.DeerNr = DeerToDeer.SecondDeerNr)
        UNION (SELECT R1.Name AS  "Deer 1", R1.DeerNr, W1.Name AS "Deer 2", W1.DeerNr
                FROM ViewWorkingDeer AS W1, ViewRetiredDeer AS R1,DeerToDeer
                WHERE R1.DeerNr = DeerToDeer.FirstDeerNr AND W1.DeerNr = DeerToDeer.SecondDeerNr)
        UNION (SELECT R1.Name AS  "Deer 1", R1.DeerNr, R1.Name AS "Deer 2", R1.DeerNr
                FROM ViewRetiredDeer AS R2, ViewRetiredDeer AS R1,DeerToDeer
                WHERE R1.DeerNr = DeerToDeer.FirstDeerNr AND R2.DeerNr = DeerToDeer.SecondDeerNr)
        ORDER BY DeerNr;

CREATE VIEW ViewDeerGroup AS SELECT DeerGroup.GroupName, DeerGroup.Capacity, DeerGroup.Filled AS "Raw Data Filled",
        (( DeerGroup.Filled / DeerGroup.Capacity ) * 100 ) AS "Filled As Procent", Group_ConCat(concat(ViewWorkingDeer.Name)) AS "Group Members"
        FROM DeerGroup INNER JOIN ViewWorkingDeer ON DeerGroup.GroupName = ViewWorkingDeer.DeerGroup GROUP BY DeerGroup.GroupName; 