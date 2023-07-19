<?php

use App\Http\Controllers\CategoryApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('/categories',CategoryApiController::class);

// Route::get('/categories',[CategoryApiController::class,'index']);
// Route::post('/categories',[CategoryApiController::class,'store']);
// Route::get('/categories/{id}',[CategoryApiController::class,'show']);
// Route::put('/categories/{id}',[CategoryApiController::class,'update']);
// Route::delete('/categories/{id}',[CategoryApiController::class,'destroy']);

Route::post('/login',function(){
    $email=request()->email;
    $password=request()->password;

    if(!$email or !$password){
        return response(['msg'=>'email or password incorrect'],403);

    }
    $user=\App\Models\User::where("email",$email)->first();
    if($user){
        if(password_verify($password,$user->password)){
            return $user->createToken('api')->plainTextToken;
        }
    }
    return response(['msg'=>'email or password incorrect'],403);
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
