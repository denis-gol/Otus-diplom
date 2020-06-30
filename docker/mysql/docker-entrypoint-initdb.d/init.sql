# выполняется после запуска контейнера mysql
# начальный скрипт

CREATE DATABASE IF NOT EXISTS `service01` COLLATE 'utf8_general_ci' ;
GRANT ALL ON `service01`.* TO 'service01'@'%' ;


FLUSH PRIVILEGES;

USE service01;
