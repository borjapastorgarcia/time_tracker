CREATE TABLE task (
id VARCHAR(36) NOT NULL,
name VARCHAR(255) DEFAULT NULL
UNIQUE INDEX idx (id), PRIMARY KEY(id))
DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB;