<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Factory as ValidatorFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    private ValidatorFactory $validatorFactory;

    public function __construct(
        ValidatorFactory $validatorFactory,
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null
    ) {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->validatorFactory = $validatorFactory;
    }

    protected function getValidatorInstance(): Validator
    {
        return $this->validatorFactory->make(
            $this->all(),
            $this->rules(),
            $this->messages(),
            $this->attributes(),
        );
    }

    protected function rules(): array
    {
        return [
            'page' => ['bail', 'required', 'int'],
            'perPage' => ['bail', 'required', 'int'],
        ];
    }

    public function getPage(): int
    {
        return (int)$this->get('page');
    }

    public function getPerPage(): int
    {
        return (int)$this->get('perPage');
    }
}
