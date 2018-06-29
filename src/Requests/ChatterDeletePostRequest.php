<?php

namespace DevDojo\Chatter\Requests;

use DevDojo\Chatter\Exceptions\ChatterUserIsNotAllowedToDeletePostException;
use DevDojo\Chatter\Models\Models;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class ChatterDeletePostRequest extends FormRequest
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

        return $this->user()->id === (int) $post->user_id;
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
        throw new ChatterUserIsNotAllowedToDeletePostException();
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