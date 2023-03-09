<?php
require_once __DIR__.'/style-class.php';
class style_Db {
    private array $styles;
    private const STYLE_DB_PATH = __DIR__ . '/styles.txt';

    public function __construct() {
        $this->styles = $this->getStylesFromDb();
    }

    public function getStylesFromDb(): array {
        $stylesFileContent = file_get_contents(self::STYLE_DB_PATH);
        $result= [];
        foreach(array_filter(explode(PHP_EOL, $stylesFileContent),fn ($style) => $style !== '') as $style) {
            $style = explode(',', $style);
            $style = new style($style[0], $style[1], $style[2] = 'description indisponible');
            $result += array($style->getStyleId()=>$style);
        }
        return $result;
    }

    public function getStyles(): array
    {
        return $this->styles;
    }

    public function contains(Style $style): bool
    {
        if($this->comparestyles($style)){
            return true;
        }else if(array_key_exists($style->getstyleId(), $this->styles)) {
            throw new Exception('erreur : l\'index fournit est occupé');
        } else
        return false;
    }


    public function add(Style $style): bool
    {
        try {
            if($this->contains($style) == true) {
                throw new Exception('erreur : style déjà existant');}
        } catch (Exception $e) {
            if ($e->getMessage() == 'erreur : l\'index fournit est occupé'){
                $style->setStyleId(array_key_last($this->styles) + 1);
            }else {
                throw new Exception($e->getMessage());
                exit;
            }
        }
        
        $stylesFile = fopen(self::STYLE_DB_PATH, 'a');
        $write = fwrite($stylesFile, $style->getStyleId() . ',' . $style->getStyleName() .','. $style ->getStyleDescription(). PHP_EOL);
        if ($write !== false) {
            return true;
        }
        fclose($stylesFile);
    }

    public function getStyleById(int $style_Id): style {
        if (!is_int($style_Id) || is_null($style_Id)) {
            throw new Exception('valeur incorrecte');
        }else if (isset($this->styles[$style_Id])) {
            return $this->styles[$style_Id];
        }else (
            throw new Exception('Style inconnu')
        );
    }

    public function comparestyles(style $style): bool {
        foreach ($this->styles as $styleDb) {
            if ($styleDb->getStyleName() == $style->getStyleName()) {
                return true;
            }
        }
        return false;
        
    }
    
}