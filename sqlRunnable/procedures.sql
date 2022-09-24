
USE a20behta;

DELIMITER //

CREATE PROCEDURE GetWorkingDeer()
BEGIN
    SELECT  WorkingDeer.DeerNr AS 'deer number', 
        CONCAT(WorkingDeer.ClanName, " ",BaseRaces.RaceString) AS "Name" ,
        CONV(WorkingDeer.Smell,2,10) AS "Smell",
        workingDeer.Pay,WorkingDeer.DeerGroup FROM WorkingDeer INNER JOIN BaseRaces ON WorkingDeer.BaseRace = BaseRaces.BitValue;
END //

CREATE PROCEDURE GetSpecificWorkingDeer(Id SMALLINT)
BEGIN
    SELECT  WorkingDeer.DeerNr AS 'deer number', 
        CONCAT(WorkingDeer.ClanName, " ",BaseRaces.RaceString) AS "Name" ,
        CONV(WorkingDeer.Smell,2,10) AS "Smell",
        pay,DeerGroup FROM WorkingDeer INNER JOIN BaseRaces ON WorkingDeer.BaseRace = BaseRaces.BitValue
        WHERE WorkingDeer.DeerNr = Id;
END //

CREATE procedure RetireWorkingDeer(id SMALLINT, canNr INT, factory VARCHAR(15), taste VARCHAR(30))
BEGIN 
	INSERT INTO RetiredDeer(DeerGroup,ClanName,BaseRace,Smell,Pay,BankAccount,DeerNr)
		(SELECT DeerGroup,ClanName,BaseRace,Smell,Pay,BankAccount,DeerNr FROM WorkingDeer WHERE WorkingDeer.deerNr = id);
		
	UPDATE RetiredDeer SET RetiredDeer.CanNr = canNr, RetiredDeer.Factory = factory, RetiredDeer.Taste = taste
		WHERE RetiredDeer.DeerNr = id;       

    INSERT INTO ColdPrices (Id, PriceComment, Given, DeerGivenTo)
        (SELECT Id, PriceComment, Given, DeerGivenTo FROM Prices WHERE Prices.DeerGivenTo = id);

    DELETE FROM Prices WHERE Prices.DeerGivenTo = id;
    DELETE FROM WorkingDeer WHERE WorkingDeer.DeerNr = id;

END //

DELIMITER ;