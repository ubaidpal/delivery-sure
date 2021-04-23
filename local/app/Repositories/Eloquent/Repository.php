<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 10-Jun-16 4:54 PM
 * File Name    : Repository.php
 */

namespace Repositories\Eloquent;

use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Repositories\Contracts\CriteriaInterface;
use Repositories\Contracts\RepositoryInterface;
use Repositories\Criteria\Criteria;

abstract class Repository implements RepositoryInterface, CriteriaInterface
{
    private   $app;
    protected $model;
    /**
     * @var Collection
     */
    protected $criteria;

    /**
     * @var bool
     */
    protected $skipCriteria = FALSE;

    /**
     * Repository constructor.
     *
     * @param $app
     */
    public function __construct(App $app, Collection $collection) {
        $this->app = $app;
        $this->makeModel();
        $this->criteria = $collection;
        $this->applyCriteria();
        $this->resetScope();
    }

    abstract function model();

    /**
     * @param array $columns
     *
     * @return mixed
     */
    public function all($columns = array('*')) {
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     *
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*')) {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data) {

        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     *
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id") {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id) {
        return $this->model->destroy($id);
    }

    /**
     * @param $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = array('*')) {
        return $this->model->find($id, $columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*')) {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    public function getBy($attribute, $value, $order, $columns = array('*')) {
        return $this->model->where($attribute, '=', $value)->orderBy('id', $order)->get($columns);
    }

    public function getByPaginate($attribute, $value, $order, $perPage = 12, $columns = array('*')) {
        return $this->model->where($attribute, '=', $value)->orderBy('id', $order)->paginate($perPage, $columns);
    }

    public function getByPaginateWith($attribute, $value, $order, $with, $perPage = 12, $columns = array('*')) {
        $query = $this->model->with($with)->where($attribute, '=', $value)->orderBy('id', $order);
        if(\URLFilter::filter()) {
            return $query->get();
        } else {
            return $query->paginate($perPage, $columns);
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws RepositoryException
     */
    public function makeModel() {

        $model = $this->app->make($this->model());

        if(!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model->newQuery();
    }

    /**
     * @return $this
     */
    public function resetScope() {
        $this->skipCriteria(FALSE);
        return $this;
    }

    /**
     * @param bool $status
     *
     * @return $this
     */
    public function skipCriteria($status = TRUE) {
        $this->skipCriteria = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCriteria() {
        return $this->criteria;
    }

    /**
     * @param Criteria $criteria
     *
     * @return $this
     */
    public function getByCriteria(Criteria $criteria) {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }

    /**
     * @param Criteria $criteria
     *
     * @return $this
     */
    public function pushCriteria(Criteria $criteria) {
        $this->criteria->push($criteria);
        return $this;
    }

    /**
     * @return $this
     */
    public function applyCriteria() {
        if($this->skipCriteria === TRUE)
            return $this;

        foreach ($this->getCriteria() as $criteria) {
            if($criteria instanceof Criteria)
                $this->model = $criteria->apply($this->model, $this);
        }

        return $this;
    }
}
