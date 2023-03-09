<?php
class band extends style{
    public int $band_Id;
    public string $band_Name;
    public string $band_Date;
    public string $band_Description;

    function __construct(int $band_Id,string $band_Name,int $band_Date, style $style, string $band_Description = 'description indisponible') {
        if(isset($band_Id) && isset($band_Name) && !is_null($band_Id) && !is_null($band_Name) && !is_null($style)) {
            $this->band_Id = $band_Id;
            $this->band_Name = $band_Name;
            $this->band_Date = $band_Date;
            $this->band_Description = $band_Description;
            parent::__construct($style->getStyleId(), $style->getStyleName(), $style->getStyleDescription());
        } else {
            throw new Exception('Erreur : un ou plusieurs paramètres sont manquants ou vides');
        }
    }

    public function getBandId(): int {
        return $this->band_Id;
    }

    public function getBandName(): string {
        return $this->band_Name;
    }

    public function getBandDate(): string {
        return $this->band_Date;
    }

    public function getBandDescription(): string {
        return $this->band_Description;
    }

    public function setBandId(int $band_Id): void {
        $this->band_Id = $band_Id;
    }
}