CREATE TABLE aleman (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  accion varchar(40) NOT NULL unique,
  texto text NOT NULL
);

CREATE TABLE ingles (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  accion varchar(40) NOT NULL unique,
  texto text NOT NULL
);

CREATE TABLE spanish (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  accion varchar(40) NOT NULL unique,
  texto text NOT NULL
);

CREATE TABLE frances (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  accion varchar(40) NOT NULL unique,
  texto text NOT NULL
);

CREATE TABLE portuges (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  accion varchar(40) NOT NULL unique,
  texto text NOT NULL
);

CREATE TABLE italiano (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  accion varchar(40) NOT NULL unique,
  texto text NOT NULL
);

CREATE TABLE hindu (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  accion varchar(40) NOT NULL unique,
  texto text NOT NULL
);

CREATE TABLE chino (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  accion varchar(40) NOT NULL unique,
  texto text NOT NULL
);

CREATE TABLE japones (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  accion varchar(40) NOT NULL unique,
  texto text NOT NULL
);

CREATE TABLE arabe (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  accion varchar(40) NOT NULL unique,
  texto text NOT NULL
);

CREATE TABLE bengali (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  accion varchar(40) NOT NULL unique,
  texto text NOT NULL
);

CREATE TABLE catalan (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  accion varchar(40) NOT NULL unique,
  texto text NOT NULL
);

CREATE TABLE euskera (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  accion varchar(40) NOT NULL unique,
  texto text NOT NULL
);

CREATE TABLE ruso (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  accion varchar(40) NOT NULL unique,
  texto text NOT NULL
);


INSERT INTO `aleman` (`id`, `accion`, `texto`) VALUES
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
('31', 'keywords', 'Schlüsselw&ouml;rter'),
('32', 'hits', 'Hits'),
('33', 'downloads', 'Downloads'),
('34', 'rating', 'Bewertung'),
('35', 'votes', 'Stimme(n)'),
('36', 'author', 'Autor'),
('37', 'headline', 'Überschrift'),
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
('50', 'sender', 'Absender');

INSERT INTO `arabe` (`id`, `accion`, `texto`) VALUES
('1', 'submit', 'إرسال'),
('2', 'reset', 'نظيف'),
('3', 'login', 'دخول'),
('4', 'user_name', 'المستخدم'),
('5', 'captcha', 'كلمة التحقق'),
('6', 'password', 'كلمة المرور');

INSERT INTO `bengali` (`id`, `accion`, `texto`) VALUES
('1', 'submit', 'পাঠান'),
('2', 'reset', 'পরিষ্কার'),
('3', 'login', 'লগইন'),
('4', 'user_name', 'ব্যবহারকারী'),
('5', 'captcha', 'ক্যাপচা'),
('6', 'password', 'পাসওয়ার্ড');

INSERT INTO `catalan` (`id`, `accion`, `texto`) VALUES
('1', 'submit', 'enviar'),
('2', 'reset', 'netejar'),
('3', 'login', 'entrar'),
('4', 'user_name', 'Usuari'),
('5', 'captcha', 'Captcha'),
('6', 'password', 'Contrasenya');

INSERT INTO `chino` (`id`, `accion`, `texto`) VALUES
('1', 'submit', '發送'),
('2', 'reset', '清潔'),
('3', 'login', '註冊'),
('4', 'user_name', '用戶'),
('5', 'captcha', '驗證碼'),
('6', 'password', '密碼');

INSERT INTO `euskera` (`id`, `accion`, `texto`) VALUES
('1', 'submit', 'bidali'),
('2', 'reset', 'garbi'),
('3', 'login', 'login'),
('4', 'user_name', 'Erabiltzaile'),
('5', 'captcha', 'Captcha'),
('6', 'password', 'Pasahitza');

INSERT INTO `frances` (`id`, `accion`, `texto`) VALUES
('1', 'submit', 'envoyer'),
('2', 'reset', 'clair'),
('3', 'login', 'entrer'),
('4', 'user_name', 'Utilisateur'),
('5', 'captcha', 'Captcha'),
('6', 'password', 'Mot de passe');

INSERT INTO `hindu` (`id`, `accion`, `texto`) VALUES
('1', 'submit', 'भेजना'),
('2', 'reset', 'स्वच्छ'),
('3', 'login', 'लॉग इन'),
('4', 'user_name', 'उपयोगक'),
('5', 'captcha', 'कैप्चा'),
('6', 'password', 'पासवर्ड');

INSERT INTO `ingles` (`id`, `accion`, `texto`) VALUES
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
('37', 'headline', 'Headline'),
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
('50', 'sender', 'Sender');

INSERT INTO `italiano` (`id`, `accion`, `texto`) VALUES
('1', 'submit', 'inviare'),
('2', 'reset', 'pulito'),
('3', 'login', 'accesso'),
('4', 'user_name', 'Utente'),
('5', 'captcha', 'Captcha'),
('6', 'password', 'Password');

INSERT INTO `japones` (`id`, `accion`, `texto`) VALUES
('1', 'submit', '送る'),
('2', 'reset', 'クリア'),
('3', 'login', 'ログイン'),
('4', 'user_name', 'ユーザー'),
('5', 'captcha', 'キャプチャ'),
('6', 'password', 'パスワード');

INSERT INTO `portuges` (`id`, `accion`, `texto`) VALUES
('1', 'submit', 'enviar'),
('2', 'reset', 'claro'),
('3', 'login', 'entrar'),
('4', 'user_name', 'Utilizador'),
('5', 'captcha', 'Captcha'),
('6', 'password', 'Password');

INSERT INTO `ruso` (`id`, `accion`, `texto`) VALUES
('1', 'submit', 'послать'),
('2', 'reset', 'чистый'),
('3', 'login', 'Войти'),
('4', 'user_name', 'пользователь'),
('5', 'captcha', 'Защитный код'),
('6', 'password', 'пароль');

INSERT INTO `spanish` (`id`, `accion`, `texto`) VALUES
('1', 'activacion_exitosa', 'El usuario se ha activado correctamente'),
('2', 'registro_exitoso', 'Gracias por registrarse'),
('3', 'error', 'Datos incorrectos'),
('4', 'ultima_visita', 'Última visita'),
('5', 'error_captcha', 'Captcha inválido'),
('6', 'agreement', 'Condiciones del registro'),
('7', 'register_msg', 'Por favor, rellene todos los campos.'),
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
('37', 'headline', 'Descripción breve'),
('38', 'comment', 'Comentario'),
('39', 'added_by', 'Subido por '),
('40', 'allow_comments', 'Permitir comentarios'),
('41', 'exif_make', 'Fabricante'),
('42', 'exif_model', 'Modelo'),
('43', 'exif_datetime', 'Fecha de creación'),
('44', 'send_postcard', 'Mandar postal'),
('45', 'edit_postcard', 'Moficiar postal'),
('46', 'bg_color', 'Color de fondo'),
('47', 'font_color', 'Color'),
('48', 'font_face', 'Tipo de letra'),
('49', 'recipient', 'Destinatario'),
('50', 'sender', 'Remitente'),
('51', 'send_postcard_success', '¡Muchas gracias! ¡Tu postal ha sido enviada!'),
('52', 'top_image_hits', 'Top 5 imágenes por visitas'),
('53', 'top_image_downloads', 'Top 5 imágenes por descargas'),
('54', 'top_image_rating', 'Top 5 imágenes por puntuación'),
('55', 'top_image_votes', 'Top 5 imágenes por votos');
