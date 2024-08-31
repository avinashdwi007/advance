<?php
class Location
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getCountries()
    {
        $query = "SELECT id, name FROM countries";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        $countries = [];

        while ($row = $result->fetch_assoc()) {
            $countries[] = $row;
        }

        $result->free(); 
        return $countries;
    }

    public function getStates($countryId)
    {
        $query = "SELECT id, name FROM states WHERE country_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $countryId);
        $stmt->execute();

        $result = $stmt->get_result();
        $states = [];

        while ($row = $result->fetch_assoc()) {
            $states[] = $row;
        }

        $result->free();
        return $states;
    }

    public function getCities($stateId)
    {
        $query = "SELECT id, name FROM cities WHERE state_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $stateId);
        $stmt->execute();

        $result = $stmt->get_result();
        $cities = [];

        while ($row = $result->fetch_assoc()) {
            $cities[] = $row;
        }

        $result->free();
        return $cities;
    }
}
