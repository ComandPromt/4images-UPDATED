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

INSERT INTO spanish (id, accion, texto) VALUES
(1, 'activacion_exitosa', 'El usuario se ha activado correctamente'),
(2, 'registro_exitoso', 'Gracias por registrarse'),
(3, 'error', 'Datos incorrectos'),
(4, 'ultima_visita', 'Última visita'),
(5, 'error_captcha', 'Captcha inválido'),
(6, 'agreement', 'Condiciones del registro'),
(7, 'register_msg', 'Por favor, rellene todos los campos.'),
(8, 'user_name', 'Usuario'),
(9, 'password', 'Contraseña'),
(10, 'email', 'Correo'),
(11, 'submit', 'Enviar'),
(12, 'reset', 'Limpiar'),
(13, 'agreement_terms', 'Usted acepta que los administradores de este sitio web tienen la facultad de intentar eliminar o editar cualquier material que pudiera ser objeccionable en el tiempo más breve posible. Usted acepta que todos los mensajes publicados en este sitio expresan las opiniones y puntos de vista de sus autores, no son opiniones ni puntos de vista de los administradores, moderadores o webmasters (excepto aquellos mensajes creados expresamente por estas últimas personas) y por tanto, no pueden ser responsables de las opiniones publicadas por los visitantes.  <br/><br/>  Usted acepta no publicar ningún contenido abusivo, obsceno, vulgar, escandaloso, hiriente, amenazante, calumnioso, de contenido sexual o pornográfico o cualquier otro material que pueda violar las leyes vigentes. Usted acepta que al webmaster y administrador de este sitio les asiste el derecho de eliminar o editar cualquier tema en el momento que estime oportuno. Como usuario usted acepta que cualquier dato que usted nos facilite será almacenado en una base de datos. Esta información no será revelada a ningún tercero sin su consentimiento. El webmaster y el administrador no pueden ser responsables de los intentos de acceso o ataques que puedan poner sus datos en compromiso. <br /><br /> Este sistema utiliza cookies para almacenar información en su ordenador. Estos cookies no contienen informaciones personales, sirven únicamente para hacer más placentera su experiencia de navegación por este sitio. <br/><br/> Haciendo click en Estoy de acuerdo usted acepta todas estas condiciones.'),
(14, 'captcha', 'Captcha'),
(15, 'ok', 'Ok'),
(16, 'recordar', 'Recordar contraseña'),
(17, 'login', 'Entrar'),
(18, 'nota_email', 'El email será útil a la hora de recuperar tu contraseña'),
(19, 'nueva_pass', 'Nueva contraseña'),
(20, 'cambiar_pass', 'Cambiar contraseña'),
(21, 'cambio_pass_exitoso', 'La contraseña ha sido cambiada correctamente');

INSERT INTO ingles (id, accion, texto) VALUES
(1, 'activacion_exitosa', 'The user has successfully activated'),
(2, 'registro_exitoso', 'Thank you for registering'),
(3, 'error', 'Incorrect data'),
(4, 'ultima_visita', 'Last visit'),
(5, 'error_captcha', 'Captcha invalid'),
(6, 'agreement', 'Registration conditions'),
(7, 'register_msg', 'Please, fill in all the fields.'),
(8, 'user_name', 'User'),
(9, 'password', 'Password'),
(10, 'email', 'Email'),
(11, 'submit', 'Submit'),
(12, 'reset', 'Clean'),
(13, 'agreement_terms', 'You agree that the administrators of this website have the power to attempt to remove or edit any material that may be objectionable in the shortest possible time. You agree that all messages published on this site express the opinions and views of their authors, are not opinions or views of administrators, moderators or webmasters (except those messages created expressly by these last persons) and therefore, They can not be responsible for the opinions published by the visitors. <br/> <br/> You agree not to publish any abusive, obscene, vulgar, scandalous, hurtful, threatening, libelous, sexual or pornographic content or any other material that may violate the laws in force. You agree that the webmaster and administrator of this site have the right to delete or edit any topic at the time you deem appropriate. As a user you accept that any data you provide will be stored in a database. This information will not be disclosed to any third party without your consent. The webmaster and the administrator can not be responsible for access attempts or attacks that may compromise their data. <br /> <br /> This system uses cookies to store information on your computer. These cookies do not contain personal information, they only serve to make your browsing experience on this site more pleasant. <br/> <br/> By clicking on I agree you accept all these conditions.'),
(14, 'captcha', 'Captcha'),
(15, 'ok', 'Ok'),
(16, 'recordar', 'Remember password'),
(17, 'login', 'Get in'),
(18, 'nota_email', 'The email will be useful when it comes to recovering your password'),
(19, 'nueva_pass', 'New Password'),
(20, 'cambiar_pass', 'Change Password'),
(21, 'cambio_pass_exitoso', 'The password has been changed correctly');

INSERT INTO aleman (id, accion, texto) VALUES
(1, 'activacion_exitosa', 'Der Benutzer wurde erfolgreich aktiviert'),
(2, 'registro_exitoso', 'Danke für die Registrierung'),
(3, 'error', 'Falsche Daten'),
(4, 'ultima_visita', 'Letzter Besuch'),
(5, 'error_captcha', 'Captcha ungültig'),
(6, 'agreement', 'Registrierungsbedingungen'),
(7, 'register_msg', 'Bitte füllen Sie alle Felder aus'),
(8, 'user_name', 'Nutzer'),
(9, 'password', 'Passwort'),
(10, 'email', 'Email'),
(11, 'submit', 'Einreichen'),
(12, 'reset', 'Sauber'),
(13, 'agreement_terms', 'Sie erklären sich damit einverstanden, dass die Administratoren dieser Website befugt sind, innerhalb kürzester Zeit Material zu entfernen oder zu bearbeiten, das möglicherweise beanstandet wird. Sie erklären sich damit einverstanden, dass alle auf dieser Website veröffentlichten Nachrichten die Meinungen und Ansichten ihrer Autoren widerspiegeln, keine Meinungen oder Ansichten von Administratoren, Moderatoren oder Webmastern sind (mit Ausnahme der Nachrichten, die von diesen letzten Personen ausdrücklich erstellt wurden) und sie daher nicht für die Website verantwortlich sind von den Besuchern veröffentlichte Meinungen. <br/> <br/> Sie erklären sich damit einverstanden, keine missbräuchlichen, obszönen, vulgären, skandalösen, verletzenden, drohenden, verleumderischen, sexuellen oder pornografischen Inhalte oder sonstiges Material zu veröffentlichen, das gegen geltende Gesetze verstoßen könnte. Sie erklären sich damit einverstanden, dass der Webmaster und der Administrator dieser Website das Recht haben, jedes Thema zu dem Zeitpunkt zu löschen oder zu bearbeiten, zu dem Sie es für angemessen halten. Als Benutzer stimmen Sie zu, dass alle von Ihnen bereitgestellten Daten in einer Datenbank gespeichert werden. Diese Daten werden ohne Ihre Zustimmung nicht an Dritte weitergegeben. Der Webmaster und der Administrator können nicht für Zugriffsversuche oder Angriffe verantwortlich gemacht werden, die ihre Daten gefährden könnten. <br /> <br /> Dieses System verwendet Cookies, um Informationen auf Ihrem Computer zu speichern. Diese Cookies enthalten keine persönlichen Informationen. Sie dienen lediglich dazu, Ihren Besuch auf dieser Website angenehmer zu gestalten. <br/> <br/> Durch Klicken auf Ich stimme zu, dass Sie alle diese Bedingungen akzeptieren'),
(14, 'captcha', 'Captcha'),
(15, 'ok', 'Ok'),
(16, 'recordar', 'Passwort merken'),
(17, 'login', 'Reinkommen'),
(18, 'nota_email', 'Die E-Mail wird hilfreich sein, wenn Sie Ihr Passwort wiederherstellen möchten'),
(19, 'nueva_pass', 'Neues Kennwort'),
(20, 'cambiar_pass', 'Ändere das Passwort'),
(21, 'cambio_pass_exitoso', 'Das Passwort wurde korrekt geändert');