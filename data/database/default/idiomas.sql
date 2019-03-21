
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


CREATE TABLE panyabi (
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
(2, 'registro_exitoso', 'Gracias por registrarse. Recibirá un correo para activar su cuenta'),
(3, 'error', 'Datos incorrectos'),
(4, 'mensaje_activacion', 'Estimado usuario,Le damos las gracias por registrarse en sitio. Por favor haga click en el siguiente enlace para activar su cuenta : url'),
(5, 'error_captcha', 'Captcha inválido'),
(6, 'agreement', 'Condiciones del registro'),
(7, 'register_msg', 'Por favor, rellene todos los campos. Introduzca una dirección de correo válido para poder proporcionarle su código de activación'),
(8, 'user_name', 'Usuario'),
(9, 'password', 'Contraseña'),
(10, 'email', 'Correo'),
(11, 'submit', 'Enviar'),
(12, 'reset', 'Limpiar'),
(13, 'agreement_terms', 'Usted acepta que los administradores de este sitio web tienen la facultad de intentar eliminar o editar cualquier material que pudiera ser objeccionable en el tiempo más breve posible. Usted acepta que todos los mensajes publicados en este sitio expresan las opiniones y puntos de vista de sus autores, no son opiniones ni puntos de vista de los administradores, moderadores o webmasters (excepto aquellos mensajes creados expresamente por estas últimas personas) y por tanto, no pueden ser responsables de las opiniones publicadas por los visitantes.  <br/><br/>  Usted acepta no publicar ningún contenido abusivo, obsceno, vulgar, escandaloso, hiriente, amenazante, calumnioso, de contenido sexual o pornográfico o cualquier otro material que pueda violar las leyes vigentes. Usted acepta que al webmaster y administrador de este sitio les asiste el derecho de eliminar o editar cualquier tema en el momento que estime oportuno. Como usuario usted acepta que cualquier dato que usted nos facilite será almacenado en una base de datos. Esta información no será revelada a ningún tercero sin su consentimiento. El webmaster y el administrador no pueden ser responsables de los intentos de acceso o ataques que puedan poner sus datos en compromiso. <br /><br /> Este sistema utiliza cookies para almacenar información en su ordenador. Estos cookies no contienen informaciones personales, sirven únicamente para hacer más placentera su experiencia de navegación por este sitio. <br/><br/> Haciendo click en Estoy de acuerdo usted acepta todas estas condiciones.'),
(14, 'captcha', 'Captcha'),
(15, 'ok', 'Ok'),
(16, 'recordar', 'Recordar'),
(17, 'login', 'Entrar');