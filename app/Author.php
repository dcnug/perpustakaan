<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Author extends Model
{
    //
    protected $fillable = ['name'];

    public function books()
    {
    	return $this->hasMany('App\Book');
    }

    public static function boot()
    {
    	parent::boot();

    	self::deleting(function($author){
    		if ($author->books->count()>0){
    			//menyimpan pesan error
    			$html = 'Penulis tidak bisa dihapus karena masih memiliki buku : ';
    			$html .='<ul>';
    			foreach ($author->books as $book){
    				$html .= "<li>$book->title</li>";
    			}
    			$html .='</ul>';

    			Session::flash("flash_notification",[
    				"level"=>"danger",
    				"message"=>$html
    				]);

    			//membatalkan proses penghapusan
    			return false;
    		}
    		});
    } 
}
