<?php

namespace App\controllers 
{    
    class PartialsController
    {
        /**
         * Função responsável por retornar um array contendo o 
         * HEAD, HEADER, FOOTER e SCRIPTS que várias páginas utilizam.
         * 
         * @return Array
         */
        public static function partials()
        {   
            $arrayMap = [
                // variáveis das partials
                'journalName' => 'Critical Care Science'                          
            ];  

            return [
                'head'      => ViewController::render('partials/HeadPartials', $arrayMap),
                'header'    => ViewController::render('partials/HeaderPartials', $arrayMap),
                'footer'    => ViewController::render('partials/FooterPartials', $arrayMap),
                'scripts'   => ViewController::render('partials/ScriptsPartials', $arrayMap)
            ];               
        }        
    }
}

?>