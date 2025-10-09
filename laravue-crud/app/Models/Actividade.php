<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actividade extends Model
{
  
    protected $fillable = [
        'user_id',
        'action',
        'tipo',
        'subject_type',
        'subject_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relação polimórfica para o "subject" (o que causou a atividade)
    public function subject()
    {
        return $this->morphTo();
    }

    // Relação com quem causou a ação (usuário)
    public function causer()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }
}
