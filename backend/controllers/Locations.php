<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');

require_once "../config/DbConn.php";
require_once "../models/Location.php";

$location = new Location;

function sendResponse($code, $message, $data = null) {
    http_response_code($code);
    echo json_encode(['message' => $message, 'datos' => $data]);
    exit;
}

$body = json_decode(file_get_contents("php://input"), true);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $data = $location->getHousingLocationById($_GET['id']);
            sendResponse(200, "Ubicación obtenida", $data);
        } else {
            $data = $location->getAllHousingLocations();
            sendResponse(200, "Ubicaciones obtenidas", $data);
        }
        break;

    case 'POST':
        if (empty($body['name']) || empty($body['city']) || empty($body['state'])) {
            sendResponse(400, "Datos inválidos");
        }
        $location->createHousingLocation(
            $body['name'], $body['city'], $body['state'], 
            $body['photo'], $body['availableUnits'], 
            $body['wifi'], $body['laundry']
        );
        sendResponse(201, "Ubicación creada");
        break;

    case 'PUT':
        if (empty($body['id']) || empty($body['name']) || empty($body['city']) || empty($body['state'])) {
            sendResponse(400, "Datos inválidos");
        }
        $location->updateHousingLocation(
            $body['id'], $body['name'], $body['city'], 
            $body['state'], $body['photo'], 
            $body['availableUnits'], $body['wifi'], $body['laundry']
        );
        sendResponse(200, "Ubicación actualizada");
        break;

    case 'DELETE':
        if (empty($body['id'])) {
            sendResponse(400, "ID inválido");
        }
        $location->deleteHousingLocation($body['id']);
        sendResponse(200, "Ubicación eliminada");
        break;

    default:
        sendResponse(405, "Método no permitido");
}
?>
