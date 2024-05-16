<?php

namespace App;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    public static function updateIfChangedOrCreate(array $lookup, array $changeable, array $fields) {
        //look for object
        $object = self::where($lookup)->first();
        //no object found, create a new obejct and return it
        if (!$object) { return self::create(array_merge($lookup, $changeable, $fields)); }
        //object found, look to see if changeable fields have changed
        $changed = count(array_diff_assoc($changeable, $object->toArray())) > 0;

        //if changed, update
        if ($changed) { $object->update(array_merge($changeable, $fields)); }
        //else leave and return the object
        return $object;
    }
}
