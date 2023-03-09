SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS test;

CREATE TABLE IF NOT EXISTS myarttable (
  id int(11) NOT NULL,
  text text NOT NULL,
  description text NOT NULL,
  keywords text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

ALTER TABLE myarttable
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE myarttable
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
  
INSERT INTO myarttable (text, description, keywords) VALUES
('Февраль', '128', 'Сидоров В.Н.'),
('Март', '520', 'Осипов А.К.'),
('Май', '629', 'Смирнов В.Ю.'),
('Июнь', '371', 'Петров К.Д.'),
('Июль', '542', 'Субботин А.Н.'),
('Август', '389', 'Данилин В.Д.'),
('Сентябрь', '291', 'Акимова Н.А.'),
('Октябрь', '579', 'Иванов Д.Ф.'),
('Ноябрь', '271', 'Петров Н.Г.'),
('Декабрь', '182', 'Никитин А.Д.'),
('Январь', '284', 'Васильев Н.Г.');

COMMIT;