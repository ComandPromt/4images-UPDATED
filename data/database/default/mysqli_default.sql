
CREATE TABLE 4images_users (
  user_id int(11) PRIMARY KEY auto_increment,
  user_level int(11) NOT NULL DEFAULT '1',
  user_name varchar(255) NOT NULL DEFAULT '' UNIQUE,
  user_password varchar(255) NOT NULL DEFAULT '',
  user_email varchar(255) NOT NULL DEFAULT '' ,
  user_allowemails tinyint(1) NOT NULL DEFAULT '1',
  user_invisible tinyint(1) NOT NULL DEFAULT '0',
  user_joindate int(11)  NOT NULL ,
  user_lastaction int(11)  NOT NULL DEFAULT '0',
  user_location varchar(255) NOT NULL DEFAULT '',
  user_lastvisit int(11)  NOT NULL DEFAULT '0',
  user_comments int(11)  NOT NULL DEFAULT '0',
  user_homepage varchar(255) NOT NULL DEFAULT '',
  user_icq varchar(20) NOT NULL DEFAULT '',
  nacionalidad varchar(15) DEFAULT 'spanish' not null
)DEFAULT CHARSET=utf8;

CREATE TABLE 4images_sessions (
  session_id varchar(32),
  session_user_id int(11) NOT NULL DEFAULT '0',
  session_lastaction int(11)  NOT NULL DEFAULT '0',
  session_location varchar(255) NOT NULL DEFAULT '',
  session_ip varchar(15) NOT NULL DEFAULT '',
  session_date date,
  FOREIGN KEY (session_user_id) REFERENCES 4images_users(user_id),
  PRIMARY KEY (session_id,session_user_id)
)DEFAULT CHARSET=utf8;

CREATE TABLE 4images_lightboxes (
  lightbox_id int(11),
  user_id int(11) NOT NULL DEFAULT '0',
  lightbox_image_id int(11),
  PRIMARY KEY(lightbox_id,user_id,lightbox_image_id),
  FOREIGN KEY (user_id) REFERENCES 4images_users(user_id),
  FOREIGN KEY (user_id) REFERENCES 4images_users(user_id)
)DEFAULT CHARSET=utf8;

CREATE TABLE 4images_categories (
  cat_id int(11)PRIMARY KEY auto_increment ,
  cat_name varchar(255) NOT NULL UNIQUE,
  cat_description text NOT NULL,
  cat_parent_id int(11)  NOT NULL DEFAULT '0',
  cat_hits int(11)  NOT NULL DEFAULT '0',
  auth_viewcat tinyint(1) NOT NULL DEFAULT '0',
  auth_viewimage tinyint(1) NOT NULL DEFAULT '0',
  auth_download tinyint(1) NOT NULL DEFAULT '0',
  auth_upload tinyint(1) NOT NULL DEFAULT '0',
  auth_vote tinyint(1) NOT NULL DEFAULT '0',
  auth_sendpostcard tinyint(1) NOT NULL DEFAULT '0',
  auth_readcomment tinyint(1) NOT NULL DEFAULT '0',
  auth_postcomment tinyint(1) NOT NULL DEFAULT '0'
)DEFAULT CHARSET=utf8;

CREATE TABLE 4images_images (
  image_id int(11) PRIMARY KEY,
  cat_id int(11)  NOT NULL DEFAULT '0',
  user_id int(11) NOT NULL DEFAULT '0',
  image_name varchar(255) NOT NULL,
  image_description text,
  image_keywords text,
  image_date date  NOT NULL,
  image_active tinyint(1) NOT NULL DEFAULT '1',
  image_media_file varchar(255) NOT NULL,
  image_allow_comments tinyint(1) NOT NULL DEFAULT '1',
  image_comments int(11)  NOT NULL DEFAULT '0',
  image_downloads int(11)  NOT NULL DEFAULT '0',
  image_votes int(11)  NOT NULL DEFAULT '0',
  image_rating decimal(4,2) NOT NULL DEFAULT '0.00',
  image_hits int(11)  NOT NULL DEFAULT '0',
  sha256 varchar(64) NOT NULL,
  FOREIGN KEY (cat_id) REFERENCES 4images_categories(cat_id),
  FOREIGN KEY (user_id) REFERENCES 4images_users(user_id)
)DEFAULT CHARSET=utf8;

CREATE TABLE 4images_comments (
  comment_id int(11) PRIMARY KEY auto_increment,
  image_id int(11)  NOT NULL DEFAULT '0',
  user_id int(11) NOT NULL DEFAULT '0',
  user_name varchar(100) NOT NULL DEFAULT '',
  comment_headline varchar(255) NOT NULL DEFAULT '',
  comment_text text NOT NULL,
  comment_ip varchar(20) NOT NULL DEFAULT '',
  comment_date date NOT NULL,
 FOREIGN KEY (image_id) REFERENCES 4images_images(image_id),
 FOREIGN KEY (user_id) REFERENCES 4images_users(user_id)
)DEFAULT CHARSET=utf8;

CREATE TABLE 4images_etiquetas (
  id int(11) PRIMARY KEY,
  nombre varchar(20) UNIQUE
)DEFAULT CHARSET=utf8;

CREATE TABLE 4images_tags(
 id_imagen int(11),
 id_tag int (11),
 FOREIGN KEY (id_imagen) REFERENCES 4images_images(image_id),
 FOREIGN KEY (id_tag) REFERENCES 4images_etiquetas(id),
 PRIMARY KEY(id_imagen,id_tag)
)DEFAULT CHARSET=utf8;

CREATE TABLE 4images_groups (
group_id int(11) PRIMARY KEY AUTO_INCREMENT,
group_name varchar(25) NOT NULL UNIQUE
)DEFAULT CHARSET=utf8;

CREATE TABLE grupos(
id_usuario int(11),
id_grupo int(11),
FOREIGN KEY (id_usuario) REFERENCES 4images_users(user_id),
FOREIGN KEY (id_grupo) REFERENCES 4images_groups(group_id),
PRIMARY KEY (id_usuario,id_grupo)
)DEFAULT CHARSET=utf8;

CREATE TABLE notas (
	id int(11) AUTO_INCREMENT PRIMARY KEY,
	Nombre varchar(50) NOT NULL UNIQUE,
	tipo varchar(50) NOT NULL,
	descripcion varchar(255) NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE antispam(
id int(11) AUTO_INCREMENT PRIMARY KEY,
Nombre varchar(25) NOT NULL UNIQUE
)DEFAULT CHARSET=utf8;


INSERT INTO 4images_users VALUES (-1, -1, 'Guest', '0493984f537120be0b8d96bc9b69cdd2', '', 0, 0, 0, 0, '', 0, 0, '', '',DEFAULT);

INSERT INTO 4images_users VALUES (1, 9, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@yourdomain.com', 1, 0, 1016023608, 1016023608, '', 0, 0, '', '',DEFAULT);

INSERT INTO antispam VALUES(1,'fuck');
INSERT INTO antispam VALUES(2,'puta');
INSERT INTO antispam VALUES(3,'zorra');
INSERT INTO antispam VALUES(4,'fulana');
INSERT INTO antispam VALUES(5,'whore');
INSERT INTO antispam VALUES(6,'viagra');
INSERT INTO antispam VALUES(7,'dumbass');
INSERT INTO antispam VALUES(8,'dickhead');
INSERT INTO antispam VALUES(9,'jerk');
INSERT INTO antispam VALUES(10,'asshole');
INSERT INTO antispam VALUES(11,'pussy');
INSERT INTO antispam VALUES(12,'cunt');
INSERT INTO antispam VALUES(13,'bitch');
INSERT INTO antispam VALUES(14,'débile');
INSERT INTO antispam VALUES(15,'bête');
INSERT INTO antispam VALUES(16,'idiot');
INSERT INTO antispam VALUES(17,'stupid');
INSERT INTO antispam VALUES(18,'conee');
INSERT INTO antispam VALUES(19,'enculé');
INSERT INTO antispam VALUES(20,'putain');
INSERT INTO antispam VALUES(21,'va te faire foutre');
INSERT INTO antispam VALUES(22,'salaud');
INSERT INTO antispam VALUES(23,'cochon');
INSERT INTO antispam VALUES(24,'nique ta mere');
INSERT INTO antispam VALUES(25,'pendejo');
INSERT INTO antispam VALUES(26,'maric');
