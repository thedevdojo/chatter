<?php

namespace DevDojo\Chatter\Exceptions;

use Exception;

class ChatterUserIsNotAllowedToDeletePostException extends Exception
{
    
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }
    
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return redirect('/' . config('chatter.routes.home'))->with([
            'chatter_alert_type' => 'danger',
            'chatter_alert'      => trans('chatter::alert.danger.reason.destroy_post'),
        ]);
    }
    
}