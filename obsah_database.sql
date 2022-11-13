-- použití správné databáze

USE jirmus;

-- přidání dat tabulky časopisů

INSERT INTO Journals (Issue, Volume, Topic) 
VALUES
    (1, 2022, 'vědy o přírodě'),
    (2, 2022, 'společenské vědy'),
    (3, 2022, 'vědy o člověku'),
    (4, 2022, 'technické vědy'),
    (4, 2021, 'ekonomické vědy');
    
-- přidání dat do tabulky uživatelů
INSERT INTO Users (Firstname, Lastname, Username, Password, Role) 
VALUES
    ('Jan', 'Novák', 'Author1', (SELECT MD5('test')), 'Author');
-- * --
INSERT INTO Users (Firstname, Lastname, Username, Password, Role) 
VALUES
    ('Maxmilián', 'Novák', 'Author2', (SELECT MD5('test')), 'Author');

INSERT INTO Users (Firstname, Lastname, Username, Password, Role) 
VALUES
    ('Martin', 'Novák', 'Editor', (SELECT MD5('test')), 'Editor');

INSERT INTO Users (Firstname, Lastname, Username, Password, Role) 
VALUES
    ('Pepa', 'Novák', 'Reviewer', (SELECT MD5('test')), 'Reviewer');

INSERT INTO Users (Firstname, Lastname, Username, Password, Role) 
VALUES
    ('Martin', 'Novák', 'Chief', (SELECT MD5('test')), 'Chief');

INSERT INTO Users (Firstname, Lastname, Username, Password, Role) 
VALUES
    ('Lída', 'Nováková-Kučerová ', 'Admin', (SELECT MD5('test')), 'Admin');


-- přidání dat tabulky vydaných článků

INSERT INTO Articles (Title, Attribute, UserID, JournalID) 
VALUES
    (
        'Lorem ipsum dolor',
        'vydaný',
        (SELECT UserID FROM Users WHERE Firstname ='Jan' AND Lastname ='Novák' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='4' AND Volume ='2022')
    ),
    
    (
        'Sit amet',
        'vydaný',
        (SELECT UserID FROM Users WHERE Firstname ='Maxmilián' AND Lastname ='Novák' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='3' AND Volume ='2022')
    ),
    (
        'Consectetuer adipiscing elit',
        'vydaný',
        (SELECT UserID FROM Users WHERE Firstname ='Jan' AND Lastname ='Novák' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='3' AND Volume ='2022')
    ),
    (
        'Praesent dapibus',
        'vydaný',
        (SELECT UserID FROM Users WHERE Firstname ='Maxmilián' AND Lastname ='Novák' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='2' AND Volume ='2022')
    ),
    (
        'Vestibulum erat nulla',
        'vydaný',
        (SELECT UserID FROM Users WHERE Firstname ='Jan' AND Lastname ='Novák' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='2' AND Volume ='2022')
    ),
    (
        'Ullamcorper nec',
        'vydaný',
        (SELECT UserID FROM Users WHERE Firstname ='Maxmilián' AND Lastname ='Novák' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='1' AND Volume ='2022')
    ),
    (
        'Rutrum non',
        'vydaný',
        (SELECT UserID FROM Users WHERE Firstname ='Jan' AND Lastname ='Novák' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='1' AND Volume ='2022')
    ),
    (
        'Nonummy ac',
        'vydaný',
        (SELECT UserID FROM Users WHERE Firstname ='Maxmilián' AND Lastname ='Novák' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='4' AND Volume ='2021')
    ),
    (
        'Mauris elementum',
        'vydaný',
        (SELECT UserID FROM Users WHERE Firstname ='Jan' AND Lastname ='Novák' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='4' AND Volume ='2021')
    );

