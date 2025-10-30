-- Inicialización de la base de datos para Sistema POS
-- Este script se ejecutará automáticamente al crear el contenedor

-- Crear base de datos si no existe
CREATE DATABASE IF NOT EXISTS `sales1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `sales1`;

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.cajas
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cajas` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `monto_inicial` decimal(10, 2) NOT NULL,
    `fecha_apertura` datetime NOT NULL,
    `fecha_cierre` datetime DEFAULT NULL,
    `compras` decimal(10, 2) NOT NULL DEFAULT '0.00',
    `gastos` decimal(10, 2) NOT NULL DEFAULT '0.00',
    `ventas` decimal(10, 2) NOT NULL DEFAULT '0.00',
    `estado` int NOT NULL DEFAULT '1',
    `id_usuario` bigint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `cajas_id_usuario_foreign` (`id_usuario`)
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.cajas
INSERT INTO
    `cajas` (
        `id`,
        `monto_inicial`,
        `fecha_apertura`,
        `fecha_cierre`,
        `compras`,
        `gastos`,
        `ventas`,
        `estado`,
        `id_usuario`,
        `created_at`,
        `updated_at`
    )
VALUES (
        2,
        10000.00,
        '2025-10-18 13:44:59',
        '2025-10-18 14:00:47',
        6020.00,
        0.00,
        4060.00,
        0,
        1,
        '2025-10-18 18:44:59',
        '2025-10-18 19:00:47'
    ),
    (
        3,
        5000.00,
        '2025-10-18 14:01:26',
        '2025-10-18 14:02:32',
        0.00,
        0.00,
        2185.00,
        0,
        5,
        '2025-10-18 19:01:26',
        '2025-10-18 19:02:32'
    ),
    (
        4,
        10000.00,
        '2025-10-18 14:03:54',
        '2025-10-18 14:08:23',
        1600.00,
        0.00,
        0.00,
        0,
        5,
        '2025-10-18 19:03:54',
        '2025-10-18 19:08:23'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.categorias
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `categorias` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 11 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.categorias
INSERT INTO
    `categorias` (
        `id`,
        `nombre`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'Electrónica',
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        2,
        'Ropa',
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        3,
        'Hogar',
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        4,
        'Alimentos',
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        5,
        'Salud y Belleza',
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        6,
        'Electrónica',
        '2025-10-05 00:13:44',
        '2025-10-05 00:13:44'
    ),
    (
        7,
        'Ropa',
        '2025-10-05 00:13:44',
        '2025-10-05 00:13:44'
    ),
    (
        8,
        'Hogar',
        '2025-10-05 00:13:44',
        '2025-10-05 00:13:44'
    ),
    (
        9,
        'Alimentos',
        '2025-10-05 00:13:44',
        '2025-10-05 00:13:44'
    ),
    (
        10,
        'Salud y Belleza',
        '2025-10-05 00:13:44',
        '2025-10-05 00:13:44'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.clientes
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `clientes` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `ruc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `telefono` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
    `correo` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `credito` decimal(10, 2) NOT NULL DEFAULT '0.00',
    `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 7 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.clientes
INSERT INTO
    `clientes` (
        `id`,
        `ruc`,
        `nombre`,
        `telefono`,
        `correo`,
        `credito`,
        `direccion`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        '12345678901',
        'Empresa ABC S.A.',
        '987654321',
        'contacto@empresaabc.com',
        5000.00,
        'Av. Principal 123, Lima',
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        2,
        '98765432109',
        'Comercial XYZ S.R.L.',
        '912345678',
        'ventas@comercialxyz.com',
        3000.00,
        'Calle Secundaria 456, Arequipa',
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        3,
        '56789012345',
        'Servicios Rápidos E.I.R.L.',
        '956789012',
        'info@serviciosrapidos.com',
        7000.00,
        'Jr. Industrial 789, Cusco',
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        4,
        '12345678901',
        'Empresa ABC S.A.',
        '987654321',
        'contacto@empresaabc.com',
        5000.00,
        'Av. Principal 123, Lima',
        '2025-10-05 00:13:44',
        '2025-10-05 00:13:44'
    ),
    (
        5,
        '98765432109',
        'Comercial XYZ S.R.L.',
        '912345678',
        'ventas@comercialxyz.com',
        3000.00,
        'Calle Secundaria 456, Arequipa',
        '2025-10-05 00:13:44',
        '2025-10-05 00:13:44'
    ),
    (
        6,
        '56789012345',
        'Servicios Rápidos E.I.R.L.',
        '956789012',
        'info@serviciosrapidos.com',
        7000.00,
        'Jr. Industrial 789, Cusco',
        '2025-10-05 00:13:44',
        '2025-10-05 00:13:44'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.compania
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `compania` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `telefono` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
    `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 8 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.compania
INSERT INTO
    `compania` (
        `id`,
        `nombre`,
        `correo`,
        `telefono`,
        `direccion`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'Extreme Code',
        'Ex_code@gmail.com',
        '6161-3075',
        'Panama',
        '2025-10-04 23:47:55',
        '2025-10-15 01:29:19'
    ),
    (
        2,
        'SISTEMAS FREE',
        'info@gmail.com',
        '987896543',
        'Perú',
        '2025-10-04 23:49:56',
        '2025-10-04 23:49:56'
    ),
    (
        3,
        'SISTEMAS FREE',
        'info@gmail.com',
        '987896543',
        'Perú',
        '2025-10-04 23:58:36',
        '2025-10-04 23:58:36'
    ),
    (
        4,
        'SISTEMAS FREE',
        'info@gmail.com',
        '987896543',
        'Perú',
        '2025-10-05 00:06:46',
        '2025-10-05 00:06:46'
    ),
    (
        5,
        'SISTEMAS FREE',
        'info@gmail.com',
        '987896543',
        'Perú',
        '2025-10-05 00:08:07',
        '2025-10-05 00:08:07'
    ),
    (
        6,
        'SISTEMAS FREE',
        'info@gmail.com',
        '987896543',
        'Perú',
        '2025-10-05 00:09:02',
        '2025-10-05 00:09:02'
    ),
    (
        7,
        'SISTEMAS FREE',
        'info@gmail.com',
        '987896543',
        'Perú',
        '2025-10-05 00:13:43',
        '2025-10-05 00:13:43'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.compras
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `compras` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `total` decimal(10, 2) NOT NULL,
    `estado` int NOT NULL DEFAULT '1',
    `id_proveedor` bigint unsigned NOT NULL,
    `id_caja` bigint unsigned NOT NULL,
    `id_usuario` bigint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `compras_id_proveedor_foreign` (`id_proveedor`),
    KEY `compras_id_caja_foreign` (`id_caja`),
    KEY `compras_id_usuario_foreign` (`id_usuario`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.compras
INSERT INTO
    `compras` (
        `id`,
        `total`,
        `estado`,
        `id_proveedor`,
        `id_caja`,
        `id_usuario`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        6020.00,
        2,
        3,
        2,
        1,
        '2025-10-18 18:51:02',
        '2025-10-18 19:00:47'
    ),
    (
        2,
        1600.00,
        2,
        1,
        4,
        5,
        '2025-10-18 19:06:09',
        '2025-10-18 19:08:23'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.cotizaciones
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cotizaciones` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `total` decimal(10, 2) NOT NULL,
    `id_cliente` bigint unsigned NOT NULL,
    `id_usuario` bigint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `cotizaciones_id_cliente_foreign` (`id_cliente`),
    KEY `cotizaciones_id_usuario_foreign` (`id_usuario`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.cotizaciones
INSERT INTO
    `cotizaciones` (
        `id`,
        `total`,
        `id_cliente`,
        `id_usuario`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        1580.00,
        3,
        1,
        '2025-10-15 01:26:58',
        '2025-10-15 01:26:58'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.detallecompra
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `detallecompra` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `precio` decimal(10, 2) NOT NULL,
    `cantidad` int NOT NULL,
    `id_producto` bigint unsigned NOT NULL,
    `id_compra` bigint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `detallecompra_id_compra_foreign` (`id_compra`),
    KEY `detallecompra_id_producto_foreign` (`id_producto`)
) ENGINE = InnoDB AUTO_INCREMENT = 7 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.detallecompra
INSERT INTO
    `detallecompra` (
        `id`,
        `precio`,
        `cantidad`,
        `id_producto`,
        `id_compra`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        20.00,
        1,
        10,
        1,
        '2025-10-18 18:51:02',
        '2025-10-18 18:51:02'
    ),
    (
        2,
        2000.00,
        3,
        1,
        1,
        '2025-10-18 18:51:02',
        '2025-10-18 18:51:02'
    ),
    (
        3,
        20.00,
        2,
        10,
        2,
        '2025-10-18 19:06:09',
        '2025-10-18 19:06:09'
    ),
    (
        4,
        10.00,
        1,
        9,
        2,
        '2025-10-18 19:06:09',
        '2025-10-18 19:06:09'
    ),
    (
        5,
        1500.00,
        1,
        8,
        2,
        '2025-10-18 19:06:09',
        '2025-10-18 19:06:09'
    ),
    (
        6,
        50.00,
        1,
        7,
        2,
        '2025-10-18 19:06:09',
        '2025-10-18 19:06:09'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.detallecotizacion
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `detallecotizacion` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `precio` decimal(10, 2) NOT NULL,
    `cantidad` int NOT NULL,
    `id_producto` bigint unsigned NOT NULL,
    `id_cotizacion` bigint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `detallecotizacion_id_cotizacion_foreign` (`id_cotizacion`),
    KEY `detallecotizacion_id_producto_foreign` (`id_producto`)
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.detallecotizacion
INSERT INTO
    `detallecotizacion` (
        `id`,
        `precio`,
        `cantidad`,
        `id_producto`,
        `id_cotizacion`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        50.00,
        1,
        7,
        1,
        '2025-10-15 01:26:58',
        '2025-10-15 01:26:58'
    ),
    (
        2,
        1500.00,
        1,
        8,
        1,
        '2025-10-15 01:26:58',
        '2025-10-15 01:26:58'
    ),
    (
        3,
        10.00,
        1,
        9,
        1,
        '2025-10-15 01:26:58',
        '2025-10-15 01:26:58'
    ),
    (
        4,
        20.00,
        1,
        10,
        1,
        '2025-10-15 01:26:58',
        '2025-10-15 01:26:58'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.detalleventa
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `detalleventa` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `nombre_producto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `precio` decimal(10, 2) NOT NULL,
    `cantidad` int NOT NULL,
    `id_producto` bigint unsigned DEFAULT NULL,
    `id_venta` bigint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `detalleventa_id_venta_foreign` (`id_venta`),
    KEY `detalleventa_id_producto_foreign` (`id_producto`)
) ENGINE = InnoDB AUTO_INCREMENT = 14 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.detalleventa
INSERT INTO
    `detalleventa` (
        `id`,
        `nombre_producto`,
        `precio`,
        `cantidad`,
        `id_producto`,
        `id_venta`,
        `created_at`,
        `updated_at`
    )
VALUES (
        6,
        'Shampoo Pantene 500ml',
        30.00,
        1,
        10,
        2,
        '2025-10-18 18:46:28',
        '2025-10-18 18:46:28'
    ),
    (
        7,
        'Arroz 5kg',
        15.00,
        2,
        9,
        2,
        '2025-10-18 18:46:28',
        '2025-10-18 18:46:28'
    ),
    (
        8,
        'Sofá 3 plazas',
        2000.00,
        1,
        8,
        2,
        '2025-10-18 18:46:28',
        '2025-10-18 18:46:28'
    ),
    (
        9,
        'Sofá 3 plazas',
        2000.00,
        1,
        3,
        2,
        '2025-10-18 18:46:28',
        '2025-10-18 18:46:28'
    ),
    (
        10,
        'Shampoo Pantene 500ml',
        30.00,
        3,
        10,
        3,
        '2025-10-18 19:02:00',
        '2025-10-18 19:02:00'
    ),
    (
        11,
        'Arroz 5kg',
        15.00,
        1,
        9,
        3,
        '2025-10-18 19:02:00',
        '2025-10-18 19:02:00'
    ),
    (
        12,
        'Sofá 3 plazas',
        2000.00,
        1,
        8,
        3,
        '2025-10-18 19:02:01',
        '2025-10-18 19:02:01'
    ),
    (
        13,
        'Camiseta Nike',
        80.00,
        1,
        7,
        3,
        '2025-10-18 19:02:01',
        '2025-10-18 19:02:01'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.formas
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `formas` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.formas
INSERT INTO
    `formas` (
        `id`,
        `nombre`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'efectivo',
        '2025-10-18 18:32:45',
        '2025-10-18 18:32:45'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.migrations
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `migrations` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `batch` int NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 23 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.migrations
INSERT INTO
    `migrations` (`id`, `migration`, `batch`)
VALUES (
        1,
        '2014_10_12_000000_create_users_table',
        1
    ),
    (
        2,
        '2014_10_12_100000_create_password_reset_tokens_table',
        1
    ),
    (
        3,
        '2019_08_19_000000_create_failed_jobs_table',
        1
    ),
    (
        4,
        '2019_12_14_000001_create_personal_access_tokens_table',
        1
    ),
    (
        5,
        '2023_01_11_091745_create_formas_table',
        1
    ),
    (
        6,
        '2023_01_17_100711_create_cajas_table',
        1
    ),
    (
        7,
        '2023_11_17_161956_create_categoria_table',
        1
    ),
    (
        8,
        '2023_11_17_161956_create_cliente_table',
        1
    ),
    (
        9,
        '2023_11_17_161956_create_compania_table',
        1
    ),
    (
        10,
        '2023_11_17_161959_create_productos_table',
        1
    ),
    (
        11,
        '2023_11_17_161959_create_venta_table',
        1
    ),
    (
        12,
        '2023_11_22_161959_create_detalleventa_table',
        1
    ),
    (
        13,
        '2024_01_05_100657_create_proveedors_table',
        1
    ),
    (
        14,
        '2024_01_05_100724_create_compras_table',
        1
    ),
    (
        15,
        '2024_01_05_100733_create_cotizaciones_table',
        1
    ),
    (
        16,
        '2024_01_05_100752_create_detallecompra_table',
        1
    ),
    (
        17,
        '2024_01_05_100800_create_detallecotizacion_table',
        1
    ),
    (
        18,
        '2024_01_11_103611_create_creditoventas_table',
        1
    ),
    (
        19,
        '2024_01_11_104107_create_abonoventas_table',
        1
    ),
    (
        20,
        '2024_01_28_095703_create_gastos_table',
        1
    ),
    (
        21,
        '2024_01_28_211009_create_permission_tables',
        1
    ),
    (
        22,
        '2025_03_17_091302_create_movimiento_inventarios_table',
        1
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.movimiento_inventarios
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `movimiento_inventarios` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `id_producto` bigint unsigned DEFAULT NULL,
    `tipo_movimiento` enum('entrada', 'salida', 'ajuste') COLLATE utf8mb4_unicode_ci NOT NULL,
    `cantidad` int NOT NULL,
    `precio_unitario` decimal(10, 2) NOT NULL,
    `stock_anterior` int DEFAULT NULL,
    `stock_actual` int DEFAULT NULL,
    `fecha_movimiento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `origen` enum(
        'compra',
        'venta',
        'ajuste_manual'
    ) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `movimiento_inventarios_id_producto_foreign` (`id_producto`)
) ENGINE = InnoDB AUTO_INCREMENT = 20 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.movimiento_inventarios
INSERT INTO
    `movimiento_inventarios` (
        `id`,
        `id_producto`,
        `tipo_movimiento`,
        `cantidad`,
        `precio_unitario`,
        `stock_anterior`,
        `stock_actual`,
        `fecha_movimiento`,
        `origen`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        10,
        'salida',
        1,
        30.00,
        30,
        29,
        '2025-10-18 18:33:23',
        'venta',
        '2025-10-18 18:33:23',
        '2025-10-18 18:33:23'
    ),
    (
        2,
        9,
        'salida',
        1,
        15.00,
        100,
        99,
        '2025-10-18 18:33:23',
        'venta',
        '2025-10-18 18:33:23',
        '2025-10-18 18:33:23'
    ),
    (
        3,
        8,
        'salida',
        1,
        2000.00,
        5,
        4,
        '2025-10-18 18:33:23',
        'venta',
        '2025-10-18 18:33:23',
        '2025-10-18 18:33:23'
    ),
    (
        4,
        7,
        'salida',
        1,
        80.00,
        50,
        49,
        '2025-10-18 18:33:23',
        'venta',
        '2025-10-18 18:33:23',
        '2025-10-18 18:33:23'
    ),
    (
        5,
        3,
        'salida',
        1,
        2000.00,
        5,
        4,
        '2025-10-18 18:33:23',
        'venta',
        '2025-10-18 18:33:23',
        '2025-10-18 18:33:23'
    ),
    (
        6,
        10,
        'salida',
        1,
        30.00,
        28,
        27,
        '2025-10-18 18:46:28',
        'venta',
        '2025-10-18 18:46:28',
        '2025-10-18 18:46:28'
    ),
    (
        7,
        9,
        'salida',
        2,
        15.00,
        98,
        96,
        '2025-10-18 18:46:28',
        'venta',
        '2025-10-18 18:46:28',
        '2025-10-18 18:46:28'
    ),
    (
        8,
        8,
        'salida',
        1,
        2000.00,
        3,
        2,
        '2025-10-18 18:46:28',
        'venta',
        '2025-10-18 18:46:28',
        '2025-10-18 18:46:28'
    ),
    (
        9,
        3,
        'salida',
        1,
        2000.00,
        3,
        2,
        '2025-10-18 18:46:28',
        'venta',
        '2025-10-18 18:46:28',
        '2025-10-18 18:46:28'
    ),
    (
        10,
        10,
        'entrada',
        1,
        20.00,
        27,
        28,
        '2025-10-18 18:51:02',
        'compra',
        '2025-10-18 18:51:02',
        '2025-10-18 18:51:02'
    ),
    (
        11,
        1,
        'entrada',
        3,
        2000.00,
        10,
        13,
        '2025-10-18 18:51:02',
        'compra',
        '2025-10-18 18:51:02',
        '2025-10-18 18:51:02'
    ),
    (
        12,
        10,
        'salida',
        3,
        30.00,
        28,
        25,
        '2025-10-18 19:02:00',
        'venta',
        '2025-10-18 19:02:00',
        '2025-10-18 19:02:00'
    ),
    (
        13,
        9,
        'salida',
        1,
        15.00,
        96,
        95,
        '2025-10-18 19:02:00',
        'venta',
        '2025-10-18 19:02:00',
        '2025-10-18 19:02:00'
    ),
    (
        14,
        8,
        'salida',
        1,
        2000.00,
        2,
        1,
        '2025-10-18 19:02:01',
        'venta',
        '2025-10-18 19:02:01',
        '2025-10-18 19:02:01'
    ),
    (
        15,
        7,
        'salida',
        1,
        80.00,
        48,
        47,
        '2025-10-18 19:02:01',
        'venta',
        '2025-10-18 19:02:01',
        '2025-10-18 19:02:01'
    ),
    (
        16,
        10,
        'entrada',
        2,
        20.00,
        25,
        27,
        '2025-10-18 19:06:09',
        'compra',
        '2025-10-18 19:06:09',
        '2025-10-18 19:06:09'
    ),
    (
        17,
        9,
        'entrada',
        1,
        10.00,
        95,
        96,
        '2025-10-18 19:06:09',
        'compra',
        '2025-10-18 19:06:09',
        '2025-10-18 19:06:09'
    ),
    (
        18,
        8,
        'entrada',
        1,
        1500.00,
        1,
        2,
        '2025-10-18 19:06:09',
        'compra',
        '2025-10-18 19:06:09',
        '2025-10-18 19:06:09'
    ),
    (
        19,
        7,
        'entrada',
        1,
        50.00,
        47,
        48,
        '2025-10-18 19:06:09',
        'compra',
        '2025-10-18 19:06:09',
        '2025-10-18 19:06:09'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.permissions
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `permissions` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `permissions_name_guard_name_unique` (`name`, `guard_name`)
) ENGINE = InnoDB AUTO_INCREMENT = 64 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.permissions
INSERT INTO
    `permissions` (
        `id`,
        `name`,
        `guard_name`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'dashboard',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        2,
        'productos.index',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        3,
        'productos.create',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        4,
        'productos.edit',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        5,
        'productos.delete',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        6,
        'productos.reportes',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        7,
        'categorias.index',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        8,
        'categorias.edit',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        9,
        'categorias.create',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        10,
        'categorias.delete',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        11,
        'formas-pago.index',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        12,
        'formas-pago.create',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        13,
        'formas-pago.edit',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        14,
        'formas-pago.delete',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        15,
        'proveedores.index',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        16,
        'proveedores.create',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        17,
        'proveedores.edit',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        18,
        'proveedores.delete',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        19,
        'proveedores.reportes',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        20,
        'clientes.index',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        21,
        'clientes.create',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        22,
        'clientes.edit',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        23,
        'clientes.delete',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        24,
        'clientes.reportes',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        25,
        'usuarios.index',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        26,
        'usuarios.create',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        27,
        'usuarios.edit',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        28,
        'usuarios.delete',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        29,
        'gastos.index',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        30,
        'gastos.create',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        31,
        'gastos.edit',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        32,
        'gastos.delete',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        33,
        'gastos.reportes',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        34,
        'compania.update',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        35,
        'venta.index',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        36,
        'venta.show',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        37,
        'venta.anular',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        38,
        'venta.reportes',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        39,
        'creditoventa.index',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        40,
        'creditoventa.abonos',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        41,
        'creditoventa.reportes',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        42,
        'compra.index',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        43,
        'compra.show',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        44,
        'compra.anular',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        45,
        'compra.reportes',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        46,
        'cotizacion.index',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        47,
        'cotizacion.show',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        48,
        'cotizacion.eliminar',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        49,
        'cotizacion.reportes',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        50,
        'cajas.index',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        51,
        'cajas.create',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        52,
        'cajas.update',
        'web',
        '2025-10-04 23:47:56',
        '2025-10-04 23:47:56'
    ),
    (
        53,
        'cajas.reportes',
        'web',
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        54,
        'roles.update',
        'web',
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        55,
        'movimientos.index',
        'web',
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        56,
        'productos.firstOrCreate',
        'web',
        '2025-10-05 00:06:47',
        '2025-10-05 00:06:47'
    ),
    (
        57,
        'categorias.firstOrCreate',
        'web',
        '2025-10-05 00:06:47',
        '2025-10-05 00:06:47'
    ),
    (
        58,
        'formas-pago.firstOrCreate',
        'web',
        '2025-10-05 00:06:47',
        '2025-10-05 00:06:47'
    ),
    (
        59,
        'proveedores.firstOrCreate',
        'web',
        '2025-10-05 00:06:47',
        '2025-10-05 00:06:47'
    ),
    (
        60,
        'clientes.firstOrCreate',
        'web',
        '2025-10-05 00:06:47',
        '2025-10-05 00:06:47'
    ),
    (
        61,
        'usuarios.firstOrCreate',
        'web',
        '2025-10-05 00:06:47',
        '2025-10-05 00:06:47'
    ),
    (
        62,
        'gastos.firstOrCreate',
        'web',
        '2025-10-05 00:06:47',
        '2025-10-05 00:06:47'
    ),
    (
        63,
        'cajas.firstOrCreate',
        'web',
        '2025-10-05 00:06:47',
        '2025-10-05 00:06:47'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.productos
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `productos` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `codigo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    `producto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `precio_compra` decimal(10, 2) NOT NULL,
    `precio_venta` decimal(10, 2) NOT NULL,
    `stock` int NOT NULL DEFAULT '0',
    `foto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `id_categoria` bigint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `productos_id_categoria_foreign` (`id_categoria`)
) ENGINE = InnoDB AUTO_INCREMENT = 11 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.productos
INSERT INTO
    `productos` (
        `id`,
        `codigo`,
        `producto`,
        `precio_compra`,
        `precio_venta`,
        `stock`,
        `foto`,
        `id_categoria`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'PROD001',
        'Laptop HP 15"',
        2000.00,
        2500.00,
        13,
        NULL,
        1,
        '2025-10-04 23:47:57',
        '2025-10-18 18:51:02'
    ),
    (
        2,
        'PROD002',
        'Camiseta Nike',
        50.00,
        80.00,
        50,
        NULL,
        2,
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        3,
        'PROD003',
        'Sofá 3 plazas',
        1500.00,
        2000.00,
        2,
        NULL,
        3,
        '2025-10-04 23:47:57',
        '2025-10-18 18:46:28'
    ),
    (
        4,
        'PROD004',
        'Arroz 5kg',
        10.00,
        15.00,
        100,
        NULL,
        4,
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        5,
        'PROD005',
        'Shampoo Pantene 500ml',
        20.00,
        30.00,
        30,
        NULL,
        5,
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        6,
        'PROD001',
        'Laptop HP 15"',
        2000.00,
        2500.00,
        10,
        NULL,
        1,
        '2025-10-05 00:13:44',
        '2025-10-05 00:13:44'
    ),
    (
        7,
        'PROD002',
        'Camiseta Nike',
        50.00,
        80.00,
        48,
        NULL,
        2,
        '2025-10-05 00:13:44',
        '2025-10-18 19:06:09'
    ),
    (
        8,
        'PROD003',
        'Sofá 3 plazas',
        1500.00,
        2000.00,
        2,
        NULL,
        3,
        '2025-10-05 00:13:44',
        '2025-10-18 19:06:09'
    ),
    (
        9,
        'PROD004',
        'Arroz 5kg',
        10.00,
        15.00,
        96,
        NULL,
        4,
        '2025-10-05 00:13:44',
        '2025-10-18 19:06:09'
    ),
    (
        10,
        'PROD005',
        'Shampoo Pantene 500ml',
        20.00,
        30.00,
        27,
        NULL,
        5,
        '2025-10-05 00:13:44',
        '2025-10-18 19:06:09'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.proveedors
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `proveedors` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `identidad` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
    `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `telefono` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
    `correo` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
    `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 7 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.proveedors
INSERT INTO
    `proveedors` (
        `id`,
        `identidad`,
        `nombre`,
        `telefono`,
        `correo`,
        `direccion`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        '20123456789',
        'Distribuidora Central S.A.',
        '987654321',
        'contacto@distribuidoracentral.com',
        'Av. Comercial 456, Lima',
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        2,
        '20987654321',
        'Importadora Global E.I.R.L.',
        '912345678',
        'ventas@importadoraglobal.com',
        'Calle Comercio 789, Arequipa',
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        3,
        '20567890123',
        'Suministros Industriales SAC',
        '956789012',
        'info@suministrosindustriales.com',
        'Jr. Proveedores 321, Cusco',
        '2025-10-04 23:47:57',
        '2025-10-04 23:47:57'
    ),
    (
        4,
        '20123456789',
        'Distribuidora Central S.A.',
        '987654321',
        'contacto@distribuidoracentral.com',
        'Av. Comercial 456, Lima',
        '2025-10-05 00:13:44',
        '2025-10-05 00:13:44'
    ),
    (
        5,
        '20987654321',
        'Importadora Global E.I.R.L.',
        '912345678',
        'ventas@importadoraglobal.com',
        'Calle Comercio 789, Arequipa',
        '2025-10-05 00:13:44',
        '2025-10-05 00:13:44'
    ),
    (
        6,
        '20567890123',
        'Suministros Industriales SAC',
        '956789012',
        'info@suministrosindustriales.com',
        'Jr. Proveedores 321, Cusco',
        '2025-10-05 00:13:44',
        '2025-10-05 00:13:44'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.roles
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `roles` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `roles_name_guard_name_unique` (`name`, `guard_name`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.roles
INSERT INTO
    `roles` (
        `id`,
        `name`,
        `guard_name`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'Admin',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    ),
    (
        2,
        'Vendedor',
        'web',
        '2025-10-04 23:47:55',
        '2025-10-04 23:47:55'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.role_has_permissions
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
    `permission_id` bigint unsigned NOT NULL,
    `role_id` bigint unsigned NOT NULL,
    PRIMARY KEY (`permission_id`, `role_id`),
    KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.role_has_permissions
INSERT INTO
    `role_has_permissions` (`permission_id`, `role_id`)
VALUES (1, 1),
    (2, 1),
    (3, 1),
    (4, 1),
    (5, 1),
    (6, 1),
    (7, 1),
    (8, 1),
    (9, 1),
    (10, 1),
    (11, 1),
    (12, 1),
    (13, 1),
    (14, 1),
    (15, 1),
    (16, 1),
    (17, 1),
    (18, 1),
    (19, 1),
    (20, 1),
    (21, 1),
    (22, 1),
    (23, 1),
    (24, 1),
    (25, 1),
    (26, 1),
    (27, 1),
    (28, 1),
    (29, 1),
    (30, 1),
    (31, 1),
    (32, 1),
    (33, 1),
    (34, 1),
    (35, 1),
    (36, 1),
    (37, 1),
    (38, 1),
    (39, 1),
    (40, 1),
    (41, 1),
    (42, 1),
    (43, 1),
    (44, 1),
    (45, 1),
    (46, 1),
    (47, 1),
    (48, 1),
    (49, 1),
    (50, 1),
    (51, 1),
    (52, 1),
    (53, 1),
    (54, 1),
    (55, 1),
    (56, 1),
    (57, 1),
    (58, 1),
    (59, 1),
    (60, 1),
    (61, 1),
    (62, 1),
    (63, 1),
    (2, 2),
    (3, 2),
    (6, 2),
    (7, 2),
    (9, 2),
    (20, 2),
    (21, 2),
    (29, 2),
    (30, 2),
    (31, 2),
    (35, 2),
    (36, 2),
    (39, 2),
    (40, 2),
    (42, 2),
    (43, 2),
    (46, 2),
    (47, 2),
    (50, 2),
    (51, 2),
    (52, 2),
    (55, 2),
    (56, 2),
    (57, 2),
    (60, 2),
    (62, 2),
    (63, 2);

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.users
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.users
INSERT INTO
    `users` (
        `id`,
        `name`,
        `email`,
        `email_verified_at`,
        `password`,
        `remember_token`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        'Jose',
        'administrador@gmail.com',
        '2025-10-04 23:56:26',
        '$2y$12$wfh7eTMQQ4riENE3K8fPQunmbN0cFCE94MMrxG9FOOeayz8lKIYc.',
        NULL,
        '2025-10-04 23:47:57',
        '2025-10-05 00:21:10'
    ),
    (
        5,
        'jhared',
        'jhared@gmail.com',
        NULL,
        '$2y$12$f5.kTbGG0.SL4FEqB6VneekdAi3nNPVviKQXYZHIKgY2lJSfTFk/6',
        NULL,
        '2025-10-05 00:16:30',
        '2025-10-18 18:55:14'
    );

-- --------------------------------------------------------
-- Volcando estructura para tabla sales1.ventas
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ventas` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `total` decimal(10, 2) NOT NULL,
    `pago_con` decimal(10, 2) NOT NULL DEFAULT '0.00',
    `metodo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    `estado` int NOT NULL DEFAULT '1',
    `nota` text COLLATE utf8mb4_unicode_ci,
    `id_cliente` bigint unsigned NOT NULL,
    `id_caja` bigint unsigned NOT NULL,
    `id_forma` bigint unsigned NOT NULL,
    `id_usuario` bigint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `ventas_id_cliente_foreign` (`id_cliente`),
    KEY `ventas_id_caja_foreign` (`id_caja`),
    KEY `ventas_id_forma_foreign` (`id_forma`),
    KEY `ventas_id_usuario_foreign` (`id_usuario`)
) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Volcando datos para la tabla sales1.ventas
INSERT INTO
    `ventas` (
        `id`,
        `total`,
        `pago_con`,
        `metodo`,
        `estado`,
        `nota`,
        `id_cliente`,
        `id_caja`,
        `id_forma`,
        `id_usuario`,
        `created_at`,
        `updated_at`
    )
VALUES (
        2,
        4060.00,
        7000.00,
        'Contado',
        2,
        NULL,
        6,
        2,
        1,
        1,
        '2025-10-18 18:46:28',
        '2025-10-18 19:00:47'
    ),
    (
        3,
        2185.00,
        5000.00,
        'Contado',
        2,
        NULL,
        6,
        3,
        1,
        5,
        '2025-10-18 19:02:00',
        '2025-10-18 19:02:32'
    );

-- --------------------------------------------------------
-- Crear las tablas restantes que no tienen datos pero son necesarias
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `abonoventas` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `monto` decimal(10, 2) NOT NULL,
    `id_caja` bigint unsigned NOT NULL,
    `id_forma` bigint unsigned NOT NULL,
    `id_credito` bigint unsigned NOT NULL,
    `id_usuario` bigint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `abonoventas_id_caja_foreign` (`id_caja`),
    KEY `abonoventas_id_forma_foreign` (`id_forma`),
    KEY `abonoventas_id_credito_foreign` (`id_credito`),
    KEY `abonoventas_id_usuario_foreign` (`id_usuario`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `creditoventas` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `monto` decimal(10, 2) NOT NULL,
    `id_cliente` bigint unsigned NOT NULL,
    `id_venta` bigint unsigned NOT NULL,
    `id_usuario` bigint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `creditoventas_id_cliente_foreign` (`id_cliente`),
    KEY `creditoventas_id_venta_foreign` (`id_venta`),
    KEY `creditoventas_id_usuario_foreign` (`id_usuario`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `failed_jobs` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `gastos` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `monto` decimal(10, 2) NOT NULL,
    `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `id_caja` bigint unsigned NOT NULL,
    `id_usuario` bigint unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `gastos_id_caja_foreign` (`id_caja`),
    KEY `gastos_id_usuario_foreign` (`id_usuario`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `model_has_permissions` (
    `permission_id` bigint unsigned NOT NULL,
    `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `model_id` bigint unsigned NOT NULL,
    PRIMARY KEY (
        `permission_id`,
        `model_id`,
        `model_type`
    ),
    KEY `model_has_permissions_model_id_model_type_index` (`model_id`, `model_type`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `model_has_roles` (
    `role_id` bigint unsigned NOT NULL,
    `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `model_id` bigint unsigned NOT NULL,
    PRIMARY KEY (
        `role_id`,
        `model_id`,
        `model_type`
    ),
    KEY `model_has_roles_model_id_model_type_index` (`model_id`, `model_type`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Insertar datos en model_has_roles
INSERT IGNORE INTO
    `model_has_roles` (
        `role_id`,
        `model_type`,
        `model_id`
    )
VALUES (1, 'App\\Models\\User', 1),
    (2, 'App\\Models\\User', 1),
    (2, 'App\\Models\\User', 5);

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
    `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`email`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `tokenable_id` bigint unsigned NOT NULL,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
    `abilities` text COLLATE utf8mb4_unicode_ci,
    `last_used_at` timestamp NULL DEFAULT NULL,
    `expires_at` timestamp NULL DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
    KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (
        `tokenable_type`,
        `tokenable_id`
    )
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Mensaje final
SELECT '✅ Base de datos sales1 inicializada correctamente con todos los datos' AS 'Estado';