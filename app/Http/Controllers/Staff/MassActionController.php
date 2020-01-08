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
 * @author     HDVinnie
 */

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessMassPM;
use App\Models\Group;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class MassActionController extends Controller
{
    /**
     * Mass PM Form.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('Staff.masspm.index');
    }

    /**
     * Send The Mass PM.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function store(Request $request)
    {
        $users = User::all();

        $sender_id = 1;
        $subject = $request->input('subject');
        $message = $request->input('message');

        $v = validator($request->all(), [
            'subject' => 'required|min:5',
            'message' => 'required|min:5',
        ]);

        if ($v->fails()) {
            return redirect()->route('staff.mass-pm.create')
                ->withErrors($v->errors());
        }
        foreach ($users as $user) {
            $this->dispatch(new ProcessMassPM($sender_id, $user->id, $subject, $message));
        }

        return redirect()->route('staff.mass-pm.create')
            ->withSuccess('MassPM Sent');
    }

    /**
     * Mass Validate Unvalidated Users.
     *
     * @return RedirectResponse
     */
    public function update(): \Illuminate\Http\RedirectResponse
    {
        $validating_group = cache()->rememberForever('validating_group', fn () => Group::where('slug', '=', 'validating')->pluck('id'));
        $member_group = cache()->rememberForever('member_group', fn () => Group::where('slug', '=', 'user')->pluck('id'));
        $users = User::where('active', '=', 0)->where('group_id', '=', $validating_group[0])->get();

        foreach ($users as $user) {
            $user->group_id = $member_group[0];
            $user->active = 1;
            $user->can_upload = 1;
            $user->can_download = 1;
            $user->can_request = 1;
            $user->can_comment = 1;
            $user->can_invite = 1;
            $user->save();
        }

        return redirect()->route('staff.dashboard.index')
            ->withSuccess('Unvalidated Accounts Are Now Validated');
    }
}
