<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 04 Aug 2019 10:57:59 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Product
 *
 * @property int $product_id
 * @property string $product_name
 * @property string $product_upc
 * @property int $product_cat_id
 * @property string $product_price
 * @property string $product_description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property Category $category
 *
 * @package App\Models
 */
class Product extends Eloquent
{
    protected $table = 'product';
    protected $primaryKey = 'product_id';

    protected $casts = [
        'product_cat_id' => 'int'
    ];

    protected $fillable = [
        'product_name',
        'product_upc',
        'product_cat_id',
        'product_price',
        'product_description',
        'product_image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'product_cat_id');
    }
}
