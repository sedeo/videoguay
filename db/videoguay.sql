------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios
(
    id       bigserial    PRIMARY KEY
  , nombre   varchar(255) NOT NULL UNIQUE
  , password varchar(255) NOT NULL
  , email    varchar(255)
  , auth_key varchar(255)
);

CREATE INDEX idx_usuarios_email ON usuarios (email);

DROP TABLE IF EXISTS socios_id CASCADE;

CREATE TABLE socios_id
(
    id bigserial PRIMARY KEY
);

DROP TABLE IF EXISTS socios CASCADE;

CREATE TABLE socios
(
    id        bigserial    PRIMARY KEY REFERENCES socios_id (id)
  , numero    numeric(6)   NOT NULL UNIQUE
  , nombre    varchar(255) NOT NULL
  , direccion varchar(255)
  , telefono  numeric(9)   CONSTRAINT ck_telefonos_no_negativo
                           CHECK (telefono IS NULL OR telefono >= 0)
);

CREATE INDEX idx_socios_nombre ON socios (nombre);
CREATE INDEX idx_socios_telefono ON socios (telefono);

DROP TABLE IF EXISTS peliculas CASCADE;

CREATE TABLE peliculas
(
    id         bigserial    PRIMARY KEY
  , codigo     numeric(4)   NOT NULL UNIQUE
  , titulo     varchar(255) NOT NULL
  , precio_alq numeric(5,2) NOT NULL
);

CREATE INDEX idx_peliculas_titulo ON peliculas (titulo);

DROP TABLE IF EXISTS alquileres CASCADE;

CREATE TABLE alquileres
(
    id          bigserial    PRIMARY KEY
  , socio_id    bigint       NOT NULL REFERENCES socios_id (id)
                             ON DELETE NO ACTION ON UPDATE CASCADE
  , pelicula_id bigint       NOT NULL REFERENCES peliculas (id)
                             ON DELETE NO ACTION ON UPDATE CASCADE
  , created_at  timestamp(0) NOT NULL DEFAULT current_timestamp
  , devolucion  timestamp(0)
  , UNIQUE (socio_id, pelicula_id, created_at)
);

CREATE INDEX idx_alquileres_pelicula_id ON alquileres (pelicula_id);
CREATE INDEX idx_alquileres_created_at ON alquileres (created_at DESC);


INSERT INTO usuarios (nombre, password, email)
    VALUES ('pepe', crypt('pepe', gen_salt('bf', 13)), 'pepe@pepe.com')
         , ('juan', crypt('juan', gen_salt('bf', 13)), 'juan@juan.com');
INSERT INTO socios_id (id) VALUES (DEFAULT), (DEFAULT), (DEFAULT);
INSERT INTO socios (numero, nombre, direccion, telefono)
    VALUES (100, 'Pepe', 'Su casa', 987654321)
         , (200, 'Juan', 'Su hogar', 987654322)
         , (300, 'Maria', 'Su calle', 897654323);

INSERT INTO peliculas (codigo, titulo, precio_alq)
    VALUES (1000, 'Los últimos Jedi', 5)
         , (2000, 'La amenaza fantasma', 4)
         , (3000, 'El ataque de los clones', 3);

INSERT INTO alquileres (socio_id, pelicula_id, created_at, devolucion)
    VALUES (1, 1, current_timestamp - 'P4D'::interval, current_timestamp - 'P3D'::interval)
         , (1, 2, current_timestamp - 'P2D'::interval, null)
         , (1, 3, current_timestamp - 'P1D'::interval, current_timestamp)
         , (3, 1, current_timestamp - 'P3D'::interval, current_timestamp - 'P1D'::interval);
