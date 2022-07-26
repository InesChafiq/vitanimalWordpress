-- Adminer 4.8.1 MySQL 5.5.5-10.5.15-MariaDB-0+deb11u1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `vitanimal_animal`;
CREATE TABLE `vitanimal_animal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `arrival_date` datetime DEFAULT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `medical_status` varchar(50) DEFAULT NULL,
  `reproductive_status` varchar(50) DEFAULT NULL,
  `features` varchar(100) DEFAULT NULL,
  `life_expectancy_in_months` int(11) DEFAULT NULL,
  `geriatric` tinyint(1) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `id_species` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vitanimal_animal` (`id`, `name`, `arrival_date`, `date_of_birth`, `medical_status`, `reproductive_status`, `features`, `life_expectancy_in_months`, `geriatric`, `gender`, `id_species`) VALUES
(1,	'Perruches tête de prune',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1),
(2,	'Etourneaux de Rotschild',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	2),
(3,	'Lamas',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	3),
(4,	'Wallabies ',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	4),
(5,	'Nandous ',	'2017-02-12 00:00:00',	'2017-02-12 00:00:00',	NULL,	NULL,	NULL,	120,	NULL,	'm',	5),
(6,	'Emeus ',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	6),
(7,	'Guépards ',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	7),
(8,	'Dromadaires ',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	8),
(9,	'Watussis ',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	9),
(10,	'Eléphants ',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	10),
(11,	'Hippopotames ',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	11),
(12,	'Gemsbok ',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	12);

DROP TABLE IF EXISTS `vitanimal_answer`;
CREATE TABLE `vitanimal_answer` (
  `id` int(11) NOT NULL,
  `type` varchar(150) NOT NULL,
  `value` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vitanimal_answer` (`id`, `type`, `value`) VALUES
(0,	'radio',	'oui:1;un peu:0.5;très faible:0.3;non:0;ne sait pas:;N/A:'),
(1,	'liste',	'à l\'extérieur;à l\'intérieur;suit l\'animal dans ses déplacements'),
(2,	'liste',	'ensoleillé;nuageux;pluvieux'),
(3,	'liste',	'oui;non'),
(4,	'liste',	'nourrisage;présence de soigneurs;nettoyage;autre');

DROP TABLE IF EXISTS `vitanimal_area`;
CREATE TABLE `vitanimal_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vitanimal_area` (`id`, `name`) VALUES
(0,	'1P'),
(1,	'2B'),
(3,	'3F'),
(4,	'4S'),
(5,	'5E'),
(6,	'6G');

DROP TABLE IF EXISTS `vitanimal_block`;
CREATE TABLE `vitanimal_block` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `id_questions_comments` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vitanimal_block` (`id`, `name`, `id_questions_comments`) VALUES
(0,	'1A : NUTRITION',	'q_0;q_1;q_2;q_7;q_8;q_9;q_10;q_11;c_0'),
(1,	'1B : ENVIRONNEMENT',	'q_12;q_13;q_14;q_15;q_16;q_17;q_18;q_19;q_20;q_30;q_31;q_32;q_33;q_34;q_35;q_36;q_37;q_38;q_39;q_40;q_41;q_42;q_43;q_44;c_0'),
(2,	'IDENTIFICATION',	'q_3;q_4;q_5;q_6'),
(3,	'2A : SANTE PHYSIQUE',	'q_21;q_22;q_23;q_24;q_25;q_26;q_27;q_28;q_29;c_0'),
(4,	'2B : COMPORTEMENT',	'q_45;q_46;q_47;q_48;q_49;q_50;q_51;q_52;q_53;q_54;q_55;q_56;q_57;q_58;q_59;q_60;q_61;c_0');

DROP TABLE IF EXISTS `vitanimal_blocks`;
CREATE TABLE `vitanimal_blocks` (
  `id_form` int(11) NOT NULL,
  `list_id_block` varchar(50) NOT NULL,
  PRIMARY KEY (`list_id_block`),
  KEY `fk_vitanimal_blocks_id_form_type` (`id_form`),
  CONSTRAINT `fk_vitanimal_blocks_id_form_type` FOREIGN KEY (`id_form`) REFERENCES `vitanimal_form_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vitanimal_blocks` (`id_form`, `list_id_block`) VALUES
(0,	'b_2;b_0;b_1'),
(1,	'b_3;b_4');

DROP TABLE IF EXISTS `vitanimal_comment`;
CREATE TABLE `vitanimal_comment` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `value` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vitanimal_comment` (`id`, `description`, `value`) VALUES
(0,	'mettez ici votre commentaire',	'');

DROP TABLE IF EXISTS `vitanimal_enclosure`;
CREATE TABLE `vitanimal_enclosure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `features` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vitanimal_enclosure` (`id`, `name`, `features`) VALUES
(1,	'1',	''),
(2,	'2',	''),
(3,	'3',	''),
(4,	'4',	''),
(5,	'5',	''),
(6,	'6',	''),
(7,	'7',	''),
(8,	'8',	''),
(9,	'9',	''),
(10,	'10',	'');

DROP TABLE IF EXISTS `vitanimal_evaluation`;
CREATE TABLE `vitanimal_evaluation` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `eval_begin` datetime NOT NULL,
  `eval_end` datetime NOT NULL,
  `id_group` int(11) NOT NULL,
  `observation` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vitanimal_evaluation` (`id`, `id_user`, `eval_begin`, `eval_end`, `id_group`, `observation`) VALUES
(0,	1,	'2022-06-27 00:00:00',	'2022-06-30 00:00:00',	4,	'2022-07-22 12:49:19'),
(1,	1,	'2022-06-27 00:00:00',	'2022-06-30 00:00:00',	7,	'2022-07-22 12:19:19'),
(3,	89,	'2022-06-27 00:00:00',	'2022-06-30 00:00:00',	3,	NULL);

DROP TABLE IF EXISTS `vitanimal_form`;
CREATE TABLE `vitanimal_form` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `observation` datetime DEFAULT NULL,
  `id_form_type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vitanimal_form_id_form_type` (`id_form_type`),
  CONSTRAINT `fk_vitanimal_form_id_form_type` FOREIGN KEY (`id_form_type`) REFERENCES `vitanimal_form_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vitanimal_form` (`id`, `name`, `observation`, `id_form_type`) VALUES
(0,	'version 1.0',	NULL,	0),
(1,	'version 1.0',	NULL,	1),
(3,	'',	NULL,	0);

DROP TABLE IF EXISTS `vitanimal_form_type`;
CREATE TABLE `vitanimal_form_type` (
  `id` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vitanimal_form_type` (`id`, `description`) VALUES
(0,	'ressource'),
(1,	'animal');

DROP TABLE IF EXISTS `vitanimal_group`;
CREATE TABLE `vitanimal_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `features` varchar(100) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `number_of_female` int(11) DEFAULT NULL,
  `id_animal` int(11) NOT NULL,
  `id_enclosure` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vitanimal_group` (`id`, `name`, `features`, `number`, `number_of_female`, `id_animal`, `id_enclosure`, `id_area`) VALUES
(1,	'perruche',	NULL,	NULL,	NULL,	1,	1,	0),
(2,	'perruche deux',	NULL,	NULL,	NULL,	1,	2,	0),
(3,	'Etourneaux',	NULL,	2,	NULL,	2,	2,	0),
(4,	'lamas',	NULL,	4,	NULL,	3,	3,	1),
(5,	'	Wallabies',	NULL,	NULL,	NULL,	4,	3,	1),
(6,	'Nandous',	'individu',	1,	NULL,	5,	4,	3),
(7,	'Emeus ',	NULL,	3,	NULL,	6,	5,	4),
(8,	'Guépards ',	NULL,	5,	NULL,	7,	6,	4),
(9,	'Dromadaires ',	NULL,	5,	NULL,	8,	7,	5),
(10,	'Watussis ',	NULL,	7,	NULL,	9,	7,	5),
(11,	'Eléphants ',	NULL,	3,	NULL,	10,	8,	5),
(12,	'Hippopotames ',	NULL,	3,	NULL,	11,	8,	5),
(13,	'Gemsbok ',	NULL,	3,	NULL,	12,	9,	6);

DROP TABLE IF EXISTS `vitanimal_observation`;
CREATE TABLE `vitanimal_observation` (
  `id_evaluation` int(11) NOT NULL,
  `id_form` int(11) NOT NULL,
  PRIMARY KEY (`id_evaluation`,`id_form`),
  KEY `fk_vitanimal_observation_id_form` (`id_form`),
  CONSTRAINT `fk_vitanimal_observation_id_evaluation` FOREIGN KEY (`id_evaluation`) REFERENCES `vitanimal_evaluation` (`id`),
  CONSTRAINT `fk_vitanimal_observation_id_form` FOREIGN KEY (`id_form`) REFERENCES `vitanimal_form` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vitanimal_observation` (`id_evaluation`, `id_form`) VALUES
(3,	0),
(3,	1);

DROP TABLE IF EXISTS `vitanimal_question`;
CREATE TABLE `vitanimal_question` (
  `id` int(11) NOT NULL,
  `titled` varchar(200) NOT NULL,
  `description` varchar(150) NOT NULL,
  `selected` varchar(50) NOT NULL,
  `id_answer` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vitanimal_question_id_answer` (`id_answer`),
  CONSTRAINT `fk_vitanimal_question_id_answer` FOREIGN KEY (`id_answer`) REFERENCES `vitanimal_answer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vitanimal_question` (`id`, `titled`, `description`, `selected`, `id_answer`) VALUES
(0,	'L\'eau est propre à la consommation animale',	'',	'',	0),
(1,	'L\'alimentation est de qualité.',	'',	'',	0),
(2,	'La quantité de nourriture répond aux besoins nutritionnels de l\'individu  (prendre en compte l\'âge et le stade physiologique : gestation,  lactation, croissance…).',	'',	'',	0),
(3,	'météo',	'',	'',	2),
(4,	'Observateur',	'',	'',	1),
(5,	'Observateur visible',	'',	'',	3),
(6,	'Conditions de l\'observation',	'',	'',	4),
(7,	'Une fiche alimentaire est disponible pour l\'individu et tient compte des  meilleures pratiques nutritionnelles (lignes directrices et  documentation factuelle disponibles sur les taxons).',	'',	'',	0),
(8,	'L\'animal a accès à de l\'eau 24/24.',	'',	'',	0),
(9,	'La diversité d\'aliments correspond aux besoins nutritionnels de  l\'individu (prendre en compte l\'âge et le stade physiologique : gestation,  lactation, croissance…).',	'',	'',	0),
(10,	'La nourriture est distribuée à un rythme et une fréquence adaptés à  l\'animal (nombre de repas, moment de la journée, méthode...).',	'',	'',	0),
(11,	'L\'alimentation est présentée de manière adaptée à l\'individu (tenir  compte des interactions sociales, de la coupe des aliments, de  l\'emplacement, la forme des gamelles…).',	'',	'',	0),
(12,	'Les températures de l\'enclos extérieur sont adaptées aux besoins de  l\'individu (nuit et journée, saisonnalité, zones chauffées, zones  ensoleillées, ombrage suffisant...).',	'',	'',	0),
(13,	'Les températures de l\'espace intérieur sont adaptées aux besoins de  l\'individu (nuit et journée, saisonnalité, gradient de température, zone  chauffée, zone fraîche…).',	'',	'',	0),
(14,	'L\'humidité de l\'enclos extérieur est adaptée aux besoins de l\'individu  (gradient, variations, saisonnalité…).',	'',	'',	0),
(15,	'L\'humidité de l\'espace intérieur est adaptée aux besoins de l\'individu  (gradient, variations, saisonnalité…)',	'',	'',	0),
(16,	'L’espace extérieur semble présenter une bonne qualité de l’air (pas  d\'alerte de pollution, de poussières, d’odeurs excessives).',	'',	'',	0),
(17,	'Les espaces intérieurs semblent présenter une bonne qualité de l\'air  (bonne ventilation, pas d\'émanation de produits chimiques, de  poussières, d\'odeurs excessives).',	'',	'',	0),
(18,	'La luminosité de l\'enclos extérieur est adaptée à l\'espèce (exposition,  intensité, besoins en UV, photopériode).',	'',	'',	0),
(19,	'L\'éclairage des intérieurs est adapté à l\'espèce (couleur, intensité,  besoins en UV, photopériode).',	'',	'',	0),
(20,	'L\'enclos préserve l\'animal des éventuelles nuisances sonores (bruits,  vibrations).',	'',	'',	0),
(21,	'L\'animal présente un bon aspect général (pas d\'écoulement anormal, bon état  du pelage / plumage / peau, des dents, de la ou des cornes / bois, du  bec, des ongles / griffes / nageoires ...).',	'',	'',	0),
(22,	'L\'animal présente une note d\'état corporel normale (ni obèse ni trop maigre).',	'',	'',	0),
(23,	'L\'animal a une bonne tonicité musculaire.',	'',	'',	0),
(24,	'L\'animal est exempt de signe de douleur et / ou de souffrance (grimace,  tressaillement, boiterie).',	'',	'',	0),
(25,	'L\'animal a des fèces de consistence et d\'apparence normale',	'',	'',	0),
(26,	'L\'animal Est exempt de signe de désorientation, de confusion, de faiblesse.',	'',	'',	0),
(27,	'L\'animal est exempt de signe de maladie (dont parasitose) ou blessure chronique  / récurrente connue.',	'',	'',	0),
(28,	'L\'animal  bénéficie d’un programme de désensibilisation / training pour faciliter  les procédures de soins et de gestion.',	'',	'',	0),
(29,	'Pour les animaux présentant un problème de santé chronique, des  mesures sont prises pour étudier et gérer la douleur (plan de soins,  surveillance continue, évaluation de la qualité de vie).',	'',	'',	0),
(30,	'Les espaces intérieurs préservent l\'animal des éventuelles nuisances sonores (bruits, vibrations).',	'',	'',	0),
(31,	'La taille, la complexité et la topographie de l\'habitat permettent à l\'animal de se déplacer et d\'explorer en 3 dimensions',	'',	'',	0),
(32,	'Tous les habitats (taille, complexité et topographie variables) sont accessibles jours et nuits, 365 jours par an.',	'',	'',	0),
(33,	'Les loges offrent un espace et un aménagement suffisants pour le temps que l\'animal doit y passer.',	'',	'',	0),
(34,	'L\'habitat est pourvu du substrat et des aménagements adaptés à la locomotion de l\'individu (abrasion, soutien, agrès, arbres, cordes….).',	'',	'',	0),
(35,	'L\'habitat est pourvu du substrat et des aménagements adaptés au repos de l\'animal (profondeur du substrat, confort, plateformes...).',	'',	'',	0),
(36,	'L\'habitat est pourvu du substrat et des aménagements adaptés au fourragement (profondeur, propreté…).',	'',	'',	0),
(37,	'L\'animal dispose d\'endroits où se réfugier s\'il veut s\'isoler des autres animaux partageant son enclos (cachettes, abris, zones de retrait, brise-vue...).',	'',	'',	0),
(38,	'L\'animal dispose d\'endroits où se réfugier s\'il veut s\'isoler de la vue des visiteurs (cachettes, abris, zones de retrait, brisevue...).',	'',	'',	0),
(39,	'Milieux terrestres : non saturés d\'eau, substrats non trempés. Il n\'y a pas d\'accumulation d\'eau de pluie dans les logements intérieurs ou extérieurs.',	'',	'',	0),
(40,	'Des enrichissements (environnemental, alimentaire, cognitif…) sont disponibles avec une fréquence et une variété adaptées aux besoins de l\'individu.',	'',	'',	0),
(41,	'L\'enclos respecte des densités d\'élevage acceptables (n\'est pas surpeuplé).',	'',	'',	0),
(42,	'L\'habitat est propre, sans accumulation inutile de matières fécales et/ou d\'urine, ou de substrats souillés (ne s\'applique pas aux animaux utilisant des latrines).',	'',	'',	0),
(43,	'Le nettoyage est réalisé avec des produits non nocifs pour l\'espèce et tient compte des signaux olfactifs naturels de l\'animal.',	'',	'',	0),
(44,	'L\'habitat assure la sécurité (physique, chimique, biologique) de l\'animal et le protège des intrusions néfastes (nuisibles, insectes, prédateurs, public).',	'',	'',	0),
(45,	'Les besoins sociaux de l\'animal sont respectés (solitaire, grégaire…).',	'',	'',	0),
(46,	'L\'animal exprime comportements de soin ou de confort autodirigés (toilettage, grattages, épouillages, activités de confort)',	'',	'',	0),
(47,	'L\'animal interagit principalement de manière positive ou neutre avec les autres animaux de l\'enclos.',	'',	'',	0),
(48,	'L\'animal interagit principalement de manière positive ou neutre avec les animaliers et autres personnels.',	'',	'',	0),
(49,	'L\'animal  répond positivement à un programme de training médical, entraînement / désensibilisation.',	'',	'',	0),
(50,	'L\'animal interagit principalement de manière positive ou neutre avec les visiteurs.',	'',	'',	0),
(51,	'L\'animal  explore son environnement (jeux, habitat).',	'',	'',	0),
(52,	'L\'animal  exploite / interagit, joue avec son environnement, manipule (jeux, habitat).',	'',	'',	0),
(53,	'L\'animal  répond de manière appropriée aux modifications de son environnement (enrichissements) avec intérêt plutôt qu\'avec aversion et peur.',	'',	'',	0),
(54,	'L\'animal  choisit d\'accéder, d\'exploiter l\'ensemble de son habitat au cours de la journée.',	'',	'',	0),
(55,	'L\'animal  choisit d\'accéder, d\'exploiter l\'ensemble de son habitat pendant la nuit.',	'',	'',	0),
(56,	'L\'animal  présente une activité normale (pas de repos excessif).',	'',	'',	0),
(57,	'L\'animal  exprime un comportement alimentaire propre à son espèce (fourragement, consommation…).',	'',	'',	0),
(58,	'L\'animal  exprime des comportements tactiles propres à son espèce (toilettage social, le grattage sur des substrats…).',	'',	'',	0),
(59,	'L\'animal  exprime des comportements sexuels à l\'égard de ses congénères.',	'',	'',	0),
(60,	'L\'animal  ne présente pas de trouble comportemental (automutilation, stéréotypies…).',	'',	'',	0),
(61,	'Si des comportements anormaux sont connus, des mesures sont mises en place pour comprendre les causes et mettre en place des actions.',	'',	'',	0);

DROP TABLE IF EXISTS `vitanimal_species`;
CREATE TABLE `vitanimal_species` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vitanimal_species` (`id`, `name`) VALUES
(1,	'Perruches tête de prune'),
(2,	'Etourneaux de Rotschild'),
(3,	'Lamas'),
(4,	'Wallabies '),
(5,	'Nandous '),
(6,	'Emeus '),
(7,	'Guépards '),
(8,	'Dromadaires '),
(9,	'Watussis '),
(10,	'Eléphants '),
(11,	'Hippopotames '),
(12,	'Gemsbok ');

-- 2022-07-26 14:15:21
