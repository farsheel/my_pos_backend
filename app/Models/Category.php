<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 04 Aug 2019 10:57:19 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Category
 *
 * @property int $cat_id
 * @property string $cat_name
 * @property string $cat_description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $products
 *
 * @package App\Models
 */
class Category extends Eloquent
{
    protected $table = 'category';
    protected $primaryKey = 'cat_id';

    protected $fillable = [
        'cat_name',
        'cat_description'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_cat_id');
    }
}
