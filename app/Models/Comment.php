<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'message'
    ];

    public function secondaryComments()
    {
        return $this->hasMany(SecondaryComment::class)->orderBy('created_at', 'DESC');
    }

    public function getCreatedAtAttribute($time)
    {
        $time_difference = time() - strtotime($time);

        if( $time_difference < 1 ) { return 'less than 1 second ago'; }
        $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                    30 * 24 * 60 * 60       =>  'month',
                    24 * 60 * 60            =>  'day',
                    60 * 60                 =>  'hour',
                    60                      =>  'minute',
                    1                       =>  'second'
        );

        foreach( $condition as $secs => $str )
        {
            $d = $time_difference / $secs;

            if( $d >= 1 )
            {
                $t = round( $d );
                return $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
            }
        }
    }
}
