<?php
/**
 * This is core configuration file.
 *
 * Use it to configure core behavior of Cake.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * CakePHP Debug Level:
 *
 * Production Mode:
 * 	0: No error messages, errors, or warnings shown. Flash messages redirect.
 *
 * Development Mode:
 * 	1: Errors and warnings shown, model caches refreshed, flash messages halted.
 * 	2: As in 1, but also with full debug messages and SQL output.
 *
 * In production mode, flash messages redirect after a time interval.
 * In development mode, you need to click the flash message to continue.
 */
	Configure::write('debug', 2);

/**
 * Configure the Error handler used to handle errors for your application. By default
 * ErrorHandler::handleError() is used. It will display errors using Debugger, when debug > 0
 * and log errors with CakeLog when debug = 0.
 *
 * Options:
 *
 * - `handler` - callback - The callback to handle errors. You can set this to any callable type,
 *   including anonymous functions.
 *   Make sure you add App::uses('MyHandler', 'Error'); when using a custom handler class
 * - `level` - integer - The level of errors you are interested in capturing.
 * - `trace` - boolean - Include stack traces for errors in log files.
 *
 * @see ErrorHandler for more information on error handling and configuration.
 */
	Configure::write('Error', array(
		'handler' => 'ErrorHandler::handleError',
		'level' => E_ALL & ~E_DEPRECATED,
		'trace' => true
	));

/**
 * Configure the Exception handler used for uncaught exceptions. By default,
 * ErrorHandler::handleException() is used. It will display a HTML page for the exception, and
 * while debug > 0, framework errors like Missing Controller will be displayed. When debug = 0,
 * framework errors will be coerced into generic HTTP errors.
 *
 * Options:
 *
 * - `handler` - callback - The callback to handle exceptions. You can set this to any callback type,
 *   including anonymous functions.
 *   Make sure you add App::uses('MyHandler', 'Error'); when using a custom handler class
 * - `renderer` - string - The class responsible for rendering uncaught exceptions. If you choose a custom class you
 *   should place the file for that class in app/Lib/Error. This class needs to implement a render method.
 * - `log` - boolean - Should Exceptions be logged?
 * - `skipLog` - array - list of exceptions to skip for logging. Exceptions that
 *   extend one of the listed exceptions will also be skipped for logging.
 *   Example: `'skipLog' => array('NotFoundException', 'UnauthorizedException')`
 *
 * @see ErrorHandler for more information on exception handling and configuration.
 */
	Configure::write('Exception', array(
		'handler' => 'ErrorHandler::handleException',
		'renderer' => 'ExceptionRenderer',
		'log' => true
	));

/**
 * Application wide charset encoding
 */
	Configure::write('App.encoding', 'UTF-8');

/**
 * To configure CakePHP *not* to use mod_rewrite and to
 * use CakePHP pretty URLs, remove these .htaccess
 * files:
 *
 * /.htaccess
 * /app/.htaccess
 * /app/webroot/.htaccess
 *
 * And uncomment the App.baseUrl below. But keep in mind
 * that plugin assets such as images, CSS and JavaScript files
 * will not work without URL rewriting!
 * To work around this issue you should either symlink or copy
 * the plugin assets into you app's webroot directory. This is
 * recommended even when you are using mod_rewrite. Handling static
 * assets through the Dispatcher is incredibly inefficient and
 * included primarily as a development convenience - and
 * thus not recommended for production applications.
 */
	//Configure::write('App.baseUrl', env('SCRIPT_NAME'));

/**
 * To configure CakePHP to use a particular domain URL
 * for any URL generation inside the application, set the following
 * configuration variable to the http(s) address to your domain. This
 * will override the automatic detection of full base URL and can be
 * useful when generating links from the CLI (e.g. sending emails)
 */
	//Configure::write('App.fullBaseUrl', 'http://example.com');

/**
 * Web path to the public images directory under webroot.
 * If not set defaults to 'img/'
 */
	//Configure::write('App.imageBaseUrl', 'img/');

/**
 * Web path to the CSS files directory under webroot.
 * If not set defaults to 'css/'
 */
	//Configure::write('App.cssBaseUrl', 'css/');

/**
 * Web path to the js files directory under webroot.
 * If not set defaults to 'js/'
 */
	//Configure::write('App.jsBaseUrl', 'js/');

/**
 * Uncomment the define below to use CakePHP prefix routes.
 *
 * The value of the define determines the names of the routes
 * and their associated controller actions:
 *
 * Set to an array of prefixes you want to use in your application. Use for
 * admin or other prefixed routes.
 *
 * 	Routing.prefixes = array('admin', 'manager');
 *
 * Enables:
 *	`admin_index()` and `/admin/controller/index`
 *	`manager_index()` and `/manager/controller/index`
 *
 */
	//Configure::write('Routing.prefixes', array('admin'));

/**
 * Turn off all caching application-wide.
 *
 */
	//Configure::write('Cache.disable', true);

/**
 * Enable cache checking.
 *
 * If set to true, for view caching you must still use the controller
 * public $cacheAction inside your controllers to define caching settings.
 * You can either set it controller-wide by setting public $cacheAction = true,
 * or in each action using $this->cacheAction = true.
 *
 */
	//Configure::write('Cache.check', true);

/**
 * Enable cache view prefixes.
 *
 * If set it will be prepended to the cache name for view file caching. This is
 * helpful if you deploy the same application via multiple subdomains and languages,
 * for instance. Each version can then have its own view cache namespace.
 * Note: The final cache file name will then be `prefix_cachefilename`.
 */
	//Configure::write('Cache.viewPrefix', 'prefix');

/**
 * Session configuration.
 *
 * Contains an array of settings to use for session configuration. The defaults key is
 * used to define a default preset to use for sessions, any settings declared here will override
 * the settings of the default config.
 *
 * ## Options
 *
 * - `Session.cookie` - The name of the cookie to use. Defaults to 'CAKEPHP'
 * - `Session.timeout` - The number of minutes you want sessions to live for. This timeout is handled by CakePHP
 * - `Session.cookieTimeout` - The number of minutes you want session cookies to live for.
 * - `Session.checkAgent` - Do you want the user agent to be checked when starting sessions? You might want to set the
 *    value to false, when dealing with older versions of IE, Chrome Frame or certain web-browsing devices and AJAX
 * - `Session.defaults` - The default configuration set to use as a basis for your session.
 *    There are four builtins: php, cake, cache, database.
 * - `Session.handler` - Can be used to enable a custom session handler. Expects an array of callables,
 *    that can be used with `session_save_handler`. Using this option will automatically add `session.save_handler`
 *    to the ini array.
 * - `Session.autoRegenerate` - Enabling this setting, turns on automatic renewal of sessions, and
 *    sessionids that change frequently. See CakeSession::$requestCountdown.
 * - `Session.ini` - An associative array of additional ini values to set.
 *
 * The built in defaults are:
 *
 * - 'php' - Uses settings defined in your php.ini.
 * - 'cake' - Saves session files in CakePHP's /tmp directory.
 * - 'database' - Uses CakePHP's database sessions.
 * - 'cache' - Use the Cache class to save sessions.
 *
 * To define a custom session handler, save it at /app/Model/Datasource/Session/<name>.php.
 * Make sure the class implements `CakeSessionHandlerInterface` and set Session.handler to <name>
 *
 * To use database sessions, run the app/Config/Schema/sessions.php schema using
 * the cake shell command: cake schema create Sessions
 *
 */
	Configure::write('Session', array(
		'defaults' => 'php'
	));


/**
 * A random string used in security hashing methods.
 */
	Configure::write('Security.salt', 'nuxr7EU23GdsNElMfYKLyb74tOKsoFrv9YONJLOU');

/**
 * A random numeric string (digits only) used to encrypt/decrypt strings.
 */
	Configure::write('Security.cipherSeed', '72185563672581108816819056330');

/**
 * Apply timestamps with the last modified time to static assets (js, css, images).
 * Will append a query string parameter containing the time the file was modified. This is
 * useful for invalidating browser caches.
 *
 * Set to `true` to apply timestamps when debug > 0. Set to 'force' to always enable
 * timestamping regardless of debug value.
 */
	//Configure::write('Asset.timestamp', true);

/**
 * Compress CSS output by removing comments, whitespace, repeating tags, etc.
 * This requires a/var/cache directory to be writable by the web server for caching.
 * and /vendors/csspp/csspp.php
 *
 * To use, prefix the CSS link URL with '/ccss/' instead of '/css/' or use HtmlHelper::css().
 */
	//Configure::write('Asset.filter.css', 'css.php');

/**
 * Plug in your own custom JavaScript compressor by dropping a script in your webroot to handle the
 * output, and setting the config below to the name of the script.
 *
 * To use, prefix your JavaScript link URLs with '/cjs/' instead of '/js/' or use JsHelper::link().
 */
	//Configure::write('Asset.filter.js', 'custom_javascript_output_filter.php');

/**
 * The class name and database used in CakePHP's
 * access control lists.
 */
	Configure::write('Acl.classname', 'DbAcl');
	Configure::write('Acl.database', 'default');

/**
 * Uncomment this line and correct your server timezone to fix
 * any date & time related errors.
 */
	//date_default_timezone_set('UTC');

/**
 * `Config.timezone` is available in which you can set users' timezone string.
 * If a method of CakeTime class is called with $timezone parameter as null and `Config.timezone` is set,
 * then the value of `Config.timezone` will be used. This feature allows you to set users' timezone just
 * once instead of passing it each time in function calls.
 */
	//Configure::write('Config.timezone', 'Europe/Paris');

/**
 * Cache Engine Configuration
 * Default settings provided below
 *
 * File storage engine.
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'File', //[required]
 *		'duration' => 3600, //[optional]
 *		'probability' => 100, //[optional]
 * 		'path' => CACHE, //[optional] use system tmp directory - remember to use absolute path
 * 		'prefix' => 'cake_', //[optional]  prefix every cache file with this string
 * 		'lock' => false, //[optional]  use file locking
 * 		'serialize' => true, //[optional]
 * 		'mask' => 0664, //[optional]
 *	));
 *
 * APC (http://pecl.php.net/package/APC)
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Apc', //[required]
 *		'duration' => 3600, //[optional]
 *		'probability' => 100, //[optional]
 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 *	));
 *
 * Xcache (http://xcache.lighttpd.net/)
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Xcache', //[required]
 *		'duration' => 3600, //[optional]
 *		'probability' => 100, //[optional]
 *		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional] prefix every cache file with this string
 *		'user' => 'user', //user from xcache.admin.user settings
 *		'password' => 'password', //plaintext password (xcache.admin.pass)
 *	));
 *
 * Memcached (http://www.danga.com/memcached/)
 *
 * Uses the memcached extension. See http://php.net/memcached
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Memcached', //[required]
 *		'duration' => 3600, //[optional]
 *		'probability' => 100, //[optional]
 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 * 		'servers' => array(
 * 			'127.0.0.1:11211' // localhost, default port 11211
 * 		), //[optional]
 * 		'persistent' => 'my_connection', // [optional] The name of the persistent connection.
 * 		'compress' => false, // [optional] compress data in Memcached (slower, but uses less memory)
 *	));
 *
 *  Wincache (http://php.net/wincache)
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Wincache', //[required]
 *		'duration' => 3600, //[optional]
 *		'probability' => 100, //[optional]
 *		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 *	));
 */

/**
 * Configure the cache handlers that CakePHP will use for internal
 * metadata like class maps, and model schema.
 *
 * By default File is used, but for improved performance you should use APC.
 *
 * Note: 'default' and other application caches should be configured in app/Config/bootstrap.php.
 *       Please check the comments in bootstrap.php for more info on the cache engines available
 *       and their settings.
 */
$engine = 'File';

// In development mode, caches should expire quickly.
$duration = '+999 days';
if (Configure::read('debug') > 0) {
	$duration = '+10 seconds';
}

// Prefix each application on the same server with a different string, to avoid Memcache and APC conflicts.
$prefix = 'myapp_';

/**
 * Configure the cache used for general framework caching. Path information,
 * object listings, and translation cache files are stored with this configuration.
 */
Cache::config('_cake_core_', array(
	'engine' => $engine,
	'prefix' => $prefix . 'cake_core_',
	'path' => CACHE . 'persistent' . DS,
	'serialize' => ($engine === 'File'),
	'duration' => $duration
));

/**
 * Configure the cache for model and datasource caches. This cache configuration
 * is used to store schema descriptions, and table listings in connections.
 */
Cache::config('_cake_model_', array(
	'engine' => $engine,
	'prefix' => $prefix . 'cake_model_',
	'path' => CACHE . 'models' . DS,
	'serialize' => ($engine === 'File'),
	'duration' => $duration
));


	/**
	 * CONFIGURACION DE PLATAFORMA DE NOTIFICACIONES
	 */
	Configure::write('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.CODIGO', 'C');
	Configure::write('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.WEB.FULL_URL', 'http://www.tiviastore.com/versiondos');


	/**
	 * SEXO DE USUARIO
	 */
	Configure::write('TIVIA_CONFIG.SEXO.FEMENINO.CODIGO', '1');
	Configure::write('TIVIA_CONFIG.SEXO.FEMENINO.TEXTO', 'Chica');
	Configure::write('TIVIA_CONFIG.SEXO.MASCULINO.CODIGO', '2');
	Configure::write('TIVIA_CONFIG.SEXO.MASCULINO.TEXTO', 'Chico');

	/**
	* ES UN PRODUCTO FISICO
	*/
	Configure::write('TIVIA_CONFIG.PRODUCTO.FISICO.VALOR', '1');
	Configure::write('TIVIA_CONFIG.PRODUCTO.FISICO.TEXTO', 'Físico');
	Configure::write('TIVIA_CONFIG.PRODUCTO.DIGITAL.VALOR', '0');
	Configure::write('TIVIA_CONFIG.PRODUCTO.DIGITAL.TEXTO', 'Digital');

	/**
	* ES UN PRODUCTO HECHO O ES POR PEDIDO
	*/
	Configure::write('TIVIA_CONFIG.PRODUCTO.ESTA_HECHO.VALOR', '1');
	Configure::write('TIVIA_CONFIG.PRODUCTO.ESTA_HECHO.TEXTO', 'Esta hecho');
	Configure::write('TIVIA_CONFIG.PRODUCTO.POR_PEDIDO.VALOR', '0');
	Configure::write('TIVIA_CONFIG.PRODUCTO.POR_PEDIDO.TEXTO', 'Por pedido');
	
	/**
	 * TIPO CUENTA: CORRIENTE:1 O AHORRO:2
	 */
	Configure::write('TIVIA_CONFIG.TIPO_CUENTA', array('1' => 'Corriente', '2' => 'Ahorro'));
	
	/**
	 * TIPO DE IMAGEN: LOGO:1 O PERFIL:2 3:PRODUCTO
	 */
	Configure::write('TIVIA_CONFIG.TIPO_IMAGEN', array('1' => 'Logo', '2' => 'Perfil', '3' => 'Producto'));
	
	/**
	 * MIN - MAX WIDTH HEIGHT JCROP
	*/
	Configure::write('TIVIA_CONFIG.CROP_SIZE.1', array('MinWidth' => '160', 'MinHeight' => '160','MaxWidth' => '258', 'MaxHeight' => '258'));
	Configure::write('TIVIA_CONFIG.CROP_SIZE.2', array('MinWidth' => '160', 'MinHeight' => '160','MaxWidth' => '258', 'MaxHeight' => '258'));
	Configure::write('TIVIA_CONFIG.CROP_SIZE.3', array('MinWidth' => '640', 'MinHeight' => '640','MaxWidth' => '640', 'MaxHeight' => '640'));
	
	/**
	 * TIPO DE ID PARA CUENTAS PERSONAL NATURAL O RIF
	 */
	Configure::write('TIVIA_CONFIG.TIPO_ID.VENEZOLANO.CODIGO', 'V');
	Configure::write('TIVIA_CONFIG.TIPO_ID.VENEZOLANO.TEXTO', 'V');
	Configure::write('TIVIA_CONFIG.TIPO_ID.EXTRANJERO.CODIGO', 'E');
	Configure::write('TIVIA_CONFIG.TIPO_ID.EXTRANJERO.TEXTO', 'E');
	Configure::write('TIVIA_CONFIG.TIPO_ID.RIF.CODIGO', 'J');
	Configure::write('TIVIA_CONFIG.TIPO_ID.RIF.TEXTO', 'J');

	/**
	* SETEA LA CANTIDAD DE PRODUCTOS QUE RECIBEN LIKES Y SE MOSTRARAN COMO ANTICIPO EN PERFIL DE USUARIO Y EN EL HOME
	*/
	Configure::write('TIVIA_CONFIG.FOTO.CANTIDAD_FOTOS', 10);

	/**
	* SETEA LA CANTIDAD DE TIENDAS EN DESCUBRE
	*/
	Configure::write('TIVIA_CONFIG.FOTO.CANTIDAD_TIENDAS_DESCUBRE', 3);

	/**
	* SETEA LA CANTIDAD DE DIRECCIONES DE ENVIO PERMITIDAS
	*/
	Configure::write('TIVIA_CONFIG.DIRECCION.CANTIDAD_DE_DIRECCIONES', 4);

	/**
	* SETEA LA CANTIDAD DE DIRECCIONES DE ENVIO PERMITIDAS
	*/
	Configure::write('TIVIA_CONFIG.PAGINADOR.LIMITE', 20);

	/**
	* SETEA LA COMBINACION DE COURIERS segun BASE DE DATOS
	*/
	Configure::write('TIVIA_CONFIG.1.COURIERS', 'MRW');
	Configure::write('TIVIA_CONFIG.2.COURIERS', 'DOMESA');
	Configure::write('TIVIA_CONFIG.3.COURIERS', 'ZOOM');
	Configure::write('TIVIA_CONFIG.4.COURIERS', 'DHL');

	/**
	* SETEA LA COMBINACION DE COURIERS
	*/
	Configure::write('TIVIA_CONFIG.COURIERS.1', array('MRW'));
	Configure::write('TIVIA_CONFIG.COURIERS.2', array('DOMESA'));
	Configure::write('TIVIA_CONFIG.COURIERS.4', array('DHL'));

	Configure::write('TIVIA_CONFIG.COURIERS.3', array(
		'MRW',
		'DOMESA',
		)
	);

	Configure::write('TIVIA_CONFIG.COURIERS.5', array(
		'MRW',
		'DHL',
		)
	);

	Configure::write('TIVIA_CONFIG.COURIERS.6', array(
		'DOMESA',
		'DHL',
		)
	);

	Configure::write('TIVIA_CONFIG.COURIERS.7', array(
		'MRW',
		'DOMESA',
		'DHL',
		)
	);

	/**
	*Colores de estatus en tabla orders::myordersclient, se definen son los nombres de las clases
	**/
	Configure::write('TIVIA_CONFIG.STATUS_ORDERSCLIENT.1', array('class' => 'status_confirmar',
													'status' => 'Por confirmar',
													'descripcion' => 'Tu pago será confirmado en 1 día hábil.'));

	Configure::write('TIVIA_CONFIG.STATUS_ORDERSCLIENT.2', array('class' => 'status_confirmado',
													'status' => 'Confirmado',
													'descripcion' => 'Tu pago está confirmado. Te notificaremos cuando sea enviado.'));

	Configure::write('TIVIA_CONFIG.STATUS_ORDERSCLIENT.3', array('class' => 'status_encamino',
													'status' => 'En camino',
													'descripcion' => 'Tu pedido está en camino.'));

	Configure::write('TIVIA_CONFIG.STATUS_ORDERSCLIENT.4', array('class' => 'status_finalizado',
													'status' => 'Finalizado',
													'descripcion' => 'Orden finalizada.'));

	Configure::write('TIVIA_CONFIG.STATUS_ORDERSCLIENT.5', array('class' => 'status_incorrecto',
													'status' => 'Incorrecto',
													'descripcion' => 'Pago incorrecto. Nos comunicaremos contigo.'));


	/**
	*Colores de estatus en tabla order::myordersstore se definen son los nombres de las clases
	**/
	Configure::write('TIVIA_CONFIG.STATUS_ORDERSSTORE.1', array('class' => 'status_confirmar',
													'status' => 'Por confirmar',
													'descripcion' => 'Tienes una nueva orden, estamos confirmando el pago.'));

	Configure::write('TIVIA_CONFIG.STATUS_ORDERSSTORE.2', array('class' => 'status_confirmado',
													'status' => 'Enviar pedido',
													'descripcion' => 'Confirmamos pago. ¡Puedes enviar tus productos!'));

	Configure::write('TIVIA_CONFIG.STATUS_ORDERSSTORE.3', array('class' => 'status_encamino',
													'status' => 'Enviado',
													'descripcion' => '¡Paquete enviado a tu cliente!'));

	Configure::write('TIVIA_CONFIG.STATUS_ORDERSSTORE.4', array('class' => 'status_finalizado',
													'status' => 'Finalizado',
													'descripcion' => 'Orden finalizada. Tu cliente recibió su compra.'));

	Configure::write('TIVIA_CONFIG.STATUS_ORDERSSTORE.5', array('class' => 'status_incorrecto',
													'status' => 'Incorrecto',
													'descripcion' => 'Pago incorrecto del cliente.'));


	/**
	* Dimensiones de banner tipo facebook original. Configuramos un tamaño minimo pues se puede adaptar.
	* Ancho: 851px
	* Alto: 315px
	*/
	Configure::write('TIVIA_CONFIG.DIMENSIONES.BANNER.MIN', array(
			'WIDTH' => '851px',
			'HEIGHT' => '315px'
		)
	);

	/**
	* Dimensiones de banner tipo facebook original. Configuramos un tamaño mas grande pues se puede adaptar.
	* Ancho: 1200px
	* Alto: 720px
	*/
	Configure::write('TIVIA_CONFIG.DIMENSIONES.BANNER.MAX', array(
			'WIDTH' => '1200px',
			'HEIGHT' => '720px'
		)
	);

	/**
	* Dimensiones de banner tipo facebook original. Configuramos un tamaño minimo pues se puede adaptar.
	* Ancho: 160px
	* Alto: 160px
	*/
	Configure::write('TIVIA_CONFIG.DIMENSIONES.LOGO.MIN', array(
			'WIDTH' => '250px',
			'HEIGHT' => '250px'
		)
	);


	/**
	* Dimensiones de logo tipo facebook original. Configuramos un tamaño mas grande pues se puede adaptar.
	* Ancho: 300px
	* Alto: 300px
	*/
	Configure::write('TIVIA_CONFIG.DIMENSIONES.LOGO.MAX', array(
			'WIDTH' => '1024px',
			'HEIGHT' => '1024px'
		)
	);

	/**
	* Propiedades de imagenes de los productos.
	*
	*/
	const FOTO_GRANDE_ANCHO = 240; const FOTO_GRANDE_ALTO = 320;
	Configure::write('TIVIA_CONFIG.FOTO.GRANDE', array('ANCHO' => FOTO_GRANDE_ANCHO, 'ALTO' => FOTO_GRANDE_ALTO, ));
	Configure::write('TIVIA_CONFIG.FOTO.GRANDE.ESTILO', 'width: ' . FOTO_GRANDE_ANCHO . 'px; height: ' . FOTO_GRANDE_ALTO . 'px; ');
	Configure::write('TIVIA_CONFIG.FOTO.GRANDE.JS', FOTO_GRANDE_ANCHO . ', ' . FOTO_GRANDE_ALTO);
	Configure::write('TIVIA_CONFIG.FOTO.GRANDE.SIZE', 'G');

	//1:1
	const FOTO_PEQUENA_ANCHO = 296; const FOTO_PEQUENA_ALTO = 296;
	Configure::write('TIVIA_CONFIG.FOTO.PEQUENA', array('ANCHO' => FOTO_PEQUENA_ANCHO, 'ALTO' => FOTO_PEQUENA_ALTO, ));
	Configure::write('TIVIA_CONFIG.FOTO.PEQUENA.ESTILO', 'width: ' . FOTO_PEQUENA_ANCHO . 'px; height: ' . FOTO_PEQUENA_ALTO . 'px; ');
	Configure::write('TIVIA_CONFIG.FOTO.PEQUENA.JS', FOTO_PEQUENA_ANCHO . ', ' . FOTO_PEQUENA_ALTO);
	Configure::write('TIVIA_CONFIG.FOTO.PEQUENA.SIZE', 'P');


	/**
	 * Notificacion al usuario cuando se registra
	 */
	Configure::write('TIVIA_CONFIG.NOTIFICACIONES.REGISTRO_USUARIO', array(
			'CODIGO' => 'REGISTRO_USUARIO',
			'PRIORIDAD' => 1,
			'MODELO' => 'Usuario',
			'EMAIL' => array(
				'SUBJECT' => ' a TiviaStore',
				'TEMPLATE' => 'registro_usuario_mail',
				'LAYOUT' => 'neworder',
				'REPLYTO' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.BUZON.NOREPLY'),
				'FROM_TITLE' => 'TiviaStore',
				'FROM_EMAIL' => 'notificaciones@tiviastore.com',
				'FULL_BASE_URL' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.WEB.FULL_URL'),
			),
	));

	/**
	 * Notificacion al usuario cuando se suscribe
	 */
	Configure::write('TIVIA_CONFIG.NOTIFICACIONES.SUSCRIPCION', array(
			'CODIGO' => 'SUSCRIPCION',
			'PRIORIDAD' => 1,
			'MODELO' => 'Suscriptor',
			'EMAIL' => array(
				'SUBJECT' => 'Suscripciones TiviaStore',
				'TEMPLATE' => 'firstmarketing_mail',
				'LAYOUT' => 'firstmarketing',
				'REPLYTO' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.BUZON.NOREPLY'),
				'FROM_TITLE' => 'TiviaStore',
				'FROM_EMAIL' => 'notificaciones@tiviastore.com',
				'FULL_BASE_URL' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.WEB.FULL_URL'),
			),
	));

	/**
	 * Notificacion cuando el usuario solicita recuperar contraseña
	 */
	Configure::write('TIVIA_CONFIG.NOTIFICACIONES.CLAVE', array(
			'CODIGO' => 'CLAVE',
			'PRIORIDAD' => 1,
			'MODELO' => 'Usuario',
			'EMAIL' => array(
				'SUBJECT' => 'Recuperar clave TiviaStore',
				'TEMPLATE' => 'resetpassword_fromemail',
				'LAYOUT' => 'neworder',
				'REPLYTO' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.BUZON.NOREPLY'),
				'FROM_TITLE' => 'TiviaStore',
				'FROM_EMAIL' => 'notificaciones@tiviastore.com',
				'FULL_BASE_URL' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.WEB.FULL_URL'),
			),
	));

	/**
	 * Se genera cuando se crea una nueva orden y/o compra. Detalla al COMPRADOR los datos de su COMPRA
	 */
	Configure::write('TIVIA_CONFIG.NOTIFICACIONES.ORDER_CLIENTE', array(
			'CODIGO' => 'ORDER_CLIENTE',
			'PRIORIDAD' => 1,
			'MODELO' => 'Order',
			'EMAIL' => array(
				'SUBJECT' => 'Detalles de tu compra',
				'TEMPLATE' => 'ordercliente_email',
				'LAYOUT' => 'neworder',
				'REPLYTO' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.BUZON.NOREPLY'),
				'FROM_TITLE' => 'TiviaStore',
				'FROM_EMAIL' => 'notificaciones@tiviastore.com',
				'FULL_BASE_URL' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.WEB.FULL_URL'),
			),
	));

	/**
	 * Se genera cuando se crea una nueva orden y/o compra. Detalla al VENDEDOR los datos de su VENTA
	 */
	Configure::write('TIVIA_CONFIG.NOTIFICACIONES.ORDER_VENDEDOR', array(
			'CODIGO' => 'ORDER_VENDEDOR',
			'PRIORIDAD' => 1,
			'MODELO' => 'Order',
			'EMAIL' => array(
				'SUBJECT' => '¡Tienes un nuevo pedido!',
				'TEMPLATE' => 'ordervendedor_email',
				'LAYOUT' => 'neworder',
				'REPLYTO' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.BUZON.NOREPLY'),
				'FROM_TITLE' => 'TiviaStore',
				'FROM_EMAIL' => 'notificaciones@tiviastore.com',
				'FULL_BASE_URL' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.WEB.FULL_URL'),
			),
	));

	/**
	 * Se envia al comprador cuando TIVIA ADMIN confirma pago correcto.
	 */
	Configure::write('TIVIA_CONFIG.NOTIFICACIONES.CONFIRMACION_ORDER_CLIENT', array(
		'CODIGO' => 'CONFIRMACION_ORDER_CLIENT',
		'PRIORIDAD' => 1,
		'MODELO' => 'Order',
		'EMAIL' => array(
			'SUBJECT' => '¡Pago confirmado!',
			'TEMPLATE' => 'confirmacion_orderclient_email',
			'LAYOUT' => 'neworder',
			'REPLYTO' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.BUZON.NOREPLY'),
			'FROM_TITLE' => 'TiviaStore',
			'FROM_EMAIL' => 'notificaciones@tiviastore.com',
			'FULL_BASE_URL' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.WEB.FULL_URL'),
		),
	));

	/**
	 * Se envia a las tiendas de una order cuando TIVIA ADMIN confirma pago correcto.
	 */
	Configure::write('TIVIA_CONFIG.NOTIFICACIONES.CONFIRMACION_ORDER_STORE', array(
		'CODIGO' => 'CONFIRMACION_ORDER_STORE',
		'PRIORIDAD' => 1,
		'MODELO' => 'Order',
		'EMAIL' => array(
			'SUBJECT' => '¡Puedes enviar tus productos!',
			'TEMPLATE' => 'confirmacion_orderstore_email',
			'LAYOUT' => 'neworder',
			'REPLYTO' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.BUZON.NOREPLY'),
			'FROM_TITLE' => 'TiviaStore',
			'FROM_EMAIL' => 'notificaciones@tiviastore.com',
			'FULL_BASE_URL' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.WEB.FULL_URL'),
		),
	));

	/**
	 * Se envia al COMPRADOR cuando VENDEDOR comfirma envío.
	 */
	Configure::write('TIVIA_CONFIG.NOTIFICACIONES.CONFIRMACION_ENVIO', array(
			'CODIGO' => 'CONFIRMACION_ENVIO',
			'PRIORIDAD' => 1,
			'MODELO' => 'Envio',
			'EMAIL' => array(
				'SUBJECT' => 'Confirmacion de envio de orden en TiviaStore',
				'TEMPLATE' => 'confirmacion_envio_email',
				'LAYOUT' => 'neworder',
				'REPLYTO' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.BUZON.NOREPLY'),
				'FROM_TITLE' => 'TiviaStore',
				'FROM_EMAIL' => 'notificaciones@tiviastore.com',
				'FULL_BASE_URL' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.WEB.FULL_URL'),
			),
	));

	/**
	 * Se envia al COMPRADOR cuando TIVIA_ADMIN RECHAZA el pago.
	 */
	Configure::write('TIVIA_CONFIG.NOTIFICACIONES.DECLINADO_ORDER_CLIENT', array(
			'CODIGO' => 'DECLINADO_ORDER_CLIENT',
			'PRIORIDAD' => 1,
			'MODELO' => 'Order',
			'EMAIL' => array(
				'SUBJECT' => 'Pago declinado',
				'TEMPLATE' => 'declinado_envio_email',
				'LAYOUT' => 'neworder',
				'REPLYTO' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.EMAIL.BUZON.NOREPLY'),
				'FROM_TITLE' => 'TiviaStore',
				'FROM_EMAIL' => 'notificaciones@tiviastore.com',
				'FULL_BASE_URL' => Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.WEB.FULL_URL'),
			),
	));