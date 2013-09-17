<?php namespace WinkForm\Input;

class Button extends Input
{
    protected $type = 'button';
    
    
    /**
     * construct Button
     * @param string $name
     * @param mixed optional $value
     */
    function __construct($name, $value = null)
    {
        parent::__construct($name, $value);
    
        // always set btn class
        $this->addClass('btn');
    }
    
    /**
     * render the button
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
                . $this->renderTitle()
                . $this->renderDataAttributes()
                . $this->renderAutoFocus()
                .' />'."\n";
        
        $output .= $this->renderInvalidations();
        
        return $output;
    }
    
}
