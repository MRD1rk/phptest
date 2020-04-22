<?php

namespace Core;


use Core\View\Engine;

class View extends Kernel
{
    const LEVEL_LAYOUT = 1;
    const LEVEL_ACTION = 2;
    const LEVEL_AJAX = 3;
    public $render_level = 1;
    public $smarty;
    public $engine;
    public $main_view = 'layouts/main';
    public $disable = false;
    public $current_template;
    protected $controller;
    protected $action;
    protected $content;

    public function __construct()
    {

        $this->smarty = new \Smarty();
        $this->smarty->setTemplateDir(APP_PATH . '/views/');
        $this->smarty->setCompileDir(APP_PATH . '/views/.compiled_templates');
        $this->smarty->setCacheDir(APP_PATH . '/views/..cache');
    }

    public function render()
    {
        if ($this->request->isAjax()) {
            $this->view->setRenderLevel(
                View::LEVEL_AJAX
            );
        }
        switch ($this->render_level) {
            case View::LEVEL_ACTION:
                try {
                    $this->smarty->display($this->getCurrentTemplate());
                    break;
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            case View::LEVEL_LAYOUT:
                $content = $this->smarty->fetch($this->getCurrentTemplate());
                $this->smarty->assign('content', $content);
                $this->smarty->display($this->getMainTemplate());
                break;
            case View::LEVEL_AJAX:
                ob_start();
                echo $this->getContent();
                ob_end_flush();
                break;
        }
    }

    public function getPartial($template, $params = null)
    {
        if (!empty($params)) {
            foreach ($params as $key => $param) {
                $this->smarty->assign($key, $param);
            }
        }
        $content = $this->smarty->fetch($template . '.' . $this->engine);
        return $content;
    }

    public function __set($property, $value)
    {
        $this->smarty->assign($property, $value);
    }

    public function disable()
    {
        $this->disable = true;
    }

    public function setRenderLevel($render_level)
    {
        $this->render_level = $render_level;
    }

    public function setMainView($view)
    {
        $this->main_view = $view;
    }

    public function getMainTemplate()
    {
        return $this->main_view . '.' . $this->engine;
    }

    public function getCurrentTemplate()
    {
        $template = $this->controller . '/' . $this->action . '.' . $this->engine;
        return $template;
    }

    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    public function registerEngine(Engine $engine)
    {
        $this->engine = $engine->file_extension;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

}