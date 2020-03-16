<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuoteRepository")
 */
class Quote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $status;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=true)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="quotes", cascade={"persist"})
     */
    private $user;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $send_to_user;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $approved_by_user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Order", mappedBy="quote", cascade={"persist", "remove"})
     */
    private $quote_order;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSendToUser(): ?\DateTimeInterface
    {
        return $this->send_to_user;
    }

    public function setSendToUser(?\DateTimeInterface $send_to_user): self
    {
        $this->send_to_user = $send_to_user;

        return $this;
    }

    public function getApprovedByUser(): ?\DateTimeInterface
    {
        return $this->approved_by_user;
    }

    public function setApprovedByUser(?\DateTimeInterface $approved_by_user): self
    {
        $this->approved_by_user = $approved_by_user;

        return $this;
    }

    public function getQuoteOrder(): ?Order
    {
        return $this->quote_order;
    }

    public function setQuoteOrder(Order $quote_order): self
    {
        $this->quote_order = $quote_order;

        // set the owning side of the relation if necessary
        if ($quote_order->getQuote() !== $this) {
            $quote_order->setQuote($this);
        }

        return $this;
    }
}
