<?php

class Building
{
    public function __construct(
        private readonly int $id,
        private readonly string $type,
        private readonly string $colour
    )
    {}

    public function __tostring(): string
    {
        return "<piece class='{$this->type}'>{$this->id}</piece>";
    }
}