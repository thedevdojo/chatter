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
     * @var Models::discussion()
     */
    public $discussion;

    /**
     * Constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request, $discussion)
    {
        $this->request = $request;

        $this->discussion = $discussion;
    }
}
