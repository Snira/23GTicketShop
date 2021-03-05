<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Factory as ValidatorFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateEventApiRequest extends ApiRequest
{
    protected function rules(): array
    {
        return [
            'title' => ['bail', 'required', 'string'],
            'description' => ['bail', 'required', 'string'],
            'ticket_amount' => ['bail', 'required', 'int'],
        ];
    }

    public function getTitle(): string
    {
        return $this->get('title');
    }

    public function getDescription(): string
    {
        return $this->get('description');
    }

    public function getTicketAmount(): int
    {
        return $this->get('ticket_amount');
    }
}
