<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SizeRepository")
 */
class Size
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Cloth", mappedBy="sizes")
     */
    private $cloths;

    public function __construct()
    {
        $this->cloths = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Cloth[]
     */
    public function getCloths(): Collection
    {
        return $this->cloths;
    }

    public function addCloth(Cloth $cloth): self
    {
        if (!$this->cloths->contains($cloth)) {
            $this->cloths[] = $cloth;
            $cloth->addSize($this);
        }

        return $this;
    }

    public function removeCloth(Cloth $cloth): self
    {
        if ($this->cloths->contains($cloth)) {
            $this->cloths->removeElement($cloth);
            $cloth->removeSize($this);
        }

        return $this;
    }
}
