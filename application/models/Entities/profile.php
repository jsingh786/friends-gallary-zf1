<?php
namespace Entities;
use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 */
class profile
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=2000, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=2000, nullable=true)
     */
    private $hobbies;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $education;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $experience;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $contact_no;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $location;

    /**
     * @ORM\OneToOne(targetEntity="Entities\users", inversedBy="profile")
     * @ORM\JoinColumn(name="users_id", referencedColumnName="id", nullable=false, unique=true)
     */
    private $users;


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }
    public function getPhoto()

    {
        return $this->photo;
    }
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }


     public function getHobbies()
    {
        return $this->hobbies;
    }

    /**
     * @return mixed
     */
    public function setHobbies($hobbies)
    {
        $this->hobbies=$hobbies;
    }

    /**
     * @param mixed $photo
     */
    
    public function getDescription()

    {
        return $this->description;
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function getEducation()

    {
        return $this->education;
    }


    public function setEducation($education)
    {
        $this->education = $education;
    } 
    public function getExperience()
    {
        return $this->experience;
    }

    public function setExperience($experience)
    {
        $this->experience = $experience;

    }

    public function getContactNo()
    {
        return $this->contact_no;
    }
    public function setContactNo($contact_no)
    {
        $this->contact_no = $contact_no;
    }
    
     public function getLocation()

    {
        return $this->location;
    }
    public function setLocation($location)
    {
        $this->location = $location;
    }
    public function getUsers()
    {
        return $this->users;
    }
    public function setUsers($users)
    {
        $this->users = $users;
    }

}