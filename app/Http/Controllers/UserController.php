<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository=$userRepository;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required',
            'image'=>'nullable|image'
        ]);
        $imagePath=null;
        if($request->hasFile('image')){
        $imagePath=$request->file('image')->store('users','public');
        $data['image']=$imagePath;
        }

        $this->userRepository->store($data);
        return redirect('/profile');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $imagePath = $user->image;
        $data=$request->all();
        if ($request->hasFile('image')) {
              $imagePath = $request->file('image')->store('users', 'public');
           $data['image']=$imagePath;}

        $this->userRepository->update($user,$data);

        return redirect('/profile')->with('success','User Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
