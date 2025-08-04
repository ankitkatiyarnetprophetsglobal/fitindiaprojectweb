<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use Illuminate\Support\Facades\Auth;
use App\Models\FoodChart;
use App\Models\User;
use App\Models\Foodname;
use App\Models\ServingQuantity;
use App\Models\CalorieIntake;
use Illuminate\Support\Facades\DB;

class FoodChartController extends Controller
{
    //
	
	public function destroy(Request $request)
	{
		
		$user = auth('api')->user();
		
		$datevar = date( "Y-m-d", strtotime($request->createdOn) );
		$res = CalorieIntake::where('user_id', $user->id)->where('food_type', $request->food_type)->where('food_id', $request->food_id)->where('for_date', $datevar)->delete();
		
			if($res){
                    return Response::json(array(
                        'statue' => 'success',
                        'code' => 200,
                        'message' => 'Calorie Intake sucessfully deleted'
                    ), 200);
            }else{
                    return Response::json(array(
                        'statue' => 'error',
                        'code' => 400,
                        'message' => 'Calorie Intake not deleted'
                    ), 400); 
            } 
				
		
	}
	
	
	public function index(Request $request)
    {
    
	
			
			if(!empty($request->food_id)){
				$food = FoodChart::where('id', $request->food_id)->orderBy('name', 'ASC')->get(); 
			}else{
				$food = FoodChart::orderBy('name', 'ASC')->get();
			}
			return Response::json(array(
					'status'    => 'success',
					'code'      =>  200,
					'message'   =>  $food
				), 200);
				
		
    }
	
	public function foodname(Request $request)
    {
        //
		$food = Foodname::orderBy('foodname', 'ASC')->get();
		return Response::json(array(
                'status'    => 'success',
                'code'      =>  200,
                'message'   =>  $food
            ), 200);
		
    }
	
	public function servingquantity(Request $request)
    {
        //
		$food = ServingQuantity::all();
		return Response::json(array(
                'status'    => 'success',
                'code'      =>  200,
                'message'   =>  $food
            ), 200);
		
    }
	
	
	public function calorieintakeget(Request $request)
    {	
		$user = auth('api')->user();
		
		if(!empty($user->id)){
		
			if(!empty($request->createdOn)){
				
				$datevar = date( "Y-m-d", strtotime($request->createdOn) );
				//$calorie = CalorieIntake::where('user_id',$user->id)->where('for_date',$datevar)->get();
				$calorie = DB::table('calorie_intakes')
				->leftJoin('serving_quantities', 'calorie_intakes.servingquantity_id', '=', 'serving_quantities.id')
				->leftJoin('foodnames', 'calorie_intakes.food_id', '=', 'foodnames.id')
				->where('calorie_intakes.user_id', $user->id)
				->where('calorie_intakes.for_date',$datevar)
				->select( DB::raw("calorie_intakes.id, calorie_intakes.user_id, calorie_intakes.food_id, calorie_intakes.servingquantity_id, calorie_intakes.calorie, calorie_intakes.food_type, calorie_intakes.quantity, calorie_intakes.goal, DATE_FORMAT( calorie_intakes.for_date, '%Y/%m/%d' ) as for_date, serving_quantities.name as servingquantity_name, foodnames.foodname as food_name " ) )
				->get();
				
			}else{
				//$calorie = CalorieIntake::where('user_id', $user->id)->get();  
				
				$calorie = DB::table('calorie_intakes')
				->leftJoin('serving_quantities', 'calorie_intakes.servingquantity_id', '=', 'serving_quantities.id')
				->leftJoin('foodnames', 'calorie_intakes.food_id', '=', 'foodnames.id')
				->where('calorie_intakes.user_id', $user->id)
				->select(
				DB::raw("calorie_intakes.id, calorie_intakes.user_id, calorie_intakes.food_id, calorie_intakes.servingquantity_id, calorie_intakes.calorie, calorie_intakes.food_type, calorie_intakes.quantity, calorie_intakes.goal, DATE_FORMAT( calorie_intakes.for_date, '%Y/%m/%d' ) as for_date, serving_quantities.name as servingquantity_name, foodnames.foodname as food_name " )
				)
				->get();

			}
		
			return Response::json(array(
                'status'    => 'success',
                'code'      =>  200,
                'message'   =>  $calorie
            ), 200);
			
		}else{
			return Response::json(array(
                'status'    => 'error',
                'code'      =>  401,
                'message'   =>  'Unauthorized'
            ), 401);
			
		}
	}
	
	public function calorieintake(Request $request)
    {
		$user = auth('api')->user();
        if($user){
			//return CalorieIntake::all();
			$datevar = date( "Y-m-d", strtotime($request->createdOn) );
			
			$colorie = CalorieIntake::where('user_id', $user->id)->where('food_type', $request->food_type)->where('food_id', $request->food_id)->where('for_date', $datevar)->first();
			
			
			if(!empty($colorie)){
				
				$res = CalorieIntake::where('user_id', $user->id)->where('food_type', $request->food_type)->where('food_id', $request->food_id)->where('for_date', $datevar)->update([
					'servingquantity_id' => $request->servingquantity_id,
					'calorie' => $request->calorie,
					'quantity' => $request->quantity,
					'goal' => $request->goal
				]);
				
				if($res){
                    return Response::json(array(
                        'statue' => 'success',
                        'code' => 200,
                        'message' => 'Calorie Intake sucessfully updated'
                    ), 200);
                }else{
                    return Response::json(array(
                        'statue' => 'error',
                        'code' => 400,
                        'message' => 'Calorie Intake not updated'
                    ), 200); 
                } 
				
			}else{
				
				$colorie = new CalorieIntake();
                $colorie->user_id = $user->id; 
				$colorie->food_id = $request->food_id;
                $colorie->servingquantity_id = $request->servingquantity_id;
				$colorie->calorie = $request->calorie;
				$colorie->food_type = $request->food_type;
				$colorie->quantity = $request->quantity;
				$colorie->goal = $request->goal;
                $colorie->for_date = $datevar;
               
                if($colorie->save()){
                    return Response::json(array(
                        'statue' => 'success',
                        'code' => 200,
                        'message' => 'Calorie Intake sucessfully stored'
                    ), 200);
                }else{
                    return Response::json(array(
                        'statue' => 'error',
                        'code' => 200,
                        'message' => 'Calorie Intake not stored'
                    ), 200); 
                } 
			}
		}else{
			
            return Response::json(array(
                'status'    => 'error',
                'code'      =>  401,
                'message'   =>  'Unauthorized'
            ), 401);
        }
       
	   
    }
	
}
