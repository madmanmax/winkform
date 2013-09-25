<?php namespace WinkForm\Input;

class DateInput extends Input
{
    /**
     * Contains the options for the jQuery DatePicker widget
     * @var array
     */
    protected $jsOptions = array();
    
    protected $type = 'text'; // 'date' will only accept yyyy-mm-dd, which is not the format we use :'(

    /**
     * Override setPosted, to
     * @return $this|void
     */
    protected function setPosted()
    {
        if (! empty($_POST[$this->name]))
        {
            $post = xsschars($_POST[$this->name]);

            // This is a fix for when users manually input dates without using leading 0s
            $post = $this->getCorrectedPostedDate($post);

            $this->posted = $post;
            $this->selected = $post;  // so we can always retrieve the selected fields with getSelected()
        }

        return $this;
    }

    /**
     * This is a fix for when users manually input dates without using leading 0s
     * We can think of a lot more checks, but let's keep it as fast as possible. Real validation is in the validate() functions
     * @param string $post
     */
    protected function getCorrectedPostedDate($post)
    {
        if (strlen($post) == 10)  // when dates are dd-mm-yyyy, they are good
            return $post;

        $elements = explode('-', $post);
        array_walk($elements, function(&$var) {
            $var = str_pad($var, 2, '0', STR_PAD_LEFT); // str_pad will ignore strings longer than given 2
        });
        $post = implode('-', $elements);

        return $post;
    }
    

    /**
     * render the date input element
     */
    public function render()
    {
        // check result of validity checks of parameters passed to this Input element
        $this->checkValidity();

        // we will show/hide the container div for the text field and the image and not the text field and the image themselves
        $this->removeStyle('display:none');
        $hidden = $this->getHidden() === true ? ' style="display:none;"' : '';
        
        // create TextInput object with all same properties as this DateInput object
        $text = new TextInput($this->name);
        copySharedAttributes($text, $this);
        
        // set default width if none was given
        if (strpos($this->renderStyle(), 'width') === false)
            $text->setWidth(80);
        
        $text->setMaxLength(10);
        
        $output = '<div id="'.$this->id.'-container"'.$hidden.' style="float: left;">'
                . $text->render()
                . '</div>' . PHP_EOL;
        
        if (empty($this->disabled))
        {
            $output .= $this->getJS() . PHP_EOL;
        }
        
        $output .= $this->renderInvalidations();
        
        return $output;
    }
    
    /**
     * The JS to initialize the jQuery UI DatePicker
     *
     * @see getJSOptions()
     * @return string the JS script
     */
    protected function getJS()
    {
        return '<script type="text/javascript">
                    $(document).ready(function()
                    {
                        var options = ' .  $this->getJSOptions() . ';
                        $("#'.$this->id.'").datepicker(options);
                    });
                </script>';
    }
    
    /**
     * Prepares the array of options for the jQuery UI DatePicker
     *
     * @link http://api.jqueryui.com/datepicker
     * @return string a HTML escaped JSON with the options for the DatePicker.
     */
    protected function getJSOptions()
    {
        $options = $this->jsOptions;
        
        //there will be no validation here, it's assumed the user has knowledge
        // of the possible arguments. Only some defaults will be provided
        
        // Merge in defaults.
        $options += array(
            'dateFormat'      => 'dd-mm-yy',
            'firstDay'        => 1,
            'showButtonPanel' => true,
            'showWeek'        => true,
            'changeMonth'     => true,
            'changeYear'      => true,
            'showOn'          => 'both',
            'buttonImage'     => (defined('BASE_URL') ? BASE_URL : '/') . 'images/helveticons/32x32/Calendar alt 32x32.png',
            'buttonImageOnly' => true,
            'buttonText'      => 'Pick a date',
        );
        
        $json = json_encode($options);

        return $json;
    }
    
    /**
     * Set extra parameters or overwrite default ones for the DatePicker.
     * @param array $options
     */
    public function setDatePickerOptions(array $options = array())
    {
        if ($this->validate($options, 'not_empty|array'))
        {
            $this->jsOptions = $options;
        }
    }
    
}
