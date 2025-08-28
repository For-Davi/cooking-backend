<?php

namespace App\Exports\Product;

use Illuminate\Support\Collection;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductExport
{
    protected Collection $products;

    public function __construct(Collection $products)
    {
        $this->products = $products;
    }

    public function download($fileName): StreamedResponse
    {
        if ($this->products->isEmpty()) {
            $emptyData = collect([[
                'ATIVO' => '',
                'NOME' => '',
                'SKU' => '',
                'CÓDIGO' => '',
                'PREÇO' => '',
                'VALOR DE VENDA' => '',
                'VALOR DE OFERTA' => '',
                'VALOR DE CUSTO' => '',
                'CATEGORIA' => '',
                'ESTOQUE' => '',
                'ALERTA MÍNIMO' => '',
                'COR' => '',
                'GRADE GRUPO' => '',
                'GRADE ITEM' => '',
                'LOCALIZAÇÃO' => '',
                'DESCRIÇÃO DO PRODUTO' => '',
                'DESCRIÇÃO DA VARIANTE' => '',
            ]]);

            return (new FastExcel($emptyData))->download($fileName);
        }

        return (new FastExcel($this->products))->download($fileName, function ($products) {
            return [
                'ATIVO' => $products->active === 1 ? 'Ativo' : 'Inativo',
                'NOME' => $products->product?->name ?? '',
                'SKU' => $products->sku ?? '',
                'CÓDIGO' => $products->code ?? '',
                'PREÇO' => $products->price ?? '',
                'VALOR DE VENDA' => $products->price ?? '',
                'VALOR DE OFERTA' => $products->cost ?? '',
                'VALOR DE CUSTO' => $products->cost ?? '',
                'CATEGORIA' => is_object($products->product?->category) && isset($products->product?->category->name)
                    ? $products->product?->category->name
                    : (is_string($products->product?->category) ? $products->product?->category : ''),
                'ESTOQUE' => $products->stock_quantity,
                'ALERTA MÍNIMO' => $products->min_stock_alert,
                'COR' => $products->color?->name,
                'GRADE GRUPO' => $products->gridItem?->gridGroup?->name ?? '',
                'GRADE ITEM' => $products->gridItem?->size ?? '',
                'LOCALIZAÇÃO' => $products->location ?? '',
                'DESCRIÇÃO DO PRODUTO' => $products->product?->description ?? '',
                'DESCRIÇÃO DA VARIANTE' => $products->description ?? '',
            ];
        });
    }
}
