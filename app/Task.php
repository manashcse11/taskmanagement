<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * Relationships
     */
    public function project(){
        return $this->hasOne('App\Project', 'id', 'project_id');
    }
    /**
     * Scopes
     */
    public function scopeTaskFilter($query, $filters){
        foreach($filters as $field => $value){
            if($field && $value && $field != "_token"){
                $query->where($field, $value);
            }
        }
        return $query;
    }
    /**
     * User defined functions
     */
    public function get_tasks($filters){
        return $this->taskFilter($filters)
            ->with('project')
            ->orderby('priority')
            ->get();
    }
}
