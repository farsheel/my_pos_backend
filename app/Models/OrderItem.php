<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 04 Aug 2019 17:47:13 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class OrderItem
 *
 * @property int $order_item_id
 * @property string $order_product_name
 * @property int $order_product_id
 * @property int $order_id
 * @property string $order_price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\Models\Order $order
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class OrderItem extends Eloquent
{
	protected $primaryKey = 'order_item_id';

	protected $casts = [
		'order_product_id' => 'int',
		'order_id' => 'int'
	];

	protected $fillable = [
		'order_product_name',
		'order_product_id',
		'order_id',
		'order_price',
        'quantity'
	];

	public function order()
	{
		return $this->belongsTo(\App\Models\Order::class);
	}

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class, 'order_product_id');
	}
}
