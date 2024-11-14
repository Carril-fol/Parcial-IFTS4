<?php

class Controller
{

    public function sanitizeInput($input)
    {
        return htmlentities(addslashes($input));
    }

    private function sanitizeUrl($url)
    {
        return parse_url($url);
    }

    public function getParamsUrl($url)
    {
        $urlParsed = $this->sanitizeURL($url);
        $queryParams = [];
        if (isset($urlParsed['query'])) {
            parse_str($urlParsed['query'], $queryParams);
        }
        return $queryParams;
    }

    public function getActionInUrl()
    {
        $url = $_SERVER['REQUEST_URI'];
        $queryParams = $this->getParamsUrl($url);
        if (isset($queryParams['action'])) {
            $action = $queryParams['action'];
        } else {
            $action = null;
        }
        return $action;
    }

    public function getIdUrl()
    {
        $url = $_SERVER['REQUEST_URI'];
        $queryParams = $this->getParamsUrl($url);
        if (isset($queryParams['id'])) {
            return $queryParams['id'];
        } else {
            return null;
        }
    }

    public function redirectToHome()
    {
        header("Location: ../index.php");
        exit();
    }

    public function handleError($error, $folder, $file)
    {
        session_start();
        $_SESSION['error'] = $error->getMessage();
        header("Location: ../../views/" . $folder . "/" . $file . ".php");
        exit();
    }
}