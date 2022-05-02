<?php

namespace supportSystem\Repositories;

use Illuminate\Database\Capsule\Manager;
use supportSystem\Model\DepartmentTopic;

include_once __DIR__ . '/../Model/DepartmentTopic.php';

class DepartmentTopicRepository
{
    public function __construct()
    {
        $this->model = new DepartmentTopic();
    }

    public function insert($data)
    {
        $this->model->insert($data);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function update($id, array $data)
    {
        Manager::table('topics_departments')->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
    }

    public function where($gid)
    {
        return $this->model->where('gid', $gid)->get();
    }

    public function whereByName($dep_name)
    {
        return $this->model->where('department_name', $dep_name)->get();
    }

    public function whereSubject($dep_id, $service_id)
    {
        return $this->model
            ->where('dept_id', $dep_id)
            ->where('gid', $service_id)
            ->get();
    }
}