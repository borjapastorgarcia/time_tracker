CREATE TABLE task (
id VARCHAR(36) NOT NULL,
name VARCHAR(255) DEFAULT NULL
UNIQUE INDEX idx (id), PRIMARY KEY(id))
DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB;


CREATE TABLE time_tracker.task_detail (
	id varchar(36) NOT NULL,
	name varchar(255) NOT NULL,
	status BOOL NOT NULL,
	started_at DATETIME NOT NULL,
	stopped_at DATETIME NULL,
	elapsed_time DATETIME NULL,
	task varchar(36) NOT NULL,
    UNIQUE INDEX idx (id), PRIMARY KEY(id),
	CONSTRAINT task_detail_FK FOREIGN KEY (task) REFERENCES time_tracker.task(id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci;
