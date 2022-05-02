<?php

namespace supportSystem\Router;
class Router
{
    public function routeList($action)
    {
        $base_url = 'C:\xampp.7.4\htdocs\whmcs\modules\addons\supportSystem\Views\\admin';
        switch ($action) {
            case 'add';
                return $base_url . '\addTopic.php';
            case 'update';
                return $base_url . '\updateTopic.php';
            case null;
                return $base_url . '\topicsDepartmentList.php';
        }
    }
}