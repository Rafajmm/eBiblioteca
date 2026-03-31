CREATE DATABASE IF NOT EXISTS eBiblioteca;

USE eBiblioteca;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    nombre_usuario VARCHAR(100) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL UNIQUE,
    pass VARCHAR(250) NOT NULL,
    activo TINYINT(1) DEFAULT 1,
    es_admin TINYINT(1) DEFAULT 0,
    moderado TINYINT(1) DEFAULT 0,
    bio TEXT,
    ruta_foto VARCHAR(255) DEFAULT 'assets/img/default/imgperfil.png',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE seguidores(
    id_seguidor int NOT null,
    id_seguido INT NOT NULL,
    fecha_seguimiento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_seguidor, id_seguido),
    CONSTRAINT fk_seguidor FOREIGN KEY (id_seguidor) REFERENCES usuarios(id) ON DELETE CASCADE,
    CONSTRAINT fk_seguido FOREIGN KEY (id_seguido) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE listas(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    id_usuario INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_usuario_lista FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE megusta_lista(
    id_usuario INT,
    id_lista INT,
    fecha_megusta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_usuario, id_lista),
    CONSTRAINT fk_usuario_mg FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    CONSTRAINT fk_lista_mg FOREIGN KEY (id_lista) REFERENCES listas(id) ON DELETE CASCADE
);

CREATE TABLE obras(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    sinopsis TEXT,
    paginas INT,
    fecha_publicacion DATE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_borrado TIMESTAMP DEFAULT NULL,
    ruta_pdf VARCHAR(200),
    ruta_html VARCHAR(200),
    genero ENUM("Narrativa","Ensayo","Poesía","Teatro","Infantil") NOT NULL
);

CREATE TABLE lista_obras(
    id_lista INT NOT NULL,
    id_obra INT NOT NULL,
    fecha_adicion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_lista,id_obra),
    CONSTRAINT fk_lsita_lo FOREIGN KEY (id_lista) REFERENCES listas(id) ON DELETE CASCADE,
    CONSTRAINT fk_obra_lo FOREIGN KEY (id_obra) REFERENCES obras(id) ON DELETE CASCADE
);

CREATE TABLE etiquetas(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) UNIQUE NOT NULL
);

CREATE TABLE obra_etiquetas(
    id_obra INT,
    id_etiqueta INT,
    PRIMARY KEY (id_obra,id_etiqueta),
    CONSTRAINT fk_obra_oe FOREIGN KEY (id_obra) REFERENCES obras(id) ON DELETE CASCADE,
    FOREIGN KEY fk_etiqueta_oe (id_etiqueta) REFERENCES etiquetas(id) ON DELETE CASCADE
);

CREATE TABLE autores(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT null,
    pais VARCHAR(30),
    fecha_nacimiento DATE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_borrado TIMESTAMP DEFAULT NULL,
    ruta_foto VARCHAR(200) DEFAULT NULL,
    biografia TEXT
);

CREATE TABLE obra_autores(
    id_autor INT NOT NULL,
    id_obra INT NOT NULL,
    PRIMARY KEY (id_autor,id_obra),
    CONSTRAINT fk_autor_oa FOREIGN KEY (id_autor) REFERENCES autores(id),
    CONSTRAINT fk_obra_oa FOREIGN KEY (id_obra) REFERENCES obras(id) 
);

CREATE TABLE comentarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    contenido TEXT NOT NULL,
    fecha_comentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_borrado TIMESTAMP DEFAULT NULL, 
    id_usuario INT NOT NULL,
    id_obra INT NOT NULL,
    revisado TINYINT DEFAULT 0,
    CONSTRAINT fk_usuario_coment FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    CONSTRAINT fk_obra_coment FOREIGN KEY (id_obra) REFERENCES obras(id) ON DELETE CASCADE
);

CREATE TABLE reporte_comentarios(
    id_usuario INT NOT NULL,
    id_comentario INT NOT NULL,
    fecha_reporte TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_borrado TIMESTAMP DEFAULT NULL,
    revisado TINYINT DEFAULT 0,
    PRIMARY KEY (id_usuario,id_comentario),
    CONSTRAINT fk_usuario_rc FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    CONSTRAINT fk_comentario_rc FOREIGN KEY (id_comentario) REFERENCES comentarios(id)
);

CREATE TABLE megusta_comentario(
    id_usuario INT NOT NULL,
    id_comentario INT NOT NULL,
    fecha_megusta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_usuario,id_comentario),
    CONSTRAINT fk_usuario_mc FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    CONSTRAINT fk_comentario_mc FOREIGN KEY (id_comentario) REFERENCES comentarios(id)
);

CREATE TABLE puntuaciones(
    valor int not null check (valor between 1 and 5),
    id_usuario INT,
    id_obra INT,
    fecha_puntuacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_usuario,id_obra),
    CONSTRAINT fk_usuario_punt FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    CONSTRAINT fk_obra_punt FOREIGN KEY (id_obra) REFERENCES obras(id)
);

