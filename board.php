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
        for ($i = 0; $i < 20; $i++) {
            $this->tiles[] = new Tile($i, "wood");
        }
        for ($i = 0; $i < 55; $i++) {
            $this->buildings[] = new Building("city", "");
        }
        for ($i = 0; $i < 72; $i++) {
            $this->roads[] = new Building("road", "");
        }
    }

    public function __ToString(): string
    {
        $print = "<board>";
        $print .= $this->cityRow(1,8);
        $print .= $this->tileRow(1,4);
        $print .= $this->cityRow(8,17);
        $print .= $this->tileRow(4,9);
        $print .= $this->cityRow(17,28);
        $print .= $this->tileRow(9,15); // middelste tiles, dus vanaf hier weer achterstevoren
        $print .= $this->cityRow(28,39);
        $print .= $this->tileRow(15,20);
        $print .= $this->cityRow(39,48);
        $print .= $this->tileRow(20,24);
        $print .= $this->cityRow(48,54);
        $print .= "</board>";
        return $print;
    }

    private function cityRow(int $start, int $stop): string
    {
        $print = "<cityrow>";
        for($i = $start; $i < $stop; $i++) {
            $print .= $this->buildings[1];
            if($i!=$stop-1) {
                $print .= array_pop($this->roads);
            }
        }
        $print .= "</cityrow>";
        return $print;
    }

    private function tileRow(int $start, int $stop): string
    {
        $print = "<tilerow>";
        $print .= array_pop($this->roads);
        for($i = $start; $i < $stop; $i++) {
            $print .= $this->tiles[1];
            $print .= array_pop($this->roads);
        }
        $print .= "</tilerow>";
        return $print;
    }
}