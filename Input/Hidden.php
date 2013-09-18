<?php namespace WinkForm\Input;

class Hidden extends Input
{
    protected $type = 'hidden';
    

    /**
     * render the hidden input element
     */
    public function render()
    {
        // default validity check
        if (! $this->validate->isValid())
            throw new \Exception($this->validate->getMessage('Error rendering '.get_class($this).' object with name '.$this->name));

        $output = '<input'
                . $this->renderType()
                . $this->renderId()
                . $this->renderClass()
                . $this->renderName()
                . $this->renderValue()
                . $this->renderStyle()
                . $this->renderDisabled()
                . $this->renderTitle()
                . $this->renderDataAttributes()
                . $this->renderRequired()
                .' />'."\n";
        
        $output .= $this->renderInvalidations();
        
        return $output;
    }
}