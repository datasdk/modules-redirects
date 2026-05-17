<?php

namespace Modules\Redirect\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Redirect extends Model
{

    use HasFactory;

    protected $table = 'redirects';

    protected $fillable = [
        'name',
        'url',
    ];

    /**
     * Get the URL associated with the given name.
     *
     * @param string $name
     * @return string|null
     */
    public static function getUrl($name)
    {
        return optional(Redirect::where('name', $name)->first())->url;
    }
}
