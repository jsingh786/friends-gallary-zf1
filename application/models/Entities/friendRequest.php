<?php
namespace Entities;
use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * @ORM\Entity
 */
class friendRequest
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $status;
 
    /**
     * @var datetime $created_at
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created_at;
 /**
     * @var datetime $updated_at
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity="Entities\users", inversedBy="senderFriendRequest")
     * @ORM\JoinColumn(name="sender_id", referencedColumnName="id")
     */
    private $friendRequestSender;

    /**
     * @ORM\ManyToOne(targetEntity="Entities\users", inversedBy="receiverFriendRequest")
     * @ORM\JoinColumn(name="receiver_id2", referencedColumnName="id")
     */
    private $friendRequestReceiver;


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }

    public function getStatus()
    {
        return $this->status;
    }


    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getFriendRequestSender()
    {
        return $this->friendRequestSender;
    }


    public function setFriendRequestSender($friendRequestSender)
    {
        $this->friendRequestSender = $friendRequestSender;
    }

    public function getFriendRequestReceiver()
    {
        return $this->friendRequestReceiver;
    }


    public function setFriendRequestReceiver($friendRequestReceiver)
    {
        $this->friendRequestReceiver = $friendRequestReceiver;
    }
    public function getCreated_at()
    {
        return $this->created_at;
    }


    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdated_at()
    {
        return $this->updated_at;
    }


    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;
    }
}