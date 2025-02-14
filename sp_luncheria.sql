USE luncheria_db;


DROP PROCEDURE IF EXISTS GET_CIUDADES;
	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE `get_ciudades`(IN `id` INT)
	BEGIN
		SELECT id_ciudad, nombre_ciudad FROM ciudades c WHERE c.id_estado=id order by nombre_ciudad ASC ;
	END $$
DELIMITER ;



DROP PROCEDURE IF EXISTS GET_ESTADOS;
	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE `get_estados`()
	BEGIN
	SELECT id_estado, nombre_estado FROM estados order by nombre_estado ASC ;
	END $$
DELIMITER ;



DROP PROCEDURE IF EXISTS GET_MUNICIPIOS;
	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE `get_municipios`(IN `id` INT)
	BEGIN
		SELECT id_municipio, nombre_municipio FROM municipios where id_estado=id order by nombre_municipio ASC ;
	END $$
DELIMITER ;



DROP PROCEDURE IF EXISTS GET_PARROQUIAS;
	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE `get_parroquias`(IN `id` INT)
	BEGIN
	SELECT id_parroquia, CASE WHEN c.nombre_ciudad IS NULL THEN p.nombre_parroquia WHEN c.nombre_ciudad IS NOT NULL THEN CONCAT(p.nombre_parroquia,' (', c.nombre_ciudad, ')') END as "parroquia_city" 
		FROM parroquias p
		LEFT JOIN ciudades c ON p.id_ciudad = c.id_ciudad
		WHERE p.id_municipio = id ;
	END $$
DELIMITER ;


DROP FUNCTION IF EXISTS set_null_if_empty;

DELIMITER //

CREATE FUNCTION set_null_if_empty(input_value VARCHAR(255))
RETURNS VARCHAR(255)
DETERMINISTIC
BEGIN
    IF input_value = '' THEN
        RETURN NULL;
    ELSE
        RETURN input_value;
    END IF;
END //

DELIMITER ;


DROP FUNCTION IF EXISTS edad_fn_fs;
	DELIMITER ;;
	CREATE DEFINER=`root`@`localhost` FUNCTION `edad_fn_fs`(`fn` DATE, `fs` DATE) RETURNS int(11)
	    DETERMINISTIC
	BEGIN
	    declare edad int;
	    set edad = floor(datediff(fs, fn)/365);
	    return edad;
	  END ;;
DELIMITER ;



DROP FUNCTION IF EXISTS mayus_first;
	DELIMITER ;;
	CREATE DEFINER=`root`@`localhost` FUNCTION  `mayus_first`(str_value VARCHAR(5000))
	RETURNS varchar(1000)
	    DETERMINISTIC
	BEGIN
	    RETURN CONCAT(UCASE(LEFT(str_value, 1)),
	             SUBSTRING(LOWER(str_value), 2));
	END ;;
DELIMITER ;


DROP PROCEDURE IF EXISTS INSERTA_DIRECCION;
	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE INSERTA_DIRECCION(

										  p_cod_postal int,
										  p_sector varchar(50),
										  p_calle varchar(50),
										  p_ca_edf varchar(8),
										  p_n_vivienda varchar (10),
										  p_pto_ref varchar(100),
										  p_id_parroquia int(11),
										  OUT id_direccion int (11))

	BEGIN
		SET @n_parroquias = (SELECT COUNT(id_parroquia) FROM parroquias WHERE id_parroquia= p_id_parroquia);
		SET @id_direccion = NULL;
			
		IF @n_parroquias !=0 THEN 
			INSERT INTO direcciones (cod_postal, sector, calle, ca_edf, n_vivienda, pto_ref, id_parroquia) 
			VALUES (p_cod_postal, p_sector, p_calle, p_ca_edf, p_n_vivienda, p_pto_ref, p_id_parroquia);
			SET @id_direccion = (SELECT last_insert_id());
		END IF;
		SELECT @id_direccion INTO id_direccion;

	END$$
DELIMITER ;



DROP PROCEDURE IF EXISTS INSERTA_TELEFONO;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE INSERTA_TELEFONO(
										  p_tipo char(1),
										  p_cod_area int(4),
										  p_numero int(7),
										  OUT id_telefono INT)

	BEGIN
		SET @id_telefono = NULL;
		
		IF p_cod_area IS NOT NULL AND p_numero IS NOT NULL AND p_tipo IS NOT NULL THEN 
			INSERT INTO telefonos VALUES (NULL, p_tipo, p_cod_area, p_numero);
			SET @id_telefono = (SELECT last_insert_id());

			SELECT @id_telefono INTO id_telefono;

		END IF;
	END$$
DELIMITER ;



DROP PROCEDURE IF EXISTS INSERTA_CORREO;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE INSERTA_CORREO(
																p_direccion_correo varchar(100),
																OUT id_correo INT)

	BEGIN
		SET @id_correo = NULL;
		IF p_direccion_correo IS NOT NULL THEN 
			INSERT INTO correos	VALUES (NULL, p_direccion_correo);
			SET @id_correo = (SELECT last_insert_id());
		END IF;

		SELECT @id_correo INTO id_correo;
	END$$
DELIMITER ;


DROP PROCEDURE IF EXISTS INSERTA_FULL_PERSONA;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE INSERTA_FULL_PERSONA(
			p_tipo_ci enum('V','E'),
			`p_ci` INT, `p_pn` VARCHAR(20), 
			`p_sn` VARCHAR(20), `p_tn` VARCHAR(20), 
			`p_pa` VARCHAR(20), `p_sa` VARCHAR(20), 
			`p_fn` DATE, `p_sexo` ENUM('M','F'), 
			`p_edo_civil` ENUM('S','C','D','V'), 
			p_cod_postal int,
			p_sector varchar(50),
			p_calle varchar(50),
			p_ca_edf varchar(8),
			p_n_vivienda varchar(10),
			p_pto_ref varchar(100),
			p_id_parroquia int(11),
			p_tipo varchar(10),
			p_cod_area INT,
			p_numero INT,
			p_direccion_correo varchar(80), OUT id_persona INT)

	BEGIN
		SET @id_direccion = NULL;
		SET @id_telefono = NULL;
		SET @id_correo = NULL;
		SET @id_persona = NULL;
		SET @n_parroquias = (SELECT COUNT(id_parroquia) FROM parroquias WHERE id_parroquia= p_id_parroquia);


		IF @n_parroquias != 0 THEN
		CALL INSERTA_DIRECCION(p_cod_postal, p_sector, p_calle,
							 p_ca_edf, p_n_vivienda, p_pto_ref, 
							 p_id_parroquia, @id_direccion);
		END IF;


		IF p_direccion_correo IS NOT NULL THEN 
			CALL INSERTA_CORREO(p_direccion_correo,	@id_correo);
		END IF;

		IF p_cod_area IS NOT NULL THEN
					CALL INSERTA_TELEFONO(p_tipo, p_cod_area, p_numero,
										@id_telefono);
		END IF;

		IF p_ci IS NOT NULL AND p_pn IS NOT NULL AND p_pa IS NOT NULL THEN 
			CALL INSERTA_PERSONA(p_tipo_ci, p_ci, p_pn,
								p_sn, p_tn, p_pa, 
								p_sa, p_fn, p_sexo, 
								p_edo_civil, @id_direccion, @id_telefono, @id_correo, @id_persona);
		END IF;

		SELECT @id_persona INTO id_persona;
		
		END$$
DELIMITER ;


DROP PROCEDURE IF EXISTS INSERTA_PERSONA;
	DELIMITER $$
	CREATE PROCEDURE INSERTA_PERSONA(
		p_tipo_ci enum('V','E'),
		`p_ci` INT(8), `p_pn` VARCHAR(20), 
		`p_sn` VARCHAR(20), `p_tn` VARCHAR(20), 
		`p_pa` VARCHAR(20), `p_sa` VARCHAR(20), 
		`p_fn` DATE, `p_sexo` ENUM('M','F'), 
		`p_edo_civil` ENUM('S','C','D','V'),
		p_id_direccion INT,
		p_id_telefono INT,
		p_id_correo INT,
		OUT id_persona INT)
	BEGIN
	SET @id_persona = NULL;
		
		IF p_pn IS NOT NULL AND p_pa IS NOT NULL AND p_sexo IS NOT NULL
		THEN
		INSERT INTO personas VALUES (NULL, p_tipo_ci,
											p_ci, 
											p_pn, 
											set_null_if_empty(p_sn), 
											set_null_if_empty(p_tn), 
											p_pa, 
											set_null_if_empty(p_sa), 
											set_null_if_empty(p_fn), 
											set_null_if_empty(p_sexo),
											p_edo_civil, 
											p_id_direccion,
											p_id_telefono,
											p_id_correo);
		
	    SET @id_persona = (SELECT last_insert_id());
		END IF;
		
	    SELECT @id_persona INTO id_persona;

	END$$
DELIMITER ;



DROP PROCEDURE IF EXISTS INSERTA_EMPLEADO;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE INSERTA_EMPLEADO(
			p_tipo_ci enum('V','E'),
			`p_ci` INT(8), `p_pn` VARCHAR(20), 
			`p_sn` VARCHAR(20), `p_tn` VARCHAR(20), 
			`p_pa` VARCHAR(20), `p_sa` VARCHAR(20), 
			`p_fn` DATE, `p_sexo` ENUM('M','F'), 
			`p_edo_civil` ENUM('S','C','D','V'), 
			p_cod_postal int,
			p_sector varchar(50),
			p_calle varchar(50),
			p_ca_edf varchar(8),
			p_n_vivienda varchar(10),
			p_pto_ref varchar(100),
			p_id_parroquia int(11),
			p_tipo varchar(10),
			p_cod_area INT,
			p_numero INT,
			p_direccion_correo varchar(80),
			`p_cargo` VARCHAR(20),
			`p_fecha_ingreso` DATE, OUT id_emple INT)

	BEGIN
		SET @id_p = NULL;
		SET @persona = (SELECT id_persona FROM personas where tipo_ci = p_tipo_ci AND ci = p_ci);
		SET @emple = (SELECT id_empleado FROM empleados WHERE id_empleado = @persona);

		IF @persona IS NULL THEN
			CALL INSERTA_FULL_PERSONA(p_tipo_ci, p_ci, p_pn, p_sn, p_tn, p_pa, p_sa, p_fn, p_sexo, p_edo_civil, p_cod_postal, p_sector, p_calle, 
								  p_ca_edf, p_n_vivienda, p_pto_ref, p_id_parroquia, p_tipo, p_cod_area, p_numero, p_direccion_correo, @id_p);
		ELSE
			SET @id_p = @persona;
			SET @direccion = (SELECT id_direccion FROM personas WHERE id_persona = @id_p);
			SET @telefono = (SELECT id_telefono FROM personas WHERE id_persona = @id_p);
			SET @correo = (SELECT id_correo FROM personas WHERE id_persona = @id_p);
		END IF;

		IF @persona IS NOT NULL AND @id_p IS NOT NULL THEN
			UPDATE personas SET tipo_ci = p_tipo_ci, ci = p_ci, nombre1 = p_pn, nombre2 = p_sn, nombre3 = p_tn, 
				apellido1 = p_pa, apellido2 = p_sa, fecha_nac = p_fn, sexo = p_sexo, edo_civil = p_edo_civil WHERE id_persona = @id_p;
		END IF;


		IF @direccion IS NOT NULL THEN
			UPDATE direcciones SET cod_postal = p_cod_postal, sector = p_sector, calle = p_calle, 
			ca_edf = p_ca_edf, n_vivienda = p_n_vivienda, pto_ref = p_pto_ref, id_parroquia = p_id_parroquia WHERE id_direccion = @direccion;		
		END IF;

		IF @persona IS NOT NULL AND @direccion IS NULL THEN
			CALL INSERTA_DIRECCION(p_cod_postal, p_sector, p_calle, p_ca_edf, p_n_vivienda, p_pto_ref, 
							 p_id_parroquia, @id_direccion);
			UPDATE personas SET id_direccion = @id_direccion WHERE id_persona = @id_p;
		END IF;


		IF @telefono IS NOT NULL THEN
			UPDATE telefonos SET tipo = p_tipo, cod_area = p_cod_area, numero = p_numero WHERE id_telefono = @telefono;
		END IF;


		IF @persona IS NOT NULL AND @telefono IS NULL THEN
			CALL INSERTA_TELEFONO(p_tipo, p_cod_area, p_numero,	@id_telefono);
			UPDATE personas SET id_telefono = @id_telefono WHERE id_persona = @id_p;
		END IF;

		IF @correo IS NOT NULL THEN
			UPDATE correos SET direccion_correo = p_direccion_correo WHERE id_correo = @correo;
		END IF;	

		IF @persona IS NOT NULL AND @correo IS NULL THEN 
			CALL INSERTA_CORREO(p_direccion_correo,	@id_correo);
			UPDATE personas SET id_correo = @id_correo WHERE id_persona = @id_p;
		END IF;	

		IF @emple IS NOT NULL THEN
      		UPDATE empleados SET cargo = p_cargo, fecha_ingreso = p_fecha_ingreso, eliminado = '0' WHERE id_empleado = @emple;
      	ELSE
      		INSERT INTO empleados VALUES (@id_p, p_cargo, p_fecha_ingreso, NULL, NULL, '0');
      		SET @emple = (SELECT id_empleado FROM empleados WHERE id_empleado = @id_p);
      	END IF;
      			
		SELECT @emple INTO id_emple;
	END$$
DELIMITER ;


DROP PROCEDURE IF EXISTS INSERTA_USUARIO;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE INSERTA_USUARIO(
			
			`p_id_empleado` INT,
			`p_usuario` VARCHAR(20),
			`p_password` VARCHAR(100),
			`p_id_rol` INT,
			OUT id_user INT)

	BEGIN
		SET @id_user = NULL;
		SET @id_emple = (SELECT id_empleado FROM empleados WHERE id_empleado = p_id_empleado);

		IF @id_emple IS NOT NULL THEN
			INSERT INTO usuarios VALUES (NULL, p_usuario, p_password, NULL, p_id_rol, NULL);
			SET @id_user = (SELECT last_insert_id());
      		UPDATE empleados SET id_usuario = @id_user WHERE id_empleado = @id_emple;
      	END IF;
      			
		SELECT @id_user INTO id_user;
	END$$
DELIMITER ;


DROP PROCEDURE IF EXISTS INSERTA_FULL_PROVEEDOR;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE INSERTA_FULL_PROVEEDOR(
			p_tipo_rif enum('V', 'E', 'P', 'G', 'J'),
			`p_rif` INT(9),
			`p_nombre` varchar(50), 
			p_cod_postal int,
			p_sector varchar(50),
			p_calle varchar(50),
			p_ca_edf varchar(8),
			p_n_vivienda varchar(10),
			p_pto_ref varchar(100),
			p_id_parroquia int(11),
			p_tipo varchar(10),
			p_cod_area INT,
			p_numero INT,
			p_direccion_correo varchar(80),
			p_id_empresa INT, OUT id_provee INT)

	BEGIN
		SET @id_provee = NULL;
		SET @id_direccion = NULL;
		SET @id_telefono = NULL;
		SET @id_correo = NULL;

		SET @proveedor = (SELECT id_proveedor FROM proveedores where tipo_rif = p_tipo_rif AND rif = p_rif);

		IF p_sector IS NOT NULL AND @proveedor IS NULL THEN
		CALL INSERTA_DIRECCION(p_cod_postal, p_sector, p_calle,
							 p_ca_edf, p_n_vivienda, p_pto_ref, 
							 p_id_parroquia, @id_direccion);
		END IF;

		IF p_cod_area IS NOT NULL AND p_numero IS NOT NULL AND @proveedor IS NULL THEN
			CALL INSERTA_TELEFONO(p_tipo, p_cod_area, p_numero,	@id_telefono);
		END IF;

		IF p_direccion_correo IS NOT NULL AND @proveedor IS NULL THEN 
			CALL INSERTA_CORREO(p_direccion_correo,	@id_correo);
		END IF;	

		IF @proveedor IS NULL THEN
		 INSERT INTO proveedores VALUES (NULL, p_tipo_rif, p_rif, p_nombre, @id_direccion, @id_telefono, 
		 								@id_correo, p_id_empresa, NULL);
		SET @provee = (SELECT last_insert_id());
		ELSE
			SET @provee = @proveedor;
		END IF;	
      			
		SELECT @provee INTO id_provee;
	END$$
DELIMITER ;


DROP PROCEDURE IF EXISTS INSERTA_CATEGORIA;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE INSERTA_CATEGORIA(p_nombre VARCHAR(20), 
																p_descripcion VARCHAR(50),
																OUT id_categoria INT)

	BEGIN
		SET @id_categoria = NULL;

		IF p_nombre IS NOT NULL AND p_descripcion IS NOT NULL THEN 
			INSERT INTO categorias VALUES(NULL, p_nombre, p_descripcion);
			SET @id_categoria = (SELECT last_insert_id());
		END IF;

		SELECT @id_categoria INTO id_categoria;
	END$$
DELIMITER ;


DROP PROCEDURE IF EXISTS INSERTA_SUMINISTRO;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE INSERTA_SUMINISTRO(p_codigo BIGINT, 
																p_nombre VARCHAR(30), 
																p_descripcion VARCHAR(50), 
																p_imagen VARCHAR(80),
																p_id_categoria INT,
																OUT id_suministro INT)

	BEGIN
		SET @id_suministro = NULL;

		IF p_nombre IS NOT NULL AND p_id_categoria IS NOT NULL THEN 
			INSERT INTO suministros VALUES(NULL, p_codigo, p_nombre, p_descripcion, p_imagen, NULL, p_id_categoria);
			SET @id_suministro = (SELECT last_insert_id());
		END IF;

		SELECT @id_suministro INTO id_suministro;
	END$$
DELIMITER ;


DROP PROCEDURE IF EXISTS INSERTA_PRODUCTO;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE INSERTA_PRODUCTO(p_nombre VARCHAR(30), 
																p_descripcion VARCHAR(50), 
																p_imagen VARCHAR(80),
																p_precio_usd DECIMAL(10,2) unsigned,
																p_id_categoria INT,
																OUT id_producto INT)

	BEGIN
		SET @id_producto = NULL;

		IF p_nombre IS NOT NULL AND p_id_categoria IS NOT NULL AND p_precio_usd IS NOT NULL THEN 
			INSERT INTO productos VALUES (NULL, p_nombre, p_descripcion, p_imagen, p_precio_usd, NULL, NULL, p_id_categoria, '0');
			SET @id_producto = (SELECT last_insert_id());
		END IF;

		SELECT @id_producto INTO id_producto;
	END$$
DELIMITER ;




DROP PROCEDURE IF EXISTS SET_PREGUNTAS_USER;
	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE `SET_PREGUNTAS_USER`(p_p1 varchar(30),
															  p_p2 varchar(30),
															  p_p3 varchar(30),
															  p_r1 varchar(30),
															  p_r2 varchar(30),
															  p_r3 varchar(30),
															  p_id_usuario INT, 
															  OUT p_id_recovery int (11))
	BEGIN
		SET @id_recovery = NULL;

		IF p_id_usuario IS NOT NULL AND p_p1 IS NOT NULL AND p_p2 IS NOT NULL AND p_p3 IS NOT NULL
		AND p_r1 IS NOT NULL AND p_r2 IS NOT NULL AND p_r3 IS NOT NULL THEN
			INSERT INTO recuperarpassword VALUES (NULL, p_p1, p_p2, p_p3, p_r1, p_r2, p_r3, p_id_usuario);
			SET @id_recovery = (SELECT last_insert_id());
		END IF;

		
		IF @id_recovery IS NOT NULL THEN
			SELECT @id_recovery INTO p_id_recovery;
		END IF;

	END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS RESET_PREGUNTAS_USER;
	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE `RESET_PREGUNTAS_USER`(`p_id_user` INT, p_password VARCHAR(120))
	BEGIN
		DELETE FROM recuperarpassword WHERE id_usuario = p_id_user;

		UPDATE usuarios SET password = p_password WHERE id_usuario = p_id_user;
	END $$
DELIMITER ;




DROP PROCEDURE IF EXISTS LISTA_USUARIOS;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE LISTA_USUARIOS()

	BEGIN
		SELECT u.id_usuario as "idUsuario", u.usuario as "usuario", r.nombre as "rol",
		CASE WHEN rc.id_recovery IS NOT NULL THEN 'true' WHEN rc.id_recovery IS NULL THEN 'false' END AS 'status',
		rc.id_recovery
		FROM usuarios u
		JOIN roles r ON u.id_rol = r.id_rol
		LEFT JOIN recuperarpassword rc ON u.id_usuario = rc.id_usuario;
		
	END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS LISTA_EMPLEADOS;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE LISTA_EMPLEADOS()

	BEGIN
		SELECT e.id_empleado as "idEmpleado", CONCAT(p.tipo_ci, '-', p.ci) as "ci", 
		CONCAT (p.nombre1, ' ', COALESCE(p.nombre2,''),' ', COALESCE(p.nombre3,''), p.apellido1, ' ', COALESCE(p.apellido2, '')) as "nombre",
		DATE_FORMAT(p.fecha_nac,"%d de %M de %Y") as "fn",CASE WHEN p.sexo = 'M' THEN 'Masculino' WHEN p.sexo = 'F' THEN 'Femenino' END as "sexo",
		CASE WHEN p.edo_civil = 'S' THEN 'Soltero' WHEN p.edo_civil = 'C' THEN 'Casado' WHEN p.edo_civil = 'V' THEN 'Viudo' END as "edoCivil",
		CONCAT(edad_fn_fs(p.fecha_nac, CURRENT_DATE), ' años') as "edad", CASE WHEN DATE_FORMAT(p.fecha_nac, '%m-%d') = DATE_FORMAT(CURRENT_DATE, '%m-%d') THEN 'yes' WHEN DATE_FORMAT(p.fecha_nac, '%m-%d') != DATE_FORMAT(CURRENT_DATE, '%m-%d') THEN 'no' END as "birthday",
		CASE WHEN pa.id_parroquia IS NULL THEN 'No posee' WHEN pa.id_parroquia IS NOT NULL THEN CONCAT(d.calle,' ', d.ca_edf,' ', CASE WHEN d.n_vivienda = '0' THEN 'S/N' WHEN d.n_vivienda != '0' THEN d.n_vivienda END,' ', d.sector, ', ', pa.nombre_parroquia, ', ', m.nombre_municipio, ', ', es.nombre_estado) END as "direccion",		
		e.cargo as "cargo", DATE_FORMAT(e.fecha_ingreso,"%d de %M de %Y") as "fechaIngreso",
		CASE WHEN t.cod_area IS NOT NULL THEN CONCAT(t.cod_area, '-', t.numero) WHEN t.cod_area IS NULL THEN 'No posee' END as "tel",
		CASE WHEN c.direccion_correo IS NOT NULL THEN c.direccion_correo WHEN c.direccion_correo IS NULL THEN 'No posee' END as "correo",
		CASE WHEN u.id_usuario IS NULL THEN 'false' WHEN u.id_usuario IS NOT NULL THEN 'true' END as 'tieneUser',
		u.usuario as "username"
		FROM personas p
		JOIN empleados e ON p.id_persona = e.id_empleado
		LEFT JOIN direcciones d ON p.id_direccion = d.id_direccion
		LEFT JOIN parroquias pa ON pa.id_parroquia = d.id_parroquia
		LEFT JOIN municipios m ON m.id_municipio = pa.id_municipio
		LEFT JOIN estados es ON es.id_estado = m.id_estado
		LEFT JOIN correos c ON p.id_correo = c.id_correo
		LEFT JOIN telefonos t ON p.id_telefono = t.id_telefono
		LEFT JOIN usuarios u ON u.id_usuario = e.id_usuario WHERE e.eliminado = '0';
		
	END$$
DELIMITER ;


DROP PROCEDURE IF EXISTS LISTA_SUMINISTROS;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE LISTA_SUMINISTROS()

	BEGIN
		SELECT s.id_suministro as idSuministro,s.codigo as codSuministro, s.nombre as nombreSuministro, s.descripcion as descripSuministro, 
		s.imagen as imagenSuministro,c.nombre as categoriaSuministro
		FROM suministros s 
		JOIN categorias c WHERE s.id_categoria = c.id_categoria;
		
	END$$
DELIMITER ;


DROP PROCEDURE IF EXISTS LISTA_PROVEEDORES;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE LISTA_PROVEEDORES()

	BEGIN
		SELECT p.id_proveedor as idProveedor, CONCAT(p.tipo_rif, "-", p.rif) as rifProveedor, p.nombre as nombreProveedor, CONCAT(DATE_FORMAT(p.fecha_in, "%d de %M de %Y "), TIME_FORMAT(p.fecha_in, "%I:%i %p")) as fechaIngresoProvee,
		CASE WHEN pa.id_parroquia IS NULL THEN 'No posee' WHEN pa.id_parroquia IS NOT NULL THEN CONCAT(d.calle,' ', d.ca_edf,' ', CASE WHEN d.n_vivienda = '0' THEN 'S/N' WHEN d.n_vivienda != '0' THEN d.n_vivienda END,' ', d.sector, ', ', pa.nombre_parroquia, ', ', m.nombre_municipio, ', ', es.nombre_estado) END as "direccionProveedor",		
		CASE WHEN t.cod_area IS NOT NULL THEN CONCAT(t.cod_area, '-', t.numero) WHEN t.cod_area IS NULL THEN 'No posee' END as "telProveedor",
		CASE WHEN c.direccion_correo IS NOT NULL THEN c.direccion_correo WHEN c.direccion_correo IS NULL THEN 'No posee' END as "correoProveedor"
		FROM proveedores as p
		LEFT JOIN direcciones as d ON p.id_direccion = d.id_direccion
		LEFT JOIN parroquias as pa ON d.id_parroquia = pa.id_parroquia
		LEFT JOIN municipios as m ON pa.id_municipio = m.id_municipio
		LEFT JOIN estados as es ON m.id_estado = es.id_estado
		LEFT JOIN telefonos as t ON p.id_telefono = t.id_telefono
		LEFT JOIN correos as c ON p.id_correo = c.id_correo;
		
	END$$
DELIMITER ;


DROP PROCEDURE IF EXISTS LISTA_PRODUCTOS;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE LISTA_PRODUCTOS()

	BEGIN
		SELECT p.id_producto as idProducto, p.nombre as nombreProducto, p.descripcion as descripProducto, p.imagen as imagenProducto, 
		p.precio_usd as precioUsd, ROUND(tc.valor*p.precio_usd,2) as precioBs ,p.id_categoria as idCategoria, c.nombre as categoriaProducto,
		CONCAT(DATE_FORMAT(p.fecha_in, "%d de %M de %Y "), TIME_FORMAT(p.fecha_in, "%I:%i %p")) as fechaIngreso,  
		CONCAT(DATE_FORMAT(p.fecha_up, "%d de %M de %Y "), TIME_FORMAT(p.fecha_up, "%I:%i %p")) as fechaUpdated  
		FROM productos p  
		INNER JOIN categorias c ON p.id_categoria = c.id_categoria 
		RIGHT JOIN tasas_cambio tc ON 1=1 
		WHERE p.eliminado = '0';
		
	END$$
DELIMITER ;




DROP PROCEDURE IF EXISTS HISTORIAL_COMPRAS_SUMINISTROS;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE HISTORIAL_COMPRAS_SUMINISTROS()

	BEGIN
		SELECT p.id_proveedor as idProveedor, UPPER(p.nombre) as nombreProveedor, s.id_suministro as idSuministro, s.nombre as nombreSuministro, 
		DATE_FORMAT(pap.fecha_compra, "%d de %M de %Y") as fechaAbasto, pap.cantidad as cantidadAbasto, pap.pagado_bs as pagadoBs, pap.pagado_usd as pagadoUsd
		FROM suministros s
		JOIN proveedores_abastecen_suministros pap ON s.id_suministro = pap.id_suministro
		JOIN proveedores p ON pap.id_proveedor = p.id_proveedor ORDER BY pap.fecha_compra DESC;
		
	END$$
DELIMITER ;


DROP PROCEDURE IF EXISTS COMPROBANTE_LISTA_SUMINISTROS;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE COMPROBANTE_LISTA_SUMINISTROS(p_id_proveedor int,
																			  p_fecha_compra date)

	BEGIN
		SELECT s.nombre as nombreSuministro, CONCAT(' ', p.tipo_rif, '-', p.rif,' ',upper(p.nombre))  as nombreRifProveedor,
		pap.cantidad as cantidadAbasto, pap.pagado_bs as pagadoBs, pap.pagado_usd as pagadoUsd
		FROM suministros s
		JOIN proveedores_abastecen_suministros pap ON s.id_suministro = pap.id_suministro
		JOIN proveedores p ON pap.id_proveedor = p.id_proveedor 
		WHERE pap.id_proveedor = p_id_proveedor AND pap.fecha_compra = p_fecha_compra;
		
	END$$
DELIMITER ;



DROP PROCEDURE IF EXISTS COMPROBANTE_TOTAL_SUMINISTROS;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE COMPROBANTE_TOTAL_SUMINISTROS(p_id_proveedor int,
																			  p_fecha_compra date)

	BEGIN
		SELECT SUM(pap.cantidad) as totalCantidad, SUM(pap.pagado_bs) as totalPagadoBs, SUM(pap.pagado_usd) as totalPagadoUsd
		FROM suministros s
		JOIN proveedores_abastecen_suministros pap ON s.id_suministro = pap.id_suministro
		JOIN proveedores p ON pap.id_proveedor = p.id_proveedor 
		WHERE pap.id_proveedor = p_id_proveedor AND pap.fecha_compra = p_fecha_compra;
		
	END$$
DELIMITER ;



DROP PROCEDURE IF EXISTS ESTADISTICAS_EMPLEADOS;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE ESTADISTICAS_EMPLEADOS()

	BEGIN
		SELECT COUNT(e.id_empleado) AS "empleadosTotales", COUNT( CASE WHEN p.sexo = 'M' THEN 1 END) as "empleadosMasculinos", 
		COUNT( CASE WHEN p.sexo = 'F' THEN 1 END) as "empleadosFemeninos", 
		ROUND(AVG(edad_fn_fs(p.fecha_nac, CURRENT_DATE)),0) as "promedioEdad"
		FROM personas p 
		INNER JOIN empleados e ON p.id_persona = e.id_empleado
		LEFT JOIN usuarios u ON e.id_usuario = u.id_usuario WHERE e.eliminado = '0';			
		
	END$$
DELIMITER ;


DROP PROCEDURE IF EXISTS ESTADISTICAS_USUARIOS;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE ESTADISTICAS_USUARIOS()

	BEGIN
		SELECT COUNT(u.id_usuario) AS "usersTotales", COUNT( CASE WHEN u.id_rol = 1 THEN 1 END) as "userAdmins", 
		COUNT( CASE WHEN u.id_rol = 2 THEN 1 END) as "usersAsist"
		FROM usuarios u;			
		
	END$$
DELIMITER ;



DROP PROCEDURE IF EXISTS ESTADISTICAS_SUMINISTROS;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE ESTADISTICAS_SUMINISTROS()

	BEGIN
		SELECT COUNT(s.id_suministro) as totalSuministros, COUNT(DISTINCT c.id_categoria) as totalCategorias
		FROM suministros  as s
		RIGHT JOIN categorias as c ON s.id_categoria = c.id_categoria;			
		
	END$$
DELIMITER ;


DROP PROCEDURE IF EXISTS ESTADISTICAS_PROVEEDORES;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE ESTADISTICAS_PROVEEDORES()

	BEGIN
		SELECT COUNT(p.id_proveedor) as totalProveedores FROM proveedores as p;			
		
	END$$
DELIMITER ;


DROP PROCEDURE IF EXISTS ESTADISTICAS_PRODUCTOS;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE ESTADISTICAS_PRODUCTOS()

	BEGIN
		SELECT COUNT(DISTINCT p.id_producto) as totalProductos, COUNT(DISTINCT c.id_categoria) as totalCategorias, tc.valor as tasaActual
		FROM categorias c
		LEFT JOIN productos p ON c.id_categoria = p.id_categoria AND p.eliminado = '0'
		CROSS JOIN tasas_cambio tc;			
		
	END$$
DELIMITER ;



DROP PROCEDURE IF EXISTS DETALLES_EMPLEADO;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE DETALLES_EMPLEADO(p_id_empleado int(11))

	BEGIN
		SELECT e.id_empleado as "idEmpleado", CONCAT(p.tipo_ci, '-', p.ci) as "ci", 
		CONCAT (p.nombre1, ' ', COALESCE(p.nombre2,''),' ', COALESCE(p.nombre3,''), p.apellido1, ' ', COALESCE(p.apellido2, '')) as "nombre",
		DATE_FORMAT(p.fecha_nac,"%d de %M de %Y") as "fn",CASE WHEN p.sexo = 'M' THEN 'Masculino' WHEN p.sexo = 'F' THEN 'Femenino' END as "sexo",
		CASE WHEN p.edo_civil = 'S' THEN 'Soltero' WHEN p.edo_civil = 'C' THEN 'Casado' WHEN p.edo_civil = 'V' THEN 'Viudo' END as "edoCivil",
		CONCAT(edad_fn_fs(p.fecha_nac, CURRENT_DATE), ' años') as "edad",
		CASE WHEN pa.id_parroquia IS NULL THEN 'No posee' WHEN pa.id_parroquia IS NOT NULL THEN CONCAT(d.calle,' ', d.ca_edf,' ', CASE WHEN d.n_vivienda = '0' THEN 'S/N' WHEN d.n_vivienda != '0' THEN d.n_vivienda END,' ', d.sector, ', ', pa.nombre_parroquia, ', ', m.nombre_municipio, ', ', es.nombre_estado) END as "direccion",		
		e.cargo as "cargo", DATE_FORMAT(e.fecha_ingreso,"%d de %M de %Y") as "fechaIngreso",
		CASE WHEN t.cod_area IS NOT NULL THEN CONCAT(t.cod_area, '-', t.numero) WHEN t.cod_area IS NULL THEN 'No posee' END as "tel",
		CASE WHEN c.direccion_correo IS NOT NULL THEN c.direccion_correo WHEN c.direccion_correo IS NULL THEN 'No posee' END as "correo",
		CASE WHEN u.id_usuario IS NULL THEN 'false' WHEN u.id_usuario IS NOT NULL THEN 'true' END as 'tieneUser',
		u.usuario as "username", u.avatar, r.nombre as "rol"
		FROM personas p
		JOIN empleados e ON p.id_persona = e.id_empleado
		LEFT JOIN direcciones d ON p.id_direccion = d.id_direccion
		LEFT JOIN parroquias pa ON pa.id_parroquia = d.id_parroquia
		LEFT JOIN municipios m ON m.id_municipio = pa.id_municipio
		LEFT JOIN estados es ON es.id_estado = m.id_estado
		LEFT JOIN correos c ON p.id_correo = c.id_correo
		LEFT JOIN telefonos t ON p.id_telefono = t.id_telefono
		LEFT JOIN usuarios u ON u.id_usuario = e.id_usuario 
		JOIN roles r ON u.id_rol = r.id_rol WHERE e.eliminado = '0' AND e.id_empleado = p_id_empleado;
	END$$
DELIMITER ;



DROP PROCEDURE IF EXISTS CONSULTA_USUARIO;


	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE CONSULTA_USUARIO(p_id_user int(11))

	BEGIN
		SELECT u.usuario as "userName", u.avatar as "userPic", r.nombre as "rol", u.fecha_IN as "dateIN",
		rp.pregunta1 as "q1", rp.pregunta2 as "q2", rp.pregunta3 as "q3",
		rp.respuesta1 as "a1", rp.respuesta2 as "a2", rp.respuesta3 as "a3"  
		FROM usuarios u
		JOIN roles r ON u.id_rol = r.id_rol
		JOIN recuperarpassword rp ON u.id_usuario= rp.id_usuario
		WHERE u.id_usuario = p_id_user;
	END$$
DELIMITER ;





DROP PROCEDURE IF EXISTS ELIMINA_EMPLEADO;
	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE `ELIMINA_EMPLEADO`(IN `p_id_empleado` INT)
	BEGIN
		SET @user = (SELECT id_usuario FROM empleados WHERE id_empleado = p_id_empleado);
		UPDATE empleados SET eliminado = '1' WHERE id_empleado = p_id_empleado;

		IF @user IS NOT NULL THEN
			DELETE FROM usuarios WHERE id_usuario = @user;
		END IF;
	END $$
DELIMITER ;




DROP PROCEDURE IF EXISTS UP_TELEFONO_USER;
	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE `UP_TELEFONO_USER`(`p_id_persona` int(11),
																	    p_tipo char(1),
																		p_cod_area int(4),
																		p_numero int(7),
																		OUT p_id_telefono int(11))
	BEGIN
		SET @id_telefono = (SELECT id_telefono FROM personas WHERE id_persona = p_id_persona);

		IF @id_telefono IS NULL THEN
			CALL INSERTA_TELEFONO(p_tipo, p_cod_area, p_numero, @id_telefono);
			UPDATE personas SET id_telefono = @id_telefono WHERE id_persona = p_id_persona;
		ELSE
			UPDATE telefonos SET tipo = p_tipo, cod_area = p_cod_area, numero = p_numero WHERE id_telefono = @id_telefono;
		END IF;

		SELECT @id_telefono INTO p_id_telefono;
	END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS UP_CORREO_USER;
	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE `UP_CORREO_USER`(`p_id_persona` int(11),
																	p_direccion_correo varchar(100),
																	OUT p_id_correo int(11))
	BEGIN
		SET @id_correo = (SELECT id_correo FROM personas WHERE id_persona = p_id_persona);

		IF @id_correo IS NULL THEN
			CALL INSERTA_CORREO(p_direccion_correo, @id_correo);
			UPDATE personas SET id_correo = @id_correo WHERE id_persona = p_id_persona;
		ELSE
			UPDATE correos SET direccion_correo = p_direccion_correo WHERE id_correo = @id_correo;
		END IF;

		SELECT @id_correo INTO p_id_correo;
	END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS UP_DIRECCION_USER;
	DELIMITER $$
	CREATE DEFINER=`root`@`localhost` PROCEDURE `UP_DIRECCION_USER`(`p_id_persona` int(11),
																	  p_cod_postal int,
																	  p_sector varchar(50),
																	  p_calle varchar(50),
																	  p_ca_edf varchar(8),
																	  p_n_vivienda varchar(5),
																	  p_pto_ref varchar(100),
																	  p_id_parroquia int(11),
																	  OUT p_id_address int(11))
	BEGIN
		SET @address = (SELECT id_direccion FROM direcciones WHERE id_direccion = (SELECT id_direccion FROM personas WHERE id_persona = p_id_persona));

		IF @address IS NULL THEN
			CALL INSERTA_DIRECCION(p_cod_postal, p_sector, p_calle, p_ca_edf, p_n_vivienda, p_pto_ref, p_id_parroquia, @id_address);
			SET @address = @id_address;
			UPDATE personas SET id_direccion = @id_address WHERE id_persona = p_id_persona;
		ELSE
			UPDATE direcciones SET cod_postal = p_cod_postal, sector = p_sector, calle = p_calle, ca_edf = p_ca_edf, n_vivienda = p_n_vivienda, pto_ref = p_pto_ref, id_parroquia = p_id_parroquia WHERE id_direccion = @address;
		END IF;

		SELECT @address INTO p_id_address;
	END $$
DELIMITER ;
