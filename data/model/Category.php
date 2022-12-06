<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

class Category
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    public function getAll()
    {
        $sql = "SELECT id, name from categories";
        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($category_id)
    {
        $sql = "SELECT id, name FROM categories WHERE id = $category_id";
        $result = $this->conn->query($sql);

        $this->conn->close();
        return $result->fetch_assoc();
    }

    public function save($request)
    {
        $category_name = $request['name'];

        $sql = "INSERT INTO categories(name) VALUES (?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s",$category_name);

        $result = '';
        if ($stmt->execute() === TRUE) {
            $result = "Successfully Save";
        } else {
            $result = "Error: <br>" . $this->conn->error;
        }

        $this->conn->close();

        return $result;
    }

    public function update($request)
    {
        $category_id = $request['id'];
        $category_name = $request['name'];

        $sql = "UPDATE categories SET name=? WHERE id=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si",$category_name, $category_id);

        $result = '';
        if ($stmt->execute() === TRUE) {
            $result = "Updated Successfully";
        } else {
            $result = "Error updating record: " . $this->conn->error;
        }

        $this->conn->close();

        return $result;
    }

    public function delete($category_id)
    {
        $sql = "DELETE FROM categories WHERE id=$category_id";

        $result = '';
        if ($this->conn->query($sql) === TRUE) {
            $result = "Deleted Successfully";
        } else {
            $result = "Error deleting record: " . $this->conn->error;
        }

        $this->conn->close();

        return $result;


    }
}
