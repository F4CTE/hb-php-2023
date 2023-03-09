<?php
require_once __DIR__.'/band-class.php';
require_once __DIR__.'/style-bdd.php';
class band_Db {
    private array $bands;
    private const BAND_DB_PATH = __DIR__ . '/bands.txt';

    public function __construct() {
        $this->bands = $this->getbandsFromDb();
    }

    public function getbandsFromDb(): array {
        $bandsFileContent = file_get_contents(self::BAND_DB_PATH);
        $result = [];
        $styles = new style_Db();
        foreach(array_filter(explode(PHP_EOL, $bandsFileContent),fn ($band) => $band !== '') as $band) {
            $band = explode(',', $band);
            $band = new band($band[0], $band[1], $band[2], $styles->getStyleById($band[3]), $band[4] = 'description indisponible');
            $result += array($band->getBandId() =>$band);
        }
        return $result;
    }

    public function getbands(): array
    {
        return $this->bands;
    }

    public function contains(band $band): bool
    {
        if($this->compareBands($band)){
            return true;
        }else if(array_key_exists($band->getBandId(), $this->bands)) {
            throw new Exception('erreur : l\'index fournit est occupé');
        } else
        return false;
    }

    public function add(band $band): bool
    {
        try {
            if($this->contains($band) == true) {
                throw new Exception('erreur : band déjà existant');}
        } catch (Exception $e) {
            if ($e->getMessage() == 'erreur : l\'index fournit est occupé'){
                $band->setBandId(array_key_last($this->bands) + 1);
            }else {
                throw new Exception($e->getMessage());
                exit;
            }
        }
        $this ->bands += array($band->getBandId() => $band);
        $bandsFile = fopen(self::BAND_DB_PATH, 'a');
        $write = fwrite($bandsFile, $band->getBandId() . ',' . $band->getBandName() . ',' . $band->getBandDate(). ',' . $band->getStyleId() . ',' . $band ->getBandDescription(). PHP_EOL);
        if ($write !== false) {
            return true;
        }
        fclose($bandsFile);
    }

    public function getbandById(int $band_Id): band {
        if (!is_int($band_Id) || is_null($band_Id)) {
            throw new Exception('valeur incorrecte');
        }
        if (!isset($this->bands[$band_Id])) {
            throw new Exception('band inconnu');
        }
        return $this->bands[$band_Id];
    }


    public function compareBands(band $band): bool {
        foreach ($this->bands as $bandDb) {
            if ($bandDb->getBandName() == $band->getBandName() && $bandDb->getBandDate() == $band->getBandDate() && $bandDb->getStyleId() == $band->getStyleId()) {
                return true;
            }
        }
        return false;
    }
}