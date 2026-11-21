<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $isBookOrder = $this->input('topic') === 'Book Order';

        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'topic' => [
                'required',
                'string',
                Rule::in([
                    'Book 1-on-1 Session',
                    'Book Order',
                    'Mind and Memory Training',
                    'Book and Resources',
                    'Student/Parent Program',
                    'School or Institutional Collaboration',
                    'HR and Professional Development',
                    'Others',
                ]),
            ],
            'book_id' => [
                Rule::requiredIf($isBookOrder),
                'nullable',
                'integer',
                Rule::exists('books', 'id')->where(fn ($query) => $query->where('is_published', true)),
            ],
            'phone' => [
                Rule::requiredIf($isBookOrder),
                'nullable',
                'string',
                'max:30',
            ],
            'message' => ['required', 'string', 'max:2000'],
        ];
    }
}
