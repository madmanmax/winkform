<?php namespace WinkForm\Support;

/**
 * Factory class to create the Input objects
 * @author b-deruiter
 *
 */
class InputCreator
{
    /**
     * @var $this
     */
    protected static $instance;
    
    /**
     * singleton
     * get instance of InputCreator
     */
    public static function getInstance()
    {
        if (empty(static::$instance))
            static::$instance = new static();
        
        return static::$instance;
    }
    
    /**
     * Don't allow normal creation
     */
    protected function __construct()
    {
        
    }
    
    
    /**
     * create AddressInput object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\AddressInput
     */
    public function address($name, $value = null)
    {
        return new \WinkForm\Input\AddressInput($name, $value);
    }
    
    /**
     * create Button object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Button\InputButton
     */
    public function inputButton($name, $value = null)
    {
        return new \WinkForm\Button\InputButton($name, $value);
    }
    
    /**
     * create ChainedDropdowns object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\ChainedDropdowns
     */
    public function chainedDropdowns($name, $value = null)
    {
        return new \WinkForm\Input\ChainedDropdowns($name, $value);
    }
    
    /**
     * create Checkbox object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\Checkbox
     */
    public function checkbox($name, $value = null)
    {
        return new \WinkForm\Input\Checkbox($name, $value);
    }
    
    /**
     * create ColorInput object
     * @param string $name
     * @param string $value
     * @return Input\ColorInput
     */
    public function color($name, $value = null)
    {
        return new \WinkForm\Input\ColorInput($name, $value);
    }
    
    /**
     * create DateInput object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\DateInput
     */
    public function date($name, $value = null)
    {
        return new \WinkForm\Input\DateInput($name, $value);
    }
    
    /**
     * create DateRange object
     * @param string $name
     * @param dd-mm-yyyy $from
     * @param dd-mm-yyyy $to
     * @return \WinkForm\Input\DateRangeInput
     */
    public function dateRange($name, $from, $to)
    {
        return new \WinkForm\Input\DateRangeInput($name, $from, $to);
    }
    
    /**
     * create Dropdown object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\Dropdown
     */
    public function dropdown($name, $value = null)
    {
        return new \WinkForm\Input\Dropdown($name, $value);
    }
    
    /**
     * create Email object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\EmailInput
     */
    public function email($name, $value = null)
    {
        return new \WinkForm\Input\EmailInput($name, $value);
    }
    
    /**
     * create FileInput object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\FileInput
     */
    public function file($name, $value = null)
    {
        return new \WinkForm\Input\FileInput($name, $value);
    }
    
    /**
     * create HiddenInput object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\HiddenInput
     */
    public function hidden($name, $value = null)
    {
        return new \WinkForm\Input\HiddenInput($name, $value);
    }
    
    /**
     * create ImageButton object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Button\ImageButton
     */
    public function image($name, $value = null)
    {
        return new \WinkForm\Button\ImageButton($name, $value);
    }
    
    /**
     * create MonthInput object
     * @param string $name
     * @param yyyy-mm $month
     * @return \WinkForm\Input\MonthInput
     */
    public function month($name, $month = null)
    {
        return new \WinkForm\Input\MonthInput($name, $month);
    }
    
    /**
     * create MonthRange object
     * @param string $name
     * @param yyyy-mm $from
     * @param yyyy-mm $to
     * @return \WinkForm\Input\MonthRangeInput
     */
    public function monthRange($name, $from = null, $to = null)
    {
        return new \WinkForm\Input\MonthRangeInput($name, $from, $to);
    }
    
    /**
     * create NumberInput object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\NumberInput
     */
    public function number($name, $value = null)
    {
        return new \WinkForm\Input\NumberInput($name, $value);
    }
    
    /**
     * create PasswordInput object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\PasswordInput
     */
    public function password($name, $value = null)
    {
        return new \WinkForm\Input\PasswordInput($name, $value);
    }
    
    /**
     * create RadioInput object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\RadioInput
     */
    public function radio($name, $value = null)
    {
        return new \WinkForm\Input\RadioInput($name, $value);
    }
    
    /**
     * create a <button> element
     * @param string $name
     * @param string $value
     * @return \WinkForm\Button\Button
     */
    public function button($name, $value = null)
    {
        return new \WinkForm\Button\Button($name, $value);
    }
    
    /**
     * create RangeInput object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\RangeInput
     */
    public function range($name, $value = null)
    {
        return new \WinkForm\Input\RangeInput($name, $value);
    }
    
    /**
     * create reset button
     * @param string $name
     * @param string $value
     * @return \WinkForm\Button\ResetButton
     */
    public function reset($name, $value = null)
    {
        return new \WinkForm\Button\ResetButton($name, $value);
    }
    
    /**
     * create SearchInput object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\SearchInput
     */
    public function search($name, $value = null)
    {
        return new \WinkForm\Input\SearchInput($name, $value);
    }
    
    /**
     * create SubmitButton object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Button\SubmitButton
     */
    public function submit($name, $value = null)
    {
        return new \WinkForm\Button\SubmitButton($name, $value);
    }
    
    /**
     * create TelInput object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\TelInput
     */
    public function tel($name, $value = null)
    {
        return new \WinkForm\Input\TelInput($name, $value);
    }
    
    /**
     * create TextInput object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\TextInput
     */
    public function text($name, $value = null)
    {
        return new \WinkForm\Input\TextInput($name, $value);
    }
    
    /**
     * create TextAreaInput object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\TextAreaInput
     */
    public function textarea($name, $value = null)
    {
        return new \WinkForm\Input\TextAreaInput($name, $value);
    }
    
    /**
     * create UrlInput object
     * @param string $name
     * @param string $value
     * @return \WinkForm\Input\UrlInput
     */
    public function url($name, $value = null)
    {
        return new \WinkForm\Input\UrlInput($name, $value);
    }
    
    /**
     * create WeekInput object
     * @param string $name
     * @param iyyy-iw $week
     * @return \WinkForm\Input\WeekInput
     */
    public function week($name, $week = null)
    {
        return new \WinkForm\Input\WeekInput($name, $week);
    }
    
    /**
     * create WeekRange object
     * @param string $name
     * @param iyyy-iw $from
     * @param iyyy-iw $to
     * @return \WinkForm\Input\WeekRangeInput
     */
    public function weekRange($name, $from = null, $to = null)
    {
        return new \WinkForm\Input\WeekRangeInput($name, $from, $to);
    }
}
