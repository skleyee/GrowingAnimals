<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Animal
 *
 * @property int $id
 * @property string $name
 * @property string $animal_kind
 * @property int $age
 * @property int $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Animal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereAnimalKind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Animal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Animal extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'kind'];

    public static function checkExistingAnimalByName($name) {
        return DB::table('animals')->where('name', $name)->exists();
    }

    public static function makeAnimalOlderByName($name) {
        return DB::table('animals')->where('name', $name)->update(['age' => self::where('name', $name)->first()->age + 1]);
    }

    public static function makeAnimalOlderAndBiggerByName($name, $growthFactor) {
        return DB::table('animals')->where('name', $name)->update(['age' => self::where('name', $name)->first()->age + 1,
                                                                          'size' => self::where('name', $name)->first()->size + $growthFactor]);
    }
}
