<?php 

namespace App\controllers {
    
    class ViewController
    {
        /**
         * Função responsável por renderizar as views.
         * 
         * @return View
         */
        public static function render($view, $vars = []){                                    

            $file = './app/views/' . $view . '.html';      
                    
            $contentView = file_exists($file) ? file_get_contents($file) : '';             

            $keys = array_keys($vars);
            $keys = array_map(function($item){
                return '{{'.$item.'}}';
            }, $keys);

            return str_replace($keys, array_values($vars), $contentView);
        }
    }
}
