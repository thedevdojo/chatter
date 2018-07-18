<?php

namespace DevDojo\Chatter\Requests;

use DevDojo\Chatter\Exceptions\PostUpdateNotAllowedException;
use DevDojo\Chatter\Models\Models;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class ChatterUpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $parameters = $this->route()->parameters;

        $post = Models::post()->with('discussion')->findOrFail($parameters['post']);

        return (! is_null($this->user())) && $this->user()->id === (int) $post->user_id;
        
    }
    
    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws ChatterUserIsNotAllowedToDeletePostException
     */
    protected function failedAuthorization()
    {
        throw new PostUpdateNotAllowedException();
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}