<?php

namespace supportSystem\ProcessTopic;
class TopicProcess
{
    public function insertTopics($departmentRepository)
    {
        if (isset($_POST['sub']) && !empty($_POST['topic']) && !empty($_POST['dept_id'])) {
            $data = [
                'topics' => $_POST['topic'],
                'dept_id' => $_POST['dept_id'],
                'gid' => $_POST['gid'],
            ];
            $departmentRepository->insert($data);
            return true;
        }
    }

    public function updateTopic($departmentRepository, $id)
    {

    }

    public function updateTopicInDataBase($departmentRepository)
    {
        if (isset($_POST['update-data']) && !empty($_POST['dept_name']) || !empty($_POST['text'])) {
            $updateData = [
                'department_name' => $_POST['dept_name'],
                'topics' => $_POST['text'],
            ];
            $departmentRepository->update($_POST['id'], $updateData);
        }
    }

    public function deleteTopic($departmentRepository)
    {
        if (isset($_POST['delete'])) {
            $departmentRepository->delete($_POST['id']);
        }
    }

    public function allProcessTopic(TopicProcess $processTopic, $departmentRepository)
    {
        $processTopic->insertTopics($departmentRepository);
//        $processTopic->updateTopic($departmentRepository, $id);
        $processTopic->updateTopicInDataBase($departmentRepository);
        $processTopic->deleteTopic($departmentRepository);
    }
}