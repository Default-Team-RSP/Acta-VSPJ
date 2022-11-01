-- vytvoření databáze

CREATE DATABASE ActaVSPJ;
USE ActaVSPJ;

-- vytvoření tabulky uživatelů

CREATE TABLE Users (
    UserID int NOT NULL AUTO_INCREMENT,
    Firstname varchar(255),
    Lastname varchar(255),
    Username varchar(255),
    Password varchar(255),
    Role varchar(255),
    PRIMARY KEY (UserID),
    UNIQUE (Username));

-- přidání dat tabulky uživatelů

INSERT INTO Users (Firstname, Lastname, Role) 
VALUES
    ('Naděžda', 'Dobrovolná', 'Author'),
    ('Dobromila', 'Mizerová', 'Author'),
    ('Dobromila', 'Ticháčková', 'Author'),
    ('Robert', 'Vaňous', 'Author'),
    ('Servác', 'Netík', 'Author'),
    ('Hubert', 'Hartmann', 'Author'),
    ('Zlata', 'Zábranská', 'Author');

-- vytvoření tabulky časopisů

CREATE TABLE Journals (
    JournalID int NOT NULL AUTO_INCREMENT,
    Timestamp timestamp,
    Issue int NOT NULL,
    Volume year(4) NOT NULL,
    Topic varchar(255),
    PRIMARY KEY (JournalID));
/* + data (PDF časopisu) */

-- přidání dat tabulky časopisů

INSERT INTO Journals (Issue, Volume, Topic) 
VALUES
    (1, 2022, 'vědy o přírodě'),
    (2, 2022, 'společenské vědy'),
    (3, 2022, 'vědy o člověku'),
    (4, 2022, 'technické vědy'),
    (4, 2021, 'ekonomické vědy');

-- vytvoření tabulky článků

CREATE TABLE Articles (
    ArticleID int NOT NULL AUTO_INCREMENT,
    Title varchar(255),
    UserID int,
    JournalID int NOT NULL,
    PRIMARY KEY (ArticleID),
    FOREIGN KEY (JournalID) REFERENCES Journals(JournalID)); 
/* + data (PDF časopisu), stav, id redaktora a recenzenta */

-- přidání dat tabulky článků

INSERT INTO Articles (Title, UserID, JournalID) 
VALUES
    (
        'Rozvoj různých forem činnosti',
        (SELECT UserID FROM Users WHERE Firstname ='Naděžda' AND Lastname ='Dobrovolná' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='4' AND Volume ='2022')
    ),
    
    (
        'Implementace existujících finančních a administrativních podmínek',
        (SELECT UserID FROM Users WHERE Firstname ='Dobromila' AND Lastname ='Mizerová' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='4' AND Volume ='2022')
    ),
    (
        'Platnost podmínek aktivizace',
        (SELECT UserID FROM Users WHERE Firstname ='Dobromila' AND Lastname ='Ticháčková' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='4' AND Volume ='2022')
    ),
    (
        'Vzájemné postavení organizačních autorit',
        (SELECT UserID FROM Users WHERE Firstname ='Robert' AND Lastname ='Vaňous' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='4' AND Volume ='2022')
    ),
    (
        'Realizace plánovaných vytyčených úkolů',
        (SELECT UserID FROM Users WHERE Firstname ='Servác' AND Lastname ='Netík' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='4' AND Volume ='2022')
    ),
    (
        'Práce na poli formování pozice',
        (SELECT UserID FROM Users WHERE Firstname ='Hubert' AND Lastname ='Hartmann' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='3' AND Volume ='2022')
    ),
    (
        'Informačně-propagandistické zabezpečení',
        (SELECT UserID FROM Users WHERE Firstname ='Dobromila' AND Lastname ='Ticháčková' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='3' AND Volume ='2022')
    ),
    (
        'Navržená struktura organizace',
        (SELECT UserID FROM Users WHERE Firstname ='Zlata' AND Lastname ='Zábranská' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='3' AND Volume ='2022')
    ),
    (
        'Nový model organizační činnosti',
        (SELECT UserID FROM Users WHERE Firstname ='Robert' AND Lastname ='Vaňous' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='3' AND Volume ='2022')
    ),
    (
        'Upřesnění a rozvoj struktur',
        (SELECT UserID FROM Users WHERE Firstname ='Servác' AND Lastname ='Netík' AND Role = 'Author'),
        (SELECT JournalID FROM Journals WHERE Issue ='3' AND Volume ='2022')
    );

-- přidání dat testovacího uživatel s heslem
INSERT INTO Users (Firstname, Lastname, Username, Password, Role) 
VALUES
    ('Jan', 'Novák', 'test', (SELECT MD5('test')), 'Author');