<?php namespace WinkForm\Input;

/**
 * Create 2 date input fields for selecting a date range
 *
 * @author b-deruiter
 */
class DateRangeInput extends Input
{
    // the 2 date objects
    protected $dateFrom,
              $dateTo;
    
    
    /**
     * construct DateRange object
     *
     * @param string $name
     * @param string $from  date in d-m-Y format
     * @param string $to    date in d-m-Y format
     */
    function __construct($name, $from, $to)
    {
        $this->validator = new \WinkForm\Validation\Validator();
        
        $this->name = $name;
        
        // validate creation
        if (! empty($from))
            $this->validate($from, 'date_format:d-m-Y');
        if (! empty($to))
            $this->validate($to, 'date_format:d-m-Y');
        
        $this->checkValidity();
        
        // create the two date input fields
        $this->setDateFrom(new DateInput($this->name.'-from', $from));
        $this->setDateTo(new DateInput($this->name.'-to', $to));
        
        // set default labels
        $this->setLabels(array('Between', 'and'));
    }
    
    /**
     * render the date range input fields
     */
    public function render()
    {
        // check result of validity checks of parameters passed to this Input element
        $this->checkValidity();

        // via casting we can pass all attributes that were set on DateRane down to the DateInput fields
        $excludes = array('type', 'name', 'id', 'value', 'label', 'selected', 'posted', 'required', 'invalidations', 'inReportForm');
        copySharedAttributes($this->dateFrom, $this, $excludes);
        copySharedAttributes($this->dateTo, $this, $excludes);
            
        // render the date range input fields
        $output = $this->dateFrom->render() . $this->dateTo->render();
        
        $output .= $this->renderInvalidations();
        
        return $output;
    }
    
    /**
     * set labels for the Dates
     *
     * @param array $labels (from, to)
     */
    public function setLabels($labels, $flag = null)
    {
        $this->dateFrom->setLabel($labels[0], $flag);
        $this->dateTo->setLabel($labels[1], $flag);
        
        return $this;
    }
    
    /**
     * get the labels of the dates
     * @return array (from, to)
     */
    public function getLabels()
    {
        return array($this->dateFrom->label, $this->dateTo->label);
    }
    
    /**
     * @return DateInput $dateFrom
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * @return DateInput $dateTo
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * @param DateInput $dateFrom
     */
    public function setDateFrom(DateInput $dateFrom)
    {
        $this->dateFrom = $dateFrom;
        
        return $this;
    }

    /**
     * @param DateInput $dateTo
     */
    public function setDateTo(DateInput $dateTo)
    {
        $this->dateTo = $dateTo;
        
        return $this;
    }
    
}
