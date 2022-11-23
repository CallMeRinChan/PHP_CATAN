<?php

include_once "board.php";
include_once "player.php";

class Controller
{
    private Board $Board;
    private array $Players;

    public function __construct($names){
        $this->Board = new Board();
        $this->Players = [];
        for($i=0;$i<count($names);$i++) {
            $this->Players[$i] = new Player($i+1, $names[$i]);
        }

        $this->turn = 0;
    }

    public function __toString() : string
    {
         return "<catan>\n" . implode('',$this->Players) . $this->Board . "</catan>\n";
    }

    public function PlaceBuilding(): void
    {
        if(isset($_GET['road'])){
            $piece = $this->Players[$this->turn]->GivePiece("road");
            $id = $_GET['road'];
        }elseif(isset($_GET['city'])){
            $piece = $this->Players[$this->turn]->GivePiece("village");
            $id = $_GET['city'];
        }elseif(isset($_GET['village'])){
            // maak receivepiece function als HW!!!
            $this->Players[$this->turn]->ReceivePiece(new Building("village"));
            $piece = $this->Players[$this->turn]->GivePiece("village");
            $id = $_GET['city'];
        }
        $this->Board->placebuilding($piece, $id);
    }
}

/*
<catan>
    <?=$b?>
    <?=$c?>
    <?=$d?>
    <?=$e?>
    <?=$a?>
</catan>


$a = new Board();

$b = new Player(1,"Aardige jongeman");
$c = new Player(2,"Onaardige jongeman");
$d = new Player(3,"Hardwerkende jongeman");
$e = new Player(4,"Luie jongeman");
*/
