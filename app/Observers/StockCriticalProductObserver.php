<?php

namespace App\Observers;

use App\Helpers\NotificationHelper;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class StockCriticalProductObserver
{
    public function updated(ProductVariant $variant): void
    {
        if ($variant->stock_quantity <= $variant->min_stock_alert) {
            $system = DB::table('setting_system')->where('enterprise_id', $variant->enterprise_id)->first();

            if ($system->send_notification_stock_critical === 1) {
                $users = DB::table('users')->where('enterprise_id', $variant->enterprise_id)->get();

                $cor = $variant->color->name ?? 'Não definida';
                $categoria = $variant->product->category->name ?? 'Não definida';
                $grade = $variant->gridItem->name ?? 'Não definida';
                $sku = $variant->sku ?? 'Não definido';

                foreach ($users as $user) {
                    NotificationHelper::create(
                        $user->id,
                        "Estoque de alerta de {$variant->product->name}",
                        "O produto {$variant->product->name} atingiu o alerta crítico.
                    Informações:
                    Cor: ".$cor.'.
                    Categoria: '.$categoria.'.
                    Grade: '.$grade.'.
                    SKU: '.$sku.'.',
                        $variant->enterprise_id
                    );
                }
            }
        }
    }
}
