<?php
namespace MVC\Controller;
class FilterFromUrl {
	private $model;

	public function __construct(\MVC\Model\Filterable $model) {
		$this->model = $model;
	}

	public function filter(...$filter) {
		$this->model->set_filter($filter);
	}
}
