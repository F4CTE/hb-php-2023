<?php
class style {
    public int $style_Id;
    public string $style_Name;
    public string $style_Description;

    function __construct(int $style_Id, string $style_Name, string $description = 'description indisponible') {
        if(isset($style_Id) && isset($style_Name) && !is_null($style_Id) && !is_null($style_Name)) {
            $this->style_Id = $style_Id;
            $this->style_Name = $style_Name;
            $this->style_Description = $description;
        } else {
            throw new Exception('Erreur : un ou plusieurs paramètres sont manquants ou vides');
        }
    }

    public function getStyleId(): int {
        return $this->style_Id;
    }

    public function getStyleName(): string {
        return $this->style_Name;
    }

    public function getStyleDescription(): string {
        return $this->style_Description;
    }
    
    public function setStyleId(int $style_Id): void {
        $this->style_Id = $style_Id;
    }
}