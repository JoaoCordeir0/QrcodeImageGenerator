<?php

namespace App\routes 
{   
    use App\controllers\HomeController;
    use Exception;

    class Routes
    {
        /**
         * Controller das rotas.
         * 
         * Realiza o tratamento e execução das rotas
         */
        public function run(string $requestUri)
        {
            try
            {
                $route = explode("?", substr($requestUri, 1))[0];
            }
            catch (Exception) 
            {
                $route = substr($requestUri, 1);
            }
                        
            $route === '' ? $this->home() : $this->$route();            
        }


        /**
         * Rotas do sistema
         */
        protected function home()
        {
            (new HomeController)->pageHome('HomeView');            
        }

        protected function showqrcode()
        {
            (new HomeController)->pageShowQrCode('ShowQrcodeView');  
        }

        protected function qrcodeinfo()
        {
            $_SESSION['name'] = $_GET['name'];
            $_SESSION['linkedin'] = $_GET['linkedin'];
            $_SESSION['github'] = $_GET['github'];
            
            $newURL = $_SERVER['HTTP_POST'] . '/' . base64_decode($_GET['name']);

            header('Location: ' . $newURL);
        }
        
        public function __call($name, $arguments)
        {            
            (new HomeController)->pageQrCodeDetails('DetailsQrcodeView');  
        }
    }
}

?>