<?php

namespace App\Models\Contracts;

use App\Models\Contracts\BaseModel;

class JsonBaseModel extends BaseModel
{
    private $db_folder;
    private $table_filePath;

    public function __construct()
    {
        $this->db_folder = BASE_PATH . 'storage/jsondb/';
        $this->db_filePath = $this->db_folder . $this->table . '.json';
    }

    public function read_table(): array
    {
        $table_data = json_decode(file_get_contents($this->db_filePath));
        return $table_data;
    }

    public function write_table($data)
    {
        $data_json = json_encode($data);
        file_put_contents($this->db_filePath, $data_json);
    }


    # create (INSERT)
    public function create(array $new_data): int
    {
        $table_data = $this->read_table();
        $table_data[] = $new_data;
        $this->write_table($table_data);
        return $new_data[$this->primaryKey];
        // return 1;
    }


    # Read (SELECT)  Single | Multiple
    public function find($id): object
    {
        $table_data = $this->read_table();
        foreach ($table_data as $row) {
            if ($row->{$this->primaryKey} == $id) {
                return $row;
            }
        }
        return null;
    }

    public function get(array $columns, array $where): array
    {
        return [];
    }

    public function getAll(): array
    {
        return $this->read_table();
    }


    # Update (UPDATE)
    public function update(array $data, array $where): int
    {
        return 1;
    }


    # Delete (DELETE)
    public function delete(array $where): int
    {
        return 1;
    }
}
