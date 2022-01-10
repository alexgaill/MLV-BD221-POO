<?php
namespace Classe\Animaux;
class Chat extends Mammifere
{
    public function getCri(): string
    {
        $this->cri = "Miaou";
        return $this->cri;
    }
}