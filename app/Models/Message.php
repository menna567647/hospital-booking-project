<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Message extends Model
{
    protected $fillable = ['id', 'name', 'email', 'phone', 'title', 'text', 'client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}