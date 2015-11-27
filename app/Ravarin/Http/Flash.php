<?php 

namespace Ravarin\Http;

use Illuminate\Session\Store;

class Flash
{   
    /**
     * Define flash messsage key in session.
     *
     * @var string
     */
    protected $key = 'flash_message';

    /**
     * Create flash instance.
     *
     * @param Illuminate\Session\Store $session
     */
    public function __construct(Store $session) 
    {
        $this->session = $session;
    }

    /**
     * Flash a general message.
     *
     * @param  string $title
     * @param  string $message
     * @param  string $type
     * @return void
     */
    public function message($title, $message, $type='info') 
    {
        $this->session->flash($this->key, compact('title', 'message', 'type'));
    }

    /**
     * Flash a success message.
     *
     * @param  string $title
     * @param  string $message
     * @return void
     */
    public function success($title, $message)
    {
        $this->message($title, $message, 'success');
    }

    /**
     * Flash a error message.
     *
     * @param  string $title
     * @param  string $message
     * @return void
     */
    public function error($title, $message)
    {
        $this->message($title, $message, 'error');
    }

    /**
     * Flash a warning message.
     *
     * @param  string $title
     * @param  string $message
     * @return void
     */
    public function warning($title, $message)
    {
        $this->message($title, $message, 'warning');
    }

    /**
     * Flash a general message when unknown type is called.
     *
     * @param  string $title
     * @param  string $message
     * @return void
     */
    public function __call($type, $arguments) 
    {
        list($title, $message) = $arguments;

        $this->message($title, $message);
    }
}