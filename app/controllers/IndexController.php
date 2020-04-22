<?php

namespace Controllers;

use Core\Paginator;
use Core\View;
use Models\CompareDate;
use Models\Task;
use Models\User;
use Models\Role;

class IndexController extends BaseController
{
    public function indexAction()
    {
        if ($this->request->isPost()) {
            $date = $this->request->getPost('date');
            $compare_date = new CompareDate();
            $result = $compare_date->processCompare($date);
            if (!$result) {
                foreach ($compare_date->getMessages() as $message) {
                    $this->alert->error($message);
                }
                return false;
            }

            $this->alert->success('Успех!');
            $this->view->result = $compare_date->getDifferent();
        }
    }

    public function compareAjaxAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {
            $date = $this->request->getPost('date');
            $compare_date = new CompareDate();
            $result = $compare_date->processCompare($date);
            if (!$result) {
                $response = [
                    'status' => false,
                    'message' => current($compare_date->getMessages())
                ];
            } else {
                $response = [
                    'status' => true,
                    'message' => 'Успех!',
                    'result' => $compare_date->getDifferent()
                ];
            }
            return $this->response->setJsonContent($response);
        }
    }

}
