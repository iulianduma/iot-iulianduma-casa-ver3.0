// src/Entity/SensorData.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class SensorData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'float')]
    private float $temperature;

    #[ORM\Column(type: 'float')]
    private float $humidity;

    #[ORM\Column(type: 'float')]
    private float $pressure;

    #[ORM\Column(type: 'float')]
    private float $gas;

    #[ORM\Column(type: 'float')]
    private float $light;

    #[ORM\Column(type: 'boolean')]
    private bool $presence;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $timestamp;

    #[ORM\ManyToOne(targetEntity: Relay::class)]
    private ?Relay $relay = null;
}

public function getId(): ?int
{
    return $this->id;
}

public function getTemperature(): float
{
    return $this->temperature;
}

public function setTemperature(float $temperature): self
{
    $this->temperature = $temperature;
    return $this;
}

public function getHumidity(): float
{
    return $this->humidity;
}

public function setHumidity(float $humidity): self
{
    $this->humidity = $humidity;
    return $this;
}

public function getPressure(): float
{
    return $this->pressure;
}

public function setPressure(float $pressure): self
{
    $this->pressure = $pressure;
    return $this;
}

public function getGas(): float
{
    return $this->gas;
}

public function setGas(float $gas): self
{
    $this->gas = $gas;
    return $this;
}

public function getLight(): float
{
    return $this->light;
}

public function setLight(float $light): self
{
    $this->light = $light;
    return $this;
}

public function isPresence(): bool
{
    return $this->presence;
}

public function setPresence(bool $presence): self
{
    $this->presence = $presence;
    return $this;
}

public function getTimestamp(): \DateTimeInterface
{
    return $this->timestamp;
}

public function setTimestamp(\DateTimeInterface $timestamp): self
{
    $this->timestamp = $timestamp;
    return $this;
}

public function getRelay(): ?Relay
{
    return $this->relay;
}

public function setRelay(?Relay $relay): self
{
    $this->relay = $relay;
    return $this;
}
