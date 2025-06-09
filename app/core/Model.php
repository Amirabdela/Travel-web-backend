<?php
class Model {
    protected $db;
    protected $table;

    public function __construct() {
        $this->db = new Database;
    }

    // Get all records
    public function getAll() {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

    // Get record by ID
    public function getById($id) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Create new record
    public function create($data) {
        $fields = array_keys($data);
        $values = array_map(function($field) {
            return ':' . $field;
        }, $fields);

        $sql = "INSERT INTO " . $this->table . " (" . implode(', ', $fields) . ") 
                VALUES (" . implode(', ', $values) . ")";

        $this->db->query($sql);

        foreach($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }

        if($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    // Update record
    public function update($id, $data) {
        $fields = array_keys($data);
        $set = array_map(function($field) {
            return $field . ' = :' . $field;
        }, $fields);

        $sql = "UPDATE " . $this->table . " 
                SET " . implode(', ', $set) . " 
                WHERE id = :id";

        $this->db->query($sql);
        $this->db->bind(':id', $id);

        foreach($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }

        return $this->db->execute();
    }

    // Delete record
    public function delete($id) {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Find records by field
    public function findBy($field, $value) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE " . $field . " = :value");
        $this->db->bind(':value', $value);
        return $this->db->resultSet();
    }

    // Find single record by field
    public function findOneBy($field, $value) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE " . $field . " = :value");
        $this->db->bind(':value', $value);
        return $this->db->single();
    }

    // Count records
    public function count() {
        $this->db->query("SELECT COUNT(*) as count FROM " . $this->table);
        return $this->db->single()->count;
    }

    // Get records with pagination
    public function getPaginated($page = 1, $per_page = 10) {
        $offset = ($page - 1) * $per_page;
        
        $this->db->query("SELECT * FROM " . $this->table . " 
                         LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $per_page);
        $this->db->bind(':offset', $offset);
        
        return $this->db->resultSet();
    }

    // Search records
    public function search($query, $fields) {
        $conditions = array_map(function($field) {
            return $field . " LIKE :query";
        }, $fields);

        $sql = "SELECT * FROM " . $this->table . " 
                WHERE " . implode(' OR ', $conditions);

        $this->db->query($sql);
        $this->db->bind(':query', '%' . $query . '%');
        
        return $this->db->resultSet();
    }
} 