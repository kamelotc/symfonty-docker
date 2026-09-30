<?php

namespace App\Dto\User;

use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;

final class UserRegisterInput
{
    #[Assert\NotBlank]
    #[Assert\Email]
    #[Assert\Length(min: 3, max: 255)]
    #[ApiProperty(schema: [
        'type' => 'string',
        'format' => 'email',
        'description' => 'L\email address of the user',
        'minLength' => 3,
        'maxLength' => 255,
        'example' => 'user@example.com',
        'required' => true,
    ])]
    public ?string $email = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 8)]
    #[ApiProperty(schema: [
        'type' => 'string',
        'format' => 'password',
        'description' => 'L\password of the user',
        'minLength' => 8,
        'maxLength' => 255,
        'example' => 'password',
        'required' => true,
    ])]
    public ?string $password = null;

    #[Assert\NotBlank]
    #[ApiProperty(schema: [
        'type' => 'string',
        'description' => 'User first name',
        'minLength' => 3,
        'maxLength' => 255,
        'required' => false,
        ])]
    public ?string $firstName = null;

    #[Assert\NotBlank]
    #[ApiProperty(schema: [
        'type' => 'string',
        'description' => 'User last name',
        'minLength' => 3,
        'maxLength' => 255,
        'required' => false,
    ])]
    public ?string $lastName = null;
}
