DROP DATABASE IF EXISTS casadecultura;

CREATE DATABASE IF NOT EXISTS casadecultura;

use casadecultura;

CREATE TABLE IF NOT EXISTS roles(
  id_rol INT AUTO_INCREMENT NOT NULL,
  tipo_rol VARCHAR(13) NOT NULL,
  avatar VARCHAR(255),
  PRIMARY KEY (id_rol)
);

CREATE TABLE IF NOT EXISTS usuarios(
  id_usuario int not null auto_increment,
    name varchar(50) not null,
    username varchar(20) not null,
    password text not null,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    update_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    rol_id int not null,
    primary key (id_usuario),
    CONSTRAINT fk_usuarios_roles FOREIGN KEY (rol_id) REFERENCES roles(id_rol)
);

CREATE TABLE IF NOT EXISTS alumnos(
  id_alumno INT AUTO_INCREMENT NOT NULL,
  nombre_alumno VARCHAR(150) NOT NULL,
  apellido_p VARCHAR(80) NOT NULL,
  apellido_m VARCHAR(80) NOT NULL,
  telefono_1 VARCHAR(10) NOT NULL,
  telefono_2 VARCHAR(10) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  update_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (id_alumno)
);

CREATE TABLE IF NOT EXISTS cursos(
  id_curso INT AUTO_INCREMENT NOT NULL,
  nombre_curso VARCHAR(100) NOT NULL,
  descripsion VARCHAR(255) NOT NULL,
  hora_inicio VARCHAR(20),
  hora_fin VARCHAR(20),
  imagen VARCHAR(255),
  PRIMARY KEY (id_curso),
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  update_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  alumno_id INT NOT NULL,
  CONSTRAINT fk_cursos_alumnos FOREIGN KEY (alumno_id) REFERENCES alumnos(id_alumno) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS cursos_alumnos(
  id_registro INT AUTO_INCREMENT NOT NULL,
  PRIMARY KEY (id_registro),
  curso_id INT NOT NULL,
  alumno_id INT NOT NULL,
  CONSTRAINT fk_curso_alumno_curso FOREIGN KEY (curso_id) REFERENCES cursos(id_curso) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_curso_alumno_alumno FOREIGN KEY (alumno_id) REFERENCES alumnos(id_alumno) ON DELETE CASCADE ON UPDATE CASCADE
);

insert into roles (tipo_rol) values ('admin');
insert into roles (tipo_rol) values ('usuario');

insert into usuarios (name, username, password, rol_id) values ('anthony solano', 'anthonyadmin', '$2y$10$GARfGt0qqIo08fFTXElBLuaoXi3W2OTCAZ6.4DTNs4cPb7kJkZZhW', 1);
insert into usuarios (name, username, password, rol_id) values ('Erika De La Zeta', 'Ekzetita', '$2y$10$GARfGt0qqIo08fFTXElBLuaoXi3W2OTCAZ6.4DTNs4cPb7kJkZZhW', 2);
insert into usuarios (name, username, password, rol_id) values ('Brisa Tellos', 'BrisTellos', '$2y$10$GARfGt0qqIo08fFTXElBLuaoXi3W2OTCAZ6.4DTNs4cPb7kJkZZhW', 2);

-- adios123 = $2y$10$GARfGt0qqIo08fFTXElBLuaoXi3W2OTCAZ6.4DTNs4cPb7kJkZZhW
