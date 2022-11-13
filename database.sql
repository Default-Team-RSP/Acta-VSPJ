-- vytvoření databáze


USE jirmus;

-- vytvoření tabulky uživatelů

CREATE TABLE Users (
    UserID int NOT NULL AUTO_INCREMENT,
    Firstname varchar(255),
    Lastname varchar(255),
    Username varchar(255),
    Password varchar(255),
    Role varchar(255),                                  -- role: Author, Editor (=redaktor), Chief (=šéfredaktor), Reviewer (=recenzent), Admin
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
    Attribute varchar(255),                             -- stav: nový / odeslaný do recenzního řízení / k formálnímu doplnění / schválený / zamítnutý / hotový / vydaný
    UserID int,
    JournalID int,
    PRIMARY KEY (ArticleID),
    FOREIGN KEY (JournalID) REFERENCES Journals(JournalID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID));     -- id autora
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
    Reference boolean,                                  -- doporučení (true = doporučuji / false = nedoporučuji)
    ArticleID int NOT NULL,
    PRIMARY KEY (ReviewID),
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
    PRIMARY KEY (HelpdeskID));
    
    
-- vytvoření tabulky souborů

CREATE TABLE Files (
    FileID int NOT NULL AUTO_INCREMENT,
    Filename varchar(255) NOT NULL,
    Type varchar(30) NOT NULL,
    Content longblob NOT NULL,
    UserID int,
    JournalID int,
    ArticleID int,
    PRIMARY KEY(FileID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (JournalID) REFERENCES Journals(JournalID),
    FOREIGN KEY (ArticleID) REFERENCES Articles(ArticleID));