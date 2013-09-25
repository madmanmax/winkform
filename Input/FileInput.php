<?php namespace WinkForm\Input;

/**
 * class to create a <input type="file">
 * Don't forget to set the enctype of the form in order to actually upload the file!!
 * enctype="multipart/form-data"
 *
 */
class FileInput extends Input
{
    protected $type = 'file';
    
    /**
     * render the hidden input element
     */
    public function render()
    {
        // check result of validity checks of parameters passed to this Input element
        $this->checkValidity();

        // default "width" (actually invalid html, but it will work)
        if (empty($this->size))
            $this->size = 40;
            
        $output = $this->renderLabel()
            . '<input'
            . $this->renderType()
            . $this->renderId()
            . $this->renderClass()
            . $this->renderName()
            . $this->renderStyle()
            . $this->renderDisabled()
            . $this->renderTitle()
            . $this->renderDataAttributes()
            . $this->renderRequired()
            . $this->renderAutoFocus()
            . ' />'
            . PHP_EOL;
        
        $output .= $this->renderInvalidations();
        
        return $output;
    }
    
    /**
     * (non-PHPdoc)
     * @see \WinkForm\Input\Input::isPosted()
     */
    public function isPosted()
    {
        return ! empty($_FILES[$this->name]['tmp_name']);
    }
    
    /**
     * (non-PHPdoc)
     * @see \WinkForm\Input\Input::setPosted()
     */
    protected function setPosted()
    {
        if (! empty($_FILES[$this->name]))
        {
            $this->posted = $_FILES[$this->name]['tmp_name'];
            $this->selected = $_FILES[$this->name]['tmp_name'];
        }
    }
    
    /**
     * get contents of uploaded file
     * @return boolean|string $contents
     */
    public function getContents()
    {
        if (! $this->isPosted())
            return false;
        
        $contents = file_get_contents($this->posted);
        return mb_convert_encoding($contents, 'UTF-8');
    }
    
    /**
     * get content of uploaded file as array of lines
     * @return array $lines
     */
    public function getLines()
    {
        if (! $this->isPosted())
            return false;
        
        $lines = file($this->posted, FILE_IGNORE_NEW_LINES);
        for ($i = 0; $i < count($lines); $i++)
        {
            $lines[$i] = mb_convert_encoding($lines[$i], 'UTF-8');
        }
        
        return $lines;
    }
    
}
