<?php

namespace App\Models\Contracts;

interface CrudInterface{

    # create (INSERT)
    public function create(array $data) : int;

    # Read (SELECT) single | multiple
    public function find($id) : object;
    public function get($columns, array $where) : array;

    # Update records
    public function update(array $data, array $where) : int;

    # Delete
    public function delete(array $where) : int;
}