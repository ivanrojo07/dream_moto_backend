<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        // return $usuario;
        return response()->json([ 'usuarios'=>$usuarios], 200);
        // return $this->showAll($usuarios);
    }

    /**
     * Show the form for login a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //
        // return response()->json([$request->all()],400);
        $data = $request->all();
        // $data['password'] = bcrypt($data->password);
        $usuario = User::where(function($query)use($data){
            $query->where('username',$data['email'])->orWhere('email',$data['email']);
        })->first();
        // dd($usuario->password);
        // $hashpass = Hash::make($data['password']);
        if ($usuario) {
            if(Hash::check($data['password'], $usuario->password))
            {
                return response()->json(['usuario'=>$usuario],200);
            }
            else{
                return response()->json(['failed'=>'Contraseña invalida'], 200);
            }
        }
        else{
            return response()->json(['failed'=>'El usuario no existe'], 200);
            
        }
        // dd($usuario);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json([$request->all()],200);
        $rules =[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username'=> 'required|unique:users',
            'password' => 'required|min:6',
        ];

        $validater = $request->validate($rules);
        // dd($validater);
        // $this->validate($request,$rules);
        $campos = $request->all();
        $campos['password']= bcrypt($request->password);
        // $campos['verified']=User::USUARIO_NO_VERIFICADO;
        // $campos['admin'] =User::USUARIO_REGULAR;
        // $campos['verification_token'] = User::generarVerificationToken();
        $usuario = User::create($campos);
        if ($usuario){
            return response()->json(['usuario'=>$usuario], 200);
        }
        else{
            return response()->json(['message'=>'Error al crear usuario'], 400);
        }
    }
    public function saveUser(request $request){
        // dd($request->all());
        $rules =[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'telefono'=>'required',
            'apmaterno'=>'required'
            // 'username'=> 'required|unique:users',
            // 'password' => 'required|min:6',
        ];

        // dd($request->all());

        $validater = $request->validate($rules);
        // dd($validater);
        // $this->validate($request,$rules);
        $campos = $request->all();
        // dd($campos);
        $campos['username']= "user".Carbon::now()->getTimestamp();
        $campos['password']= bcrypt('secret');
        // dd($campos);
        // $campos['verified']=User::USUARIO_NO_VERIFICADO;
        // $campos['admin'] =User::USUARIO_REGULAR;
        // $campos['verification_token'] = User::generarVerificationToken();
        $usuario = User::create($campos);
        if ($usuario){
            return response()->json(['usuario'=>$usuario], 200);
        }
        else{
            return response()->json(['message'=>'Error al crear usuario'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            return response()->json(['usuario'=>$usuario],200);
            // return $this->showOne($usuario);
        }
        else{
            return response()->json(['messenger'=>'El usuario no existe'], 404);
        }
            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $rules = [
            'email'=> 'email|unique:users,email,' . $usuario->id,
            'username'=> 'required|unique:users',
            'password'=> 'min:6|confirmed',
            
        ];

        $this->validate($request, $rules);

        if ($request->has('name')) {
            $usuario->name = $request->name;
        }

        if ($request->has('email') && $usuario->email != $request->email){
            // $usuario->verified = User::USUARIO_NO_VERIFICADO;
            // $usuario->verification_token = User::generarVerificationToken();
            $usuario->email = $request->email;
        }
        if ($request->has('password')) {
            $usuario->password = bcrypt($request->password);
        }
        // if ($request->has('admin')) {
        //     if(!$usuario->esVerificado()){
        //         // return $this->errorResponse('Error al Actualizar. Se necesita ser Administrador para actualizar', 409);
        //         response()->json(['message'=>'Error al actualizar', 'codigo'=>409],409);
        //     }
        //     else{
        //         $usuario->admin = $request->admin;
        //     }
        // }
        // var_dump($usuario);
        if (!$usuario->isDirty()) {
            // return $this->errorResponse('Error. Se debe de especificar al menos un valor diferente para actualizar', 422);
          return response()->json(['message'=>'Error. Se debe de especificar al menos un valor diferente para actualizar', 'code'=>422], 422);
        }

        $usuario->save();
        // return $this->showOne($usuario);
        return response()->json(['usuario'=>$usuario],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        
        $usuario->delete($usuario);

        // return $this->showOne($usuario);
        return response()->json(['usuario'=>$usuario],200);
    }
    public function verify($token){
        $user = User::where('verification_token', $token)->firstOrFail();
        // $user->verified = User::USUARIO_VERIFICADO;
        // $user->verification_token = null;
        $user->save();
        // return $this->successResponse('La cuenta ha sido verificada',200);
        return response()->json(['message'=>'La cuenta ha sido verificada'], 200);
    }
    public function resend(User $user){
        if ($user->esVerificado()) {
            return $this->errorResponse('Este usuario ya ha sido verificado', 409);
        }
        else{
            retry(5, function() use ($user){
                Mail::to($user)->send(new UserCreated($user));
            },100);
            return response()->json(['message'=>'El correo de verificación se ha reenviado'],200);
        }

    }
    public function getUser (Request $request) {
        return $request->user();
    }

    public function changePassword(Request $request){
        $user = $request->user();
        $data = $request->all();
        if(Hash::check($data['password'], $user->password)){
            
            $rules= [
                'password_new'=> 'required|min:6|confirmed',
            ];
            $this->validate($request, $rules);
            $user->password = bcrypt($data['password_new']);
            $user->save();
            return response()->json(['message'=>"Tu contraseña a sido actualizada"],200);
        }
        else{
            return response()->json(["error"=>"Tu contraseña no es correcta."],401);
            
        }

    }

    public function searchEmail(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        // dd($user);
        if($user != null){
            return response()->json(['user'=>$user],201);
        }
        else{
            return response()->json(['error'=>'Usuario no localizado'],404);
        }
    }

    public function searchMoto(User $user,Request $request)
    {
        
        $inputs = $request->all();
        $moto = $user->motos();
        if(isset($inputs['marca']) ){
            $moto->where('marca',$inputs['marca']);

        }

        if(isset($inputs['modelo']) ){
            $moto->where('modelo',$inputs['modelo']);
        }

        if(isset($inputs['version']) ){
            $moto->where('version',$inputs['version']);
        }

        if(isset($inputs['anio']) ){
            $moto->where('anio',$inputs['anio']);
        }

        if(isset($inputs['serie']) ){
            $moto->where('serie',$inputs['serie']);
        }

        $moto = $moto->first();
        if($moto == null){
            return response()->json(['message'=>'moto no encontrada'],404);
        }

        else{
            return response()->json(['moto'=>$moto],200);
        }
    }
    public function saveMoto(User $user, Request $request)
    {
        $inputs = $request->all();
        // dd($inputs);
        $moto = $user->motos()->updateOrCreate(
            [
                'marca'=>$inputs['marca'],
                'serie'=>$inputs['serie']
            ],
            [

                'modelo'=>$inputs['modelo'],
                'version'=>$inputs['version'],
                'anio'=>$inputs['anio'],
                'km'=>$inputs['km']
            ]
        );
        return response()->json(['moto'=>$moto],201);
    }

}
