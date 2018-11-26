<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Major;
use App\University;
use App\Community;
use App\Tutor;
use App\Event;
use App\Music;
use App\Sport;
use App\ActivityWall;
use App\WallImages;
use Auth;
use Illuminate\Support\Facades\Input;
use View;
use Redirect;
use DB;
use Mail;
use Hash;


class UserController extends Controller
{

	public function signup(Request $request)
	{
		$exist=User::where('EmailID',$request->EmailID)->first();

		if($exist == "")
		{

			$insert=new User();
			$insert->firstname=$request->sFName;
			$insert->lastname=$request->sLName;
			$insert->EmailID=$request->EmailID;
			$insert->MajorID=$request->MajorID;
			$insert->DOB=$request->DOB;
			$insert->Password=Hash::make($request->Password);

			$todayyear=date('Y');

			$birthdayyear=date('Y',strtotime($request->DOB));

			$year=$todayyear-$birthdayyear;

			$insert->Age=$year;

			$inserted=$insert->save();
			
			if($inserted)
			{
	                $id= encrypt($insert->UserID); 

	                $bodyMessage=url('/').'/verifyemail/'.$id;

	                $data = array("bodymessage" => $bodyMessage, "email" => $request->EmailID);

	                Mail::send('mail.send_verifyemail', $data, function($message) use ($data) {

	                    $message->to($data['email'], $data['email'])

	                            ->subject('Verify Email');

	                    $message->from('admin@100degree.com','100Degree Portal');

	                });
				return response()->json(['code'=>200,'status'=> true, 'message'=> 'Successfully signup']);
			}
			else
			{

				return response()->json(['code'=>500,'status'=> false, 'message'=> 'Something went wrong, try again later']);
			}
		}
		else
		{
			return response()->json(['code'=>201,'status'=> false, 'message'=> 'Already exist email id']);

		}

	}

	public function verifyemail(Request $request)
	{
		$id=decrypt($request->id);

		$update=User::where('UserID',$id)->update(['status'=>'True']);

		if($update)
		{
			return View::make('register_sucess');

		}
		else
		{
			return redirect('/')->with('failed','something went wrong,please try again later');
		}
	}

	public function login(Request $request)
	{
		$exist=User::where('EmailID',$request->EmailID)->first();

		if($exist != "")
		{
			$verify=User::where('EmailID',$request->EmailID)->where('status','True')->first();
			if($verify != "")
			{

				$login=Hash::check($request->Password, $verify->Password);
				if($login)
				{
					$verify->Msg="Successfully login";
					$verify->majorname=$verify->majors->Major;
					return response()->json(['code'=>200,'status'=> true, 'message'=>$verify]);
				}
				else
				{
					return response()->json(['code'=>203,'status'=> false, 'message'=> 'Password is not match']);		
				}

			}
			else
			{
				return response()->json(['code'=>202,'status'=> false, 'message'=> 'Please verify email id']);	
			}			

		}
		else
		{
			return response()->json(['code'=>201,'status'=> false, 'message'=> 'Invalid Email']);
		}
	}

	public function majors()
	{
		$data=Major::all();
		if($data != '')
				{
					return response()->json(['code'=>200,'status'=> true, 'message'=>$data]);
				}
				else
				{
					return response()->json(['code'=>500,'status'=> false, 'message'=> 'data is not find out']);		
				}

	}

	public function universities()
	{
		$data1=University::all();
		if($data1 != '')
				{
					return response()->json(['code'=>200,'status'=> true, 'message'=>$data1]);
				}
				else
				{
					return response()->json(['code'=>500,'status'=> false, 'message'=> 'data is not find out']);		
				}

	}

	public function community()
	{

		$data=Community::all();
		
		if($data != '')
				{
					return response()->json(['code'=>200,'status'=> true, 'message'=>$data]);
				}
				else
				{
					return response()->json(['code'=>500,'status'=> false, 'message'=> 'data is not find out']);		
				}

	}

	public function profile(Request $request)
	{
		$data=User::where('UserID',$request->id)->first();

		if($data != '')
				{
					$data->majorname=$data->majors->Major;
					return response()->json(['code'=>200,'status'=> true, 'message'=>$data]);
				}
				else
				{
					return response()->json(['code'=>500,'status'=> false, 'message'=> 'data is not find out']);		
				}
	}

	public function events()
	{
		$data=Event::all();


		if($data != '')
				{
					return response()->json(['code'=>200,'status'=> true, 'message'=>$data]);
				}
				else
				{
					return response()->json(['code'=>500,'status'=> false, 'message'=> 'data is not find out']);		
				}

	}

	public function tutors()
	{
		$data=Tutor::all();
		foreach($data as $d)
		{

			$d->majorname=$d->majors->Major;
		}

		if($data != '')
				{
					return response()->json(['code'=>200,'status'=> true, 'message'=>$data]);
				}
				else
				{
					return response()->json(['code'=>500,'status'=> false, 'message'=> 'data is not find out']);		
				}

	}

	public function musics()
	{
		$data=Music::all();

		if($data != '')
				{
					return response()->json(['code'=>200,'status'=> true, 'message'=>$data]);
				}
				else
				{
					return response()->json(['code'=>500,'status'=> false, 'message'=> 'data is not find out']);		
				}
	}

	public function edit_profile(Request $request)
	{

		$exist=User::find($request->id);
		$exist->firstname=$request->FName;
		$exist->MajorID=$request->MajorID;
		$exist->UniversityID=$request->UniversityID;
		$exist->Age=$request->Age;
		$exist->Gender=$request->Gender;
		$exist->AboutMe=$request->AboutMe;
		if($request->ProfilePic != '')
		{
				$rand=rand(1,1000000);
                // Set the destination path
                $destinationPath = public_path().'/images';
                // Get the orginal filname or create the filename of your choice
                $filename1 = str_replace(' ', '_', $request->ProfilePic->getClientOriginalName());
                $filename1 = $rand.''.$filename1;
                $request->ProfilePic->move($destinationPath, $filename1);
        $exist->ProfilePic=$filename1;
        }

		$update=$exist->save();
		if($update)
		{
				return response()->json(['code'=>200,'status'=> true, 'Msg'=>"Profile has been updated successfully."]);
		}
		else
		{
				return response()->json(['code'=>500,'status'=> false, 'message'=> 'data is not find out']);		
		}
	}

	public function sports()
	{

		$data=Sport::all();


		if($data != '')
				{
					return response()->json(['code'=>200,'status'=> true, 'message'=>$data]);
				}
				else
				{
					return response()->json(['code'=>500,'status'=> false, 'message'=> 'data is not find out']);		
				}		
	}


	public function forgot_password(Request $request)
	{
		$rand=rand(100000,999999);
		$exist=User::where('EmailID',$request->email)->update(['Password'=>Hash::make($rand) ]);
		if($exist)
		{

			$data = array("password" => $rand, "email" => $request->email);

	                Mail::send('mail.send_password', $data, function($message) use ($data) {

	                    $message->to($data['email'], $data['email'])

	                            ->subject('New Password');

	                    $message->from('admin@100degree.com','100Degree Portal');

	                });

			return response()->json(['code'=>200,'status'=> true, 'Msg'=>"Password send successfully."]);

		}
		else
		{

			return response()->json(['code'=>500,'status'=> false, 'message'=> 'data is not find out']);

		}

	}


	public function activity_wall(Request $request)
	{
		$insert=new ActivityWall($request->all());
		$inserted=$insert->save();
		if($inserted != '')
				{
					$data=$request->imgaes;
					foreach($data as $d)
					{
						if($d != '')
						{

								$rand=rand(1,1000000);
				                // Set the destination path
				                $destinationPath = public_path().'/images';
				                // Get the orginal filname or create the filename of your choice
				                $filename1 = str_replace(' ', '_', $d->getClientOriginalName());
				                $filename1 = $rand.''.$filename1;
				                $d->move($destinationPath, $filename1);

						}
						$insert21=new WallImages();
						$insert21->images=$filename1;
						$insert21->wall_id=$insert->id;
						$insert21->save();
					}

					return response()->json(['code'=>200,'status'=> true, 'message'=>'Success']);
				}
				else
				{
					return response()->json(['code'=>500,'status'=> false, 'message'=> 'something went wrong, please try again later']);		
				}
	}

	public function activitywalls(Request $request)
	{
		$data=ActivityWall::get();

		foreach($data as $d)
		{
			$d->images=$d->images;
			$d->user=$d->user;
		}

				if($data != '')
				{
					return response()->json(['code'=>200,'status'=> true, 'message'=>$data]);
				}
				else
				{
					return response()->json(['code'=>500,'status'=> false, 'message'=> 'data is not find out']);		
				}

	}


	public function social_login(Request $request)
	{
		$exist=User::where('EmailID',$request->EmailID)->first();

		if($exist != '')
		{
			if($exist->FacebookId != '' && $exist->GmailId)
			{
				return response()->json(['code'=>202,'status'=> false,'data'=>$exist ,'message'=> 'Email id already exist with both social login']);
			}
			else if(($exist->FacebookId != '') && ($request->AuthType=='facebook'))
			{
				return response()->json(['code'=>202,'status'=> false,'data'=>$exist,'message'=> 'Email id already exist with facebook']);
			}
			elseif(($exist->GmailId != '') && ($request->AuthType=='gmail'))
			{
				return response()->json(['code'=>202,'status'=> false,'data'=>$exist,'message'=> 'Email id already exist with gmail']);
			}
			elseif(($exist->FacebookId != '') && ($exist->GmailId == '') && ($request->AuthType=='gmail'))
			{

				$update=User::find($exist->UserID);
				$update->firstname=$request->Name;
				$update->GmailId=$request->AuthID;
				$updated=$update->save();
				if($updated != '')
				{
					return response()->json(['code'=>200,'status'=> true,'data'=>$update,'message'=>'Successfully Login']);
				}
				else
				{
					return response()->json(['code'=>500,'status'=> true,'data'=>$update,'message'=>'Something Went wrong, try again later']);
				}

			}
			elseif(($exist->GmailId != '') && ($exist->FacebookId == '') && ($request->AuthType=='facebook'))
			{

				$update=User::find($exist->UserID);
				$update->firstname=$request->Name;
				$update->FacebookId=$request->AuthID;
				$updated=$update->save();
				if($updated != '')
				{
					return response()->json(['code'=>200,'status'=> true,'data'=>$update,'message'=>'Successfully Login']);
				}
				else
				{
					return response()->json(['code'=>500,'status'=> true,'data'=>$update,'message'=>'Something Went wrong, try again later']);
				}

			}
			else
			{
				$insert=new User();
				$insert->firstname=$request->Name;
				$insert->EmailID=$request->EmailID;
				if($request->AuthType == 'facebook')
				{
					$insert->FacebookId=$request->AuthID;
				}
				else
				{
					$insert->GmailId=$request->AuthID;	
				}
				$inserted=$insert->save();
				if($inserted != '')
				{
					return response()->json(['code'=>200,'status'=> true,'data'=>$insert,'message'=>'Successfully Login']);
				}
				else
				{
					return response()->json(['code'=>500,'status'=> true,'data'=>$insert,'message'=>'Something Went wrong, try again later']);
				}

			}

		}

		else
		{


				$insert=new User();
				$insert->firstname=$request->Name;
				$insert->EmailID=$request->EmailID;
				if($request->AuthType == 'facebook')
				{
					$insert->FacebookId=$request->AuthID;
				}
				else
				{
					$insert->GmailId=$request->AuthID;	
				}
				$inserted=$insert->save();
				if($inserted != '')
				{
					return response()->json(['code'=>200,'status'=> true,'data'=>$insert,'message'=>'Successfully Login']);
				}
				else
				{
					return response()->json(['code'=>500,'status'=> true,'data'=>$insert,'message'=>'Something Went wrong, try again later']);
				}

		}
	}


	

}