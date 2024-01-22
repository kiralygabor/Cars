<?php
require_once 'CarsInterface.php';
require_once 'DB.php';

class DBModel extends DB implements CarsInterface
{

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): ?int
    {
        $sql = 'INSERT INTO models (%s) VALUES (%s)';
        $fields = '';
        $values = '';
        foreach ($data as $field => $value) {
            if ($fields > '') {
                $fields .= ',' . $field;
            } else
                $fields .= $field;

            if ($values > '') {
                $values .= ',' . "'$value'";
            } else
                $values .= "'$value'";
        }
        $sql = sprintf($sql, $fields, $values);
        $this->mysqli->query($sql);

        $lastInserted = $this->mysqli->query("SELECT LAST_INSERT_ID() id;")->fetch_assoc();

        return $lastInserted['id'];
    }

    public function get(int $id): array
    {
        $query = "SELECT * FROM models WHERE id = $id";

        return $this->mysqli->query($query)->fetch_assoc();
    }

    public function getByName(string $name): array
    {
        $query = "SELECT * FROM models WHERE name = '$name'";

        return $this->mysqli->query($query)->fetch_assoc();
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM models ORDER BY name";

        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function update(int $id, array $data)
    {
        $query = "UPDATE models SET name='{$data['name']}' WHERE id = $id;";
        $this->mysqli->query($query);

        return $this->get($id);
    }

    public function delete(int $id) : bool
    {
        $query = "DELETE FROM models WHERE id = $id";

        return $this->mysqli->query($query);
    }

    public function getAbc(): array
    {
        $models = $this->getAll();
        $abc = [];
        foreach ($models as $model) {
            $ch = strtoupper($model['name'][0]);
            if (!in_array($ch, $abc)) {
                $abc[] = $ch;
            }
        }

        return $abc;
    }

    public function getByFirstCh($ch)
    {
        $query = "SELECT * FROM models WHERE name LIKE '$ch%' ORDER BY name";

        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function findByName($needle)
    {
        $query = "SELECT * FROM models WHERE name LIKE '%$needle%' ORDER BY name";

        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function truncate()
    {
        $query = "TRUNCATE TABLE models;";

        return $this->mysqli->query($query);
    }

    public function getCount(): int
    {
        $query = "SELECT COUNT(1) AS cnt FROM models;";

        $result = $this->mysqli->query($query)->fetch_assoc();

        return $result['cnt'];
    }
}