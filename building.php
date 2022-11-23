<?php

class Building
{
    public function __construct(
        private int $id,
        private readonly string $type,
        private readonly string $color
    )
    {}

    public function __tostring(): string
    {
        return "<piece class='{$this->type} {$this->color}' onclick='location.href=`?{$this->type}={$this->id}`'>{$this->id}</piece>";
    }

    public function getType(){
        return $this->type;
    }

    public function setID($id){
        $this->id = $id;
    }
}