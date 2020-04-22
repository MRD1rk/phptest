<?php

namespace Core;


class Filter
{
    protected $sanitizers = [];

    public function __construct()
    {
    }

    public function sanitize($value = null, $sanitizer = null)
    {

        if (!empty($sanitizer) && is_array($sanitizer)) {
            foreach ($sanitizer as $sanitize) {
                $this->sanitizers[] = $sanitize;
            }
        } else
            $this->sanitizers[] = $sanitizer;

        foreach ($this->sanitizers as $sanitizer) {
            $value = $this->makeSanitize($value, $sanitizer);
        }
        return $value;
    }

    public function makeSanitize($value, $sanitize)
    {
        switch ($sanitize) {
            case 'int':
                $value = filter_var($value,FILTER_VALIDATE_INT);
                break;
            case 'string':
                $value = (string)$value;
                break;
            case 'striptags':
                $value = addslashes(strip_tags($value));
                break;
            case 'email':
                $value = filter_var($value,FILTER_VALIDATE_EMAIL);
                break;
        }
        return $value;
    }
}