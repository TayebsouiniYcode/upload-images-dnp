<?php

namespace app\core;

class Request
{

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position === false){
            return $path;
        }

        $path = substr($path, 0, $position);
        return $path;
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->method() === 'get';
    }

    public function isPost()
    {
        return $this->method() === 'post';
    }

    public function getBody()
    {
        $body = [];

        if ($this->method() === 'get')
        {
            foreach($_GET as $key => $value)
            {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->method() === 'post')
        {
            $_POST['image'] = $_FILES['image']['name'] ?? '';
            foreach($_POST as $key => $value)
            {
                if(!empty($_FILES['image']['name']) && $key === 'image') {
                    $filename = $_FILES['image']['name'];
                    $filetmpname = $_FILES['image']['tmp_name'];
                    $folder = "assets/img/";
                    if(move_uploaded_file($filetmpname, $folder.$filename))
                    {
                        $body[$key] = $filename;
                    }
                } else {
                    $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
                
            }
        }

        return $body;
    }

}