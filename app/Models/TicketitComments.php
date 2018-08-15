<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class TicketitComments extends Model
{
    protected $table = 'ticketit_comments';
    /**
	 * @var string
	 */
	protected $primaryKey = 'id';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }
}
