<?php

namespace App\Http\Requests\Rate;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    return [
      // 'title' => 'string|required|max:255',
      // 'content' => 'string|required',
      // 'preview_image' => 'file|required',
      // 'main_image' => 'file|required',
      // 'category_id' => 'required|integer|exists:categories,id',
      // 'tag_ids' => 'nullable|array',
      // 'tag_id.*' => 'nullable|integer|exists:tags,id',
    ];
  }

  public function messages()
  {
    return [
      // 'title.required' => 'Required field',
      // 'category_id.required' => 'Please choose category',
      // 'title.required' => 'Required field',
    ];
  }
}
