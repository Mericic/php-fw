<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Templating;

interface ViewRenderer
{
    public function render(string $viewName, array $parameters = []);
}
