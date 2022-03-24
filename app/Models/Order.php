<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public function getOrderCount()
    {
        $count = 0;
        foreach($this->products as $product) {
            if (isset($product->pivot->count)) {
                $count += $product->pivot->count;
            }
        }
        return $count;
    }

    public function getFullPrice()
    {
        $sum = 0;
        foreach($this->products as $product) {
            $sum += $product->getPriceForCount();
        }
        return $sum;
    }

    public function saveOrder($name, $surname, $email, $phone)
    {
        if ($this->status == 0) {
            $this->name = $name;
            $this->surname = $surname;
            $this->email = $email;
            $this->phone = $phone;
            $this->status = 1;
            $this->save();
            return true;
        } else {
            return false;
        }
    }
}
