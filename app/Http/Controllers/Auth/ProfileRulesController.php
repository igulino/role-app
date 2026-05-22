<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\StoreUser;

class ProfileRulesController extends Controller {

    public function DashRules() : View {
        
    }

    public function Quick(Request $request, User $user) : View {
        $this->authorize('UpdateAdmin', $user);

        Log::info("editing user: " . $user->id . " requested by: " . $request->user()->id);

        return view("profile.editUser", ['user' => $user, 'RequestBy' => $request->user()->id]);
    }
    /*
    public function UpdateUser(Request $request, User $user) : void {
        $this->authorize('update', $user);

    }*/
    public function updateAdm(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $user = User::findOrFail($validated['id']);

        Log::info("admin updating user: " . $user->role . " requested by: " . $request->user()->role);
        
        $this->authorize('updateByAdmin', $user);

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $user->save();
        return redirect('/profile/' . $user->id)->with('status', 'Profile updated!');
        
    }

    public function updatePasswordAdm(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'id' => ['required', 'exists:users,id'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = User::findOrFail($validated['id']);
        
        $this->authorize('updateByAdmin', $user);
        
        $user->update([
            'password' => Hash::make($validated['password'])
        ]);
        return back()->with('status', 'password-updated');
        
    }

    public function destroyAdm(Request $request)
    {
        Log::info('destroyAdm ', $request->only(['id']));

        $validated = $request->validateWithBag('userDeletion', [
            'id' => ['required', 'exists:users,id'],
            'password' => ['required', 'current_password'],
        ]);
      

        $user = User::findOrFail($validated['id']);
        $this->authorize('updateByAdmin', $user);
        
        $user->delete();
        return Redirect::to('/dashboardAdm')->with('status', 'excluido!');
    }

    public function storeAdm(StoreUser $request) {
        $validated = $request->validated();

        $user = new User();

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'user',
            'genitor' => false
        ]);

        $user->save();
        return Redirect::to('/dashboardAdm')->with('status', 'deu bom!');
    }

    public function UpdateGenitor() : Returntype {
        
    }
}
