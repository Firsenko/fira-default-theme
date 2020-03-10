<?php

/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'fira_db' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );


define('FS_METHOD', 'direct');

define( 'WP_MEMORY_LIMIT', '128M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );
define('ALLOW_UNFILTERED_UPLOADS', true); // allow svg upload
define( 'WPCF7_AUTOP', false );
/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Vlg)xTChvik$Q;:z)WOY[|#F,EPMCjJl|6nF.wI0L-*%[JL-XZpU[2wTaJP~Y!on');
define('SECURE_AUTH_KEY',  ',Jz#]y1H]4*`NtV;kM:uc~~LI_!.be*GP>,9]<El-8oFL}FI/d#b[IF8-kHv2&%}');
define('LOGGED_IN_KEY',    '/h82QHj$BUN22;Gqg*A3.3J-WP2= 8T@.K_K-7B_;<mmy,g~%bm:8`Xj^qbt$2kv');
define('NONCE_KEY',        'V}cxYN&vn+3008pkC/.3tW8jP`>86yBS]O]+jvk4rYS[rZA,b!V{sW%78TvGV`EL');
define('AUTH_SALT',        '%1d8w2T{1T~YE];l)ne`1Amcd;$4JJ50E~lxXcEb+L--F/OLkv`DrC?wVn5Qr,aW');
define('SECURE_AUTH_SALT', 'VW/[YiQbsq:&}-4dj&xZ7zQNT,*pU3J7a:q%vTjU|ofX16c3S<}%*$nL)OO/fhux');
define('LOGGED_IN_SALT',   'i!k[Q/wJQuX;e~hj2z~>GNn2?v8/y]J*y#CRbM}uPfdMTr^2+oR^Ww #j&8*dm$}');
define('NONCE_SALT',       '+31tg-q8-8dmU}1KbxK1.4xS*T=O0CVwZkM8isvz-w*91 a.`=mvDkh>?zuF!Y/K');
/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', true );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
