<?php
include("database.php");
// configuracion de API y permisos
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");

header('Content-type: application/json');

// definiendo variables de busqueda
$queries = array();
$search = '';
if (isset($_SERVER['QUERY_STRING'])) {
    parse_str($_SERVER['QUERY_STRING'], $queries);
    $search = "WHERE product.name LIKE LOWER('%".$queries["q"]."%')";
}
// seleccionando las tablas a usar de la base de datos
$queryCategory = "SELECT * FROM category";
$queryProduct = "SELECT category.name AS categoryName, product.name AS productName, category.id AS categoryId, product.url_image, product.price, product.discount FROM product INNER JOIN category ON category.id = product.category ".$search;

// respuesta de error en caso de que exista
$resultCategory= $con->query($queryCategory) or trigger_error(mysqli_error($con));
$resultProduct= $con->query($queryProduct) or trigger_error(mysqli_error($con));

$categories= array();
$products= array();

// imprimir los resultados de la consulta a la base de datos
while($row = $resultCategory->fetch_array(MYSQLI_ASSOC)) {
    $categories[] = $row;
}

while($row = $resultProduct->fetch_array(MYSQLI_ASSOC)) {
    $products[] = $row;
}


echo json_encode(array("categories"=>$categories, "products"=>$products));
// cerrar la conexion
$con -> close();

?>







