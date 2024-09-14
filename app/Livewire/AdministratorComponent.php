<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\UserRole;
use App\Models\UserType;
use App\Models\Operability;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\DB;

class AdministratorComponent extends Component
{
    use WithPagination;

    public $edit, $userTypes, $password_confirmation,$roles;

    #[Rule(['required','unique:users'])]
    public $email ;
    #[Rule(['required','min:7'])]
    public $name;
    #[Rule(['required','min:7','confirmed'])]
    public $password ;
    #[Rule('required')]
    public $userType;

    public function mount(){
        $this->userTypes = UserType::all();
        $this->roles = Role::all();
    }
    public function save(){
        if($this->edit){
            $this->validate([
                'email' => 'required',
                'name' => ['required','min:7'],
                'userType' => ['required']
            ]);
            $user = User::where('email',$this->email)->first();
            DB::table('users')->where('email', $this->email)->update(['name'=>$this->name,'user_type_id' => 2]);
            DB::table('user_roles')->where('user_id',$user->id)->updateOrInsert(['user_id'=>$user->id],['role_id' => $this->userType]);
            session()->flash('message', 'Información guardada exitosamente');
            $this->reset('email','password','name','userType','password_confirmation');
            $this->edit = null;
            $this->mount();
        }else{
            $this->validate();
            $user = UserModel::create([
                'email' => $this->email,
                'name' => $this->name,
                'password' => bcrypt($this->password),
                'user_type_id' => 2
            ]);
            UserRole::create([
                'user_id'=>$user->id,
                'role_id' => $this->userType
            ]);
            $this->reset('email','password','name','userType','password_confirmation');
            session()->flash('message', 'Información guardada exitosamente');
            $this->mount();
        }
    }
    public function editUser(UserModel $user){
        $this->email = $user->email;
        $this->name = $user->name;
        $this->userType = isset($user->userRole) && !is_null($user->userRole) ? $user->userRole->role_id : $user->user_type_id;
        $this->edit = true;
    }
    public function cancel(){
        $this->edit = null;
        $this->reset('email','password','name','userType','password_confirmation');
        $this->mount();
    }
    public function restoreTwoFactor(UserModel $user){
        $user->two_factor_secret = null;
        $user->two_factor_recovery_codes = null;
        $user->two_factor_confirmed_at = null;
        $user->save();
        session()->flash('message-two-factor', 'Autenticación de dos pasos deshabilitada exitosamente');
        $this->cancel();
    }


    public function userDelete($id){
        $user = User::find($id);
        $operability = Operability::where('user_id', $user->id)->first();
        if($operability){
            session()->flash('message-error',"No se puede eliminar al usuario $user->name");
            $this->cancel();
        }else{
            UserRole::where('user_id',$user->id)->delete();
            $user->delete();
            session()->flash('message-success',"El usuario $user->name fue eliminado exitosamente");
            $this->cancel();
        }

    }
    public function render()
    {
        $users = UserModel::join('user_types','users.user_type_id','=', 'user_types.id')
            ->where('users.id','!=',auth()->user()->id)
            ->where('users.status','A')
            ->select('users.id','users.email','users.name','users.id','users.two_factor_secret',
                'users.two_factor_recovery_codes','users.two_factor_confirmed_at','user_types.description as description')
            ->orderByDesc('users.updated_at')
            ->paginate(10);
        return view('livewire.administrator-component',[
            'users' => $users
        ])->layout('layouts.app');
    }
}
