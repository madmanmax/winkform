<?php namespace WinkForm;

use WinkForm\Support\InputCreator;

/**
 * abstract class Form
 *
 * @author Bas
 *
 */
abstract class Form
{
    // enctype constants
    const ENCTYPE_DEFAULT = 'application/x-www-form-urlencoded';
    const ENCTYPE_FILE    = 'multipart/form-data';


    protected $method = 'post',
              $action = '',
              $enctype = self::ENCTYPE_DEFAULT,
              $name,
              $isValid = true,
              $validator;   // Validate class to perform the POST validation


    /**
     * Create new Form
     */
    public function __construct()
    {
        $this->validator = new \WinkForm\Validation\FormValidator();
    }

    /**
     * render the form
     * @return string
     */
    abstract public function render();

    /**
     * render the default form open tag
     * @return string
     */
    protected function renderFormHead()
    {
        $this->determineEnctype();
        return '<form name="'.$this->name.'" method="'.$this->method.'" action="'.$this->action.'" enctype="'.$this->enctype.'">'."\n";
    }

    /**
     * render the form close tag
     * @return string
     */
    protected function renderFormFoot()
    {
        return '</form>'."\n";
    }

    /**
     * validate all posted values for the form input fields
     * @return boolean
     */
    public function validate()
    {
        // handle validations passed to this form or to the public input fields
        foreach (get_object_vars($this) as $input)
        {
            if (! $input instanceof Input\Input)
                continue;

            $this->validateInput($input);
        }

        return $this->isValid();
    }

    /**
     * validate a single input object using default validations or
     * custom validations assigned to the object or to the form
     * @param \WinkForm\Input\Input $input
     */
    protected function validateInput(\WinkForm\Input\Input $input)
    {
        // skip non-required fields that are not posted
        if (! $input->isPosted() && ! $input->isRequired())
            return;

        // always validate that posted value(s) of checkbox, radio or dropdown are in the array of values of the Input element
        $values = $input->getValues();
        if (! empty($values))
        {
            $this->validator->addValidation($input, 'all_in:'.implode(',', $values));
        }

        // validations added to the Input element
        if ($input->hasValidations())
        {
            $this->validator->addValidation($input, $input->getValidations());
        }

        // place found invalidations after the input element
        if (! $this->validator->isValid())
        {
            $this->invalidate($input, implode("<br/>\n", $this->validator->getAttributeErrors($input->getName())));
        }

        // clear the validator for the next input
        $this->validator->reset();
    }

    /**
     * is the form posted?
     * @return boolean
     */
    abstract public function isPosted();

    /**
     * Invalidate input field (and let this form know it is invalid)
     * @param Input\Input $input
     * @param string $invalidation
     */
    public function invalidate(Input\Input $input, $invalidation)
    {
        $this->isValid = false;
        $input->addInvalidation($invalidation);
    }

    /**
     * generate salt
     * @param int $length
     * @return string
     */
    public function generateSalt($length = 10)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $salt = '';
        for ($i = 0; $i < $length; $i++)
            $salt .= $chars[mt_rand(0, strlen($chars) - 1)];

        return $salt;
    }

    /**
     * is the form valid?
     * @return boolean
     */
    public function isValid()
    {
        return $this->isValid;
    }

    /**
     * @return string $method
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string $action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return string $enctype
     */
    public function getEnctype()
    {
        return $this->enctype;
    }

    /**
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        if (! in_array($method, array('post', 'get')))
            throw new \Exception('Invalid method for Form');

        $this->method = $method;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @param string $enctype
     */
    public function setEnctype($enctype)
    {
        if (! in_array($enctype, array(self::ENCTYPE_DEFAULT, self::ENCTYPE_FILE, 'text/plain')))
            throw new \Exception('Invalid enctype given for Form');

        $this->enctype = $enctype;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * check if the Form has FileInput objects and if so, set the enctype to Form::ENCTYPE_FILE
     */
    protected function determineEnctype()
    {
        // check the properties
        foreach (get_object_vars($this) as $input)
        {
            if (is_object($input) && $input instanceof Input\FileInput)
            {
                $this->setEnctype(self::ENCTYPE_FILE);
                return $this->enctype; // immediately quit searching when a FileInput is found
            }
        }

        return $this->enctype;
    }
    
    /**
     * Handle dynamic, static calls to the object abusing the Facade pattern
     * This way we can create the input elements statically
     *
     * @param  string  $method
     * @param  array   $args
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        $creator = InputCreator::getInstance();
    
        switch (count($args))
        {
            case 0:
                return $creator->$method();
    
            case 1:
                return $creator->$method($args[0]);
    
            case 2:
                return $creator->$method($args[0], $args[1]);
    
            case 3:
                return $creator->$method($args[0], $args[1], $args[2]);
    
            case 4:
                return $creator->$method($args[0], $args[1], $args[2], $args[3]);
    
            default:
                return call_user_func_array(array($creator, $method), $args);
        }
    }

}
