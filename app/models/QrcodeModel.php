<?php 

namespace App\models {
    
    use chillerlan\QRCode\QRCode;
    
    class QrcodeModel
    {
        /**
         * Função responsável por gerar o qrcode.
         * 
         * @return Qrcode
         */
        public function qrcodeGenerator($url)
        {                                                
            return (new QRCode)->render($url);
        }
    }
}
