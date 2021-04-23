<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 10-Jun-16 4:52 PM
 * File Name    : RepositoryInterface.php
 */

namespace Repositories\Contracts;

interface RepositoryInterface
{

    public function all($columns = array('*'));

    public function paginate($perPage = 15, $columns = array('*'));

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id, $columns = array('*'));

    public function findBy($field, $value, $columns = array('*'));

    public function getBy($field, $value, $order, $columns = array('*'));

    public function getByPaginate($attribute, $value, $order, $perPage = 15, $columns = array('*'));
}
