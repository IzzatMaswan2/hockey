<?php

        namespace App\Models;
        
        use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;
        
        class Formation extends Model
        {
            use HasFactory;
        
            public $timestamps = false; // Disable timestamps
        
            protected $fillable = [
                'fullName',
                'displayName',
                'contact',
                'jerseyNumber',
                'position',
                'formationPosition',
                
            ];

            
        }
