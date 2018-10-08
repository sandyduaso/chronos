<?php

namespace Submission\Support\Dompdf;

use Dompdf\Dompdf;

class PDF extends Dompdf
{
    /**
     * Load a View and convert to HTML
     *
     * @param string $view
     * @param array $data
     * @param string $encoding
     * @return static
     */
    public function loadView($view, $data = [], $encoding = null){
        $html = view($view)->with($data)->render();

        $this->loadHTML($html, $encoding);

        return $this;
    }
}
