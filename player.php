<?php

class Player
{
    private array $pieces;
    private array $resources;

    public function __construct(
        private int $id,
        private string $name
    )
    {
        $this->pieces = [];
        for ($i = 0; $i < 4; $i++) {
            $this->pieces['cities'][] = new building($i, "city", "p{$this->id}");
        }
        for ($i = 0; $i < 5; $i++) {
            $this->pieces['villages'][] = new building($i, "village", "p{$this->id}");
        }
        for ($i = 0; $i < 15; $i++) {
            $this->pieces['roads'][] = new building($i, "road", "p{$this->id}");
        }
        $this->resources = ["sheep" => 0, "stone" => 0, "wood" => 0, "ore" => 0, "wheat" => 0];
        console("Created Player {$this->id} with " . count($this->pieces['cities']) . " and " . count($this->pieces['villages']) . " and " . count($this->pieces['roads']));

    }

    public function __toString() : string
    {
        $print = "<Player id='P{$this->id}'>\n";
        $print .= "<h3> {$this->name} </h3>";
        $print .= "<buildings>";
        foreach($this->pieces as $catagories){
            $print .= implode($catagories);
        }
        $print .= "</buildings>";
        $print .= "<resources>";
        foreach($this->resources as $resource => $amount){
            $print .= "<card class='{$resource}'>\n";
            $print .= "<div></div>\n<p>";
            $print .= ($amount>9)?$amount:"0".$amount;
            $print .= "X</p>";
            $print .= "</card>";
        }
        $print .= "</resources>";
        $print .= "</Player>\n";
        return $print;
    }

    public function GivePiece(string $type): Building
    {
        return match ($type) {
            "road" => array_pop($this->pieces[$type]),
            "village" => array_pop($this->pieces[$type]),
            "city" => array_pop($this->pieces[$type])
        };
    }
}