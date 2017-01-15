<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

// Подключение автозагрузчика
require '../../vendor/autoload.php';

session_start();

// Инициализация
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Назначение зависимостей
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Регистрация маршрутов
require __DIR__ . '/../src/routes.php';

// Запуск приложения
$app->run();


//// инициализация
//$app = new \Slim\App(["settings" => $config]);;
//
//$app->post( '/do_login', 'doLogin'  ); // логин
//$app->get( '/is_login', 'isLogin' ); //проверка на логин
//$app->get( '/logout', 'logout' ); // выход
//$app->post( '/join_room', 'joinRoom' ); // присоединение к комнате
//$app->post( '/add_room', 'addRoom' ); // создание комнаты
//$app->post( '/get_rooms', 'getRooms' ); // получить все комнаты
//$app->post( '/delete_room', 'deleteRoom' ); // удаление комнаты
//
//$app->run();
///**
// * Проверка на логин
// */
//function isLogin() {
//	session_start();
//	if( isset($_SESSION['username']) && !empty($_SESSION['username']))
//		echo '{"isLogin": true}';
//	else
//		echo '{"isLogin": false}';
//}
//
///**
// * Выход
// */
//function logout() {
//	session_start();
//	session_destroy();
//}
//
///**
// * Логин
// */
//function doLogin(Request $request, Response $response) {
//
//	$user = $request->getAttribute('user');
//
//	$sql = "SELECT * FROM users WHERE username=:username AND password=:password";
//	try {
//		$db = getConnection();
//        // Подготовка
//		$stmt = $db->prepare($sql);
//		$stmt->bindParam("username", $user->username);
//		$stmt->bindParam("password", $user->password);
//        // Выполнение запроса
//		$stmt->execute();
//		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//		$db = null;
//        // Если есть результаты
//		if( count($rows) ) {
//			session_start();
//			$_SESSION['username'] =  $user->username;
//
//			echo '{"status": "success"}';
//		}
//		else {
//			echo '{"status": "failed"}';
//		}
//	} catch(PDOException $e) {
//		echo '{"error":{"text":'. $e->getMessage() .'}}';
//	}
//}
//
//function joinRoom() {
//	$sql = "select * FROM products WHERE deleted=0 ORDER BY product_id";
//	try {
//		$db = getConnection();
//		$stmt = $db->query($sql);
//		$products = $stmt->fetchAll(PDO::FETCH_OBJ);
//		$db = null;
//		echo json_encode($products);
//	} catch(PDOException $e) {
//		echo '{"error":{"text":'. $e->getMessage() .'}}';
//	}
//}
//function addRoom( $id ) {
//	$sql = "select * FROM products WHERE product_id=".$id." ORDER BY product_id";
//	try {
//		$db = getConnection();
//		$stmt = $db->query($sql);
//		$product = $stmt->fetchAll(PDO::FETCH_OBJ);
//		$db = null;
//		echo json_encode($product);
//	} catch(PDOException $e) {
//		echo '{"error":{"text":'. $e->getMessage() .'}}';
//	}
//}
//
//function getRooms() {
//	$request = \Slim\Slim::getInstance()->request();
//	$product = json_decode($request->getBody());
//	$sql = "INSERT INTO products (product_name, product_description, product_price, product_stock) VALUES (:product_name, :product_description, :product_price, :product_stock)";
//	try {
//		$db = getConnection();
//		$stmt = $db->prepare($sql);
//		$stmt->bindParam("product_name", $product->name);
//		$stmt->bindParam("product_description", $product->description);
//		$stmt->bindParam("product_price", $product->price);
//		$stmt->bindParam("product_stock", $product->stock);
//		$status = $stmt->execute();
//		$db = null;
//		echo '{"status":'.$status.'}';
//	} catch(PDOException $e) {
//		echo '{"error":{"text":'. $e->getMessage() .'}}';
//	}
//}
//
//function deleteRoom($id) {
//	$sql = "UPDATE products SET deleted=1 WHERE product_id=".$id;
//	try {
//		$db = getConnection();
//		$stmt = $db->query($sql);
//		$db = null;
//		getProducts();
//	} catch(PDOException $e) {
//		echo '{"error":{"text":'. $e->getMessage() .'}}';
//	}
//}
//
//function updateProduct($id) {
//	$request = \Slim\Slim::getInstance()->request();
//	$product = json_decode($request->getBody());
//	$sql = "UPDATE products SET product_name=:name, product_description=:description, product_price=:price, product_stock=:stock WHERE product_id=:id";
//	try {
//		$db = getConnection();
//		$stmt = $db->prepare($sql);
//		$stmt->bindParam("name", $product->product_name);
//		$stmt->bindParam("description", $product->product_description);
//		$stmt->bindParam("price", $product->product_price);
//		$stmt->bindParam("stock", $product->product_stock);
//		$stmt->bindParam("id", $id);
//		$stmt->execute();
//		$db = null;
//		echo json_encode($product);
//	} catch(PDOException $e) {
//		echo '{"error":{"text":'. $e->getMessage() .'}}';
//	}
//}
//
//function getConnection() {
//	$dbhost="localhost";
//	$dbuser="root";
//	$dbpass="";
//	$dbname="angular-crud";
//	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
//	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//	return $dbh;
//}
//

?>