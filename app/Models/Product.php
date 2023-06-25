<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const PRODUCT_TB = 'product';
    const COL_ID = 'id';
    const COL_NAME = 'name';
    const COL_STATUS = 'status';
    const COL_DESCRIPTION = 'description';
    const COL_CREATED_AT = 'created_at';
    const COL_UPDATED_AT = 'updated_at';

    protected $table = Product::PRODUCT_TB;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       self::COL_ID,
       self::COL_NAME,
       self::COL_STATUS,
       self::COL_DESCRIPTION,
       self::COL_CREATED_AT,
       self::COL_UPDATED_AT
    ];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // not need column hidden
    ];
}
