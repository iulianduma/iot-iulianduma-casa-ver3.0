// src/Entity/Relay.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Relay
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    private string $deviceId;

    #[ORM\Column(type: 'boolean')]
    private bool $status;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $lastUpdated;
}

public function getId(): ?int
{
    return $this->id;
}

public function getDeviceId(): string
{
    return $this->deviceId;
}

public function setDeviceId(string $deviceId): self
{
    $this->deviceId = $deviceId;
    return $this;
}

public function isStatus(): bool
{
    return $this->status;
}

public function setStatus(bool $status): self
{
    $this->status = $status;
    return $this;
}

public function getLastUpdated(): \DateTimeInterface
{
    return $this->lastUpdated;
}

public function setLastUpdated(\DateTimeInterface $lastUpdated): self
{
    $this->lastUpdated = $lastUpdated;
    return $this;
}
