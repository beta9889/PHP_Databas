-- Active: 1663691954105@@127.0.0.1@3306@a20behta
USE a20behta;

INSERT INTO DeerGroup(groupname,capacity,filled)
            VALUES("gogoGaga",3,0),
			("Hammered",3,0);

INSERT INTO WorkingDeer(DeerGroup,ClanName,BaseRace,Smell,Pay,BankAccount,DeerNr)
			VALUES("gogoGaga","baba",0,3,100,123456789,1),
			("gogoGaga","Jaga",2,3,100,321654987,2),
			("Hammered","baba",1,3,100,741852936,3),
			("Hammered","gaga",0,5,100,963852741,4),
			("gogoGaga", "Bosse", 5,1,65,65189416,5);

INSERT INTO Prices(priceComment,given,deerGivenTo)
			VALUES("mickes favorit","2022-10-10",1),
			("Get fucked","2022-10-10",2);
CALL RetireWorkingDeer(2,69,"Helverik","Rudolfs frästelse");
CALL RetireWorkingDeer(4,69,"BigTree","Julafton");
INSERT INTO DeerToDeer(firstDeerNr,secondDeerNr)
			VALUES(1,3),
			(1,2);

INSERT INTO Sled(id,sledName ,Registration,RegionId)
			Value(21,"SleepLess nights",00,1);
INSERT INTO Sled(id,sledName,Registration,RegionId)
			VALUES(10,"Coal Patrol",b'11',2);

INSERT INTO WorkingDeer(DeerGroup,ClanName,BaseRace,Smell,Pay,BankAccount,DeerNr)
			VALUES("Hammered","glados",1,b'101',615,8456,-1);
