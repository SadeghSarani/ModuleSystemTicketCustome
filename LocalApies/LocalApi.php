<?php

namespace supportSystem\LocalApies;

class LocalApi
{
    public static function getProductUser($user_id)
    {

        return localAPI('GetClientsProducts', ['clientid' => $user_id]);
    }

    public static function getDepartments()
    {

        return localAPI('GetSupportDepartments');
    }

    public static function openNewTicket($dept_id, $subject, $client_id, $priority, $service_id, $message)
    {
        $postData = array(
            'deptid' => $dept_id,
            'subject' => $subject,
            'clientid' => $client_id,
            'priority' => $priority,
            'serviceid' => $service_id,
            'message' => $message,
        );

        return localAPI('OpenTicket', $postData);
    }

    public static function getProducts($pid)
    {

        return localAPI('GetProducts', ['pid' => $pid]);
    }
}