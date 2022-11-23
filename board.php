<?php
include_once "building.php";
include_once "tile.php";

class Board
{
    /** @var Tile[] */
    public array $tiles;
    public array $docks;
    /** @var int[] */
    public array $buildings;
    public array $roads;

    public function __construct()
    {
        $Numbers = [1=>11,12,9,4,6,5,10,3,11,7,4,8,8,10,9,3,5,2,6];
        $Types = [1=>"wood","grass","wheat","stone","iron","stone","grass","wood","wheat","","wood","wheat","stone","grass","grass","iron","iron","wheat","wood"];
        for ($i = 1; $i < 20; $i++) {
            $this->tiles[$i] = new Tile($Numbers[$i], $Types[$i]);
        }
        for ($i = 1; $i < 55; $i++) {
            $this->buildings[$i] = new Building($i,"city", "");
        }
        for ($i = 72; $i > 0; $i--) {
            $this->roads[$i] = new Building($i,"road", "");
        }
    }

    public function __ToString(): string
    {
        $print = "<board>\n";
        $print .= $this->cityRow(1,8);
        $print .= $this->tileRow(1,4);
        $print .= $this->cityRow(8,17);
        $print .= $this->tileRow(4,8);
        $print .= $this->cityRow(17,28);
        $print .= $this->tileRow(8,13); // middelste tiles, dus vanaf hier weer achterstevoren
        $print .= $this->cityRow(28,39);
        $print .= $this->tileRow(13,17);
        $print .= $this->cityRow(39,48);
        $print .= $this->tileRow(17,20);
        $print .= $this->cityRow(48,55);
        $print .= "</board>\n";
        return $print;
    }

    private function cityRow(int $start, int $stop): string
    {
        $print = "<cityrow>\n";
        for($i = $start; $i < $stop; $i++) {
            $print .= $this->buildings[$i];
            if($i!=$stop-1) {
                $print .= array_pop($this->roads);
            }
        }
        $print .= "</cityrow>\n<br/>";
        return $print;
    }

    private function tileRow(int $start, int $stop): string
    {
        $print = "<tilerow>\n";
        $print .= array_pop($this->roads);
        for($i = $start; $i < $stop; $i++) {
            $print .= $this->tiles[$i];
            $print .= array_pop($this->roads);
        }
        $print .= "</tilerow>\n<br/>";
        return $print;
    }

    public function PlaceBuilding(Building $piece,$id): void{
        $buildingType = $piece->GetType();
        switch($buildingType) {
            case "road":
                $this->roads[$id] = $piece;
                $this->roads[$id]->setID($id);
                break;

            case "village":
            case "city":
                $this->buildings[$id] = $piece;
                $this->buildings[$id]->setID($id);
                break;
        }
    }
}