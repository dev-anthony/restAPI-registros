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

CREATE TABLE IF NOT EXISTS cursos(
  id_curso INT AUTO_INCREMENT NOT NULL,
  nombre_curso VARCHAR(100) NOT NULL,
  descripsion VARCHAR(255) NOT NULL,
  hora_inicio VARCHAR(20),
  hora_fin VARCHAR(20),
  PRIMARY KEY (id_curso),
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  update_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE IF NOT EXISTS alumnos(
  id_alumno INT AUTO_INCREMENT NOT NULL,
  nombre_alumno VARCHAR(150) NOT NULL,
  apellido_p VARCHAR(80) NOT NULL,
  apellido_m VARCHAR(80) NOT NULL,
  telefono_1 VARCHAR(10) NOT NULL UNIQUE,
  telefono_2 VARCHAR(10) NOT NULL UNIQUE,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  update_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (id_alumno)
);

CREATE TABLE IF NOT EXISTS cursos_alumnos (
  id_curso_alumno INT AUTO_INCREMENT NOT NULL,
  alumno_id int not null,
  curso_id int not null,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  update_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (id_curso_alumno, alumno_id, curso_id),
  CONSTRAINT fk_cursos_alumnos_alumnos FOREIGN KEY (alumno_id) REFERENCES alumnos(id_alumno) ON DELETE CASCADE ON UPDATE CASCADE, 
  CONSTRAINT fk_cursos_alumnos_cursos FOREIGN KEY (curso_id) REFERENCES cursos(id_curso) ON DELETE CASCADE ON UPDATE NO ACTION
);

-- vista de la tabla cursos con la de alumnos
CREATE VIEW v_cursos_alumnos AS
SELECT c.id_curso, c.nombre_curso, c.descripsion, c.hora_inicio, c.hora_fin, a.id_alumno, a.nombre_alumno, a.apellido_p, a.apellido_m, a.telefono_1, a.telefono_2
FROM cursos c
INNER JOIN cursos_alumnos ca ON c.id_curso = ca.curso_id
INNER JOIN alumnos a ON ca.alumno_id = a.id_alumno;
-- fin de la vista de la tabla cursos con la de alumnos

insert into roles (tipo_rol) values ('admin');
insert into roles (tipo_rol) values ('usuario');

-- adios123 = $2y$10$GARfGt0qqIo08fFTXElBLuaoXi3W2OTCAZ6.4DTNs4cPb7kJkZZhW
insert into usuarios (name, username, password, rol_id) values ('anthony solano', 'anthonyadmin', '$2y$10$GARfGt0qqIo08fFTXElBLuaoXi3W2OTCAZ6.4DTNs4cPb7kJkZZhW', 1);
insert into usuarios (name, username, password, rol_id) values ('Erika De La Zeta', 'Ekzetita', '$2y$10$GARfGt0qqIo08fFTXElBLuaoXi3W2OTCAZ6.4DTNs4cPb7kJkZZhW', 2);
insert into usuarios (name, username, password, rol_id) values ('Brisa Tellos', 'BrisTellos', '$2y$10$GARfGt0qqIo08fFTXElBLuaoXi3W2OTCAZ6.4DTNs4cPb7kJkZZhW', 2);

insert into cursos (nombre_curso, descripsion, hora_inicio, hora_fin) values ('Curso de Angular', 'Curso de programacion en ANGULAR', '08:00', '18:00');
insert into cursos (nombre_curso, descripsion, hora_inicio, hora_fin) values ('Curso de JavaScript', 'Curso de programacion en JS', '08:00', '18:00');

insert into alumnos (nombre_alumno, apellido_p, apellido_m, telefono_1, telefono_2) values ('Anthony', 'Solano', 'Gonzalez', '55555551', '55555550');
insert into alumnos (nombre_alumno, apellido_p, apellido_m, telefono_1, telefono_2) values ('Erika', 'De La Zeta', 'Gonzalez', '55555553', '55555552');