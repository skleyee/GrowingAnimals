<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\AnimalKinds
 *
 * @property int $id
 * @property string $kind
 * @property int $max_size
 * @property int $max_age
 * @property float $growth_factor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalKinds newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalKinds newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalKinds query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalKinds whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalKinds whereGrowthFactor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalKinds whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalKinds whereKind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalKinds whereMaxAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalKinds whereMaxSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnimalKinds whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AnimalKinds extends Model
{
    use HasFactory;

    public static function getAllKinds() {
        $data = DB::table('animal_kinds')->select('kind')->get();
        $result = [];
        foreach ($data as $elem) {
            $result[] = $elem->kind;
        }
        return $result;
    }
}
