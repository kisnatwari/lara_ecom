<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Seller;
use App\Models\ShopCategory;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function createSeller(): View
    {
        $districts = District::select(['id', 'district_name'])->get();
        $municipalities = Municipality::where('district_id', $districts[0]['id'])->select(['id', 'municipality_name'])->get();
        $shopCategories = ShopCategory::all();
        return view('auth.seller-register', compact('districts', 'municipalities', 'shopCategories'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^(?![0-9])[A-Za-z\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'regex:/^(98|97)[0-9]{8}$/'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function storeSeller(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^(?![0-9])[A-Za-z\s]+$/'],
            'shop_name' => ['required', 'string', 'max:255', 'regex:/^(?![0-9])[A-Za-z0-9\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'municipality_id' => ['required', 'exists:municipalities,id'],
            'shop_category' => ['required', 'exists:shop_categories,id'],
            'ward' => ['required', 'string', 'regex:/^(?![0-9])[A-Za-z\s0-9]+$/'],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'municipality_id' => $request->municipality_id,
            'ward' => $request->ward,
        ]);

        Seller::create([
            'user_id' => $user->id,
            'shop_name' => $request->shop_name,
            'shop_category_id' => $request->shop_category,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
