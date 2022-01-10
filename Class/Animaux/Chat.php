<?php
namespace Class\Animaux;
class Chat extends Mammifere
{
    public function getCri(): string
    {
        $this->cri = "Miaou";
        return $this->cri;
    }
}