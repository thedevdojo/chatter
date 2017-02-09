<?php

namespace DevDojo\Chatter\Events;

use Illuminate\Http\Request;

class ChatterAfterNewDiscussion
{
    /**
     * @var Request
     */
    public $request;

    /**
     * Constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
