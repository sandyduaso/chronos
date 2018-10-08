<?php

namespace Form\Support\Builder;

use Form\Models\Form;
use Form\Support\Builder\Traits\FieldableTrait;
use Form\Support\Builder\Traits\TemplatableFormTrait;
use Illuminate\Support\Facades\View;

class FormBuilder
{
    use FieldableTrait, TemplatableFormTrait;

    /**
     * The form instance.
     *
     * @var \Form\Models\Form
     */
    protected $form;

    /**
     * Instantiate the form builder.
     *
     * @param  \Form\Models\Form $form
     * @param mixed $fields
     * @param string $templatePath
     */
    public function __construct(Form $form, $fields = null, $templatePath = null)
    {
        $this->setForm($form);
        $this->setFields($fields);
        $this->setTemplatePath($templatePath);
    }

    /**
     * Set the form instance.
     *
     * @param \Form\Models\Form $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }

    /**
     * Get the form instance.
     *
     * @return \Form\Models\Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Render the form in html.
     *
     * @param  string $templatePath
     * @return mixed
     */
    public function build($templatePath = null)
    {
        return View::make($templatePath ?? $this->templatePath())
                    ->with([
                        'form' => $this->getForm(),
                        'fields' => $this->fields(),
                    ])
                    ->render();
    }
}
