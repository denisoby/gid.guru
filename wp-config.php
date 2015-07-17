<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи и ABSPATH. Дополнительную информацию можно найти на странице
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется скриптом для создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения вручную.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'gidguru');

/** Имя пользователя MySQL */
define('DB_USER', 'wpuser');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'jh#8HF4$SuSC');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+u2Ym7S@%k]0H%srDiG1_+wY@({m^!Q1(Oa&>UzJ(qs4;xc(R5zuxX2Uj|Rp`eSg');
define('SECURE_AUTH_KEY',  'UeWqa?dCd,;`NiTb&wr?|^*.kHfQ4&<PKIG-f),q||H})h.0@Lk_= #XWdyo~^+4');
define('LOGGED_IN_KEY',    '-NL&;Q-mnLKIZPN*C{$-)NMp4Ob..cUXp+J3aMS~G|6j|C-?$X7na+5+Ar?9ag67');
define('NONCE_KEY',        'dsPjF+ Yx?FfnT*M+2f!Z7i`Dw%0oG`_7khAqP_Pgw:XW<zI.Vw=I`AMcz+efGY-');
define('AUTH_SALT',        '+y.Wf2z2Uel4m|y>8cbI=^2<qd*lo`uK?=OA?YSjc)+~2p.>2zCD{<|gkoij>sR5');
define('SECURE_AUTH_SALT', 'd!Wj-1Hsc`QH>:NBCl+>qi.O)1Xs$SW3-|-(j6Wl]OJIUQ R?)$O/S+rV!,Q2AHj');
define('LOGGED_IN_SALT',   'L|yVGX0X.$yw.VPVhW/V^5}TO)9xIQ13^a~N+BTflX|xCzvwKg]Mr+,vG^-SvTGC');
define('NONCE_SALT',       'b}U]z;;YS8m#~,rWq.L*Lp/k2nkax]p>-W^giDL}<:m |17jK-8g{5+okRL^-3E/');
/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
