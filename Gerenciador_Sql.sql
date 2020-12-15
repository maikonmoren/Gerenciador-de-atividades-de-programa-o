drop database tcc_web;
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema tcc_web
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tcc_web
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tcc_web` DEFAULT CHARACTER SET utf8mb4 ;
USE `tcc_web` ;

-- -----------------------------------------------------
-- Table `tcc_web`.`tb_pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_web`.`tb_pessoa` (
  `p_id` INT(11) NOT NULL AUTO_INCREMENT,
  `p_nome` VARCHAR(40) NOT NULL,
  `p_email` VARCHAR(50) NOT NULL,
  `p_usuario` VARCHAR(40) NOT NULL,
  `p_senha` VARCHAR(50) NOT NULL,
  `p_tipo` INT(11) NOT NULL DEFAULT 1,
  `p_copilador` VARCHAR(100) NULL DEFAULT '0',
  PRIMARY KEY (`p_id`),
  UNIQUE INDEX `p_email` (`p_email` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 19
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `tcc_web`.`admin_pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_web`.`admin_pedido` (
  `pedido_id` INT(11) NOT NULL AUTO_INCREMENT,
  `pedido_tipo` INT(1) NULL DEFAULT NULL,
  `pedido_texto` VARCHAR(200) NULL DEFAULT NULL,
  `pedido_st` INT(1) NULL DEFAULT NULL,
  `p_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`pedido_id`),
  UNIQUE INDEX `p_id` (`p_id` ASC),
  CONSTRAINT `admin_pedido_ibfk_1`
    FOREIGN KEY (`p_id`)
    REFERENCES `tcc_web`.`tb_pessoa` (`p_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `tcc_web`.`tb_turma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_web`.`tb_turma` (
  `t_codigo` VARCHAR(20) NOT NULL,
  `t_nome` VARCHAR(50) NULL DEFAULT NULL,
  `t_desc` TEXT NULL DEFAULT NULL,
  `t_dono` INT(11) NULL DEFAULT NULL,
  `t_att` CHAR(1) NULL DEFAULT NULL,
  `t_senha` VARCHAR(40) NULL DEFAULT NULL,
  PRIMARY KEY (`t_codigo`),
  INDEX `t_dono` (`t_dono` ASC),
  CONSTRAINT `tb_turma_ibfk_1`
    FOREIGN KEY (`t_dono`)
    REFERENCES `tcc_web`.`tb_pessoa` (`p_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `tcc_web`.`tb_atividade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_web`.`tb_atividade` (
  `a_id` INT(11) NOT NULL AUTO_INCREMENT,
  `a_titulo` VARCHAR(100) NOT NULL,
  `a_info` TEXT NOT NULL,
  `a_arquivo` VARCHAR(45) NOT NULL,
  `a_codigo` TEXT NOT NULL,
  `a_entrada` VARCHAR(45) NOT NULL,
  `a_data` DATE NOT NULL,
  `t_codigo` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`a_id`),
  INDEX `tb_atividade_ibfk_1` (`t_codigo` ASC),
  CONSTRAINT `tb_atividade_ibfk_1`
    FOREIGN KEY (`t_codigo`)
    REFERENCES `tcc_web`.`tb_turma` (`t_codigo`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `tcc_web`.`pe_at`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_web`.`pe_at` (
  `p_id` INT(11) NOT NULL,
  `a_id` INT(11) NOT NULL,
  `pe_at_situacao` INT(11) NOT NULL,
  `pe_at_feedback` MEDIUMTEXT NULL DEFAULT 'Sem retorno',
  `pe_at_erro` TEXT NULL DEFAULT 'Sem erros',
  INDEX `pe_at_ibfk_1` (`p_id` ASC) ,
  INDEX `pe_at_ibfk_2` (`a_id` ASC) ,
  CONSTRAINT `pe_at_ibfk_1`
    FOREIGN KEY (`p_id`)
    REFERENCES `tcc_web`.`tb_pessoa` (`p_id`),
  CONSTRAINT `pe_at_ibfk_2`
    FOREIGN KEY (`a_id`)
    REFERENCES `tcc_web`.`tb_atividade` (`a_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `tcc_web`.`pe_tu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_web`.`pe_tu` (
  `p_id` INT(11) NULL DEFAULT NULL,
  `t_codigo` VARCHAR(20) NULL DEFAULT NULL,
  INDEX `p_id` (`p_id` ASC),
  INDEX `t_codigo` (`t_codigo` ASC),
  CONSTRAINT `pe_tu_ibfk_1`
    FOREIGN KEY (`p_id`)
    REFERENCES `tcc_web`.`tb_pessoa` (`p_id`),
  CONSTRAINT `pe_tu_ibfk_2`
    FOREIGN KEY (`t_codigo`)
    REFERENCES `tcc_web`.`tb_turma` (`t_codigo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `tcc_web`.`suporte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_web`.`suporte` (
  `s_id` INT(11) NOT NULL AUTO_INCREMENT,
  `s_texto` TEXT NULL DEFAULT NULL,
  `s_situacao` INT(1) NULL DEFAULT NULL,
  `s_solucao` TEXT NULL DEFAULT 'Sem resposta',
  `p_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`s_id`),
  INDEX `p_id` (`p_id` ASC),
  CONSTRAINT `suporte_ibfk_1`
    FOREIGN KEY (`p_id`)
    REFERENCES `tcc_web`.`tb_pessoa` (`p_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb4;

USE `tcc_web` ;

-- -----------------------------------------------------
-- Placeholder table for view `tcc_web`.`feedback`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_web`.`feedback` (`id` INT, `nome` INT, `aid` INT, `info` INT, `resultado` INT);

-- -----------------------------------------------------
-- Placeholder table for view `tcc_web`.`vw_copilador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_web`.`vw_copilador` (`ID` INT, `Arquivo` INT, `codigo` INT, `entrada` INT, `pid` INT, `copilador` INT);

-- -----------------------------------------------------
-- Placeholder table for view `tcc_web`.`vw_minhas_sala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_web`.`vw_minhas_sala` (`t_nome` INT, `t_desc` INT, `t_att` INT, `t_codigo` INT);

-- -----------------------------------------------------
-- Placeholder table for view `tcc_web`.`vw_minhas_salas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_web`.`vw_minhas_salas` (`nome` INT, `codigo` INT);

-- -----------------------------------------------------
-- Placeholder table for view `tcc_web`.`vw_painel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_web`.`vw_painel` (`id` INT, `aluno` INT, `atividade` INT, `titulo` INT, `st` INT);

-- -----------------------------------------------------
-- Placeholder table for view `tcc_web`.`vw_pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_web`.`vw_pedido` (`id` INT, `pedido` INT, `texto` INT, `st` INT);

-- -----------------------------------------------------
-- Placeholder table for view `tcc_web`.`vw_pedido2`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_web`.`vw_pedido2` (`nome` INT, `id` INT, `pedido` INT, `texto` INT, `st` INT);

-- -----------------------------------------------------
-- Placeholder table for view `tcc_web`.`vw_professor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_web`.`vw_professor` (`id` INT, `nome` INT, `tipo` INT, `nsala` INT);

-- -----------------------------------------------------
-- View `tcc_web`.`feedback`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc_web`.`feedback`;
USE `tcc_web`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tcc_web`.`feedback` AS select `p`.`p_id` AS `id`,`p`.`p_nome` AS `nome`,`a`.`a_id` AS `aid`,`a`.`a_info` AS `info`,`pa`.`pe_at_erro` AS `resultado` from ((`tcc_web`.`tb_pessoa` `p` join `tcc_web`.`tb_atividade` `a`) join `tcc_web`.`pe_at` `pa`) where `pa`.`p_id` = `p`.`p_id` and `a`.`a_id` = `pa`.`a_id`;

-- -----------------------------------------------------
-- View `tcc_web`.`vw_copilador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc_web`.`vw_copilador`;
USE `tcc_web`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tcc_web`.`vw_copilador` AS select `a`.`a_id` AS `ID`,`a`.`a_arquivo` AS `Arquivo`,`a`.`a_codigo` AS `codigo`,`a`.`a_entrada` AS `entrada`,`p`.`p_id` AS `pid`,`p`.`p_copilador` AS `copilador` from (`tcc_web`.`tb_atividade` `a` join `tcc_web`.`tb_pessoa` `p`);

-- -----------------------------------------------------
-- View `tcc_web`.`vw_minhas_sala`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc_web`.`vw_minhas_sala`;
USE `tcc_web`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tcc_web`.`vw_minhas_sala` AS select `tcc_web`.`tb_turma`.`t_nome` AS `t_nome`,`tcc_web`.`tb_turma`.`t_desc` AS `t_desc`,`tcc_web`.`tb_turma`.`t_att` AS `t_att`,`tcc_web`.`tb_turma`.`t_codigo` AS `t_codigo` from `tcc_web`.`tb_turma` where `tcc_web`.`tb_turma`.`t_codigo` in (select `tcc_web`.`pe_tu`.`t_codigo` from `tcc_web`.`pe_tu` where `tcc_web`.`pe_tu`.`p_id` = 0);

-- -----------------------------------------------------
-- View `tcc_web`.`vw_minhas_salas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc_web`.`vw_minhas_salas`;
USE `tcc_web`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tcc_web`.`vw_minhas_salas` AS select `tcc_web`.`tb_turma`.`t_nome` AS `nome`,`tcc_web`.`tb_turma`.`t_codigo` AS `codigo` from `tcc_web`.`tb_turma` where `tcc_web`.`tb_turma`.`t_codigo` in (select `tcc_web`.`pe_tu`.`t_codigo` from `tcc_web`.`pe_tu` where `tcc_web`.`pe_tu`.`p_id` = 0);

-- -----------------------------------------------------
-- View `tcc_web`.`vw_painel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc_web`.`vw_painel`;
USE `tcc_web`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tcc_web`.`vw_painel` AS select `p`.`p_id` AS `id`,`p`.`p_nome` AS `aluno`,`a`.`a_id` AS `atividade`,`a`.`a_titulo` AS `titulo`,if(`a`.`a_data` < current_timestamp() and `pa`.`pe_at_situacao` = 0,3,`pa`.`pe_at_situacao`) AS `st` from ((`tcc_web`.`tb_pessoa` `p` join `tcc_web`.`pe_at` `pa`) join `tcc_web`.`tb_atividade` `a`) where `p`.`p_id` = `pa`.`p_id` and `pa`.`a_id` = `a`.`a_id`;

-- -----------------------------------------------------
-- View `tcc_web`.`vw_pedido`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc_web`.`vw_pedido`;
USE `tcc_web`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tcc_web`.`vw_pedido` AS select `tcc_web`.`admin_pedido`.`p_id` AS `id`,case when `tcc_web`.`admin_pedido`.`pedido_tipo` = 1 then 'Professor' when `tcc_web`.`admin_pedido`.`pedido_tipo` = 2 then 'Administrador' end AS `pedido`,`tcc_web`.`admin_pedido`.`pedido_texto` AS `texto`,case when `tcc_web`.`admin_pedido`.`pedido_st` = 0 then 'Pedido não avaliado' when `tcc_web`.`admin_pedido`.`pedido_st` = 1 then 'Pedido aprovado' when `tcc_web`.`admin_pedido`.`pedido_st` = 2 then 'Pedido negado' end AS `st` from `tcc_web`.`admin_pedido`;

-- -----------------------------------------------------
-- View `tcc_web`.`vw_pedido2`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc_web`.`vw_pedido2`;
USE `tcc_web`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tcc_web`.`vw_pedido2` AS select `tp`.`p_nome` AS `nome`,`p`.`p_id` AS `id`,case when `p`.`pedido_tipo` = 1 then 'Professor' when `p`.`pedido_tipo` = 2 then 'Administrador' end AS `pedido`,`p`.`pedido_texto` AS `texto`,case when `p`.`pedido_st` = 0 then 'Pedido não avaliado' when `p`.`pedido_st` = 1 then 'Pedido aprovado' when `p`.`pedido_st` = 2 then 'Pedido negado' end AS `st` from (`tcc_web`.`admin_pedido` `p` join `tcc_web`.`tb_pessoa` `tp`) where `p`.`p_id` = `tp`.`p_id` and `p`.`pedido_st` = 0;

-- -----------------------------------------------------
-- View `tcc_web`.`vw_professor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc_web`.`vw_professor`;
USE `tcc_web`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tcc_web`.`vw_professor` AS select `tcc_web`.`tb_pessoa`.`p_id` AS `id`,`tcc_web`.`tb_pessoa`.`p_nome` AS `nome`,`tcc_web`.`tb_pessoa`.`p_tipo` AS `tipo`,(select count(`t`.`t_codigo`) from (`tcc_web`.`tb_turma` `t` join `tcc_web`.`tb_pessoa` `p`) where `t`.`t_dono` = `p`.`p_id`) AS `nsala` from `tcc_web`.`tb_pessoa` where `tcc_web`.`tb_pessoa`.`p_tipo` = 2;
USE `tcc_web`;

DELIMITER $$
USE `tcc_web`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `tcc_web`.`tb_turma_AFTER_INSERT`
AFTER INSERT ON `tcc_web`.`tb_turma`
FOR EACH ROW
BEGIN
	insert into pe_tu values (NEW.t_dono,NEW.t_codigo);
END$$

USE `tcc_web`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `tcc_web`.`tb_turma_BEFORE_DELETE`
BEFORE DELETE ON `tcc_web`.`tb_turma`
FOR EACH ROW
BEGIN
	delete from pe_tu where t_codigo = old.t_codigo;
    delete from tb_atividade where t_codigo = old.t_codigo;
END$$

USE `tcc_web`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `tcc_web`.`tb_atividade_AFTER_INSERT`
AFTER INSERT ON `tcc_web`.`tb_atividade`
FOR EACH ROW
BEGIN
	DECLARE done INT DEFAULT FALSE;
    declare id int(11);
    declare cur cursor for select p_id from pe_tu where t_codigo = NEW.t_codigo;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    open cur;
    read_loop: LOOP
    fetch cur into id;
	if done then
		leave read_loop;
	end if;
		insert into pe_at values(id,new.a_id,0,"Sem retorno","Atividade não enviada");
	end loop;
    close cur;

END$$

USE `tcc_web`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `tcc_web`.`tb_atividade_BEFORE_DELETE`
BEFORE DELETE ON `tcc_web`.`tb_atividade`
FOR EACH ROW
BEGIN
		delete from pe_at where a_id = old.a_id;
END$$

USE `tcc_web`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `tcc_web`.`pe_tu_AFTER_INSERT`
AFTER INSERT ON `tcc_web`.`pe_tu`
FOR EACH ROW
BEGIN
	DECLARE done INT DEFAULT FALSE;
    declare id int(11);
    declare cur cursor for select a_id from tb_atividade where t_codigo = NEW.t_codigo;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    open cur;
    read_loop: LOOP
    fetch cur into id;
	if done then
		leave read_loop;
	end if;
		insert into pe_at values(new.p_id,id,0,"Sem retorno","Atividade não enviada");
	end loop;
    close cur;
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
