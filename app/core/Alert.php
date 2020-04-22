<?php

namespace Core;


use Core\Message\MessageInterface;
use Core\Message\Error;
use Core\Message\Success;

class Alert
{
    protected $messages = [];

    public function add(MessageInterface $message)
    {
        $this->messages[] = $message;
        return $this;
    }

    public function error($message)
    {
        $message = new Error($message);
        $this->add($message);
    }

    public function success($message)
    {
        $message = new Success($message);
        $this->add($message);
    }

    public function output()
    {
        $content = '';
        if (!empty($this->messages)) {
            foreach ($this->messages as $message) {
                $content .= $message->render();
            }
        }
        $this->messages = [];
        return $content;
    }
}