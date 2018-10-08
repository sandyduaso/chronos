<?php

namespace Comment\Requests;

use Comment\Models\Comment;
use Pluma\Requests\FormRequest;

class CommentOwnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $comment = Comment::find($this->comment);

        return $this->user()->id == $comment->user->id;
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
