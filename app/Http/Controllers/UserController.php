<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Util;
use App\Models\User;
use App\Models\simulacao;
use App\Models\faculdade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

use Sentinel;
// use Reminder;
use Mail;

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function login(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);      

        $user=User::where('email',$request->input('email'))->first();

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            
            if($user->tipo_user == 1){                
                return redirect('dashboard-admin');
            }
            else{
            return redirect('dashboard');
            }
        } else{
            return redirect('/')
                ->with('error', 'Usuário ou senha Inválidos!')
                ->with('tab', 'login');
        }
    }

    public function criarUsuario(Request $request){        
        // dd($request);
        $novoUsuario = new User();
        $novoUsuario->name = $request->input('name');        
        $novoUsuario->email= $request->input('email');
        $novoUsuario->telefone= $request->input('tel');
        $senha= $request->input('password');
        $novoUsuario->password = Hash::make($senha);

        $simulacao = new simulacao();
        $simulacao->matematica = $request->input('matematicaR');
        $simulacao->humanas = $request->input('humanasR');
        $simulacao->linguagens = $request->input('linguagensR');
        $simulacao->natureza = $request->input('naturezaR');
        $simulacao->redacao = $request->input('redacaoR');
        $simulacao->faculdades_id = 1;
        $simulacao->modalidade =1;
        $simulacao->estado ='mg';
        $simulacao->nota_corte = ($simulacao->matematica + $simulacao->humanas + $simulacao->linguagens + $simulacao->natureza + $simulacao->redacao)/5;
     

        
        if (User::where('email',$novoUsuario->email)->first()){
            return redirect('/')
            ->with('error', 'Email já cadastrado, tente outro!');
        }

        $novoUsuario->save();
        $simulacao->user_id = $novoUsuario->id;
        try{ 
            $simulacao->save();            
        } catch (\Throwable $th) {
            return redirect('/')
            ->with('error', 'Erro ao cadastrar usuário, é necessario preencher todas as notas para cadastro!');
        }
            return redirect('/')
            ->with('success', 'Usuário cadastrado com sucesso, faça o login!')
            ->with('tab', 'login');        
    }    


    // FUNÇÕES DO FRONT
    public function indexFront(){
        $estados = Util::estados();
        if(Auth::check()){
            $user= Auth::user();
            if($user->tipo_user == 1){
                return redirect('/dashboard-admin')
                ->with('user', $user)   
                ->with('estados', $estados)             
                ->with('success', 'Login realizado com sucesso!');
            }
            else{
            return redirect('/dashboard')
                ->with('user', $user)
                ->with('estados', $estados)
                ->with('success', 'Login realizado com sucesso!');
            }
        }
        else{
            $user= Auth::user();
            return view('index')
            ->with('user', $user);
        }
        
    }

    public function dashboard(){
        $user = Auth::user();
        
        return view('simulacao')
        ->with('user', $user)
        ->with('simulacao',  simulacao::where('user_id',$user->id)->first())
        ->with('faculdades',  faculdade::all())
        ->with('estados',  Util::estados());
    }

    public function dashboardAdmin(){
        $users = User::orderBy('id', 'desc')->paginate(15);
        $user = Auth::user();
        return view('admin')
        ->with('users', $users)
        ->with('user', $user);
    }

}