<?php

namespace App\controllers 
{
    use App\models\QrCodeModel;

    class HomeController
    {
        /**
         * Função responsável por renderizar a HomePage.
         */
        public function pageHome($namePage)
        {   
            $arrayMap = [
                // variáveis da página home                                
            ];  

            $arrayMap = array_merge($arrayMap, PartialsController::partials());

            print ViewController::render($namePage, $arrayMap);
        }       
        

        /**
         * Função responsável por renderizar o qrcode gerado.
         */
        public function pageShowQrCode($namePage)
        {
            $url = "http://" . $_SERVER['HTTP_HOST'] . "/qrcodeinfo?name=" . base64_encode($_POST['name']) . 
                   "&linkedin=" . base64_encode($_POST['linkedin']) . 
                   "&github=" . base64_encode($_POST['github']); 
            
            $arrayMap = [
                'name' => $_POST['name'],
                'qrcode' => (new QrCodeModel)->qrcodeGenerator($url),
            ];  

            $arrayMap = array_merge($arrayMap, PartialsController::partials());

            print ViewController::render($namePage, $arrayMap);
        }


        /**
         * Função responsável por renderizar as informações do qrcode.
         */
        public function pageQrCodeDetails($namePage)
        {                      
            $arrayMap = [
                'name' => base64_decode($_SESSION['name']),
                'linkedin' => base64_decode($_SESSION['linkedin']),
                'github' => base64_decode($_SESSION['github'])
            ];  

            $arrayMap = array_merge($arrayMap, PartialsController::partials());

            print ViewController::render($namePage, $arrayMap);
        }
    }
}

?>