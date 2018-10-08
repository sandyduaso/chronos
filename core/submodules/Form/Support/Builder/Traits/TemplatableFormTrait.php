<?php

namespace Form\Support\Builder\Traits;

trait TemplatableFormTrait
{
    /**
     * Path to the template file.
     *
     * @var string
     */
    protected $templatePath;

    /**
     * Sets the templatePath.
     *
     * @param string $templatePath
     */
    public function setTemplatePath($templatePath)
    {
        $this->templatePath = $templatePath;

        return $this;
    }

    /**
     * Retrieves the array.
     *
     * @return  strin
     */
    public function getTemplatePath()
    {
        return $this->templatePath;
    }

    /**
     * Alias for getTemplatePath().
     *
     * @return string
     */
    public function templatePath()
    {
        return $this->templatePath;
    }
}
