CREATE DATABASE restaurante_canasto;
USE restaurante_canasto;

-- =========================
-- ESTADOS
-- =========================
CREATE TABLE CANASTO_ESTADOS_TB(
    ID_ESTADO INT PRIMARY KEY,
    DESCRIPCION VARCHAR(50) NOT NULL
);

-- =========================
-- ROLES
-- =========================
CREATE TABLE CANASTO_ROLES_TB(
    ID_ROL INT PRIMARY KEY,
    NOMBRE VARCHAR(50) NOT NULL,
    DESCRIPCION VARCHAR(100),
    ID_ESTADO INT,
    FOREIGN KEY (ID_ESTADO)
        REFERENCES CANASTO_ESTADOS_TB(ID_ESTADO)
);

-- =========================
-- USUARIOS
-- =========================
CREATE TABLE CANASTO_USUARIOS_TB(
    IDENTIFICACION INT PRIMARY KEY,
    NOMBRE VARCHAR(100) NOT NULL,
    APELLIDO_PATERNO VARCHAR(100),
    APELLIDO_MATERNO VARCHAR(100),
    CORREO VARCHAR(150) UNIQUE NOT NULL,
    CONTRASENA VARCHAR(255) NOT NULL,
    FECHA_INGRESO DATETIME DEFAULT CURRENT_TIMESTAMP,
    ID_ESTADO INT,
    ID_ROL INT,
    FOREIGN KEY (ID_ESTADO)
        REFERENCES CANASTO_ESTADOS_TB(ID_ESTADO),
    FOREIGN KEY (ID_ROL)
        REFERENCES CANASTO_ROLES_TB(ID_ROL)
);

SELECT * FROM CANASTO_ROLES_TB;

-- =========================
-- CATEGORÍAS
-- =========================
CREATE TABLE CANASTO_CATEGORIAS_MENU_TB(
    ID_CATEGORIA INT PRIMARY KEY,
    NOMBRE_CATEGORIA VARCHAR(100),
    DESCRIPCION VARCHAR(1000),
    ID_ESTADO INT,
    FOREIGN KEY (ID_ESTADO)
        REFERENCES CANASTO_ESTADOS_TB(ID_ESTADO)
);

-- =========================
-- PRODUCTOS
-- =========================
CREATE TABLE CANASTO_PRODUCTOS_TB(
    ID_PRODUCTO INT PRIMARY KEY,
    NOMBRE VARCHAR(100),
    DESCRIPCION VARCHAR(1000),
    PRECIO DECIMAL(10,2),
    ID_CATEGORIA INT,
    IMAGEN_RUTA VARCHAR(1000),
    ID_ESTADO INT,
    FOREIGN KEY (ID_CATEGORIA)
        REFERENCES CANASTO_CATEGORIAS_MENU_TB(ID_CATEGORIA),
    FOREIGN KEY (ID_ESTADO)
        REFERENCES CANASTO_ESTADOS_TB(ID_ESTADO)
);

-- =========================
-- PEDIDOS
-- =========================
CREATE TABLE CANASTO_PEDIDOS_TB(
    ID_PEDIDO INT PRIMARY KEY,
    IDENTIFICACION INT,
    OBSERVACIONES VARCHAR(1000),
    FECHA_PEDIDO DATETIME DEFAULT CURRENT_TIMESTAMP,
    ID_ESTADO INT,
    FOREIGN KEY (IDENTIFICACION)
        REFERENCES CANASTO_USUARIOS_TB(IDENTIFICACION),
    FOREIGN KEY (ID_ESTADO)
        REFERENCES CANASTO_ESTADOS_TB(ID_ESTADO)
);
ALTER TABLE CANASTO_PEDIDOS_TB 
MODIFY ID_PEDIDO INT AUTO_INCREMENT;

-- =========================
-- DETALLE PEDIDO
-- =========================
CREATE TABLE CANASTO_DETALLE_PEDIDO_TB(
    ID_PEDIDO INT,
    ID_PRODUCTO INT,
    CANTIDAD INT,
    PRECIO_UNITARIO DECIMAL(10,2),
    SUBTOTAL DECIMAL(10,2),
    ID_ESTADO INT,
    PRIMARY KEY (ID_PEDIDO, ID_PRODUCTO),
    FOREIGN KEY (ID_PEDIDO)
        REFERENCES CANASTO_PEDIDOS_TB(ID_PEDIDO),
    FOREIGN KEY (ID_PRODUCTO)
        REFERENCES CANASTO_PRODUCTOS_TB(ID_PRODUCTO),
    FOREIGN KEY (ID_ESTADO)
        REFERENCES CANASTO_ESTADOS_TB(ID_ESTADO)
);


-- =========================
-- HISTORIAL
-- =========================
CREATE TABLE CANASTO_HISTORIAL_PEDIDOS_TB(
    ID_HISTORIAL INT PRIMARY KEY,
    ID_PEDIDO INT,
    FECHA_PEDIDO DATETIME,
    IDENTIFICACION INT,
    ID_ESTADO INT,
    FOREIGN KEY (ID_PEDIDO)
        REFERENCES CANASTO_PEDIDOS_TB(ID_PEDIDO),
    FOREIGN KEY (IDENTIFICACION)
        REFERENCES CANASTO_USUARIOS_TB(IDENTIFICACION),
    FOREIGN KEY (ID_ESTADO)
        REFERENCES CANASTO_ESTADOS_TB(ID_ESTADO)
);

-- =========================
-- IMPUESTOS
-- =========================
CREATE TABLE CANASTO_IMPUESTOS_TB(
    ID_IMPUESTO INT PRIMARY KEY,
    NOMBRE VARCHAR(100),
    PORCENTAJE DECIMAL(5,2),
    ID_ESTADO INT,
    FOREIGN KEY (ID_ESTADO)
        REFERENCES CANASTO_ESTADOS_TB(ID_ESTADO)
);

-- =========================
-- MÉTODOS DE PAGO
-- =========================
CREATE TABLE CANASTO_METODOS_PAGO_TB(
    ID_METODO_PAGO INT PRIMARY KEY,
    NOMBRE VARCHAR(100),
    ID_ESTADO INT,
    FOREIGN KEY (ID_ESTADO)
        REFERENCES CANASTO_ESTADOS_TB(ID_ESTADO)
);

-- =========================
-- FACTURAS
-- =========================
CREATE TABLE CANASTO_FACTURAS_TB(
    ID_FACTURA INT PRIMARY KEY,
    ID_PEDIDO INT,
    FECHA_FACTURA DATETIME DEFAULT CURRENT_TIMESTAMP,
    SUBTOTAL DECIMAL(10,2),
    ID_IMPUESTO INT,
    TOTAL DECIMAL(10,2),
    ID_METODO_PAGO INT,
    ID_ESTADO INT,
    FOREIGN KEY (ID_PEDIDO)
        REFERENCES CANASTO_PEDIDOS_TB(ID_PEDIDO),
    FOREIGN KEY (ID_IMPUESTO)
        REFERENCES CANASTO_IMPUESTOS_TB(ID_IMPUESTO),
    FOREIGN KEY (ID_METODO_PAGO)
        REFERENCES CANASTO_METODOS_PAGO_TB(ID_METODO_PAGO),
    FOREIGN KEY (ID_ESTADO)
        REFERENCES CANASTO_ESTADOS_TB(ID_ESTADO)
);
ALTER TABLE CANASTO_FACTURAS_TB 
MODIFY ID_FACTURA INT AUTO_INCREMENT;

INSERT INTO CANASTO_ESTADOS_TB (ID_ESTADO, DESCRIPCION) VALUES
(1,'ACTIVO'),
(2,'INACTIVO'),
(3,'PENDIENTE'),
(4,'EN_PROCESO'),
(5,'COMPLETADO'),
(6,'CANCELADO'),
(7,'FACTURADO'),
(8,'PAGADO'),
(9,'ANULADO');

INSERT INTO CANASTO_ROLES_TB (ID_ROL, NOMBRE, DESCRIPCION, ID_ESTADO) VALUES
(1, 'ADMIN', 'Administrador del sistema', 1),
(2, 'MESERO', 'Encargado de pedidos', 1),
(3, 'CLIENTE', 'Cliente del restaurante', 1);

INSERT INTO CANASTO_USUARIOS_TB 
(IDENTIFICACION, NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, CORREO, CONTRASENA, ID_ESTADO, ID_ROL)
VALUES
-- ADMINISTRADORES (ROL = 1)
(1000, 'Gustavo', 'Ortiz', 'Picado', 'admin@gmail.com', 'admin123', 1, 1),
(1001, 'Laura', 'Chaves', 'Mora', 'laura.admin@gmail.com', 'admin123', 1, 1),

-- MESEROS (ROL = 2)
(2000, 'Carlos', 'Ramirez', 'Perez', 'carlos.mesero@gmail.com', '123', 1, 2),
(2001, 'Ana', 'Castro', 'Lopez', 'ana.mesera@gmail.com', '123', 1, 2),
(2002, 'Luis', 'Gomez', 'Rojas', 'luis.mesero@gmail.com', '123', 1, 2),
(2003, 'Daniel', 'Vargas', 'Soto', 'daniel.mesero@gmail.com', '123', 1, 2),
(2004, 'Paola', 'Jimenez', 'Araya', 'paola.mesera@gmail.com', '123', 1, 2),

-- CLIENTES (ROL = 3)
(3000, 'Maria', 'Fernandez', 'Lopez', 'maria@gmail.com', '123', 1, 3),
(3001, 'Jose', 'Mora', 'Castro', 'jose@gmail.com', '123', 1, 3),
(3002, 'Andrea', 'Soto', 'Ramirez', 'andrea@gmail.com', '123', 1, 3),
(3003, 'Ricardo', 'Salas', 'Vega', 'ricardo@gmail.com', '123', 1, 3),
(3004, 'Fernando', 'Araya', 'Perez', 'fernando@gmail.com', '123', 1, 3),
(3005, 'Valeria', 'Rojas', 'Jimenez', 'valeria@gmail.com', '123', 1, 3),
(3006, 'Kevin', 'Navarro', 'Solis', 'kevin@gmail.com', '123', 1, 3),
(3007, 'Sofia', 'Solano', 'Vargas', 'sofia@gmail.com', '123', 1, 3),
(3008, 'Miguel', 'Cordero', 'Lopez', 'miguel@gmail.com', '123', 1, 3),
(3009, 'Paula', 'Herrera', 'Castillo', 'paula@gmail.com', '123', 1, 3),
(3010, 'Jorge', 'Mendez', 'Rojas', 'jorge@gmail.com', '123', 1, 3);


INSERT INTO CANASTO_CATEGORIAS_MENU_TB 
(ID_CATEGORIA, NOMBRE_CATEGORIA, DESCRIPCION, ID_ESTADO) 
VALUES 
(1,'Desayunos', 'Platos tradicionales servidos con café o fresco, disponibles de 7:00 a.m. a 11:00 a.m.', 1),
(2,'Bebidas Calientes', 'Variedad de cafés, tés y bebidas calientes tradicionales.', 1),
(3,'Almuerzos', 'Casados tradicionales y platos fuertes de carne, pollo y pescado.', 1),
(4,'Delicioso Arroz', 'Especialidades de la casa en arroces: cantones, pollo y camarón.', 1),
(5,'Pastas', 'Opciones de espaguetis con salsas artesanales y pan de ajo.', 1),
(6,'Deliciosas Pupusas', 'Pupusas artesanales con diversos rellenos y combinaciones.', 1),
(7,'Acompañamientos', 'Porciones adicionales para complementar los platos principales.', 1),
(8,'Postres', 'Dulces tradicionales para finalizar la comida.', 1),
(9,'Bebidas Frías', 'Refrescos naturales, gaseosas y jugos.', 1),
(10,'Comidas Rápidas', 'Hamburguesas, enyucados, tacos y snacks rápidos.', 1),
(11,'Calzones', 'Pizzas dobladas y rellenas, horneadas a la perfección.', 1),
(12,'Entradas', 'Deliciosas opciones para empezar su comida.', 1),
(13,'Costilla Asada', 'Costilla de cerdo asada en nuestra deliciosa salsa BBQ.', 1),
(14,'Pollo Asado', 'Pollo asado a la leña, jugoso y lleno de sabor.', 1),
(15,'Carnes Baho', 'Especialidad de la casa, disponible los fines de semana.', 1),
(16,'Pizzas', 'Nuestra gran variedad de pizzas artesanales.', 1);


INSERT INTO CANASTO_PRODUCTOS_TB 
(ID_PRODUCTO, NOMBRE, DESCRIPCION, PRECIO, ID_CATEGORIA, ID_ESTADO) 
VALUES 

-- DESAYUNOS (1 - 9)
(1,'Pinto con huevo','Incluye natilla, pan o tortillas, café o fresco natural',4200,1,1),
(2,'Pinto con huevo y queso','Incluye pan o tortillas, café o fresco natural',4200,1,1),
(3,'Pinto con huevo y maduro','Incluye pan o tortillas, café o fresco natural',4200,1,1),
(4,'Pinto con huevo y salchichón','Incluye pan o tortillas, café o fresco natural',4200,1,1),
(5,'Pinto con huevo y carne en salsa','Incluye pan o tortillas, café o fresco natural',4500,1,1),
(6,'Pinto con huevo y carne mechada','Incluye pan o tortillas, café o fresco natural',4500,1,1),
(7,'Pinto con huevo y pollo en salsa','Incluye pan o tortillas, café o fresco natural',4500,1,1),
(8,'Pinto con huevo y pollo asado','Incluye pan o tortillas, café o fresco natural',5000,1,1),
(9,'Pinto Canasto Especial','Huevo, queso, maduro, salchichón, natilla, pan o tortillas, café o fresco',6000,1,1),

-- BEBIDAS (10 - 14)
(10,'Café Negro','Bebida caliente',1300,2,1),
(11,'Café con Leche','Bebida caliente',1500,2,1),
(12,'Agua Dulce','Bebida caliente',1300,2,1),
(13,'Fresco Natural','Vaso de fresco del día',1500,2,1),
(14,'Fresco Vidrio','Gaseosa o bebida en envase de vidrio',1300,2,1),

-- ALMUERZOS (15 - 19)
(15,'Casado de Carne en Salsa','Incluye refresco natural',4700,3,1),
(16,'Casado de Pollo Asado','Incluye refresco natural',6000,3,1),
(17,'Olla de Carne','Hecha a la leña, incluye arroz, tortillas y fresco',7500,3,1),
(18,'Bistec de Cerdo','Casado tradicional con fresco',4700,3,1),
(19,'Filete de Pescado','Casado tradicional con fresco',4700,3,1),

-- ARROCES Y PASTAS (20 - 24)
(20,'Arroz Cantones Entero','Receta especial de la casa',7000,4,1),
(21,'Arroz con Pollo Entero','Acompañado de papas y ensalada',9000,4,1),
(22,'Arroz con Camarón Entero','Camarones seleccionados',10500,4,1),
(23,'Espaguetis a la Boloñesa','Salsa de tomate, carne molida, queso y pan de ajo',7500,4,1),
(24,'Espaguetis Alfredo','Salsa blanca, jamón, hongos, queso y pan de ajo',8500,4,1),

-- PUPUSAS (25 - 28)
(25,'Pupusa Mixta','Chicharrón, frijoles y queso',3200,6,1),
(26,'Pupusa de Queso','Solo queso mozzarella',3000,6,1),
(27,'Pupusa de Chicharrón','Chicharrón con queso',3200,6,1),
(28,'Pupusa La Canasto','Extra queso, chicharrón, frijol y extra mozzarella',4000,6,1),

-- COMIDAS RÁPIDAS (29 - 33)
(29,'Hamburguesa con Papas','Hamburguesa clásica con papas fritas',5000,8,1),
(30,'Enyucado de Carne','Yuca suave rellena de carne',3500,8,1),
(31,'Tacos de Carne o Pollo','Servidos con repollo y salsas',3500,8,1),
(32,'Deditos de Pollo con Papas','Ideales para niños o snacks',5000,8,1),
(33,'Salchipapas Grande','Papas fritas con salchichón picado',5500,8,1),

-- CALZONES (34 - 38)
(34,'Calzone El Canasto','Pepperoni, tocineta, cebolla, chile dulce, hongos y queso',8000,11,1),
(35,'Calzone Vegetariano','Aceitunas, chile dulce, cebolla, hongos, tomate y orégano',7000,11,1),
(36,'Calzone de Jamón','Jamón, queso y orégano',6000,11,1),
(37,'Calzone Jamón y Hongos','Queso, jamón, hongos y orégano',7000,11,1),
(38,'Calzone Supremo','Queso, jamón, carne molida, chile dulce y cebolla',7000,11,1),

-- ENTRADAS (39 - 40)
(39,'Pan de Ajo','Acompañamiento perfecto',4000,12,1),
(40,'Pan de Ajo con Queso','Acompañamiento perfecto con queso derretido',5000,12,1),

-- COSTILLA (41 - 43)
(41,'1/4 de Costilla BBQ','Costilla de cerdo asada en salsa BBQ',5500,13,1),
(42,'Medio Kilo de Costilla BBQ','Costilla de cerdo asada en salsa BBQ',9500,13,1),
(43,'1 Kilo de Costilla BBQ','Costilla de cerdo asada en salsa BBQ',19500,13,1),

-- POLLO (44 - 46)
(44,'1/4 de Pollo Asado','Pollo asado a la leña',2900,14,1),
(45,'Medio Pollo Asado','Pollo asado a la leña',5000,14,1),
(46,'1 Pollo Entero Asado','Pollo asado a la leña',8900,14,1),

-- BAHO (47)
(47,'Carnes Baho','Especialidad de la casa',7000,15,1),

-- PIZZAS (48 - 59)
(48,'Pizza Jamón S','Queso y jamón',5000,16,1),
(49,'Pizza Jamón M','Queso y jamón',9000,16,1),
(50,'Pizza Jamón L','Queso y jamón',12000,16,1),
(51,'Pizza Jamón XL','Queso y jamón',14000,16,1),

(52,'Pizza Jamón y Hongos S','Jamón y hongos',7000,16,1),
(53,'Pizza Jamón y Hongos M','Jamón y hongos',10000,16,1),
(54,'Pizza Jamón y Hongos L','Jamón y hongos',13000,16,1),
(55,'Pizza Jamón y Hongos XL','Jamón y hongos',15000,16,1),

(56,'Pizza La Casa S','Especial',8000,16,1),
(57,'Pizza La Casa M','Especial',12000,16,1),
(58,'Pizza La Casa L','Especial',14000,16,1),
(59,'Pizza La Casa XL','Especial',16000,16,1);

INSERT INTO CANASTO_IMPUESTOS_TB (ID_IMPUESTO, NOMBRE, PORCENTAJE, ID_ESTADO) VALUES
(1, 'IVA', 13.00, 1),
(2, 'Servicio', 10.00, 1);

INSERT INTO CANASTO_METODOS_PAGO_TB (ID_METODO_PAGO, NOMBRE, ID_ESTADO) VALUES
(1, 'Efectivo', 1),
(2, 'Tarjeta', 1),
(3, 'SINPE', 1);

