<?php

class Ville
{

    public int $id;
    public string $name;
    
    public function getNameVille()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}