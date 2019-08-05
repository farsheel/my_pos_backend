<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 04 Aug 2019 17:47:05 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Order
 *
 * @property int $order_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $order_items
 *
 * @package App\Models
 */
class Order extends Eloquent
{
    protected $primaryKey = 'order_id';

    public function order_items()
    {
        return $this->hasMany(\App\Models\OrderItem::class, "order_id");
    }
}
