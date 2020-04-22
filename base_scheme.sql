# create compare_date table
CREATE TABLE `compare_date`
(
    `id`             INT(11)     NOT NULL AUTO_INCREMENT,
    `ip_address`     VARCHAR(50) NOT NULL,
    `first_operand`  VARCHAR(50) NOT NULL,
    `second_operand` VARCHAR(50) NOT NULL,
    `different`      INT(11)     NOT NULL,
    `execution_time` FLOAT       NOT NULL,
    `date_add`       TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
)
    COLLATE = 'utf8_general_ci'
    ENGINE = InnoDB;
# create resources table
CREATE TABLE `resources`
(
    `id_resource` INT(11)                   NOT NULL AUTO_INCREMENT,
    `id_role`     INT(11)                   NOT NULL,
    `controller`  VARCHAR(50)               NOT NULL,
    `action_list` VARCHAR(255)              NOT NULL,
    `type`        ENUM ('public','private') NOT NULL,
    `date_add`    TIMESTAMP                 NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_resource`)
)
    COLLATE = 'utf8_general_ci'
    ENGINE = InnoDB;

# data for resources table
INSERT INTO `resources` (`id_role`, `controller`, `action_list`, `type`)
VALUES (1, 'index', '["*"]', 'public');
# create roles table
CREATE TABLE `roles`
(
    `id_role`     INT(11)      NOT NULL AUTO_INCREMENT,
    `name`        VARCHAR(50)  NULL DEFAULT NULL,
    `description` VARCHAR(255) NULL DEFAULT NULL,
    `active`      TINYINT(4)   NULL DEFAULT '1',
    `date_add`    TIMESTAMP    NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_role`)
)
    COLLATE = 'utf8_general_ci'
    ENGINE = InnoDB;
# data for roles table
INSERT INTO `roles` (`name`, `description`, `active`)
VALUES ('guest', 'no-logged people', 1);
INSERT INTO `roles` (`name`, `description`, `active`)
VALUES ('admin', 'administrator', 1);
