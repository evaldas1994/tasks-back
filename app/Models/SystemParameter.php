<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemParameter extends Model
{
    protected $fillable = ['key', 'type', 'value'];

    public static function getValue(string $key)
    {
        $param = self::where('key', $key)->first();

        if (!$param)
            return null;

        if (in_array($param->type, ['int']))
            return (int)$param->value;

        if (in_array($param->type, ['float']))
            return (float)$param->value;

        if (in_array($param->type, ['string']))
            return (string)$param->value;

        if (in_array($param->type, ['bool']))
            return (bool)$param->value;

        return null;
    }

    public static function setValue(string $key, mixed $value): void
    {
        $param = self::where('key', $key)->first();

        if (in_array($param->type, ['int']))
            $value =  (int)$value;

        if (in_array($param->type, ['float']))
            $value =  (float)$value;

        if (in_array($param->type, ['string']))
            $value =  (string)$value;

        if (in_array($param->type, ['bool']))
            $value =  (bool)$value;

        $param->value = $value;
        echo "saugom: ". $value;
        $param->save();
    }
}
