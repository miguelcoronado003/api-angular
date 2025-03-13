<?php
class Location {
    private $conn;

    public function __construct() {
        $this->conn = DbConn::connection();
    }

    public function getAllHousingLocations() {
        $stmt = $this->conn->query("SELECT * FROM locations");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHousingLocationById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM locations WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createHousingLocation($name, $city, $state, $photo, $availableUnits, $wifi, $laundry) {
        $stmt = $this->conn->prepare("INSERT INTO locations (name, city, state, photo, availableUnits, wifi, laundry) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $city, $state, $photo, $availableUnits, $wifi, $laundry]);
    }

    public function updateHousingLocation($id, $name, $city, $state, $photo, $availableUnits, $wifi, $laundry) {
        $stmt = $this->conn->prepare("UPDATE locations SET name = ?, city = ?, state = ?, photo = ?, availableUnits = ?, wifi = ?, laundry = ? WHERE id = ?");
        return $stmt->execute([$name, $city, $state, $photo, $availableUnits, $wifi, $laundry, $id]);
    }

    public function deleteHousingLocation($id) {
        $stmt = $this->conn->prepare("DELETE FROM locations WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
