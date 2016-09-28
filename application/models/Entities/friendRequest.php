<?php
namespace Entities;
use Doctrine\ORM\Mapping AS ORM;

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
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=false)
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
}