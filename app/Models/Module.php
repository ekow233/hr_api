<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table= "modules";

    //method return all the modules stored in the database
    public function getsModule(){
        $modules = $this::all();
        return $modules;
    }

    //method returns module specified by the id
    public function getModule($id){
        $module = $this->where("id", $id)->first();
        return $module;
    }


}
