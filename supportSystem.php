<?php

include_once __DIR__ . DIRECTORY_SEPARATOR . 'lib.php';


use supportSystem\ConfigModule\ConfigModule;
use supportSystem\LocalApies\LocalApi;
use supportSystem\ProcessTopic\TopicProcess;
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
    $processTopic = new TopicProcess();
    $departments = $departmentRepository->getAll();
    $id = $_POST['id'];
    $action = $_GET['action'];
    include_once Router::routeList($action);
    if (isset($_POST['update'])) {
        $data = $departmentRepository->where($id)->toArray();
        include_once __DIR__ . '/views/admin/updateTopic.php';
    }
    $processTopic->allProcessTopic($processTopic, $departmentRepository, $id);
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
        $departmentGroupID = collect($dataSql)->map(function ($item) use ($department) {
            foreach ($department as $dep) {
                if ($dep['id'] == $item['dept_id']) {
                    return $dep;
                }
            }
        });
        $departmentName = array_filter($departmentGroupID->toArray());
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

function getGid($service_id)
{
    $products = LocalApi::getProducts($service_id);
    $gid = $products['products']['product'][0]['gid'];
    return $gid;
}