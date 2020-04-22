<?php

namespace Core\Message;


class Success implements MessageInterface
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function render()
    {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> ' . $this->message . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>';
    }
}