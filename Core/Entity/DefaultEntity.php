<?php
namespace Core\Entity;

class DefaultEntity{

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    /**
     * Hydrate l'objet pour charger les données
     *
     * @param array $data
     * @return void
     */
    public function hydrate (array $data)
    {
        // if (isset($data["name"])) {
        //     $this->setName($data["name"]);
        // }

        // On va générer les setter en fonction des clés qu'on reçoit dans l'array
        // On va vérifier que le setter existe
        // S'il existe on utilise le setter
        foreach ($data as $key => $value) {
            $method = "set". ucfirst($key);
            //setId, setName
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}