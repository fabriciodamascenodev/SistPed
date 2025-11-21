<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        // Lista personalizada de descartáveis
        $produtos = [
            'Sacola Plástica Branca 30x40', 'Sacola Plástica Reforçada 50x60',
            'Bobina Picotada Fundo Estrela', 'Bobina Térmica 80mm',
            'Copo Descartável 200ml (Cx 1000un)', 'Copo Descartável 300ml (Cx 1000un)',
            'Copo de Café 50ml (Cx 2500un)', 'Prato Fundo 15cm (Pct 10un)',
            'Prato Raso 21cm (Pct 10un)', 'Garfo de Refeição Branco (Pct 50un)',
            'Faca de Refeição Branca (Pct 50un)', 'Colher de Sobremesa (Pct 50un)',
            'Marmitex de Alumínio n8', 'Marmitex de Alumínio n9',
            'Embalagem Isopor Hamburgueira', 'Pote Redondo 250ml c/ Tampa',
            'Pote Retangular 500ml c/ Tampa', 'Papel Toalha Interfolha',
            'Papel Higiênico Institucional', 'Saco de Lixo 100L Preto',
            'Saco de Lixo 200L Reforçado', 'Luva Látex Tamanho M',
            'Touca Descartável (Pct 100un)', 'Canudo Flexível (Pct 100un)',
            'Guardanapo de Papel 30x30'
        ];

        // Gera um preço base aleatório
        $price = $this->faker->randomFloat(2, 5, 250);

        return [
            // Nome do produto + uma palavra aleatória para criar variações
            'name' => $this->faker->randomElement($produtos) . ' - ' . $this->faker->word(),
            
            // CORREÇÃO: Deixando a descrição em branco (nula)
            'description' => null,
            
            'image_path' => null, 
            
            'quantity' => $this->faker->numberBetween(10, 1000), // Estoque
            
            // Gera SKU e Código de Barras únicos
            'sku' => $this->faker->unique()->bothify('SKU-####'),
            'barcode' => $this->faker->unique()->ean13(),
            
            // Regra de Negócio: Preço à Vista e Faturado (+10%)
            'cash_price' => $price,
            'billed_price' => $price * 1.10,
        ];
    }
}