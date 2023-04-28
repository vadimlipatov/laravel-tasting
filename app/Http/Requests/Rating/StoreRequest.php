<?php

namespace App\Http\Requests\Rating;

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
      'commercial' => 'required|decimal:1',
      'appearance' => 'required|decimal:1',
      'cut' => 'required|decimal:1',
      'color' => 'required|decimal:1',
      'taste' => 'required|decimal:1',
      'smell' => 'required|decimal:1',
      'consistency' => 'required|decimal:1',
      'comment' => 'nullable|string',
      'note' => 'nullable|string',
      'userId' => 'required|integer'
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
