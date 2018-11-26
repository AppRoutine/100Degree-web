<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Major;

use App\Community;

use App\Event;

use App\University;

use App\Sport;

use App\Tutor;

use Auth;

use Illuminate\Support\Facades\Input;

use View;

use Redirect;

use Hash;

use Mail;

use Session;

use URL;

use App\Admin;

use App\Finder;

use Carbon\Carbon;

use PDF;

class UserController extends Controller

{
	public function majors(Request $request)
	{
		$majors=Major::all();
		return view::make('majors',compact('majors'));
	}
		public function community(Request $request)
	{
		$community=Community::all();
		return view::make('community',compact('community'));
	}

	public function events(Request $request)
	{
		$events=Event::all();
		return view::make('events',compact('events'));
	}

		public function universities(Request $request)
	{
		$universities=University::all();
		return view::make('universities',compact('universities'));
	}
	public function sports(Request $request)
	{
		$sports=Sport::all();
		return view::make('sports',compact('sports'));
	}
	public function tutors(Request $request)
	{
		$tutors=Tutor::all();
		return view::make('tutor',compact('tutors'));
	}

	public function add_tutor(Request $request)
	{
		$data=Major::all();
		return view::make('add_tutor',compact('data'));
	}

	public function edit_tutor(Request $request)
	{
		$data=Tutor::find($request->id);
		$majors=Major::all();
		return view::make('edit_tutor',compact('data','majors'));
	}

	public function update_tutor(Request $request)
	{

		$update=Tutor::find($request->id);
		$update->TutorName=$request->TutorName;
		$update->EmailID=$request->EmailID;
		$update->PhoneNo=$request->PhoneNo;
		$update->Major=$request->Major;
		$update->Address=$request->Address;
		$update->Description=$request->Description;

		if($request->ProfilePicPath != '')
		{
				$rand=rand(1,1000000);
                // Set the destination path
                $destinationPath = public_path().'/images';
                // Get the orginal filname or create the filename of your choice
                $filename = str_replace(' ', '_', $request->OrganizerImg->getClientOriginalName());
                $filename = $rand.''.$filename;
                $request->ProfilePicPath->move($destinationPath, $filename);

		}
		else
		{
			$filename=$request->oldProfilePicPath;
		}

		$update->ProfilePicPath=$filename;
		
		$updated=$update->save();
		if($updated)
		{
			return redirect('tutors')->with('success','Tutor edited successfully');
			
		}
		else
		{
			return redirect('tutors')->with('error','Something went wrong, try again later');
		}



	}

	public function submit_tutor(Request $request)
	{
		$insert=new Tutor($request->all());
		if($request->ProfilePicPath != '')
		{
				$rand=rand(1,1000000);
                // Set the destination path
                $destinationPath = public_path().'/images';
                // Get the orginal filname or create the filename of your choice
                $filename = str_replace(' ', '_', $request->ProfilePicPath->getClientOriginalName());
                $filename = $rand.''.$filename;
                $request->ProfilePicPath->move($destinationPath, $filename);

		}
		else
		{
			$filename='';
		}

		$insert->ProfilePicPath=$filename;
		$inserted=$insert->save();

		if($inserted)
		{
			return redirect('tutors')->with('success','Tutor added successfully');
			
		}
		else
		{
			return redirect('tutors')->with('error','Something went wrong, try again later');
		}

	}

	public function delete_tutor(Request $request)
	{

		$delete=Tutor::where('id',$request->id)->delete();
		if($delete)
		{
			return redirect('tutors')->with('success','Delete the tutor successfully');
			
		}
		else
		{
			return redirect('tutors')->with('error','Something went wrong, try again later');
		}
	}


	public function delete_event(Request $request)
	{

		$delete=Event::where('id',$request->id)->delete();
		if($delete)
		{
			return redirect('events')->with('success','Delete the event successfully');
			
		}
		else
		{
			return redirect('events')->with('error','Something went wrong, try again later');
		}
	}

		public function edit_event(Request $request)
	{

		$event=Event::where('id',$request->id)->first();
		if($event)
		{
			return view::make('edit_event',compact('event'));
			
		}
		else
		{
			return redirect('events')->with('error','Something went wrong, try again later');
		}
	}

	public function update_event(Request $request)
	{

		$update=Event::find($request->id);
		$update->EventName=$request->EventName;
		$update->StartDate=$request->StartDate;
		$update->StartTime=$request->StartTime;
		$update->EndTime=$request->EndTime;
		$update->Venu=$request->Venu;
		$update->AboutEvent=$request->AboutEvent;
		$update->BuyTicketURL=$request->BuyTicketURL;
		$update->Organizer=$request->Organizer;

		if($request->OrganizerImg != '')
		{
				$rand=rand(1,1000000);
                // Set the destination path
                $destinationPath = public_path().'/images';
                // Get the orginal filname or create the filename of your choice
                $filename = str_replace(' ', '_', $request->OrganizerImg->getClientOriginalName());
                $filename = $rand.''.$filename;
                $request->OrganizerImg->move($destinationPath, $filename);

		}
		else
		{
			$filename=$request->oldOrganizerImg;
		}

		$update->OrganizerImg=$filename;

		if($request->BannerImg != '')
		{

				$rand=rand(1,1000000);
                // Set the destination path
                $destinationPath = public_path().'/images';
                // Get the orginal filname or create the filename of your choice
                $filename1 = str_replace(' ', '_', $request->BannerImg->getClientOriginalName());
                $filename1 = $rand.''.$filename1;
                $request->BannerImg->move($destinationPath, $filename1);

		}
		else
		{
			$filename1=$request->oldBannerImg;

		}

		$update->BannerImg=$filename1;
		$updated=$update->save();
		if($updated)
		{
			return redirect('events')->with('success','Event edited successfully');
			
		}
		else
		{
			return redirect('events')->with('error','Something went wrong, try again later');
		}



	}



	public function add_event(Request $request)
	{
		return view::make('add_event');
	}


	public function submit_event(Request $request)
	{
		$insert=new Event($request->all());

		if($request->OrganizerImg != '')
		{
				$rand=rand(1,1000000);
                // Set the destination path
                $destinationPath = public_path().'/images';
                // Get the orginal filname or create the filename of your choice
                $filename = str_replace(' ', '_', $request->OrganizerImg->getClientOriginalName());
                $filename = $rand.''.$filename;
                $request->OrganizerImg->move($destinationPath, $filename);

		}
		else
		{
			$filename='';
		}

		$insert->OrganizerImg=$filename;

		if($request->BannerImg != '')
		{

				$rand=rand(1,1000000);
                // Set the destination path
                $destinationPath = public_path().'/images';
                // Get the orginal filname or create the filename of your choice
                $filename1 = str_replace(' ', '_', $request->BannerImg->getClientOriginalName());
                $filename1 = $rand.''.$filename1;
                $request->BannerImg->move($destinationPath, $filename1);

		}
		else
		{
			$filename1='';

		}

		$insert->BannerImg=$filename1;
		$inserted=$insert->save();

		if($inserted)
		{
			return redirect('events')->with('success','Event added successfully');
			
		}
		else
		{
			return redirect('events')->with('error','Something went wrong, try again later');
		}

	}

	public function submit_major(Request $request)
	{
		$insert=new Major($request->all());
		$inserted=$insert->save();
		if($inserted)
		{
			return redirect('majors')->with('success','Major added successfully');
			
		}
		else
		{
			return redirect('majors')->with('error','Something went wrong, try again later');
		}

	}

		public function update_major(Request $request)
	{
		$update=Major::find($request->id);
		$update->Major=$request->Major;
		$updated=$update->save();
		if($updated)
		{
			return redirect('majors')->with('success','Major edited successfully');
			
		}
		else
		{
			return redirect('majors')->with('error','Something went wrong, try again later');
		}

	}

	public function delete_major(Request $request)
	{
		$delete=Major::where('id',$request->id)->delete();
		if($delete)
		{
			return redirect('majors')->with('success','Major deleted successfully');
			
		}
		else
		{
			return redirect('majors')->with('error','Something went wrong, try again later');
		}

	}


	public function submit_universities(Request $request)
	{
		$insert=new University($request->all());
		$inserted=$insert->save();
		if($inserted)
		{
			return redirect('universities')->with('success','University added successfully');
			
		}
		else
		{
			return redirect('universities')->with('error','Something went wrong, try again later');
		}

	}

		public function update_universities(Request $request)
	{
		$update=University::find($request->id);
		$update->University=$request->University;
		$updated=$update->save();
		if($updated)
		{
			return redirect('universities')->with('success','University edited successfully');
			
		}
		else
		{
			return redirect('universities')->with('error','Something went wrong, try again later');
		}

	}

	public function delete_universities(Request $request)
	{
		$delete=University::where('id',$request->id)->delete();
		if($delete)
		{
			return redirect('universities')->with('success','University deleted successfully');
			
		}
		else
		{
			return redirect('universities')->with('error','Something went wrong, try again later');
		}

	}

	public function add_sport(Request $request)
	{
		return view::make('add_sport');
	}

	public function edit_sport(Request $request)
	{
		$data=Sport::find($request->id);
		return view::make('edit_sport',compact('data'));
	}


	public function delete_sport(Request $request)
	{
		$delete=Sport::where('id',$request->id)->delete();
		if($delete)
		{
			return redirect('sports')->with('success','Sport deleted successfully');
			
		}
		else
		{
			return redirect('sports')->with('error','Something went wrong, try again later');
		}

	}


	public function update_sport(Request $request)
	{

		$update=Sport::find($request->id);
		$update->SportName=$request->SportName;
		$update->SportType=$request->SportType;
		$update->StartDate=$request->StartDate;
		$update->StartTime=$request->StartTime;
		$update->EndTime=$request->EndTime;
		$update->Address=$request->Address;
		$update->Description=$request->Description;

		if($request->BannerImg != '')
		{

				$rand=rand(1,1000000);
                // Set the destination path
                $destinationPath = public_path().'/images';
                // Get the orginal filname or create the filename of your choice
                $filename1 = str_replace(' ', '_', $request->BannerImg->getClientOriginalName());
                $filename1 = $rand.''.$filename1;
                $request->BannerImg->move($destinationPath, $filename1);

		}
		else
		{
			$filename1=$request->oldBannerImg;

		}

		$i=0;

		foreach($request->Team as $Teams)
		{
			$TeamsList[$i]['Team']=$Teams;

			if(!empty($request->Logo))
			{
				foreach($request->Logo as $key => $logos)
				{
						if($key == $i)
						{
							$rand=rand(1,1000000);
				            // Set the destination path
				            $destinationPath = public_path().'/images';
				            // Get the orginal filname or create the filename of your choice
				            $filename2 = str_replace(' ', '_', $logos->getClientOriginalName());
				            $filename2 = $rand.''.$filename2;
				            $logos->move($destinationPath, $filename2);
				        }
				        else
				        {

				        	foreach($request->oldLogo as $oldkey => $olds)
				        	{
				        		if($oldkey == $i )
				        		{
				        			$filename2=$olds;
				        		}
				        	}

				        }

					$TeamsList[$i]['Logo']=$filename2;
				}
			}
			else
			{
				foreach($request->oldLogo as $oldkey => $olds)
				{
					if($oldkey == $i )
				    	{
				        	$TeamsList[$i]['Logo']=$olds;
				        }
				}

			}

			$i++;
		}


		$teamslist=json_encode($TeamsList);
		$update->TeamsList=$teamslist;
		$update->BannerImg=$filename1;
		$updated=$update->save();
		if($updated)
		{
			return redirect('sports')->with('success','Sport edited successfully');
			
		}
		else
		{
			return redirect('sports')->with('error','Something went wrong, try again later');
		}
	}

	public function submit_sport(Request $request)
	{
		$insert=new Sport($request->all());
		if($request->BannerImg != '')
		{

				$rand=rand(1,1000000);
                // Set the destination path
                $destinationPath = public_path().'/images';
                // Get the orginal filname or create the filename of your choice
                $filename1 = str_replace(' ', '_', $request->BannerImg->getClientOriginalName());
                $filename1 = $rand.''.$filename1;
                $request->BannerImg->move($destinationPath, $filename1);

		}
		else
		{
			$filename1=$request->oldBannerImg;

		}

		$i=0;

		foreach($request->Team as $Teams)
		{
			$TeamsList[$i]['Team']=$Teams;
			$i++;
		}
		$k=0;

		foreach($request->Logo as $logos)
		{

			if($logos != '')
			{
					$rand=rand(1,1000000);
		            // Set the destination path
		            $destinationPath = public_path().'/images';
		            // Get the orginal filname or create the filename of your choice
		            $filename1 = str_replace(' ', '_', $logos->getClientOriginalName());
		            $filename1 = $rand.''.$filename1;
		            $logos->move($destinationPath, $filename1);

			}
			else
			{
				$filename1='';

			}

			$TeamsList[$k]['Logo']=$filename1;
			$k++;
		}


		$teamslist=json_encode($TeamsList);
		$insert->TeamsList=$teamslist;
		$insert->BannerImg=$filename1;

		$inserted=$insert->save();
		if($inserted)
		{
			return redirect('sports')->with('success','Sport edited successfully');
			
		}
		else
		{
			return redirect('sports')->with('error','Something went wrong, try again later');
		}


	}

	public function add_community(Request $request)
	{
		return view::make('add_community');
	}

	public function edit_community(Request $request)
	{
		$data=Community::find($request->id);
		return view::make('edit_community',compact('data'));
	}


	public function delete_community(Request $request)
	{
		$delete=Community::where('id',$request->id)->delete();
		if($delete)
		{
			return redirect('community')->with('success','Community deleted successfully');
			
		}
		else
		{
			return redirect('community')->with('error','Something went wrong, try again later');
		}

	}


	public function update_community(Request $request)
	{

		$update=Community::find($request->id);
		$update->ServiceTitle=$request->ServiceTitle;
		$update->StartDate=$request->StartDate;
		$update->StartTime=$request->StartTime;
		$update->EndTime=$request->EndTime;
		$update->State=$request->State;
		$update->City=$request->City;
		$update->Venue=$request->Venue;
		$update->Organizer=$request->Organizer;
		$update->AboutService=$request->AboutService;
	
		if($request->BannerImg != '')
		{

				$rand=rand(1,1000000);
                // Set the destination path
                $destinationPath = public_path().'/images';
                // Get the orginal filname or create the filename of your choice
                $filename1 = str_replace(' ', '_', $request->BannerImg->getClientOriginalName());
                $filename1 = $rand.''.$filename1;
                $request->BannerImg->move($destinationPath, $filename1);

		}
		else
		{
			$filename1=$request->oldBannerImg;

		}
		if($request->OrganizerImg != '')
		{

				$rand=rand(1,1000000);
                // Set the destination path
                $destinationPath = public_path().'/images';
                // Get the orginal filname or create the filename of your choice
                $filename = str_replace(' ', '_', $request->OrganizerImg->getClientOriginalName());
                $filename = $rand.''.$filename;
                $request->OrganizerImg->move($destinationPath, $filename);

		}
		else
		{
			$filename=$request->oldOrganizerImg;

		}

		$update->BannerPic=$filename1;
		$update->OrganizerImg=$filename;
		$updated=$update->save();
		if($updated)
		{
			return redirect('community')->with('success','Community edited successfully');
			
		}
		else
		{
			return redirect('community')->with('error','Something went wrong, try again later');
		}
	}

	public function submit_community(Request $request)
	{
		
		$update=new Community($request->all());
		
		if($request->BannerImg != '')
		{

				$rand=rand(1,1000000);
                // Set the destination path
                $destinationPath = public_path().'/images';
                // Get the orginal filname or create the filename of your choice
                $filename1 = str_replace(' ', '_', $request->BannerImg->getClientOriginalName());
                $filename1 = $rand.''.$filename1;
                $request->BannerImg->move($destinationPath, $filename1);

		}
		else
		{
			$filename1=$request->oldBannerImg;

		}
		if($request->OrganizerImg != '')
		{

				$rand=rand(1,1000000);
                // Set the destination path
                $destinationPath = public_path().'/images';
                // Get the orginal filname or create the filename of your choice
                $filename = str_replace(' ', '_', $request->OrganizerImg->getClientOriginalName());
                $filename = $rand.''.$filename;
                $request->OrganizerImg->move($destinationPath, $filename);

		}
		else
		{
			$filename=$request->oldOrganizerImg;

		}

		$update->BannerPic=$filename1;
		$update->OrganizerImg=$filename;
		$updated=$update->save();
		if($updated)
		{
			return redirect('community')->with('success','Community edited successfully');
			
		}
		else
		{
			return redirect('community')->with('error','Something went wrong, try again later');
		}
	}

}