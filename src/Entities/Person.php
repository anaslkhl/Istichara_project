<?php



class Person
{


    private int $id;
    private string $fullname;
    private string $email;
    private string $phone;
    private string $experience;
    private float $tarif;
    private string $speciality;
    private string $consultate_online;
    private string $type_actes;
    private int $ville_id;



    public function getId()
    {
        return $this->id;
    }


    public function getName()
    {
        return $this->fullname;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function getPhone()
    {
        return $this->phone;
    }


    public function getExperience()
    {
        return $this->experience;
    }


    public function getTarif()
    {
        return $this->tarif;
    }


    public function getSpeciality()
    {
        return $this->speciality;
    }

    public function getConsultateOnline()
    {
        return $this->consultate_online;
    }

    public function getTypeActes()
    {
        return $this->type_actes;
    }

    public function getVille()
    {
        return $this->ville_id;
    }



    public function setfullName($fullname)
    {
        $this->fullname = $fullname;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


    public function setExperience($experience)
    {
        $this->experience = $experience;
    }


    public function setTarif($tarif)
    {
        $this->tarif = $tarif;
    }


    public function setSpeciality($speciality)
    {
        $this->speciality = $speciality;
    }


    public function setConsoltateOnline($consultate_online)
    {
        $this->consultate_online = $consultate_online;
    }


    public function setVille($ville_id)
    {
        $this->ville_id = $ville_id;
    }


    public function setTypeActes($type_actes)
    {
        $this->type_actes = $type_actes;
    }
}
