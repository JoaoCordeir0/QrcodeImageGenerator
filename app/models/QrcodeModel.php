<?php 

namespace App\models {
    
    use chillerlan\QRCode\QRCode;
    use App\core\DataBase;
    
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


        /**
         * Função responsável por inserir as informações do qrcode no banco de dados.
         * 
         * @return id 
         */
        public function setNewQrcode($name, $linkedin, $github)
        {                        
            $name = base64_encode($name);
            $linkedin = base64_encode($linkedin);
            $github = base64_encode($github);
           
            $setInfoQrcode = (new DataBase)->prepare("INSERT INTO qrcode (name, linkedin, github) VALUES (?,?,?)");
            $setInfoQrcode->bindParam(1, $name, \PDO::PARAM_STR);
            $setInfoQrcode->bindParam(2, $linkedin, \PDO::PARAM_STR);
            $setInfoQrcode->bindParam(3, $github, \PDO::PARAM_STR);
            $setInfoQrcode->execute();
    
            $getQrcode = (new DataBase)->prepare("SELECT id FROM qrcode ORDER BY id DESC");
            $getQrcode->execute();
    
            if ($result = $getQrcode->fetch())
            {
                return $result["id"];
            }            
        }


        /**
         * Função responsável por retornar as informações que serão disponibilizadas na api de consulta do qrcode
         * 
         * @return String
         */
        public function getInfoQrcode($id)
        {                        
            $getQrcode = (new DataBase)->prepare("SELECT * FROM qrcode WHERE id = ?");
            $getQrcode->bindParam(1, $id, \PDO::PARAM_STR);
            $getQrcode->execute();

            if ($result = $getQrcode->fetch())
            {          
                $array = [
                    'name' => $result['name'],
                    'github' => $result['github'],
                    'linkedin' => $result['linkedin'],
                ];
                return $array;
            }
            return null;     
        }
    }
}
