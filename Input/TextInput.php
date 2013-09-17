<?php namespace WinkForm\Input;

class TextInput extends Input
{
    
    protected $type = 'text',
              $maxLength;

    /**
     * render the text input element
     */
    public function render()
    {
        // default validity check
        if (! $this->validate->isValid())
            throw new FormException($this->validate->getMessage('Error rendering '.get_class($this).' object with name '.$this->name));
            
        $output = $this->renderLabel()
                . '<input'
                . $this->renderType()
                . $this->renderId()
                . $this->renderClass()
                . $this->renderName()
                . $this->renderValue()
                . $this->renderStyle()
                . $this->renderDisabled()
                . $this->renderMaxLength()
                . $this->renderTitle()
                . $this->renderDataAttributes()
                . $this->renderRequired()
                . $this->renderPlaceholder()
                . $this->renderAutoFocus()
                .' />'."\n";
        
        $output .= $this->renderInvalidations();
        
        return $output;
    }
    
    /**
     * @return the $maxLength
     */
    public function renderMaxLength()
    {
        return ! empty($this->maxLength) ? ' maxlength="'.$this->maxLength.'"' : '';
    }

    /**
     * @param int $maxLength
     */
    public function setMaxLength($maxLength)
    {
        if (! $this->validate->numeric($maxLength))
            throw new FormException('Invalid value for maxLength: '.$maxLength);
        else
            $this->maxLength = $maxLength;
        
        return $this;
    }

}
