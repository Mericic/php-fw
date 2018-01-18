<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Session;

interface Session
{
    public function start(): void;
    public function has(string $attributeName): bool;
    public function get(string $attributeName, $default = null);
    public function set(string $attributeName, $value): void;
    public function remove(string $attributeName): void;
    public function all(): array;
}
