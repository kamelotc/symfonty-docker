<?php


namespace App\Dto\User;

use ApiPlatform\Metadata\ApiProperty;

class UserDetailsOutput{
    public function __construct(

        #[ApiProperty(schema: [
            'type' => 'string',
            'description' => 'Identifiant du compte, un UUID v7 produit par l\entité',
            'format' => 'uuid',
        ])]
        public string $id,

        #[ApiProperty(schema: [
            'type' => 'string',
            'description' => 'Adresse de connexion du compte',
            'format' => 'email',
        ])]
        public string $email,

        #[ApiProperty(schema: [
            'type' => 'string',
            'description' => 'Prénom du voyageur. Nul quand il n\a pas été renseigné.',
            'format' => 'uuid',
        ])]
        public null|string $firstName,

        #[ApiProperty(schema: [
            'type' => 'string',
            'description' => 'Nom du voyageur. Nul quand il n\a pas été renseigné.',
            'format' => 'uuid',
        ])]
        public null|string $lastName,

        #[ApiProperty(schema: [
            'type' => 'string',
            'description' => 'Date de création du compte, estampillée à l\inscription',
            'format' => 'uuid',
        ])]
        public null|\DateTime $createdAt,
    ){

    }
}
