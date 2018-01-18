<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Session;

class InMemorySession implements Session
{
    private $fakeSession = [];

    public function start(): void
    {
        // nothing to do
     }

    public function safeStart(): void
    {
        if (!$this->isStarted()) {
            $this->start();
        }
    }

    public function isStarted(): bool
    {
        return true;
    }

    public function has(string $attributeName): bool
    {
        return isset($this->fakeSession[$attributeName]);
    }

    public function get(string $attributeName, $default = null)
    {
        return $this->fakeSession[$attributeName] ?? $default;
    }

    public function set(string $attributeName, $value): void
    {
        $this->fakeSession[$attributeName] = $value;
    }

    public function remove(string $attributeName): void
    {
        unset($this->fakeSession[$attributeName]);
    }

    public function all(): array
    {
        return $this->fakeSession;
    }
}
