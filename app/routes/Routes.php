<?php

namespace App\routes 
{   
    use App\controllers\HomeController;
    use App\controllers\QrcodeController;
    use App\models\QrcodeModel;
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
            (new QrcodeController)->pageShowQrCode('ShowQrcodeView');  
        }

        protected function detailsqrcode()
        {            
            (new QrcodeController)->redirectDetailsqrcode();          
        }

        protected function qrcodeinfo()
        {            
            print_r((new QrcodeModel)->getInfoQrcode($_GET['id']));            
        }
        
        public function __call($name, $arguments)
        {            
            (new QrcodeController)->pageQrCodeDetails('DetailsQrcodeView');  
        }
    }
}

?>