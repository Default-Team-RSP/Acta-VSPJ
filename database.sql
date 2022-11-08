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
    Role varchar(255),                                  --role: Author, Editor (=redaktor), Chief (=šéfredaktor), Reviewer (=recenzent), Admin
    PRIMARY KEY (UserID),
    UNIQUE (Username));

-- vytvoření tabulky časopisů

CREATE TABLE Journals (
    JournalID int NOT NULL AUTO_INCREMENT,
    Timestamp timestamp,
    Issue int NOT NULL,
    Volume year(4) NOT NULL,
    Topic varchar(255),                                 -- téma: ekonomické vědy, společenské vědy, technické vědy, vědy o přírodě, vědy o člověku
    PRIMARY KEY (JournalID));
/* + data (PDF časopisu) */

-- vytvoření tabulky článků

CREATE TABLE Articles (
    ArticleID int NOT NULL AUTO_INCREMENT,
    Timestamp timestamp,
    Title varchar(255),
    Attribute varchar(255),                              -- stav: nový / odeslaný do recenzního řízení / k formálnímu doplnění / schválený / zamítnutý / hotový / vydaný
    UserID int,
    JournalID int,
    PRIMARY KEY (ArticleID),
    FOREIGN KEY (JournalID) REFERENCES Journals(JournalID)),
    FOREIGN KEY (UserID) REFERENCES Users(UserID));      -- id autora
/* + data (PDF časopisu) */

-- vytvoření tabulky oponentního formuláře

CREATE TABLE Reviews (
    ReviewID int NOT NULL AUTO_INCREMENT,
    Timestamp timestamp,
    UserID int,
    Asset int,                                          -- aktuálnost, zajímavost a přínosnost
    Originality int,
    Expertness int,                                     -- odborná úroveň
    Grammar int,                                        -- jazyková a stylistická úroveň
    Text longtext,
    Reference boolean,                                   -- doporučení (true = doporučuji / false = nedoporučuji)
    ArticleID int NOT NULL,
    PRIMARY KEY (ReviewID),
    FOREIGN KEY (ArticleID) REFERENCES Articles(ArticleID)),
    FOREIGN KEY (UserID) REFERENCES Users(UserID));     -- id recenzenta

-- vytvoření tabulky helpdeskového formuláře

CREATE TABLE Helpdesk (
    HelpdeskID int NOT NULL AUTO_INCREMENT,
    Timestamp timestamp,
    Firstname varchar(255),
    Lastname varchar(255),
    Email varchar(255),
    Telefon int,
    Issue varchar(255),                                 -- Popis problému
    Checkbox boolean,
    PRIMARY KEY (HelpdeskID);

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

-- přidání dat tabulky časopisů

INSERT INTO Journals (Issue, Volume, Topic) 
VALUES
    (1, 2022, 'vědy o přírodě'),
    (2, 2022, 'společenské vědy'),
    (3, 2022, 'vědy o člověku'),
    (4, 2022, 'technické vědy'),
    (4, 2021, 'ekonomické vědy');


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
