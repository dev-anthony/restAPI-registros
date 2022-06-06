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
    CONSTRAINT fk_usuarios_roles FOREIGN KEY (rol_id) REFERENCES roles(id_rol) ON DELETE CASCADE ON UPDATE CASCADE
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
  curso_id INT NOT NULL,
  PRIMARY KEY (id_alumno),
  CONSTRAINT fk_alumnos_cursos FOREIGN KEY (curso_id) REFERENCES cursos(id_curso) ON DELETE CASCADE ON UPDATE CASCADE
);
-- Vista de cursos alumnos
CREATE VIEW IF NOT EXISTS v_cursos_alumnos AS
  SELECT
    a.id_alumno,
    a.nombre_alumno,
    a.apellido_p,
    a.apellido_m,
    a.telefono_1,
    a.telefono_2,
    c.id_curso,
    c.nombre_curso,
    c.descripsion,
    c.hora_inicio,
    c.hora_fin
  FROM
    alumnos a
  INNER JOIN
    cursos c
  ON
    a.curso_id = c.id_curso;

-- CREATE TABLE IF NOT EXISTS cursos_alumnos(
--   id_registro INT AUTO_INCREMENT NOT NULL,
--   PRIMARY KEY (id_registro),
--   curso_id INT NOT NULL,
--   alumno_id INT NOT NULL,
--   CONSTRAINT fk_curso_alumno_curso FOREIGN KEY (curso_id) REFERENCES cursos(id_curso) ON DELETE CASCADE ON UPDATE CASCADE,
--   CONSTRAINT fk_curso_alumno_alumno FOREIGN KEY (alumno_id) REFERENCES alumnos(id_alumno) ON DELETE CASCADE ON UPDATE CASCADE
-- );

-- Inicio vista de la tabla cursos y alumnos
-- CREATE VIEW IF NOT EXISTS v_cursos_alumnos AS
--   SELECT
--     cursos.id_curso,
--     cursos.nombre_curso,
--     cursos.descripsion,
--     cursos.hora_inicio,
--     cursos.hora_fin,
--     alumnos.id_alumno,
--     alumnos.nombre_alumno,
--     alumnos.apellido_p,
--     alumnos.apellido_m,
--     alumnos.telefono_1,
--     alumnos.telefono_2
--   FROM
--     cursos
--   INNER JOIN cursos_alumnos ON cursos.id_curso = cursos_alumnos.curso_id
--   INNER JOIN alumnos ON cursos_alumnos.alumno_id = alumnos.id_alumno;
  -- Fin de la vista

insert into roles (tipo_rol) values ('admin');
insert into roles (tipo_rol) values ('usuario');

insert into usuarios (name, username, password, rol_id) values ('anthony solano', 'anthonyadmin', '$2y$10$GARfGt0qqIo08fFTXElBLuaoXi3W2OTCAZ6.4DTNs4cPb7kJkZZhW', 1);
insert into usuarios (name, username, password, rol_id) values ('Erika De La Zeta', 'Ekzetita', '$2y$10$GARfGt0qqIo08fFTXElBLuaoXi3W2OTCAZ6.4DTNs4cPb7kJkZZhW', 2);
insert into usuarios (name, username, password, rol_id) values ('Brisa Tellos', 'BrisTellos', '$2y$10$GARfGt0qqIo08fFTXElBLuaoXi3W2OTCAZ6.4DTNs4cPb7kJkZZhW', 2);

insert into cursos (nombre_curso, descripsion, hora_inicio, hora_fin) values ('Curso de PHP', 'Curso de PHP', '08:00', '18:00');
insert into cursos (nombre_curso, descripsion, hora_inicio, hora_fin) values ('Curso de JavaScript', 'Curso de JavaScript', '08:00', '18:00');

insert into alumnos (nombre_alumno, apellido_p, apellido_m, telefono_1, telefono_2, curso_id) values ('Anthony', 'Solano', 'Gonzalez', '4651327980', '1324657980', 1);
insert into alumnos (nombre_alumno, apellido_p, apellido_m, telefono_1, telefono_2, curso_id) values ('Erika', 'De La Zeta', 'Gonzalez', '1654892130', '4354986571', 2);

-- adios123 = $2y$10$GARfGt0qqIo08fFTXElBLuaoXi3W2OTCAZ6.4DTNs4cPb7kJkZZhW