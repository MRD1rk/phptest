<?php

namespace Core;


class Response
{
    public function setJsonContent($response = '')
    {
        $this->setHeader('Content-Type: application/json');
        return json_encode($response);
    }

    public function setHeader($header)
    {
        header($header);
    }

    public function redirect($url)
    {
        $this->setHeader('Location:' . $url);
        exit;
    }
}