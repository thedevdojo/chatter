<?php

namespace MeinderA\Forum\Events;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class ForumBeforeNewDiscussion
{
    /**
     * @var Request
     */
    public $request;

    /**
     * @var Validator
     */
    public $validator;

    /**
     * Constructor.
     *
     * @param Request   $request
     * @param Validator $validator
     */
    public function __construct(Request $request, Validator $validator)
    {
        $this->request = $request;
        $this->validator = $validator;
    }
}
