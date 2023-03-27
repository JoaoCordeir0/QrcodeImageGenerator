<?php

namespace App\controllers 
{
    use App\models\QrcodeModel;

    class QrcodeController
    {       
        /**
         * Função responsável por renderizar o qrcode gerado.
         */
        public function pageShowQrCode($namePage)
        {                         
            if (!empty($_POST['name']) && !empty($_POST['linkedin']) && !empty($_POST['github']))
            {
                $url = "http://" . $_SERVER['HTTP_HOST'] . "/detailsqrcode?id=" . (new QrcodeModel)->setNewQrcode($_POST['name'], $_POST['linkedin'], $_POST['github']); 
                                
                $arrayMap = [
                    'name' => $_POST['name'],
                    'qrcode' => (new QrcodeModel)->qrcodeGenerator($url),
                ];  

                $arrayMap = array_merge($arrayMap, PartialsController::partials());

                print ViewController::render($namePage, $arrayMap);
            }
            else 
            {
                header('Location: /');
            }
        }


        /**
         * Função responsável por redirecionar para os detalhes do qrcode.
         */
        public function redirectDetailsqrcode()
        {
            $data = (new QrcodeModel)->getInfoQrcode($_GET['id']);            

            $_SESSION['name'] = $data['name'];
            $_SESSION['linkedin'] = $data['linkedin'];
            $_SESSION['github'] = $data['github'];
            
            $newURL = '/' . base64_decode($data['name']);

            header('Location: ' . $newURL);       
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