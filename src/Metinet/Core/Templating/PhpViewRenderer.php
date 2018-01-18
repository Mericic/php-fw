<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Core\Templating;

class PhpViewRenderer implements ViewRenderer
{
    private $viewsDirectory;
    private $layoutPath;

    public function __construct(string $viewsDirectory, string $layoutPath)
    {
        $this->viewsDirectory = $viewsDirectory;
        $this->layoutPath = $layoutPath;
    }

    public function render(string $viewName, array $parameters = [])
    {
        extract($parameters, EXTR_PREFIX_ALL, '');

        ob_start();
        include $this->viewsDirectory . $viewName;
        $view = ob_get_contents();
        ob_clean();

        // Small function to render the view in the layout
        $renderView = function () use ($view) {
            echo $view;
        };

        ob_start();
        include $this->layoutPath;
        $layout = ob_get_contents();
        ob_clean();

        return $layout;
    }
}
