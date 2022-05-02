<?php

include_once __DIR__ . DIRECTORY_SEPARATOR . 'ConfigModule/ConfigModule.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'Router/Router.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'Repositories/DepartmentTopicRepository.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'SetPage.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'LocalApies/LocalApi.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'Repositories/ProductGroupRepository.php';


use supportSystem\ConfigModule\ConfigModule;
use supportSystem\LocalApies\LocalApi;
use supportSystem\Repositories\DepartmentTopicRepository;
use supportSystem\Repositories\ProductGroupRepository;
use supportSystem\Router\Router;
use supportSystem\SetPage;


function supportSystem_config()
{
    return ConfigModule::configs();
}

function supportSystem_activate()
{
    return ConfigModule::activate();
}

function supportSystem_deactive()
{
    return ConfigModule::deactive();
}

function supportSystem_output($vars)
{
    $departmentRepository = new DepartmentTopicRepository();
    $results = LocalApi::getDepartments();
    $group = new ProductGroupRepository();
    $productGroup = $group->getProductAll();
    $route = new Router();
    $action = $_GET['action'];
    $departments = $departmentRepository->getAll();
    $id = $_POST['id'];
    include $route->routeList($action);
    if (isset($_POST['sub']) && !empty($_POST['topic']) && !empty($_POST['dept_id'])) {
        $data = [
            'topics' => $_POST['topic'],
            'dept_id' => $_POST['dept_id'],
            'gid' => $_POST['gid'],
        ];
        $departmentRepository->insert($data);
    }
    if (isset($_POST['update'])) {
        $data = $departmentRepository->where($id)->toArray();
        include_once __DIR__ . '/views/admin/updateTopic.php';
    }
    if (isset($_POST['update-data']) && !empty($_POST['dept_name']) || !empty($_POST['text'])) {
        $updateData = [
            'department_name' => $_POST['dept_name'],
            'topics' => $_POST['text'],
        ];
        $departmentRepository->update($_POST['id'], $updateData);
    }
    if (isset($_POST['delete'])) {
        $departmentRepository->delete($_POST['id']);
    }
}

function supportSystem_clientarea()
{
    $departmentRepository = new DepartmentTopicRepository();
    $user_id = json_decode($_SESSION['login_auth_tk'])->id;
    $services = LocalApi::getProductUser($user_id);
    $data = LocalApi::getDepartments();
    if ($_GET['action'] == 'product') {
        $service_id = $_POST['service_id'];
        $gid = getGid($service_id);
        $dataSql = $departmentRepository->where($gid);
        $department = LocalApi::getDepartments();
        $department = $department['departments']['department'];
        $callback = collect($dataSql)->map(function ($item) use ($department) {
            foreach ($department as $dep) {
                if ($dep['id'] == $item['dept_id']) {
                    return $dep;
                }
            }
        });
        $departmentName = array_filter($callback->toArray());
        echo json_encode($departmentName);
        http_response_code(200);
        die;
    }
    if ($_GET['action'] == 'subject') {
        $dep_id = $_POST['department_id'];
        $gid = getGid($_POST['service_id']);
        $subject = $departmentRepository->whereSubject($dep_id, $gid);
        echo json_encode($subject);
        http_response_code(200);
        die;
    }
    if ($_GET['action'] == 'submit') {
        $department_id = $_POST['department_id'];
        $subject = $_POST['subject'];
        $service_id = $_POST['service_id'];
        $priority = $_POST['priority'];
        $message = $_POST['message'];
        $result = LocalApi::openNewTicket($department_id, $subject, $user_id, $priority, $service_id, $message);
        echo json_encode($result);
        die;
    }

    return SetPage::setPage($data['departments']['department'], $services);
}

/**
 * @param $service_id
 * @return mixed
 */
function getGid($service_id)
{
    $products = LocalApi::getProducts($service_id);
    $gid = $products['products']['product'][0]['gid'];
    return $gid;
}