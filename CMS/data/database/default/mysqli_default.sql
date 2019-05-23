CREATE TABLE `aleman` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
);

CREATE TABLE `ingles` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
);

CREATE TABLE `spanish` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
);

CREATE TABLE `frances` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
);

CREATE TABLE `portuges` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
);

CREATE TABLE `italiano` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
);

CREATE TABLE `hindu` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
);

CREATE TABLE `chino` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
);

CREATE TABLE `japones` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
);

CREATE TABLE `arabe` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
);

CREATE TABLE `bengali` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
);

CREATE TABLE `catalan` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
);

CREATE TABLE `euskera` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
);

CREATE TABLE `ruso`(
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
);
