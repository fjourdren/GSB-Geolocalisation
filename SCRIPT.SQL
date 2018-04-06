DROP DATABASE IF EXISTS PPE4;

CREATE DATABASE IF NOT EXISTS PPE4;
USE PPE4;
# -----------------------------------------------------------------------------
#       TABLE : USER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS USER
 (
   ID_USER INTEGER NOT NULL  ,
   TEL_USER CHAR(32) NULL  ,
   LOGIN_USER CHAR(32) NOT NULL  ,
   PASSWORD_USER CHAR(64) NOT NULL  ,
   LAST_NAME_USER CHAR(32) NULL  ,
   FIRST_NAME_USER CHAR(32) NULL  ,
   EMAIL_USER CHAR(32) NULL  
   , PRIMARY KEY (ID_USER) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ADMINISTRATION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ADMINISTRATION
 (
   ID_ADMIN INTEGER NOT NULL  ,
   LOGIN_ADMIN CHAR(32) NOT NULL  ,
   PASSWORD_ADMIN CHAR(64) NOT NULL  ,
   LAST_NAME_ADMIN CHAR(32) NULL  ,
   FIRST_NAME_ADMIN CHAR(32) NULL  ,
   EMAIL_ADMIN CHAR(32) NULL  
   , PRIMARY KEY (ID_ADMIN) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : LOCATION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS LOCATION
 (
   ID_LOCATION INTEGER NOT NULL  ,
   ID_USER INTEGER NULL  ,
   HOUR_LOCATION TIME NULL  ,
   PLACE_LOCATION CHAR(32) NULL  
   , PRIMARY KEY (ID_LOCATION) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE LOCATION
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_LOCATION_USER
     ON LOCATION (ID_USER ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE LOCATION 
  ADD FOREIGN KEY FK_LOCATION_USER (ID_USER)
      REFERENCES USER (ID_USER) ;

