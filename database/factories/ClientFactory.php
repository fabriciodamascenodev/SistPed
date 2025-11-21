<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    public function definition(): array
    {
        $bairrosSG = [
            'Alcântara', 'Centro', 'Rocha', 'Neves', 'Colubandê', 
            'Maria Paula', 'Mutondo', 'Trindade', 'Laranjal', 
            'Porto Novo', 'Pita', 'Barro Vermelho', 'Santa Catarina',
            'Jardim Catarina', 'Paraíso', 'Patronato'
        ];

        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->cellphoneNumber(),
            
            // Endereço
            'cep' => $this->faker->numerify('24###-###'),
            'street' => $this->faker->streetName(),
            'number' => $this->faker->buildingNumber(),
            'complement' => $this->faker->optional(0.3)->word(), // 30% de chance de ter complemento
            'district' => $this->faker->randomElement($bairrosSG),
            'city' => 'São Gonçalo',
            'state' => 'RJ',
            'reference' => $this->faker->optional()->sentence(3),
            
            // CPF ou CNPJ
            'cpf_cnpj' => $this->faker->boolean() 
                ? $this->faker->cpf() 
                : $this->faker->cnpj(),
        ];
    }
}