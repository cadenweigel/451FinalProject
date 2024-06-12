CREATE TABLE `final_project_db`.`Players`(
	PlayerID int,
    TeamID int,
    AgentID int,
    CollegeID int,
    FirstName varchar(255),
    LastName varchar(255),
    Position varchar(255),
    PlayerNumber int,
    Salary int,
    experience int
);

CREATE TABLE `final_project_db`.`Arenas`(
    ArenaID int,
    TeamID int,
    Attendance int,
    ArenaCity varchar(255),
    ArenaState varchar(255),
    ArenaCountry varchar(255),
    ArenaName varchar(255)
);

CREATE TABLE `final_project_db`.`Owners`(
    OwnerID int,
    TeamID int,
    datePurchased date
);

CREATE TABLE `final_project_db`.`Coaches`(
    CoachID int,
    TeamID int,
    Salary int,
    CoachName varchar(255)
);

CREATE TABLE `final_project_db`.`Agents`(
    AgentID int,
    AgentName varchar(255)
);

CREATE TABLE `final_project_db`.`Games`(
    GameID int,
    WinnerID int,
    LoserID int,
    ArenaID int,
    WinningScore int,
    LosingScore int,
    DatePlayed date
);

CREATE TABLE `final_project_db`.`Purchases`(
    OrderID int,
    PlayerID int,
    TeamID int,
    Cost int,
    JerseyType varchar(255)
);

CREATE TABLE `final_project_db`.`Colleges`(
    CollegeID int,
    CollegeName varchar(255),
    CollegeCity varchar(255),
    CollegeState varchar(255),
    CollegeCountry varchar(255),
    Conference varchar(255)
);