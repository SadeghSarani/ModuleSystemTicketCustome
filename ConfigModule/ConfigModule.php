<?php

namespace supportSystem\ConfigModule;


use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Capsule\Manager as Capsule;

class ConfigModule
{
    public static function configs()
    {
        return [
            // Display name for your module
            'name' => 'Support System',
            // Description displayed within the admin interface
            'description' => 'This module provides an example WHMCS Addon Module'
                . ' This Module For Save Custom Ticket From User To Departments',
            // Module author name
            'author' => 'Sadegh Sarani',
            // Default language
            'language' => 'english',
            // Version number
            'version' => '1.0',
        ];
    }

    public static function activate()
    {
        try {
            Capsule::schema()
                ->create(
                    'topics_departments',
                    function ($table) {
                        /** @var \Illuminate\Database\Schema\Blueprint $table */
                        $table->increments('id');
                        $table->bigInteger('dept_id');
                        $table->string('gid');
                        $table->string('topics');
                    }
                );

            return [
                // Supported values here include: success, error or info
                'status' => 'success',
                'description' => 'This is a demo module only. '
                    . 'In a real module you might report a success or instruct a '
                    . 'user how to get started with it here.',
            ];
        } catch (\Exception $e) {
            return [
                // Supported values here include: success, error or info
                'status' => "error",
                'description' => 'Unable to create mod_addonexample: ' . $e->getMessage(),
            ];
        }
    }

    public static function deactive()
    {
        try {
            Manager::schema()->dropIfExists('topics_departments');
            return [
                'status' => 'success',
                'description' => 'This is a demo module only. '
                    . 'In a real module you might report a success here.',
            ];
        } catch (\Exception $e) {
            return [
                "status" => "error",
                "description" => "Unable to drop mod_addonexample: {$e->getMessage()}",
            ];
        }
    }

    public static function clientarea($list, $services)
    {
        return array(
            'pagetitle' => 'Add Ticket',
            'breadcrumb' => array('index.php?m=supportSystem' => 'support system'),
            'templatefile' => 'views/client/clientTicket',
            'vars' => array(
                'data' => $list->toArray(),
                'service' => $services['products']['product'],
            ),
        );
    }
}