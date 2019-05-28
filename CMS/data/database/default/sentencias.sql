CREATE TABLE `aleman` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE `ingles` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE `spanish` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE `frances` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE `portuges` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE `italiano` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE `hindu` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE `chino` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE `japones` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE `arabe` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE `bengali` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE `catalan` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE `euskera` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE `ruso`(
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `accion` varchar(40) NOT NULL unique,
  `texto` text NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE `4images_users` (
  `user_id` int(11) PRIMARY KEY auto_increment,
  `user_level` int(11) NOT NULL DEFAULT '1',
  `user_name` varchar(255) NOT NULL DEFAULT '' UNIQUE,
  `user_password` varchar(255) NOT NULL DEFAULT '',
  `user_email` varchar(255) NOT NULL,
  `user_allowemails` tinyint(1) NOT NULL DEFAULT '1',
  `user_invisible` tinyint(1) NOT NULL DEFAULT '0',
  `user_joindate` int(11)  NOT NULL ,
  `user_lastaction` int(11)  NOT NULL DEFAULT '0',
  `user_location` varchar(255) NOT NULL DEFAULT '',
  `user_lastvisit` int(11)  NOT NULL DEFAULT '0',
  `user_comments` int(11)  NOT NULL DEFAULT '0',
  `user_homepage` varchar(255) NOT NULL DEFAULT '',
  `user_icq` varchar(20) NOT NULL DEFAULT '',
  `nacionalidad` varchar(15) DEFAULT 'spanish' not null
)DEFAULT CHARSET=utf8;

CREATE TABLE `mensajes`(
`id` int(11) PRIMARY KEY auto_increment,
`remitente` int(11),
`destinatario` int(11),
`asunto` varchar(30),
`mensaje` text,
`leido` tinyint(1) DEFAULT 0,
FOREIGN KEY (`remitente`) REFERENCES `4images_users`(`user_id`),
FOREIGN KEY (`destinatario`) REFERENCES `4images_users`(`user_id`)
);

CREATE TABLE `4images_sessions` (
  `session_id` int(11),
  `session_user_id` int(11),
  `session_lastaction` int(11)  NOT NULL DEFAULT '0',
  `session_location` varchar(255) NOT NULL DEFAULT '',
  `session_ip` varchar(15) NOT NULL DEFAULT '',
  `session_date` date,
  FOREIGN KEY (`session_user_id`) REFERENCES `4images_users`(`user_id`),
  PRIMARY KEY (`session_id`,`session_user_id`)
)DEFAULT CHARSET=utf8;

CREATE TABLE `4images_lightboxes` (
  `user_id` int(11),
  `lightbox_image_id` int(11),
  PRIMARY KEY(`user_id`,`lightbox_image_id`),
  FOREIGN KEY (`user_id`) REFERENCES `4images_users`(`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `4images_users`(`user_id`)
)DEFAULT CHARSET=utf8;

CREATE TABLE `4images_categories` (
  `cat_id` int(11)PRIMARY KEY auto_increment ,
  `cat_name` varchar(255) NOT NULL UNIQUE,
  `cat_description` text NOT NULL,
  `cat_parent_id` int(11)  NOT NULL DEFAULT '0',
  `cat_hits` int(11)  NOT NULL DEFAULT '0',
  `auth_viewcat` tinyint(1) NOT NULL DEFAULT '0',
  `auth_viewimage` tinyint(1) NOT NULL DEFAULT '0',
  `auth_download` tinyint(1) NOT NULL DEFAULT '0',
  `auth_upload` tinyint(1) NOT NULL DEFAULT '0',
  `auth_vote` tinyint(1) NOT NULL DEFAULT '0',
  `auth_sendpostcard` tinyint(1) NOT NULL DEFAULT '0',
  `auth_readcomment` tinyint(1) NOT NULL DEFAULT '0',
  `auth_postcomment` tinyint(1) NOT NULL DEFAULT '0'
)DEFAULT CHARSET=utf8;

CREATE TABLE `4images_images` (
  `image_id` int(11) PRIMARY KEY auto_increment,
  `cat_id` int(11)  NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `image_name` varchar(255) NOT NULL,
  `image_description` text,
  `image_keywords` text,
  `image_date` date  NOT NULL,
  `image_active` tinyint(1) NOT NULL DEFAULT '1',
  `image_media_file` varchar(255) NOT NULL UNIQUE,
  `image_allow_comments` tinyint(1) NOT NULL DEFAULT '1',
  `image_comments` int(11)  NOT NULL DEFAULT '0',
  `image_downloads` int(11)  NOT NULL DEFAULT '0',
  `image_votes` int(11)  NOT NULL DEFAULT '0',
  `image_rating` decimal(4,2) NOT NULL DEFAULT '0.00',
  `image_hits` int(11)  NOT NULL DEFAULT '0',
  `sha256` varchar(64) NOT NULL,
  FOREIGN KEY (`cat_id`) REFERENCES `4images_categories`(`cat_id`),
  FOREIGN KEY (`user_id`) REFERENCES `4images_users`(`user_id`)
)DEFAULT CHARSET=utf8;

CREATE TABLE `4images_comments` (
  `comment_id` int(11) PRIMARY KEY auto_increment,
  `image_id` int(11)  NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `comment_headline` varchar(255) NOT NULL DEFAULT '',
  `comment_text` text NOT NULL,
  `comment_ip` varchar(20) NOT NULL DEFAULT '',
  `comment_date` date NOT NULL,
 FOREIGN KEY (`image_id`) REFERENCES `4images_images`(`image_id`),
 FOREIGN KEY (`user_id`) REFERENCES `4images_users`(`user_id`)
)DEFAULT CHARSET=utf8;

CREATE TABLE `4images_etiquetas` (
  `id` int(11) PRIMARY KEY,
  `nombre` varchar(20) UNIQUE
)DEFAULT CHARSET=utf8;

CREATE TABLE `4images_tags`(
 `id_imagen` int(11),
 `id_tag` int (11),
 FOREIGN KEY (`id_imagen`) REFERENCES `4images_images`(`image_id`),
 FOREIGN KEY (`id_tag`) REFERENCES `4images_etiquetas`(`id`),
 PRIMARY KEY(`id_imagen`,`id_tag`)
)DEFAULT CHARSET=utf8;

CREATE TABLE `4images_groups` (
`group_id` int(11) PRIMARY KEY AUTO_INCREMENT,
`group_name` varchar(25) NOT NULL UNIQUE
)DEFAULT CHARSET=utf8;

CREATE TABLE `grupos`(
`id_usuario` int(11),
`id_grupo` int(11),
FOREIGN KEY (`id_usuario`) REFERENCES 4images_users(`user_id`),
FOREIGN KEY (`id_grupo`) REFERENCES 4images_groups(`group_id`),
PRIMARY KEY (`id_usuario`,`id_grupo`)
)DEFAULT CHARSET=utf8;

CREATE TABLE `notas` (
	`id` int(11) AUTO_INCREMENT PRIMARY KEY,
	`Nombre` varchar(50) NOT NULL UNIQUE,
	`tipo` varchar(50) NOT NULL,
	`descripcion` varchar(255) NOT NULL
)DEFAULT CHARSET=utf8;

CREATE TABLE `antispam`(
`id` int(11) AUTO_INCREMENT PRIMARY KEY,
`Nombre` varchar(25) NOT NULL UNIQUE
)DEFAULT CHARSET=utf8;

INSERT INTO aleman (id, accion, texto) VALUES
('1', 'activacion_exitosa', 'Der Benutzer wurde erfolgreich aktiviert'),
('2', 'registro_exitoso', 'Danke für die Registrierung'),
('3', 'error', 'Falsche Daten'),
('4', 'ultima_visita', 'Letzter Besuch'),
('5', 'error_captcha', 'Captcha ungültig'),
('6', 'agreement', 'Registrierungsbedingungen'),
('7', 'register_msg', 'Bitte füllen Sie alle Felder aus'),
('8', 'user_name', 'Nutzer'),
('9', 'password', 'Passwort'),
('10', 'email', 'Email'),
('11', 'submit', 'Einreichen'),
('12', 'reset', 'Sauber'),
('13', 'agreement_terms', 'Sie erklären sich damit einverstanden, dass die Administratoren dieser Website befugt sind, innerhalb kürzester Zeit Material zu entfernen oder zu bearbeiten, das möglicherweise beanstandet wird. Sie erklären sich damit einverstanden, dass alle auf dieser Website veröffentlichten Nachrichten die Meinungen und Ansichten ihrer Autoren widerspiegeln, keine Meinungen oder Ansichten von Administratoren, Moderatoren oder Webmastern sind (mit Ausnahme der Nachrichten, die von diesen letzten Personen ausdrücklich erstellt wurden) und sie daher nicht für die Website verantwortlich sind von den Besuchern veröffentlichte Meinungen. <br/> <br/> Sie erklären sich damit einverstanden, keine missbräuchlichen, obszönen, vulgären, skandalösen, verletzenden, drohenden, verleumderischen, sexuellen oder pornografischen Inhalte oder sonstiges Material zu veröffentlichen, das gegen geltende Gesetze verstoßen könnte. Sie erklären sich damit einverstanden, dass der Webmaster und der Administrator dieser Website das Recht haben, jedes Thema zu dem Zeitpunkt zu löschen oder zu bearbeiten, zu dem Sie es für angemessen halten. Als Benutzer stimmen Sie zu, dass alle von Ihnen bereitgestellten Daten in einer Datenbank gespeichert werden. Diese Daten werden ohne Ihre Zustimmung nicht an Dritte weitergegeben. Der Webmaster und der Administrator können nicht für Zugriffsversuche oder Angriffe verantwortlich gemacht werden, die ihre Daten gefährden könnten. <br /> <br /> Dieses System verwendet Cookies, um Informationen auf Ihrem Computer zu speichern. Diese Cookies enthalten keine persönlichen Informationen. Sie dienen lediglich dazu, Ihren Besuch auf dieser Website angenehmer zu gestalten. <br/> <br/> Durch Klicken auf Ich stimme zu, dass Sie alle diese Bedingungen akzeptieren'),
('14', 'captcha', 'Captcha'),
('15', 'ok', 'Ok'),
('16', 'recordar', 'Passwort merken'),
('17', 'login', 'Reinkommen'),
('18', 'nota_email', 'Die E-Mail wird hilfreich sein, wenn Sie Ihr Passwort wiederherstellen möchten'),
('19', 'nueva_pass', 'Neues Kennwort'),
('20', 'cambiar_pass', 'Ändere das Passwort'),
('21', 'cambio_pass_exitoso', 'Das Passwort wurde korrekt geändert'),
('22', 'comments', 'Kommentare'),
('23', 'already_voted', 'Sie haben dieses Bild bereits bewertet!'),
('24', 'no_comments', 'Es wurden noch keine Kommentare abgegeben.'),
('25', 'comments_deactivated', 'Kommentarfunktion deaktiviert!'),
('26', 'post_comment', 'Kommentar posten'),
('27', 'comment_success', 'Ihr Kommentar wurde gespeichert'),
('28', 'download_error', 'Fehler beim Download der Bild-Datei!'),
('29', 'register_download', 'Um Bilder downloaden zu können, müssen Sie registrierter Benutzer sein'),
('30', 'description', 'Beschreibung'),
('31', 'keywords', 'Schlüsselwörter'),
('32', 'hits', 'Hits'),
('33', 'downloads', 'Downloads'),
('34', 'rating', 'Bewertung'),
('35', 'votes', 'Stimme(n)'),
('36', 'author', 'Autor'),
('37',  'tipe',  'Typ'),
('38', 'comment', 'Kommentar'),
('39', 'added_by', 'Hinzugefügt von'),
('40', 'allow_comments', 'Kommentare erlauben'),
('41', 'exif_make', 'Hersteller'),
('42', 'exif_model', 'Modell'),
('43', 'exif_datetime', 'Aufnahmedatum'),
('44', 'send_postcard', 'eCard versenden'),
('45', 'edit_postcard', 'eCard bearbeiten'),
('46', 'bg_color', 'Hintergrundfarbe'),
('47', 'font_color', 'Schriftfarbe'),
('48', 'font_face', 'Schriftart'),
('49', 'recipient', 'Empfänger'),
('50', 'sender', 'Absender'),
('51', 'send_postcard_success', 'Vielen Dank! Ihre E-Mail wurde gesendet!'),
('52', 'top_image_hits', 'Top 5 Bilder von Besuchen'),
('53', 'top_image_downloads', 'Top 5 Bilder von Downloads'),
('54', 'top_image_rating', 'Top 5 Bilder nach Punktzahl'),
('55', 'top_image_votes', 'Top 5 Bilder nach Stimmenzahl'),
('56', 'upload_success', 'Die Dateien wurden korrekt hochgeladen'),
('57', 'nombre_subida_multiple', 'Name des Bildes oder der Bilder'),
('58', 'insertar_categoria', 'Wählen Sie die Kategorie aus'),
('59',  'name',  'Name'), 
('60',  'desc',  'Beschreibung');

INSERT INTO arabe (id, accion, texto) VALUES
('1', 'submit', 'إرسال'),
('2', 'reset', 'نظيف'),
('3', 'login', 'دخول'),
('4', 'user_name', 'المستخدم'),
('5', 'captcha', 'كلمة التحقق'),
('6', 'password', 'كلمة المرور');

INSERT INTO bengali (id, accion, texto) VALUES
('1', 'submit', 'পাঠান'),
('2', 'reset', 'পরিষ্কার'),
('3', 'login', 'লগইন'),
('4', 'user_name', 'ব্যবহারকারী'),
('5', 'captcha', 'ক্যাপচা'),
('6', 'password', 'পাসওয়ার্ড');

INSERT INTO catalan (id, accion, texto) VALUES
('1', 'submit', 'enviar'),
('2', 'reset', 'netejar'),
('3', 'login', 'entrar'),
('4', 'user_name', 'Usuari'),
('5', 'captcha', 'Captcha'),
('6', 'password', 'Contrasenya');

INSERT INTO chino (id, accion, texto) VALUES
('1', 'submit', '發送'),
('2', 'reset', '清潔'),
('3', 'login', '註冊'),
('4', 'user_name', '用戶'),
('5', 'captcha', '驗證碼'),
('6', 'password', '密碼');

INSERT INTO euskera (id, accion, texto) VALUES
('1', 'activacion_exitosa', 'El usuario se ha activado correctamente'),
('2', 'registro_exitoso', 'Gracias por registrarse'),
('3', 'error', 'Datos incorrectos'),
('4', 'ultima_visita', 'Última visita'),
('5', 'error_captcha', 'Captcha inválido'),
('6', 'agreement', 'Condiciones del registro'),
('7', 'register_msg', 'Por favor, rellene todos los campos'),
('8', 'user_name', 'Usuario'),
('9', 'password', 'Contraseña'),
('10', 'email', 'Correo'),
('11', 'submit', 'Enviar'),
('12', 'reset', 'Limpiar'),
('13', 'agreement_terms', 'Usted acepta que los administradores de este sitio web tienen la facultad de intentar eliminar o editar cualquier material que pudiera ser objeccionable en el tiempo más breve posible. Usted acepta que todos los mensajes publicados en este sitio expresan las opiniones y puntos de vista de sus autores, no son opiniones ni puntos de vista de los administradores, moderadores o webmasters (excepto aquellos mensajes creados expresamente por estas últimas personas) y por tanto, no pueden ser responsables de las opiniones publicadas por los visitantes.  <br/><br/>  Usted acepta no publicar ningún contenido abusivo, obsceno, vulgar, escandaloso, hiriente, amenazante, calumnioso, de contenido sexual o pornográfico o cualquier otro material que pueda violar las leyes vigentes. Usted acepta que al webmaster y administrador de este sitio les asiste el derecho de eliminar o editar cualquier tema en el momento que estime oportuno. Como usuario usted acepta que cualquier dato que usted nos facilite será almacenado en una base de datos. Esta información no será revelada a ningún tercero sin su consentimiento. El webmaster y el administrador no pueden ser responsables de los intentos de acceso o ataques que puedan poner sus datos en compromiso. <br /><br /> Este sistema utiliza cookies para almacenar información en su ordenador. Estos cookies no contienen informaciones personales, sirven únicamente para hacer más placentera su experiencia de navegación por este sitio. <br/><br/> Haciendo click en Estoy de acuerdo usted acepta todas estas condiciones.'),
('14', 'captcha', 'Captcha'),
('15', 'ok', 'Ok'),
('16', 'recordar', 'Recordar contraseña'),
('17', 'login', 'Entrar'),
('18', 'nota_email', 'El email será útil a la hora de recuperar tu contraseña'),
('19', 'nueva_pass', 'Nueva contraseña'),
('20', 'cambiar_pass', 'Cambiar contraseña'),
('21', 'cambio_pass_exitoso', 'La contraseña ha sido cambiada correctamente'),
('22', 'comments', 'Comentarios'),
('23', 'already_voted', 'Lo sentimos, usted ha calificado esta imagen recientemente'),
('24', 'no_comments', 'No hay comentarios para esta imagen'),
('25', 'comments_deactivated', 'Comentarios desactivados'),
('26', 'post_comment', 'Agregar comentario'),
('27', 'comment_success', 'Tu comentario se ha guardado'),
('28', 'download_error', 'Error de descarga'),
('29', 'register_download', 'Regístrese para descargar imágenes'),
('30', 'description', 'Descripción'),
('31', 'keywords', 'Palabras clave'),
('32', 'hits', 'Impactos'),
('33', 'downloads', 'Descargas'),
('34', 'rating', 'Puntuación'),
('35', 'votes', 'Votos'),
('36', 'author', 'Autor'),
('37',  'tipe',  'Tipo'),
('38', 'comment', 'Comentario'),
('39', 'added_by', 'Subido por '),
('40', 'allow_comments', 'Permitir comentarios'),
('41', 'exif_make', 'Fabricante'),
('42', 'exif_model', 'Modelo'),
('43', 'exif_datetime', 'Fecha de creación'),
('44', 'send_postcard', 'Mandar postal'),
('45', 'edit_postcard', 'Modificar postal'),
('46', 'bg_color', 'Color de fondo'),
('47', 'font_color', 'Color'),
('48', 'font_face', 'Tipo de letra'),
('49', 'recipient', 'Destinatario'),
('50', 'sender', 'Remitente'),
('51', 'send_postcard_success', '¡Muchas gracias! ¡Tu postal ha sido enviada!'),
('52', 'top_image_hits', 'Top 5 imágenes por visitas'),
('53', 'top_image_downloads', 'Top 5 imágenes por descargas'),
('54', 'top_image_rating', 'Top 5 imágenes por puntuación'),
('55', 'top_image_votes', 'Top 5 imágenes por votos'),
('56', 'upload_success', 'Los archivos se han subido correctamente'),
('57', 'nombre_subida_multiple', 'Nombre de la imagen o imágenes'),
('58', 'insertar_categoria', 'Seleccione la categoría'),
('59',  'name',  'Nombre'), 
('60',  'desc',  'Descripción');

INSERT INTO frances (id, accion, texto) VALUES
('1', 'activacion_exitosa', 'Le utilisateur a activé avec succès'),
('2', 'registro_exitoso', 'Merci de vous inscrire'),
('3', 'error', 'Données incorrectes'),
('4', 'ultima_visita', 'Dernière visite'),
('5', 'error_captcha', 'Captcha invalide'),
('6', 'agreement', 'Conditions de inscription'),
('7', 'register_msg', 'Sil vous plaît, remplissez tous les champs'),
('8', 'user_name', 'Utilisateur'),
('9', 'password', 'Mot de passe'),
('10', 'email', 'Mail'),
('11', 'submit', 'Envoyer'),
('12', 'reset', 'Nettoyer'),
('13', 'agreement_terms', 'Vous acceptez que les administrateurs de ce site Web aient le pouvoir de essayer de supprimer ou de éditer tout matériel qui pourrait être répréhensible dans les plus brefs délais. Vous acceptez que tous les messages publiés sur ce site expriment les opinions et les points de vue de leurs auteurs, ne sont pas des opinions ni des vues de administrateurs, de modérateurs ou de webmasters (à la exception des messages créés expressément par ces dernières personnes) et, par conséquent, Ils ne peuvent être tenus responsables des opinions publiées par les visiteurs. <br/> <br/> Vous acceptez de ne publier aucun contenu abusif, obscène, vulgaire, scandaleux, blessant, menaçant, diffamatoire, sexuel ou pornographique ou tout autre matériel qui pourrait violer les lois en vigueur. Vous acceptez que le webmaster et le administrateur de ce site aient le droit de supprimer ou de modifier ne importe quel sujet au moment que vous jugerez utile. En tant que utilisateur, vous acceptez que toutes les données que vous fournissez soient stockées dans une base de données. Ces informations ne seront divulguées à aucune tierce partie sans votre consentement. Le webmaster et le administrateur ne peuvent être tenus responsables des tentatives de accès ou des attaques susceptibles de compromettre leurs données. <br /> <br /> Ce système utilise des cookies pour stocker des informations sur votre ordinateur. Ces cookies ne contiennent pas de informations personnelles, ils servent uniquement à rendre votre expérience de navigation sur ce site plus agréable. <br/> <br/> En cliquant sur Je accepte, vous acceptez toutes ces conditions.'),
('14', 'captcha', 'Captcha'),
('15', 'ok', 'Ok'),
('16', 'recordar', 'Mémoriser le mot de passe'),
('17', 'login', 'Entrer'),
('18', 'nota_email', 'Le e-mail sera utile pour récupérer votre mot de passe'),
('19', 'nueva_pass', 'Nouveau mot de passe'),
('20', 'cambiar_pass', 'Changer le mot de passe'),
('21', 'cambio_pass_exitoso', 'Le mot de passe a été changé correctement'),
('22', 'comments', 'Commentaires'),
('23', 'already_voted', 'Nous sommes désolés, vous avez récemment noté cette image.'),
('24', 'no_comments', 'Il ne y a pas de commentaires pour cette image'),
('25', 'comments_deactivated', 'Commentaires fermés'),
('26', 'post_comment', 'Ajouter un commentaire'),
('27', 'comment_success', 'Votre commentaire a été enregistré'),
('28', 'download_error', 'Erreur de téléchargement'),
('29', 'register_download', 'Inscrivez-vous pour télécharger des images'),
('30', 'description', 'Description'),
('31', 'keywords', 'Mots-clés'),
('32', 'hits', 'Les impacts'),
('33', 'downloads', 'Téléchargements'),
('34', 'rating', 'Score'),
('35', 'votes', 'Votes'),
('36', 'author', 'Auteur'),
('37',  'tipe',  'Type'),
('38', 'comment', 'Commentaire'),
('39', 'added_by', 'Téléchargé par '),
('40', 'allow_comments', 'Autoriser les commentaires'),
('41', 'exif_make', 'Fabricant'),
('42', 'exif_model', 'Modèle'),
('43', 'exif_datetime', 'Date de creation'),
('44', 'send_postcard', 'Envoyer une carte postale'),
('45', 'edit_postcard', 'Modifier la carte postale'),
('46', 'bg_color', 'Couleur de fond'),
('47', 'font_color', 'Couleur'),
('48', 'font_face', 'Police de caractères'),
('49', 'recipient', 'Destinataire'),
('50', 'sender', 'Expéditeur'),
('51', 'send_postcard_success', 'Merci beaucoup! Votre carte postale a été envoyée!'),
('52', 'top_image_hits', 'Top 5 des images par visite'),
('53', 'top_image_downloads', 'Top 5 des images à télécharger'),
('54', 'top_image_rating', 'Top 5 des images par score'),
('55', 'top_image_votes', 'Top 5 des images par votes'),
('56', 'upload_success', 'Les fichiers ont été téléchargés correctement'),
('57', 'nombre_subida_multiple', 'Nom de la image ou des images'),
('58', 'insertar_categoria', 'Sélectionnez la catégorie'),
('59',  'name',  'Nom'), 
('60',  'desc',  'Description');

INSERT INTO hindu (id, accion, texto) VALUES
('1', 'activacion_exitosa', 'उपयोगकर्ता सफलतापूर्वक सक्रिय हो गया है'),
('2', 'registro_exitoso', 'पंजीकरण के लिए धन्यवाद'),
('3', 'error', 'गलत डेटा'),
('4', 'ultima_visita', 'अंतिम यात्रा'),
('5', 'error_captcha', 'कैप्चा अमान्य है'),
('6', 'agreement', 'पंजीकरण की स्थिति'),
('7', 'register_msg', 'कृपया, सभी फ़ील्ड भरें'),
('8', 'user_name', 'उपयोगकर्ता'),
('9', 'password', 'पासवर्ड'),
('10', 'email', 'मेल'),
('11', 'submit', 'भेजना'),
('12', 'reset', 'स्वच्छ'),
('13', 'agreement_terms', 'आप इस बात से सहमत हैं कि इस वेबसाइट के व्यवस्थापकों के पास किसी भी सामग्री को हटाने या संपादित करने का प्रयास करने की शक्ति है जो कम से कम समय में आपत्तिजनक हो सकती है। आप सहमत हैं कि इस साइट पर प्रकाशित सभी संदेश उनके लेखकों के विचारों और विचारों को व्यक्त करते हैं, प्रशासकों, मध्यस्थों या वेबमास्टरों की राय या विचार नहीं हैं (इन अंतिम व्यक्तियों द्वारा स्पष्ट रूप से बनाए गए संदेशों को छोड़कर) और इसलिए, वे आगंतुकों द्वारा प्रकाशित राय के लिए जिम्मेदार नहीं हो सकते। <br/> <br/> आप किसी भी अपमानजनक, अश्लील, अश्लील, निंदनीय, आहत करने वाली, धमकी देने वाली, अपमानजनक, यौन या अश्लील सामग्री या किसी अन्य सामग्री को प्रकाशित नहीं करने के लिए सहमत हैं जो कानूनों का उल्लंघन हो। आप इस बात से सहमत हैं कि इस साइट के वेबमास्टर और एडमिनिस्ट्रेटर के पास किसी भी विषय को हटाने और संपादित करने का अधिकार है, जब आप उपयुक्त हों। एक उपयोगकर्ता के रूप में आप स्वीकार करते हैं कि आपके द्वारा प्रदान किया गया कोई भी डेटा एक डेटाबेस में संग्रहीत किया जाएगा। यह जानकारी आपकी सहमति के बिना किसी भी तीसरे पक्ष को नहीं दी जाएगी। वेबमास्टर और व्यवस्थापक एक्सेस प्रयासों या हमलों के लिए जिम्मेदार नहीं हो सकते हैं जो उनके डेटा से समझौता कर सकते हैं। <br /> <br /> यह सिस्टम आपके कंप्यूटर पर जानकारी संग्रहीत करने के लिए कुकीज़ का उपयोग करता है। इन कुकीज़ में व्यक्तिगत जानकारी नहीं होती है, वे केवल इस साइट पर आपके ब्राउज़िंग अनुभव को अधिक सुखद बनाने के लिए कार्य करते हैं। <br/> <br/> I सहमति पर क्लिक करके आप इन सभी शर्तों को स्वीकार करते हैं।'),
('14', 'captcha', 'कैप्चा'),
('15', 'ok', 'ठीक है'),
('16', 'recordar', 'पासवर्ड याद रखें'),
('17', 'login', 'दर्ज'),
('18', 'nota_email', 'आपके पासवर्ड को पुनर्प्राप्त करने के लिए ईमेल उपयोगी होगा'),
('19', 'nueva_pass', 'नया पासवर्ड'),
('20', 'cambiar_pass', 'पासवर्ड बदलें'),
('21', 'cambio_pass_exitoso', 'पासवर्ड सही ढंग से बदल दिया गया है'),
('22', 'comments', 'टिप्पणियाँ'),
('23', 'already_voted', 'हमें खेद है, आपने हाल ही में इस छवि का मूल्यांकन किया है'),
('24', 'no_comments', 'इस छवि के लिए कोई टिप्पणी नहीं है'),
('25', 'comments_deactivated', 'टिप्पणियाँ बंद'),
('26', 'post_comment', 'टिप्पणी जोड़ें'),
('27', 'comment_success', 'आपकी टिप्पणी सहेज ली गई है'),
('28', 'download_error', 'डाउनलोड त्रुटि'),
('29', 'register_download', 'छवियों को डाउनलोड करने के लिए पंजीकरण करें'),
('30', 'description', 'विवरण'),
('31', 'keywords', 'कीवर्ड'),
('32', 'hits', 'प्रभावों'),
('33', 'downloads', 'डाउनलोड'),
('34', 'rating', 'स्कोर'),
('35', 'votes', 'वोट'),
('36', 'author', 'लेखक'),
('37',  'tipe',  'टाइप'),
('38', 'comment', 'टिप्पणी'),
('39', 'added_by', 'द्वारा अपलोड किया गया '),
('40', 'allow_comments', 'टिप्पणियों की अनुमति दें'),
('41', 'exif_make', 'उत्पादक'),
('42', 'exif_model', 'आदर्श'),
('43', 'exif_datetime', 'निर्माण की तिथि'),
('44', 'send_postcard', 'पोस्टकार्ड भेजें'),
('45', 'edit_postcard', 'पोस्टकार्ड को संशोधित करें'),
('46', 'bg_color', 'पृष्ठभूमि का रंग'),
('47', 'font_color', 'रंग'),
('48', 'font_face', 'फ़ॉन्ट'),
('49', 'recipient', 'पत्र पानेवाला'),
('50', 'sender', 'प्रेषक'),
('51', 'send_postcard_success', 'धन्यवाद! आपका पोस्टकार्ड भेज दिया गया है!'),
('52', 'top_image_hits', 'शीर्ष 5 चित्र प्रति विज़िट'),
('53', 'top_image_downloads', 'डाउनलोड के लिए शीर्ष 5 चित्र'),
('54', 'top_image_rating', 'स्कोर द्वारा शीर्ष 5 चित्र'),
('55', 'top_image_votes', 'वोटों से शीर्ष 5 चित्र'),
('56', 'upload_success', 'फाइलों को सही तरीके से अपलोड किया गया है'),
('57', 'nombre_subida_multiple', 'छवि या छवियों का नाम'),
('58', 'insertar_categoria', 'श्रेणी का चयन करें'),
('59',  'name',  'नाम'), 
('60',  'desc',  'विवरण');

INSERT INTO ingles (id, accion, texto) VALUES
('1', 'activacion_exitosa', 'The user has successfully activated'),
('2', 'registro_exitoso', 'Thank you for registering'),
('3', 'error', 'Incorrect data'),
('4', 'ultima_visita', 'Last visit'),
('5', 'error_captcha', 'Captcha invalid'),
('6', 'agreement', 'Registration conditions'),
('7', 'register_msg', 'Please, fill in all the fields.'),
('8', 'user_name', 'User'),
('9', 'password', 'Password'),
('10', 'email', 'Email'),
('11', 'submit', 'Submit'),
('12', 'reset', 'Clean'),
('13', 'agreement_terms', 'You agree that the administrators of this website have the power to attempt to remove or edit any material that may be objectionable in the shortest possible time. You agree that all messages published on this site express the opinions and views of their authors, are not opinions or views of administrators, moderators or webmasters (except those messages created expressly by these last persons) and therefore, They can not be responsible for the opinions published by the visitors. <br/> <br/> You agree not to publish any abusive, obscene, vulgar, scandalous, hurtful, threatening, libelous, sexual or pornographic content or any other material that may violate the laws in force. You agree that the webmaster and administrator of this site have the right to delete or edit any topic at the time you deem appropriate. As a user you accept that any data you provide will be stored in a database. This information will not be disclosed to any third party without your consent. The webmaster and the administrator can not be responsible for access attempts or attacks that may compromise their data. <br /> <br /> This system uses cookies to store information on your computer. These cookies do not contain personal information, they only serve to make your browsing experience on this site more pleasant. <br/> <br/> By clicking on I agree you accept all these conditions.'),
('14', 'captcha', 'Captcha'),
('15', 'ok', 'Ok'),
('16', 'recordar', 'Remember password'),
('17', 'login', 'Get in'),
('18', 'nota_email', 'The email will be useful when it comes to recovering your password'),
('19', 'nueva_pass', 'New Password'),
('20', 'cambiar_pass', 'Change Password'),
('21', 'cambio_pass_exitoso', 'The password has been changed correctly'),
('22', 'comments', 'Comments'),
('23', 'already_voted', 'Sorry, you\'ve already rated for this image once recently'),
('24', 'no_comments', 'There are no comments for this image'),
('25', 'comments_deactivated', 'Comment deactivated!'),
('26', 'post_comment', 'Post comment'),
('27', 'comment_success', 'Your comment has been saved'),
('28', 'download_error', 'Download error'),
('29', 'register_download', 'Please register to download images'),
('30', 'description', 'Description'),
('31', 'keywords', 'Keywords'),
('32', 'hits', 'Hits'),
('33', 'downloads', 'Downloads'),
('34', 'rating', 'Rating'),
('35', 'votes', 'Vote(s)'),
('36', 'author', 'Author'),
('37',  'tipe',  'Type'),
('38', 'comment', 'Comment'),
('39', 'added_by', 'Added by'),
('40', 'allow_comments', 'Allow comments'),
('41', 'exif_make', 'Make'),
('42', 'exif_model', 'Model'),
('43', 'exif_datetime', 'Date created'),
('44', 'send_postcard', 'Send eCard'),
('45', 'edit_postcard', 'Modify eCard'),
('46', 'bg_color', 'Background Color'),
('47', 'font_color', 'Font Color'),
('48', 'font_face', 'Font Face'),
('49', 'recipient', 'Recipient'),
('50', 'sender', 'Sender'),
('51', 'send_postcard_success', 'Thank you! Your email has been sent!'),
('52', 'top_image_hits', 'Top 5 images by visits'),
('53', 'top_image_downloads', 'Top 5 images by downloads'),
('54', 'top_image_rating', 'Top 5 images by score'),
('55', 'top_image_votes', 'Top 5 imágenes by votes'),
('56', 'upload_success', 'The files have been uploaded correctly'),
('57', 'nombre_subida_multiple', 'Name of the image or images'),
('58', 'insertar_categoria', 'Select the category'),
('59',  'name',  'Name'), 
('60',  'desc',  'Description');


INSERT INTO italiano (id, accion, texto) VALUES
('1', 'activacion_exitosa', 'Le utente si è attivato con successo'),
('2', 'registro_exitoso', 'Grazie per esserti registrato'),
('3', 'error', 'Dati errati'),
('4', 'ultima_visita', 'Ultima visita'),
('5', 'error_captcha', 'Captcha non valido'),
('6', 'agreement', 'Condizioni di registrazione'),
('7', 'register_msg', 'Per favore, compila tutti i campi'),
('8', 'user_name', 'utente'),
('9', 'password', 'password'),
('10', 'email', 'posta'),
('11', 'submit', 'inviare'),
('12', 'reset', 'pulito'),
('13', 'agreement_terms', 'Accetti che gli amministratori di questo sito web abbiano il potere di tentare di rimuovere o modificare qualsiasi materiale che possa essere contestabile nel più breve tempo possibile. Accetti che tutti i messaggi pubblicati su questo sito esprimano opinioni e opinioni dei loro autori, non siano opinioni o opinioni di amministratori, moderatori o webmaster (ad eccezione di quelli creati espressamente da queste ultime persone) e quindi, Non possono essere responsabili per le opinioni pubblicate dai visitatori. <br/> <br/> Accetti di non pubblicare alcun contenuto abusivo, osceno, volgare, scandaloso, offensivo, minaccioso, diffamatorio, sessuale o pornografico o qualsiasi altro materiale che possa violare le leggi in vigore. Accetti che il webmaster e l'amministratore di questo sito abbiano il diritto di eliminare o modificare qualsiasi argomento nel momento in cui lo ritieni opportuno. Come utente, accetti che tutti i dati che fornisci vengano archiviati in un database. Queste informazioni non saranno divulgate a terze parti senza il tuo consenso. Il webmaster e l'amministratore non possono essere responsabili per tentativi di accesso o attacchi che potrebbero compromettere i loro dati. <br /> <br /> Questo sistema utilizza i cookie per memorizzare le informazioni sul tuo computer. Questi cookie non contengono informazioni personali, servono solo a rendere più piacevole la tua esperienza di navigazione su questo sito. <br/> <br/> Cliccando su Accetto accetti tutte queste condizioni.'),
('14', 'captcha', 'Captcha'),
('15', 'ok', 'bene'),
('16', 'recordar', 'Ricorda la password'),
('17', 'login', 'Entrare'),
('18', 'nota_email', 'Le email sarà utile quando si tratta di recuperare la password'),
('19', 'nueva_pass', 'Nuova password'),
('20', 'cambiar_pass', 'Cambia password'),
('21', 'cambio_pass_exitoso', 'La password è stata cambiata correttamente'),
('22', 'comments', 'commenti'),
('23', 'already_voted', 'Siamo spiacenti, hai valutato questa immagine di recente'),
('24', 'no_comments', 'Non ci sono commenti per questa immagine'),
('25', 'comments_deactivated', 'Commenti disabilitati'),
('26', 'post_comment', 'Aggiungi commento'),
('27', 'comment_success', 'Il tuo commento è stato salvato'),
('28', 'download_error', 'Scarica errore'),
('29', 'register_download', 'Registrati per scaricare le immagini'),
('30', 'description', 'descrizione'),
('31', 'keywords', 'parole chiave'),
('32', 'hits', 'impatti'),
('33', 'downloads', 'download'),
('34', 'rating', 'punteggio'),
('35', 'votes', 'voti'),
('36', 'author', 'autore'),
('37',  'tipe',  'tipo'),
('38', 'comment', 'commento'),
('39', 'added_by', 'Caricato da '),
('40', 'allow_comments', 'Consenti commenti'),
('41', 'exif_make', 'Fabbricante'),
('42', 'exif_model', 'Modello'),
('43', 'exif_datetime', 'Data di creazione'),
('44', 'send_postcard', 'Invia cartolina'),
('45', 'edit_postcard', 'Modifica cartolina'),
('46', 'bg_color', 'Colore di sfondo'),
('47', 'font_color', 'colore'),
('48', 'font_face', 'font'),
('49', 'recipient', 'destinatario'),
('50', 'sender', 'mittente'),
('51', 'send_postcard_success', 'Grazie! La tua cartolina è stata inviata!'),
('52', 'top_image_hits', 'Prime 5 immagini per visita'),
('53', 'top_image_downloads', 'Le 5 immagini migliori per i download'),
('54', 'top_image_rating', 'Le 5 migliori immagini per punteggio'),
('55', 'top_image_votes', 'Le 5 immagini migliori per voti'),
('56', 'upload_success', 'I file sono stati caricati correttamente'),
('57', 'nombre_subida_multiple', 'Nome del le immagine o delle immagini'),
('58', 'insertar_categoria', 'Seleziona la categoria'),
('59',  'name',  'nome'), 
('60',  'desc',  'descrizione');

INSERT INTO japones (id, accion, texto) VALUES
('1', 'activacion_exitosa', 'ユーザーは正常にアクティブ化されました'),
('2', 'registro_exitoso', 'ご登録ありがとうございます'),
('3', 'error', '誤ったデータ'),
('4', 'ultima_visita', '最後の訪問'),
('5', 'error_captcha', 'キャプチャが無効です'),
('6', 'agreement', '登録条件'),
('7', 'register_msg', 'すべての欄に記入してください'),
('8', 'user_name', 'ユーザー'),
('9', 'password', 'パスワード'),
('10', 'email', 'メール'),
('11', 'submit', '送る'),
('12', 'reset', 'きれいな'),
('13', 'agreement_terms', 'あなたは、このウェブサイトの管理者が可能な限り最短時間で好ましくないと思われる素材を削除または編集しようとする権限を有することに同意します。あなたは、このサイトに掲載されたすべてのメッセージが作成者の意見や見解を表すものであり、管理者、モデレータ、またはウェブマスターの意見や見解ではないことに同意します。彼らは訪問者によって公表された意見について責任を負うことはできません。 <br/> <br/>あなたは、虐待的、わいせつ、下品、スキャンダル、有害、脅迫的、猥褻、性的、またはポルノのコンテンツ、または現行の法律に違反する可能性のある他のいかなる資料も公開しないことに同意します。あなたは、あなたが適切と判断したときに、このサイトのウェブマスターと管理者がトピックを削除または編集する権利を有することに同意します。ユーザーとして、あなたはあなたが提供するデータがデータベースに保存されることに同意します。この情報は、あなたの同意なしに第三者に開示されることはありません。ウェブマスターと管理者は、自分のデータを危険にさらす可能性のあるアクセスの試みや攻撃に対して責任を負うことはできません。 <br /> <br />このシステムはクッキーを使ってあなたのコンピュータに情報を保存します。これらのクッキーには個人情報は含まれていません。このサイトでの閲覧をより快適にするためのものです。 <br/> <br/>私はクリックすることであなたはこれらすべての条件に同意しますと同意します。'),
('14', 'captcha', 'キャプチャ'),
('15', 'ok', 'わかりました'),
('16', 'recordar', 'パスワードを忘れない'),
('17', 'login', '入ります'),
('18', 'nota_email', 'それはあなたのパスワードを回復することになると電子メールが便利になります'),
('19', 'nueva_pass', '新しいパスワード'),
('20', 'cambiar_pass', 'パスワード変更'),
('21', 'cambio_pass_exitoso', 'パスワードが正しく変更されました'),
('22', 'comments', 'コメント'),
('23', 'already_voted', '申し訳ありませんが、最近この画像を評価しました'),
('24', 'no_comments', 'この画像にコメントはありません'),
('25', 'comments_deactivated', 'コメントオフ'),
('26', 'post_comment', 'コメントを追加'),
('27', 'comment_success', 'あなたのコメントは保存されました'),
('28', 'download_error', 'ダウンロードエラー'),
('29', 'register_download', '画像をダウンロードするために登録'),
('30', 'description', '説明'),
('31', 'keywords', 'キーワード'),
('32', 'hits', '影響'),
('33', 'downloads', 'ダウンロード'),
('34', 'rating', '得点'),
('35', 'votes', '投票'),
('36', 'author', '作者'),
('37',  'tipe',  'タイプ'),
('38', 'comment', 'コメント'),
('39', 'added_by', 'アップロード者 '),
('40', 'allow_comments', 'コメントを許可する」'),
('41', 'exif_make', 'メーカー'),
('42', 'exif_model', 'モデル'),
('43', 'exif_datetime', '作成日'),
('44', 'send_postcard', 'はがきを送る'),
('45', 'edit_postcard', 'はがきを修正'),
('46', 'bg_color', '背景色'),
('47', 'font_color', '色'),
('48', 'font_face', '書体'),
('49', 'recipient', '受取人'),
('50', 'sender', '送信者'),
('51', 'send_postcard_success', 'ありがとうございます。あなたのはがきが送られました！'),
('52', 'top_image_hits', '1回の訪問あたりのトップ5画像'),
('53', 'top_image_downloads', 'ダウンロード用のトップ5画像'),
('54', 'top_image_rating', 'スコア別トップ5画像'),
('55', 'top_image_votes', '投票によるトップ5画像'),
('56', 'upload_success', 'ファイルは正しくアップロードされました'),
('57', 'nombre_subida_multiple', '画像の名前'),
('58', 'insertar_categoria', 'カテゴリーを選択'),
('59',  'name',  'お名前'), 
('60',  'desc',  '説明');

INSERT INTO portuges (id, accion, texto) VALUES
('1', 'activacion_exitosa', 'O usuário foi ativado com sucesso'),
('2', 'registro_exitoso', 'Obrigado por se registrar'),
('3', 'error', 'Dados incorretos'),
('4', 'ultima_visita', 'Última visita'),
('5', 'error_captcha', 'Captcha inválido'),
('6', 'agreement', 'Condições de registro'),
('7', 'register_msg', 'Por favor, preencha todos os campos'),
('8', 'user_name', 'Usuário'),
('9', 'password', 'Senha'),
('10', 'email', 'Mail'),
('11', 'submit', 'Enviar'),
('12', 'reset', 'Limpo'),
('13', 'agreement_terms', 'Você concorda que os administradores deste site tem o poder para tentar remover ou editar qualquer material que possa ser censurável no menor tempo possível. Você reconhece que todas as mensagens colocadas nos fóruns expressam os pontos de vista e as opiniões de seus autores, não são opiniões ou pontos de vista dos administradores, moderadores ou webmaster (exceto aquelas mensagens criadas especificamente por essas pessoas) e, portanto, Eles não podem ser responsáveis ​​pelas opiniões publicadas pelos visitantes. <br/> Você concorda em não postar qualquer conteúdo abusivo, obsceno, vulgar, insultuosa, de ódio, ameaçadora, difamatória, sexual ou pornográfico ou qualquer outro material que possa violar qualquer lei aplicável. Você concorda que o webmaster e administrador do site que eles têm o direito de remover ou editar qualquer tópico no momento que julgar conveniente. Como usuário, você aceita que quaisquer dados que você fornecer serão armazenados em um banco de dados. Esta informação não será divulgada a terceiros sem o seu consentimento. O webmaster e o administrador não podem ser responsabilizados por tentativas de acesso ou ataques que possam comprometer seus dados. <br /> <br /> Este sistema usa cookies para armazenar informações no seu computador. Estes cookies não contêm informações pessoais, servem apenas para tornar mais agradável a sua experiência de navegação neste site. <br/> <br/> Ao clicar em Concordo, você aceita todas essas condições.'),
('14', 'captcha', 'Captcha'),
('15', 'ok', 'Ok'),
('16', 'recordar', 'Lembrar senha'),
('17', 'login', 'Enter'),
('18', 'nota_email', 'O email será útil quando se trata de recuperar sua senha'),
('19', 'nueva_pass', 'Nova senha'),
('20', 'cambiar_pass', 'Alterar senha'),
('21', 'cambio_pass_exitoso', 'A senha foi alterada corretamente'),
('22', 'comments', 'Comentários'),
('23', 'already_voted', 'Desculpe, você avaliou esta imagem recentemente'),
('24', 'no_comments', 'Não há comentários para esta imagem'),
('25', 'comments_deactivated', 'Comentários desativados'),
('26', 'post_comment', 'Adicionar comentário'),
('27', 'comment_success', 'Seu comentário foi salvo'),
('28', 'download_error', 'Erro de download'),
('29', 'register_download', 'Registre-se para baixar imagens'),
('30', 'description', 'Descrição'),
('31', 'keywords', 'Palavras chave'),
('32', 'hits', 'Impactos'),
('33', 'downloads', 'Downloads'),
('34', 'rating', 'Pontuação'),
('35', 'votes', 'Votos'),
('36', 'author', 'Autor'),
('37',  'tipe',  'Digite'),
('38', 'comment', 'Comentário'),
('39', 'added_by', 'Carregado por '),
('40', 'allow_comments', 'Permitir comentários'),
('41', 'exif_make', 'Fabricante'),
('42', 'exif_model', 'Modelo'),
('43', 'exif_datetime', 'Data de criação'),
('44', 'send_postcard', 'Enviar cartão postal'),
('45', 'edit_postcard', 'Modificar cartão postal'),
('46', 'bg_color', 'Cor de fundo'),
('47', 'font_color', 'Cor'),
('48', 'font_face', 'Tipo de letra'),
('49', 'recipient', 'Destinatário'),
('50', 'sender', 'Remetente'),
('51', 'send_postcard_success', 'Obrigado! Seu cartão postal foi enviado!'),
('52', 'top_image_hits', 'Top 5 imagens por visitas'),
('53', 'top_image_downloads', 'Top 5 imagens para downloads'),
('54', 'top_image_rating', 'Top 5 imagens por pontuação'),
('55', 'top_image_votes', 'Top 5 imagens por votos'),
('56', 'upload_success', 'Os arquivos foram enviados corretamente'),
('57', 'nombre_subida_multiple', 'Nome da imagem ou imagens'),
('58', 'insertar_categoria', 'Selecione a categoria'),
('59',  'name',  'Nome'), 
('60',  'desc',  'Descrição');

INSERT INTO ruso (id, accion, texto) VALUES
('1', 'activacion_exitosa', 'Пользователь успешно активирован'),
('2', 'registro_exitoso', 'Спасибо за регистрацию'),
('3', 'error', 'Неверные данные'),
('4', 'ultima_visita', 'Последнее посещение'),
('5', 'error_captcha', 'Неверный код'),
('6', 'agreement', 'Условия регистрации'),
('7', 'register_msg', 'Пожалуйста, заполните все поля'),
('8', 'user_name', 'пользователь'),
('9', 'password', 'пароль'),
('10', 'email', 'почта'),
('11', 'submit', 'послать'),
('12', 'reset', 'чистый'),
('13', 'agreement_terms', 'Вы соглашаетесь с тем, что администраторы этого веб-сайта имеют право попытаться удалить или отредактировать любой материал, который может быть нежелательным, в кратчайшие сроки. Вы соглашаетесь с тем, что все сообщения, опубликованные на этом сайте, выражают мнения и взгляды их авторов, не являются мнениями или мнениями администраторов, модераторов или веб-мастеров (за исключением сообщений, созданных явно этими последними лицами), и, следовательно, Они не могут нести ответственность за мнения, опубликованные посетителями. <br/> Вы соглашаетесь не размещать оскорбительное, непристойное, вульгарное, клеветническое, угрожающее, клеветническое, сексуальное или порнографическое содержание или любой другой материал, который может нарушить любые применимые законы. Вы соглашаетесь с тем, что веб-мастер и администратор этого сайта имеют право удалять или редактировать любую тему в то время, когда вы считаете это целесообразным. Как пользователь, вы соглашаетесь с тем, что любые предоставленные вами данные будут храниться в базе данных. Эта информация не будет открыта третьим лицам без вашего согласия. Веб-мастер и администратор не могут нести ответственность за попытки доступа или атаки, которые могут поставить под угрозу их данные. <br /> <br /> Эта система использует куки для хранения информации на вашем компьютере. Эти файлы cookie не содержат личной информации, они служат только для того, чтобы сделать ваш просмотр на этом сайте более приятным. <br/> <br/> Нажав кнопку «Я согласен», вы принимаете все эти условия.'),
('14', 'captcha', 'Защитный код'),
('15', 'ok', 'Ok'),
('16', 'recordar', 'Запомнить пароль'),
('17', 'login', 'входить'),
('18', 'nota_email', 'Электронная почта будет полезна при восстановлении пароля'),
('19', 'nueva_pass', 'Новый пароль'),
('20', 'cambiar_pass', 'Сменить пароль'),
('21', 'cambio_pass_exitoso', 'Пароль был изменен правильно'),
('22', 'comments', 'комментарии'),
('23', 'already_voted', 'К сожалению, вы недавно оценили это изображение'),
('24', 'no_comments', 'Там нет комментариев к этому изображению'),
('25', 'comments_deactivated', 'Комментарии отключены'),
('26', 'post_comment', 'Добавить комментарий'),
('27', 'comment_success', 'Ваш комментарий был сохранен'),
('28', 'download_error', 'Ошибка загрузки'),
('29', 'register_download', 'Зарегистрируйтесь, чтобы загрузить изображения'),
('30', 'description', 'описание'),
('31', 'keywords', 'ключевые слова'),
('32', 'hits', 'воздействие'),
('33', 'downloads', 'загрузок'),
('34', 'rating', 'счет'),
('35', 'votes', 'голосов'),
('36', 'author', 'автор'),
('37',  'tipe',  'тип'),
('38', 'comment', 'комментарий'),
('39', 'added_by', 'Загружено пользователем '),
('40', 'allow_comments', 'Разрешить комментарии'),
('41', 'exif_make', 'производитель'),
('42', 'exif_model', 'модель'),
('43', 'exif_datetime', 'Дата создания'),
('44', 'send_postcard', 'Отправить открытку'),
('45', 'edit_postcard', 'Изменить открытку'),
('46', 'bg_color', 'Цвет фона'),
('47', 'font_color', 'цвет'),
('48', 'font_face', 'шрифт'),
('49', 'recipient', 'адресат'),
('50', 'sender', 'отправитель'),
('51', 'send_postcard_success', 'Спасибо Ваша открытка была отправлена!'),
('52', 'top_image_hits', 'Топ 5 изображений за посещения'),
('53', 'top_image_downloads', 'Топ 5 изображений для скачивания'),
('54', 'top_image_rating', 'Лучшие 5 изображений по счету'),
('55', 'top_image_votes', 'Топ 5 изображений по голосам'),
('56', 'upload_success', 'Файлы были загружены правильно'),
('57', 'nombre_subida_multiple', 'Название изображения или изображений'),
('58', 'insertar_categoria', 'Выберите категорию'),
('59',  'name',  'имя'), 
('60',  'desc',  'описание');

INSERT INTO spanish (id, accion, texto) VALUES
('1', 'activacion_exitosa', 'El usuario se ha activado correctamente'),
('2', 'registro_exitoso', 'Gracias por registrarse'),
('3', 'error', 'Datos incorrectos'),
('4', 'ultima_visita', 'Última visita'),
('5', 'error_captcha', 'Captcha inválido'),
('6', 'agreement', 'Condiciones del registro'),
('7', 'register_msg', 'Por favor, rellene todos los campos'),
('8', 'user_name', 'Usuario'),
('9', 'password', 'Contraseña'),
('10', 'email', 'Correo'),
('11', 'submit', 'Enviar'),
('12', 'reset', 'Limpiar'),
('13', 'agreement_terms', 'Usted acepta que los administradores de este sitio web tienen la facultad de intentar eliminar o editar cualquier material que pudiera ser objeccionable en el tiempo más breve posible. Usted acepta que todos los mensajes publicados en este sitio expresan las opiniones y puntos de vista de sus autores, no son opiniones ni puntos de vista de los administradores, moderadores o webmasters (excepto aquellos mensajes creados expresamente por estas últimas personas) y por tanto, no pueden ser responsables de las opiniones publicadas por los visitantes.  <br/><br/>  Usted acepta no publicar ningún contenido abusivo, obsceno, vulgar, escandaloso, hiriente, amenazante, calumnioso, de contenido sexual o pornográfico o cualquier otro material que pueda violar las leyes vigentes. Usted acepta que al webmaster y administrador de este sitio les asiste el derecho de eliminar o editar cualquier tema en el momento que estime oportuno. Como usuario usted acepta que cualquier dato que usted nos facilite será almacenado en una base de datos. Esta información no será revelada a ningún tercero sin su consentimiento. El webmaster y el administrador no pueden ser responsables de los intentos de acceso o ataques que puedan poner sus datos en compromiso. <br /><br /> Este sistema utiliza cookies para almacenar información en su ordenador. Estos cookies no contienen informaciones personales, sirven únicamente para hacer más placentera su experiencia de navegación por este sitio. <br/><br/> Haciendo click en Estoy de acuerdo usted acepta todas estas condiciones.'),
('14', 'captcha', 'Captcha'),
('15', 'ok', 'Ok'),
('16', 'recordar', 'Recordar contraseña'),
('17', 'login', 'Entrar'),
('18', 'nota_email', 'El email será útil a la hora de recuperar tu contraseña'),
('19', 'nueva_pass', 'Nueva contraseña'),
('20', 'cambiar_pass', 'Cambiar contraseña'),
('21', 'cambio_pass_exitoso', 'La contraseña ha sido cambiada correctamente'),
('22', 'comments', 'Comentarios'),
('23', 'already_voted', 'Lo sentimos, usted ha calificado esta imagen recientemente'),
('24', 'no_comments', 'No hay comentarios para esta imagen'),
('25', 'comments_deactivated', 'Comentarios desactivados'),
('26', 'post_comment', 'Agregar comentario'),
('27', 'comment_success', 'Tu comentario se ha guardado'),
('28', 'download_error', 'Error de descarga'),
('29', 'register_download', 'Regístrese para descargar imágenes'),
('30', 'description', 'Descripción'),
('31', 'keywords', 'Palabras clave'),
('32', 'hits', 'Impactos'),
('33', 'downloads', 'Descargas'),
('34', 'rating', 'Puntuación'),
('35', 'votes', 'Votos'),
('36', 'author', 'Autor'),
('37',  'tipe',  'Tipo'),
('38', 'comment', 'Comentario'),
('39', 'added_by', 'Subido por '),
('40', 'allow_comments', 'Permitir comentarios'),
('41', 'exif_make', 'Fabricante'),
('42', 'exif_model', 'Modelo'),
('43', 'exif_datetime', 'Fecha de creación'),
('44', 'send_postcard', 'Mandar postal'),
('45', 'edit_postcard', 'Modificar postal'),
('46', 'bg_color', 'Color de fondo'),
('47', 'font_color', 'Color'),
('48', 'font_face', 'Tipo de letra'),
('49', 'recipient', 'Destinatario'),
('50', 'sender', 'Remitente'),
('51', 'send_postcard_success', '¡Muchas gracias! ¡Tu postal ha sido enviada!'),
('52', 'top_image_hits', 'Top 5 imágenes por visitas'),
('53', 'top_image_downloads', 'Top 5 imágenes por descargas'),
('54', 'top_image_rating', 'Top 5 imágenes por puntuación'),
('55', 'top_image_votes', 'Top 5 imágenes por votos'),
('56', 'upload_success', 'Los archivos se han subido correctamente'),
('57', 'nombre_subida_multiple', 'Nombre de la imagen o imágenes'),
('58', 'insertar_categoria', 'Seleccione la categoría'),
('59',  'name',  'Nombre'), 
('60',  'desc',  'Descripción'),
('61',  'msg_success',  'El mensaje se ha enviado correctamente'),
('62',  'img_fav',  'Imágenes favoritas'),
('63',  'config',  'Configuración'),
('64',  'img_upload',  'Subir imágenes'),
('65',  'logout',  'Cerrar sesión'),
('66',  'msg',  'Mensaje'),
('67',  'new_msg',  'Nuevos mensajes'),
('68',  'register',  'Registro'),
('69',  'msg_write',  'Escribir mensaje'),
('70',  'inbox',  'Bandeja de entrada'),
('71',  'outbox',  'Bandeja de salida'),
('72',  'add_cat',  'Añadir categorías'),
('73',  'geo',  'Geolocalización');

INSERT INTO 4images_users VALUES ('-1', '-1', 'Guest', '0493984f537120be0b8d96bc9b69cdd2', '', '0', '0', '0', '0', '','0', '0', '', '',DEFAULT);

INSERT INTO 4images_users VALUES ('1', '9', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@yourdomain.com', '1', '0', '1016023608', '1016023608', '', '0', '0', '', '',DEFAULT);

INSERT INTO antispam VALUES('1','fuck');
INSERT INTO antispam VALUES('2','puta');
INSERT INTO antispam VALUES('3','zorra');
INSERT INTO antispam VALUES('4','fulana');
INSERT INTO antispam VALUES('5','whore');
INSERT INTO antispam VALUES('6','viagra');
INSERT INTO antispam VALUES('7','dumbass');
INSERT INTO antispam VALUES('8','dickhead');
INSERT INTO antispam VALUES('9','jerk');
INSERT INTO antispam VALUES('10','asshole');
INSERT INTO antispam VALUES('11','pussy');
INSERT INTO antispam VALUES('12','cunt');
INSERT INTO antispam VALUES('13','bitch');
INSERT INTO antispam VALUES('14','débile');
INSERT INTO antispam VALUES('15','bête');
INSERT INTO antispam VALUES('16','idiot');
INSERT INTO antispam VALUES('17','stupid');
INSERT INTO antispam VALUES('18','conee');
INSERT INTO antispam VALUES('19','enculé');
INSERT INTO antispam VALUES('20','putain');
INSERT INTO antispam VALUES('21','va te faire foutre');
INSERT INTO antispam VALUES('22','salaud');
INSERT INTO antispam VALUES('23','cochon');
INSERT INTO antispam VALUES('24','nique ta mere');
INSERT INTO antispam VALUES('25','pendejo');
INSERT INTO antispam VALUES('26','maric');
INSERT INTO antispam VALUES('27','slut');
INSERT INTO antispam VALUES('28','marihuana');
INSERT INTO antispam VALUES('29','marijuana');
INSERT INTO antispam VALUES('30','putita');
INSERT INTO antispam VALUES('31','porro');