<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TvEpisodeRepository")
 */
class TvEpisode implements TimestampableInterface
{
    use TimestampableTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TvSeason", inversedBy="episodes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TvShow", inversedBy="episodes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $show;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

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

    public function getSeason(): ?TvSeason
    {
        return $this->season;
    }

    public function setSeason(?TvSeason $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getShow(): ?TvShow
    {
        return $this->show;
    }

    public function setShow(?TvShow $show): self
    {
        $this->show = $show;

        return $this;
    }
}
