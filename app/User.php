<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use App\Book;
use App\BorrowLog;
use App\Exceptions\BookException;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','clase_id', 'avatar'
    ];
        public function clase()
    {
        return $this->belongsTo('App\Clase');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function borrow(Book $book)
    {
        //cek masih ada stok buku
        if ($book->stock < 1){
            throw new BookException("Buku $book->title sedang tidak tersedia.");
        }

        // cek apakah buku ini sedang dipinjam oleh user
        if($this->borrowLogs()->where('book_id',$book->id)->where('is_returned', 0)->count() > 0 ) {
        throw new BookException("Buku $book->title sedang Anda pinjam.");
    }
        $borrowLog = BorrowLog::create(['user_id'=>$this->id, 'book_id'=>$book->id]);
        return $borrowLog;
    }
    
    public function borrowLogs()
    {
        return $this->hasMany('App\BorrowLog');
    }

    public static function boot()
    {
        self::deleting(function($member)
        {
            if ($member->borrowLogs()->count() > 0) {
                Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Member $member->name sedang meminjam buku."
            ]);
            return false;
            }
        });
    }

    public function getPhotoPathAttribute() { 
        if ($this->avatar != '') { 
            return url('/img/' . $this->avatar); 
        } else { 
            return '/img/avatar.png'; 
        }
    } 
}
