
CREATE TABLE 4images_users (
  user_id int(11) PRIMARY KEY auto_increment,
  user_level int(11) NOT NULL default '1',
  user_name varchar(255) NOT NULL default '' UNIQUE,
  user_password varchar(255) NOT NULL default '',
  user_email varchar(255) NOT NULL default '' UNIQUE,
  user_allowemails tinyint(1) NOT NULL default '1',
  user_invisible tinyint(1) NOT NULL default '0',
  user_joindate int(11)  NOT NULL ,
  user_lastaction int(11)  NOT NULL default '0',
  user_location varchar(255) NOT NULL default '',
  user_lastvisit int(11)  NOT NULL default '0',
  user_comments int(11)  NOT NULL default '0',
  user_homepage varchar(255) NOT NULL default '',
  user_icq varchar(20) NOT NULL default '',
  nacionalidad varchar(15) default 'spanish' not null
)DEFAULT CHARSET=utf8;

CREATE TABLE 4images_sessions (
  session_id varchar(32),
  session_user_id int(11) NOT NULL default '0',
  session_lastaction int(11)  NOT NULL default '0',
  session_location varchar(255) NOT NULL default '',
  session_ip varchar(15) NOT NULL default '',
  session_date date,
  FOREIGN KEY (session_user_id) REFERENCES 4images_users(user_id),
  PRIMARY KEY (session_id,session_user_id)
)DEFAULT CHARSET=utf8;

CREATE TABLE 4images_lightboxes (
  lightbox_id varchar(32) PRIMARY KEY default '',
  user_id int(11) NOT NULL default '0',
  lightbox_lastaction int(11)  NOT NULL default '0',
  lightbox_image_ids text,
  FOREIGN KEY (user_id) REFERENCES 4images_users(user_id)
)DEFAULT CHARSET=utf8;

CREATE TABLE 4images_categories (
  cat_id int(11) auto_increment,
  cat_name varchar(255) NOT NULL UNIQUE,
  cat_description text NOT NULL,
  cat_parent_id int(11)  NOT NULL default '0',
  cat_order int(11)  NOT NULL default '0',
  cat_hits int(11)  NOT NULL default '0',
  auth_viewcat tinyint(2) NOT NULL default '0',
  auth_viewimage tinyint(2) NOT NULL default '0',
  auth_download tinyint(2) NOT NULL default '0',
  auth_upload tinyint(2) NOT NULL default '0',
  auth_directupload tinyint(2) NOT NULL default '0',
  auth_vote tinyint(2) NOT NULL default '0',
  auth_sendpostcard tinyint(2) NOT NULL default '0',
  auth_readcomment tinyint(2) NOT NULL default '0',
  auth_postcomment tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (cat_id,cat_parent_id,cat_order)
)DEFAULT CHARSET=utf8;

CREATE TABLE 4images_images (
  image_id int(11) PRIMARY KEY,
  cat_id int(11)  NOT NULL default '0',
  cat_parent_id int(11)  NOT NULL default '0',
  cat_order int(11)  NOT NULL default '0',
  user_id int(11) NOT NULL default '0',
  image_name varchar(255) NOT NULL default '',
  image_description text NOT NULL,
  image_keywords text NOT NULL,
  image_date date  NOT NULL,
  image_active tinyint(1) NOT NULL default '1',
  image_media_file varchar(255) NOT NULL default '',
  image_thumb_file varchar(255) NOT NULL default '',
  image_allow_comments tinyint(1) NOT NULL default '1',
  image_comments int(11)  NOT NULL default '0',
  image_downloads int(11)  NOT NULL default '0',
  image_votes int(11)  NOT NULL default '0',
  image_rating decimal(4,2) NOT NULL default '0.00',
  image_hits int(11)  NOT NULL default '0',
  sha256 varchar(64) NOT NULL,
  FOREIGN KEY (cat_id,cat_parent_id,cat_order) REFERENCES 4images_categories(cat_id,cat_parent_id,cat_order),
  FOREIGN KEY (user_id) REFERENCES 4images_users(user_id)
)DEFAULT CHARSET=utf8;

CREATE TABLE 4images_comments (
  comment_id int(11) PRIMARY KEY auto_increment,
  image_id int(11)  NOT NULL default '0',
  user_id int(11) NOT NULL default '0',
  user_name varchar(100) NOT NULL default '',
  comment_headline varchar(255) NOT NULL default '',
  comment_text text NOT NULL,
  comment_ip varchar(20) NOT NULL default '',
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

INSERT INTO 4images_users VALUES (-1, -1, 'Guest', '0493984f537120be0b8d96bc9b69cdd2', '', 0, 0, 0, 0, '', 0, 0, '', '',1);

INSERT INTO 4images_users VALUES (1, 9, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@yourdomain.com', 1, 0, 1016023608, 1016023608, '', 0, 0, '', '',default);