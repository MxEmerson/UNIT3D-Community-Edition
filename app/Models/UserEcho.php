<?php
/**
 * NOTICE OF LICENSE.
 *
 * UNIT3D is open-sourced software licensed under the GNU Affero General Public License v3.0
 * The details is bundled with this project in the file LICENSE.txt.
 *
 * @project    UNIT3D
 *
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html/ GNU Affero General Public License v3.0
 * @author     singularity43
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\UserEcho.
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $room_id
 * @property int|null $target_id
 * @property int|null $bot_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Bot|null $bot
 * @property-read \App\Models\Chatroom|null $room
 * @property-read \App\Models\User|null $target
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEcho newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEcho newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEcho query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEcho whereBotId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEcho whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEcho whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEcho whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEcho whereTargetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEcho whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEcho whereUserId($value)
 * @mixin \Eloquent
 */
final class UserEcho extends Model
{
    /**
     * Indicates If The Model Should Be Timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'user_echoes';

    /**
     * Belongs To A User.
     *
     * @return BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Belongs To A Chatroom.
     *
     * @return BelongsTo
     */
    public function room(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Chatroom::class);
    }

    /**
     * Belongs To A Target.
     *
     * @return BelongsTo
     */
    public function target(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Belongs To A Bot.
     *
     * @return BelongsTo
     */
    public function bot(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Bot::class);
    }
}
