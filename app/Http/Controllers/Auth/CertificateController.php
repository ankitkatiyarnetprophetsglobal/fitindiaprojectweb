<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Role;
use App\Models\CertQues;
use App\Models\Userkey;
use App\Models\User;
use App\Models\CertStatus;
use App\Models\CertRequest;
use App\Models\Ambassador;
use App\Models\Champion;
use App\Models\YouthStatus;
use App\Models\YouthCertRequest;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\LocalBody;

class CertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function flagstore(Request $request)
    {
        $flagdata = CertRequest::where('user_id', $request->user_id)->where('cat_id', 1621)->first();
        $rules = [
            'num_teachers' => 'required|numeric|min:1|max:100',
            'teacher_cert_doc' => (
                empty($flagdata) || empty($flagdata->teacher_cert_doc)
            ) ? 'required|mimes:pdf,doc,docx|max:20480' : 'nullable|mimes:pdf,doc,docx|max:20480',

            'outdoor_sports' => 'required|array|min:2',
            'outdoor_sports.*' => 'required|string',

            'indoor_sports' => 'required|array|min:2',
            'indoor_sports.*' => 'required|string',
            'town_planning_doc' => (
                empty($flagdata) || empty($flagdata->town_planning_doc)
            ) ? 'required|mimes:pdf,doc,docx|max:20480' : 'nullable|mimes:pdf,doc,docx|max:20480',

            'num_students' => 'required|numeric|min:1|max:10000',
            'students_active_30min' => 'required|numeric|min:1|max:10000',

            'activity_timetable_doc' => (
                empty($flagdata) || empty($flagdata->activity_timetable_doc)
            ) ? 'required|mimes:pdf,doc,docx|max:20480' : 'nullable|mimes:pdf,doc,docx|max:20480',

            'sports_facility_images' => (
                empty($flagdata) || empty($flagdata->sports_facility_images)
            ) ? 'required|array|min:4|max:5' : 'nullable|array|min:1|max:5',

            'sports_facility_images.*' => (
                empty($flagdata) || empty($flagdata->sports_facility_images)
            ) ? 'required|image|mimes:jpeg,jpg,png|max:20480' : 'nullable|image|mimes:jpeg,jpg,png|max:20480',

            'fit_india_participation' => 'required|accepted', // Checkbox must be checked
        ];


        $messages = [
            'num_teachers.required' => 'Number of PE teachers is required.',
            'teacher_cert_doc.required' => 'Teacher certification document is required.',
            'teacher_cert_doc.mimes' => 'Upload a valid PDF/Word document.',
            'teacher_cert_doc.max' => 'Maximum file size is 20MB.',

            'outdoor_sports.required' => 'At least two outdoor sports must be selected.',
            'outdoor_sports.min' => 'Select at least two outdoor sports.',
            'outdoor_sports.*.required' => 'Invalid outdoor sport selection.',

            'indoor_sports.required' => 'At least two indoor sports must be selected.',
            'indoor_sports.min' => 'Select at least two indoor sports.',
            'indoor_sports.*.required' => 'Invalid indoor sport selection.',

            'town_planning_doc.required' => 'Town planning document is required.',
            'town_planning_doc.mimes' => 'Upload a valid PDF/Word document.',
            'town_planning_doc.max' => 'Maximum file size is 20MB.',

            'num_students.required' => 'Total number of students is required.',
            'students_active_30min.required' => 'Please enter how many students do 30+ min of activity.',
            'students_active_30min.numeric' => 'Must be a valid number.',

            'activity_timetable_doc.required' => 'Timetable/proof of physical activity is required.',
            'activity_timetable_doc.mimes' => 'Upload a valid PDF/Word document.',
            'activity_timetable_doc.max' => 'Maximum file size is 20MB.',

            'sports_facility_images.required' => 'Upload sports facility photos.',
            'sports_facility_images.array' => 'Upload multiple images.',
            'sports_facility_images.min' => 'Upload at least one image.',
            'sports_facility_images.max' => 'Upload no more than 5 images.',
            'sports_facility_images.*.required' => 'Each photo is required.',
            'sports_facility_images.*.image' => 'Images must be in jpeg/jpg/png format.',
            'sports_facility_images.*.mimes' => 'Upload images in jpeg, jpg, or png format.',
            'sports_facility_images.*.max' => 'Each image must be under 20MB.',

            'fit_india_participation.required' => 'Please confirm Fit India participation.',
            'fit_india_participation.accepted' => 'Please tick the checkbox to confirm participation.',
        ];
        $request->validate($rules, $messages);
        // ⏬ Proceed with original existing logic (unchanged) ⏬
        $flag = 0;
        $cflag = 0;
        $csts = CertStatus::where('user_id', $request->user_id)->first();
        if (!empty($csts)) {
            $flag = 1;
        } else {
            $flag = 0;
        }
        if ($flag == 1) {
            $crsts = CertRequest::where('user_id', $request->user_id)->first();
            $cflag = !empty($crsts) ? 1 : 0;
        }
        if ($flag == 1 && $cflag == 0) {
            try {
                CertStatus::where('user_id', $request->user_id)->delete();
                return back()->with('error', 'Please try again.');
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        } else if (($flag == 0) || ($flag == 1 && $cflag == 1)) {
            try {
                $certstatus = new CertStatus();
                $certstatus->user_id = $request->user_id;
                $certstatus->cat_id = $request->ratingreqid;
                $certstatus->cur_status = 'awarded';
                $certstatus->status = 'awarded';
                $certstatus->created = now();
                $certstatus->updated = now();

                if ($certstatus->save()) {
                    // Save images
                    $image_urls = [];
                    if ($request->hasFile('sports_facility_images')) {
                        $year = date("Y/m") . 'SCIMG1STAR';
                        foreach ($request->file('sports_facility_images') as $file) {
                            $path = $file->store($year, ['disk' => 'uploads']);
                            $image_urls[] = url('wp-content/uploads/' . $path);
                        }
                    }
                    $year1 = date("Y/m") . 'SCDOCS1STAR';

                    // Save request
                    $certreq = new CertRequest();
                    $certreq->user_id = $request->user_id;
                    $certreq->cat_id = $request->ratingreqid;
                    $certreq->peteacherno = $request->num_teachers;
                    $certreq->teacher_cert_doc = $request->file('teacher_cert_doc')->store($year1, ['disk' => 'uploads']);
                    $certreq->outdoorsports = serialize($request->outdoor_sports);
                    $certreq->indoorsports = serialize($request->indoor_sports);
                    $certreq->town_planning_doc = $request->file('town_planning_doc')->store($year1, ['disk' => 'uploads']);
                    $certreq->noofstudents = $request->num_students;
                    $certreq->students_active_30min = $request->students_active_30min;
                    $certreq->activity_timetable_doc = $request->file('activity_timetable_doc')->store($year1, ['disk' => 'uploads']);
                    $certreq->sports_facility_images = serialize($image_urls);
                    $certreq->fit_india_participation = $request->has('fit_india_participation') ? 1 : 0;
                    $certreq->created = now();

                    if ($certreq->save()) {
                        $userkey = new Userkey();
                        $userkey->user_id = $request->user_id;
                        $userkey->key = 'ratingreqid';
                        $userkey->value = $request->ratingreqid;
                        $userkey->save();

                        return back()->with('success', 'Your request has been submitted successfully.');
                    } else {
                        return back()->with('error', 'Your request could not be submitted.');
                    }
                } else {
                    return back()->with('error', 'Request not added successfully');
                }
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }
    }

    public function threestar(Request $request)
    {
        $threedata = CertRequest::where('user_id', $request->user_id)->where('cat_id', 1622)->first();

        $rules = [
            // Section 01: Active Participation in Daily Physical Activity
            'no_of_schools'        => 'required|numeric|min:1',
            'grade1_5_students'    => 'required|numeric|min:0',
            'grade6_12_students'   => 'required|numeric|min:0',
            'timetable_doc' => (
                empty($threedata) || empty($threedata->timetable_doc)
            ) ? 'required|mimes:pdf,doc,docx|max:20480' : 'nullable|mimes:pdf,doc,docx|max:20480',

            // Section 02: Designated PE Teacher
            'peteacherno'          => 'required|numeric|min:1',
            'teacher_certification' => (
                empty($threedata) || empty($threedata->teacher_certification)
            ) ? 'required|mimes:pdf,doc,docx|max:20480' : 'nullable|mimes:pdf,doc,docx|max:20480',

            // Section 04: Playground & Sports
            'outdoor_sports'       => 'required|array|min:2',
            'outdoor_sports.*'     => 'required|string',
            'indoor_sports'        => 'required|array|min:2',
            'indoor_sports.*'      => 'required|string',
            'town_country_plan_doc' => (
                empty($threedata) || empty($threedata->town_country_plan_doc)
            ) ? 'required|mimes:pdf,doc,docx|max:20480' : 'nullable|mimes:pdf,doc,docx|max:20480',

            'geo_tagged_images' => (
                empty($threedata) || empty($threedata->geo_tagged_images)
            ) ? 'required|array|min:4|max:5' : 'nullable|array|min:0|max:5',

            'geo_tagged_images.*' => (
                empty($threedata) || empty($threedata->geo_tagged_images)
            ) ? 'required|image|mimes:jpeg,jpg,png|max:20480' : 'nullable|image|mimes:jpeg,jpg,png|max:20480',
        ];

        $messages = [
            // Section 01
            'no_of_schools.required'        => 'Please enter total number of students in school.',
            'no_of_schools.numeric'         => 'Total students must be a number.',
            'grade1_5_students.required'    => 'Please enter number of students in Grade 1-5.',
            'grade6_12_students.required'   => 'Please enter number of students in Grade 6-12.',
            'timetable_doc.required'        => 'Timetable or physical activity proof is required.',
            'timetable_doc.mimes'           => 'Timetable file must be a PDF, DOC, or DOCX.',
            'timetable_doc.max'             => 'Timetable file must be less than 20MB.',

            // Section 02
            'peteacherno.required'          => 'Please enter number of PE teachers.',
            'peteacherno.numeric'           => 'PE teacher count must be a number.',
            'teacher_certification.required' => 'Teacher certification document is required.',
            'teacher_certification.mimes'   => 'Certification file must be PDF, DOC, or DOCX.',
            'teacher_certification.max'     => 'Certification file must be under 20MB.',

            // Section 04
            'outdoor_sports.required'       => 'Please select at least 2 outdoor sports.',
            'outdoor_sports.min'            => 'At least 2 outdoor sports are required.',
            'outdoor_sports.*.required'     => 'Each outdoor sport is required.',
            'indoor_sports.required'        => 'Please select at least 2 indoor sports.',
            'indoor_sports.min'             => 'At least 2 indoor sports are required.',
            'indoor_sports.*.required'      => 'Each indoor sport is required.',
            'town_country_plan_doc.required' => 'Town and country planning document is required.',
            'town_country_plan_doc.mimes'   => 'Plan must be a PDF, DOC, or DOCX.',
            'town_country_plan_doc.max'     => 'File must be less than 20MB.',

            // Section 05
            'geo_tagged_images.required'    => 'Please upload 4-5 geo-tagged pictures.',
            'geo_tagged_images.min'         => 'Minimum 4 pictures are required.',
            'geo_tagged_images.max'         => 'Maximum 5 pictures allowed.',
            'geo_tagged_images.*.mimes'     => 'Each image must be a JPEG, JPG, or PNG.',
            'geo_tagged_images.*.max'       => 'Each image must be less than 20MB.',
        ];


        $request->validate($rules, $messages);

        $chkerro = false;
        $validator = Validator::make([], []);

        if ($chkerro) {
            throw new ValidationException($validator);
        }

        try {
            // Using updateOrCreate for CertStatus to update if the record exists, otherwise create new
            $certstatus = CertStatus::updateOrCreate(
                ['user_id' => $request->user_id, 'cat_id' => $request->ratingreqid],
                [
                    'cur_status' => 'awarded',
                    'status' => 'downloadcerficate',
                    'created' => date('Y-m-d H:i:s'),
                    'updated' => date('Y-m-d H:i:s')
                ]
            );

            // Check if CertStatus was saved successfully
            if ($certstatus) {
                try {
                    // Initialize the image URLs array
                    $image_urls = [];

                    if ($request->hasFile('geo_tagged_images')) {
                        $year = date("Y/m") . "SC3STAR";

                        foreach ($request->file('geo_tagged_images') as $file) {
                            $path = $file->store($year, ['disk' => 'uploads']);
                            $image_urls[] = url('wp-content/uploads/' . $path);
                        }
                    } elseif (!empty($threedata) && !empty($threedata->geo_tagged_images)) {
                        $image_urls = @unserialize($threedata->geo_tagged_images) ?: [];
                    }

                    $year1 = date("Y/m") . 'SCDOCS3STAR';
                    /* Files and images upload logic */
                    $timetable_doc = $request->hasFile('timetable_doc') ? $request->file('timetable_doc')->store($year1, ['disk' => 'uploads']) : ($threedata->timetable_doc ?? null);
                    $teacher_certification = $request->hasFile('teacher_certification') ? $request->file('teacher_certification')->store($year1, ['disk' => 'uploads']) : ($threedata->teacher_certification ?? null);
                    $town_country_plan_doc = $request->hasFile('town_country_plan_doc') ? $request->file('town_country_plan_doc')->store($year1, ['disk' => 'uploads']) : ($threedata->town_country_plan_doc ?? null);



                    // Using updateOrCreate for CertRequest to handle the same update/create behavior
                    $certreq = CertRequest::updateOrCreate(
                        ['user_id' => $request->user_id, 'cat_id' => $request->ratingreqid],
                        [
                            'totnoteachers' => $request->totnoteachers,
                            'no_of_schools' => $request->no_of_schools,
                            'grade1_5_students' => $request->grade1_5_students,
                            'grade6_12_students' => $request->grade6_12_students,
                            'peteacherno' => $request->peteacherno,
                            'outdoorsports' => serialize($request->outdoor_sports),
                            'indoorsports' => serialize($request->indoor_sports),
                            'timetable_doc' => $timetable_doc,
                            'teacher_certification' => $teacher_certification,
                            'town_country_plan_doc' => $town_country_plan_doc,
                            'geo_tagged_images' => serialize($image_urls),

                            'created' => date('Y-m-d H:i:s'),
                            'updated' => date('Y-m-d H:i:s')
                        ]
                    );
                    // Update or create in Userkey table as well
                    Userkey::updateOrCreate(
                        ['user_id' => $request->user_id, 'key' => 'ratingreqid'],
                        ['value' => $request->ratingreqid]
                    );

                    if ($certreq) {
                        Userkey::updateOrCreate(
                            ['user_id' => $request->user_id, 'key' => 'ratingreqid'],
                            ['value' => $request->ratingreqid]
                        );
                        return back()->with('success', 'Congratulations, you have been awarded 3-STAR certification.');
                    } else {
                        return back()->with('error', 'Request not added successsfully');
                    }
                } catch (\Exception $e) {
                    // Return with error message if any exception occurs during CertRequest processing
                    return back()->with('error', 'Error in processing your request: ' . $e->getMessage());
                }
            } else {
                // Return with error message if CertStatus failed to save
                return back()->with('error', 'Request not added successfully.');
            }
        } catch (\Exception $e) {
            // Return with error message if any exception occurs during CertStatus processing
            return back()->with('error', 'Error in processing CertStatus: ' . $e->getMessage());
        }
    }

    public function fivestar(Request $request)
    {
        $fivedata = CertRequest::where('user_id', $request->user_id)->where('cat_id', 1623)->first();
        $rules = [
            // Section 01: Active Participation in Daily Physical Activity
            'num_students_5start'        => 'required|numeric|min:1',
            'no_of_schools_5start'        => 'required|numeric|min:1',
            'grade1_5_students_5start'    => 'required|numeric|min:0',
            'grade6_12_students_5start'   => 'required|numeric|min:0',
            // Conditionally require timetable_doc
            'timetable_doc_5start' => (
                empty($fivedata) || empty($fivedata->timetable_doc)
            ) ? 'required|mimes:pdf,doc,docx|max:20480' : 'nullable|mimes:pdf,doc,docx|max:20480',


            // Section 04: Playground & Sports
            'outdoor_sports_5start'       => 'required|array|min:2',
            'outdoor_sports_5start.*'     => 'required|string',
            'indoor_sports_5start'        => 'required|array|min:2',
            'indoor_sports_5start.*'      => 'required|string',
            // 'town_country_plan_doc_5start' => 'required|mimes:pdf,doc,docx|max:20480',
            'town_country_plan_doc_5start' => (
                empty($fivedata) || empty($fivedata->town_country_plan_doc)
            ) ? 'required|mimes:pdf,doc,docx|max:20480' : 'nullable|mimes:pdf,doc,docx|max:20480',
            'no_of_schools_5start'        => 'required|numeric|min:1',
            'geo_tagged_images_5start' => (
                empty($fivedata) || empty($fivedata->geo_tagged_images)
            ) ? 'required|array|min:4|max:5' : 'nullable|array|min:0|max:5',

            'geo_tagged_images_5start.*' => (
                empty($fivedata) || empty($fivedata->geo_tagged_images)
            ) ? 'required|image|mimes:jpeg,jpg,png|max:20480' : 'nullable|image|mimes:jpeg,jpg,png|max:20480',
            'school_initiative' => 'required|accepted',
            'fit_india_participation_5start' => 'required|accepted',
        ];

        $messages = [
            // Section 01
            'num_students_5start.required'        => 'Please enter total number of students in school.',
            'no_of_schools_5start.numeric'         => 'Please enter total number of school in school.',
            'grade1_5_students_5start.required'    => 'Please enter number of students in Grade 1-5.',
            'grade6_12_students_5start.required'   => 'Please enter number of students in Grade 6-12.',
            'timetable_doc_5start.required'        => 'Timetable or physical activity proof is required.',
            'timetable_doc_5start.mimes'           => 'Timetable file must be a PDF, DOC, or DOCX.',
            'timetable_doc_5start.max'             => 'Timetable file must be less than 20MB.',
            // Section 04
            'outdoor_sports_5start.required'       => 'Please select at least 2 outdoor sports.',
            'outdoor_sports_5start.min'            => 'At least 2 outdoor sports are required.',
            'outdoor_sports_5start.*.required'     => 'Each outdoor sport is required.',
            'indoor_sports_5start.required'        => 'Please select at least 2 indoor sports.',
            'indoor_sports_5start.min'             => 'At least 2 indoor sports are required.',
            'indoor_sports_5start.*.required'      => 'Each indoor sport is required.',
            'town_country_plan_doc_5start.required' => 'Town and country planning document is required.',
            'town_country_plan_doc_5start.mimes'   => 'Plan must be a PDF, DOC, or DOCX.',
            'town_country_plan_doc_5start.max'     => 'File must be less than 20MB.',

            // Section 05
            'geo_tagged_images_5start.required'    => 'Please upload 4-5 geo-tagged pictures.',
            'geo_tagged_images_5start.min'         => 'Minimum 4 pictures are required.',
            'geo_tagged_images_5start.max'         => 'Maximum 5 pictures allowed.',
            'geo_tagged_images_5start.*.mimes'     => 'Each image must be a JPEG, JPG, or PNG.',
            'geo_tagged_images_5start.*.max'       => 'Each image must be less than 20MB.',
            'school_initiative.required' => 'Please confirm Fit India participation.',
            'school_initiative.accepted' => 'Please tick the checkbox to confirm participation.',
            'fit_india_participation_5start.required' => 'Please confirm Fit India participation.',
            'fit_india_participation_5start.accepted' => 'Please tick the checkbox to confirm participation.',
        ];


        $request->validate($rules, $messages);

        $chkerro = false;
        $validator = Validator::make([], []);



        if ($chkerro) {
            throw new ValidationException($validator);
        }

        try {

            $certstatus = CertStatus::updateOrCreate(
                ['user_id' => $request->user_id, 'cat_id' => $request->ratingreqid],
                [
                    'cur_status' => 'awarded',
                    'status' => 'downloadcerficate',
                    'created' => date('Y-m-d H:i:s'),
                    'updated' => date('Y-m-d H:i:s')
                ]
            );

            if ($certstatus) {
                $year = date("Y/m") . "SC5STAR";
                try {
                    $image_urls = [];
                    if ($request->hasFile('geo_tagged_images_5start')) {
                        $year = date("Y/m") . "SC5STAR";

                        foreach ($request->file('geo_tagged_images_5start') as $file) {
                            $path = $file->store($year, ['disk' => 'uploads']);
                            $image_urls[] = url('wp-content/uploads/' . $path);
                        }
                    } elseif (!empty($fivedata) && !empty($fivedata->geo_tagged_images)) {
                        $image_urls = @unserialize($fivedata->geo_tagged_images) ?: [];
                    }
          
                    $year1 = date("Y/m") . 'SCDOCS5STAR';
                      $timetable_doc = $request->hasFile('timetable_doc_5start') ? $request->file('timetable_doc_5start')->store($year1, ['disk' => 'uploads']) : ($fivedata->timetable_doc ?? null);
                      $town_country_plan_doc_5start = $request->hasFile('town_country_plan_doc_5start') ? $request->file('town_country_plan_doc_5start')->store($year1, ['disk' => 'uploads']) : ($fivedata->town_country_plan_doc ?? null);
                    $certreq = CertRequest::updateOrCreate(
                        ['user_id' => $request->user_id, 'cat_id' => $request->ratingreqid],
                        [
                            'no_of_schools'         => $request->no_of_schools_5start,
                            'noofstudents'         => $request->num_students_5start,
                            'grade1_5_students'     => $request->grade1_5_students_5start,
                            'grade6_12_students'    => $request->grade6_12_students_5start,
                            'outdoorsports' => serialize($request->outdoor_sports_5start),
                            'indoorsports' => serialize($request->indoor_sports_5start),
                            'timetable_doc' => $timetable_doc,
                            'town_country_plan_doc' => $town_country_plan_doc_5start,
                            'geo_tagged_images' => serialize($image_urls),
                            'fit_india_participation' => $request->has('fit_india_participation_5start') ? 1 : 0,
                            'school_initiative' => $request->has('school_initiative') ? 1 : 0,
                            'created' => date('Y-m-d H:i:s'),
                            'updated' => date('Y-m-d H:i:s')
                        ]
                    );

                    if ($certreq) {

                        Userkey::updateOrCreate(
                            ['user_id' => $request->user_id, 'key' => 'ratingreqid'],
                            ['value' => $request->ratingreqid]
                        );


                        return back()->with('success', 'Congratulations, you have been awarded 5-STAR certification.');
                    } else {
                        return back()->with('error', 'Request not added successsfully');
                    }
                } catch (\Exception $e) {
                    return back()->with('error', $e->getMessage());
                }
            } else {
                return back()->with('error', 'Your request not submitted successfully.');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }




    public function certification()
    {
        try {
            $id = @$_REQUEST['auth_id'];

            if (!empty($id)) {

                $udata = User::where('id', $id)->first();
            }

            if (!empty($udata)) {
                $userid = $udata->id;
                $role = $udata->role;
            } else {
                return back()->with('error', 'Unauthorized'); //exit();
            }


            if (!empty($role)) {

                $appliedfor = false;
                $currentflag = false;
                $appliedfor = Userkey::where('user_id', $userid)->where('key', 'ratingreqid')->first();

                if ($appliedfor) {
                    if ($appliedfor->value) {
                        $appliedfor = $appliedfor->value;
                        $currentflag = ($appliedfor + 1);
                    }
                } else {
                    $currentflag = 1621;
                }

                $flags = CertQues::where('cert_cats_id', 1621)->orderBy('priority', 'asc')->get();
                $threestars = CertQues::where('cert_cats_id', 1622)->orderBy('priority', 'asc')->get();
                $fivestars = CertQues::where('cert_cats_id', 1623)->orderBy('priority', 'asc')->get();

                $role = Role::where('slug', $role)->first()->name;

                if ($appliedfor) {

                    switch ($appliedfor) {
                        case 1621:
                            $flagdata = CertRequest::where('user_id', $userid)->where('cat_id', 1621)->first();
                            $flagstatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1621)->first();
                            return view('event.scert', ['userid' => $userid, 'role' => $role, 'flags' => $flags, 'threestars' => $threestars, 'fivestars' => $fivestars, 'appliedfor' => $appliedfor, 'currentflag' => $currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata]);
                            break;
                        case 1622:
                            $flagdata = CertRequest::where('user_id', $userid)->where('cat_id', 1621)->first();
                            $flagstatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1621)->first();
                            $threedata = CertRequest::where('user_id', $userid)->where('cat_id', 1622)->first();
                            $threestatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1622)->first();
                            return view('event.scert', ['userid' => $userid, 'role' => $role, 'flags' => $flags, 'threestars' => $threestars, 'fivestars' => $fivestars, 'appliedfor' => $appliedfor, 'currentflag' => $currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata, 'threedata' => $threedata, 'threestatusdata' => $threestatusdata]);
                            break;
                        case 1623:

                            $flagdata = CertRequest::where('user_id', $userid)->where('cat_id', 1621)->first();
                            $flagstatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1621)->first();
                            $threedata = CertRequest::where('user_id', $userid)->where('cat_id', 1622)->first();
                            $threestatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1622)->first();
                            $fivedata = CertRequest::where('user_id', $userid)->where('cat_id', 1623)->first();
                            $fivestatusdata = CertStatus::where('user_id', $userid)->where('cat_id', 1623)->first();

                            return view('event.scert', ['userid' => $userid, 'role' => $role, 'flags' => $flags, 'threestars' => $threestars, 'fivestars' => $fivestars, 'appliedfor' => $appliedfor, 'currentflag' => $currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata, 'threedata' => $threedata, 'threestatusdata' => $threestatusdata, 'fivedata' => $fivedata, 'fivestatusdata' => $fivestatusdata]);
                            break;
                        default:
                            return view('event.scert', ['userid' => $userid, 'role' => $role, 'flags' => $flags, 'threestars' => $threestars, 'fivestars' => $fivestars, 'appliedfor' => $appliedfor, 'currentflag' => $currentflag]);
                    }
                } else {
                    return view('event.scert', ['userid' => $userid, 'role' => $role, 'flags' => $flags, 'threestars' => $threestars, 'fivestars' => $fivestars, 'appliedfor' => $appliedfor, 'currentflag' => $currentflag]);
                }
            }

            return view('event.scert');
        } catch (Exception $e) {

            return abort(404);
        }
    }



    public function indexbk()
    {
        try {
            $role = Auth::user()->role;

            if ($role) {
                $appliedfor = false;
                $currentflag = false;
                $appliedfor = Userkey::where('user_id', Auth::user()->id)->where('key', 'ratingreqid')->first();

                if ($appliedfor) {
                    if ($appliedfor->value) {

                        $appliedfor = $appliedfor->value;
                        $currentflag = ($appliedfor + 1);
                    }
                } else {
                    $currentflag = 1622;
                }

                $flags = CertQues::where('cert_cats_id', 1621)->orderBy('priority', 'asc')->get();
                $threestars = CertQues::where('cert_cats_id', 1622)->orderBy('priority', 'asc')->get();
                $fivestars = CertQues::where('cert_cats_id', 1623)->orderBy('priority', 'asc')->get();


                $role = Role::where('slug', $role)->first()->name;
                if ($appliedfor) {


                    switch ($appliedfor) {
                        case 1621:
                            $flagdata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1621)->first();

                            $flagstatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1621)->first();
                            $threedata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1622)->first();
                            $threestatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1622)->first();
                            $fivedata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1623)->first();
                            $fivestatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1623)->first();
                            return view('event.cert', ['role' => $role, 'flags' => $flags, 'threestars' => $threestars, 'fivestars' => $fivestars, 'appliedfor' => $appliedfor, 'currentflag' => $currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata, 'threedata' => $threedata, 'threestatusdata' => $threestatusdata, 'fivedata' => $fivedata, 'fivestatusdata' => $fivestatusdata]);
                            break;
                        case 1622:

                            $flagdata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1621)->first();
                            $flagstatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1621)->first();
                            $threedata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1622)->first();
                            $threestatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1622)->first();
                            $fivedata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1623)->first();
                            $fivestatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1623)->first();
                            return view('event.cert', ['role' => $role, 'flags' => $flags, 'threestars' => $threestars, 'fivestars' => $fivestars, 'appliedfor' => $appliedfor, 'currentflag' => $currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata, 'threedata' => $threedata, 'threestatusdata' => $threestatusdata, 'fivedata' => $fivedata, 'fivestatusdata' => $fivestatusdata]);
                            break;
                        case 1623:

                            $flagdata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1621)->first();
                            $flagstatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1621)->first();
                            $threedata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1622)->first();
                            $threestatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1622)->first();
                            $fivedata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1623)->first();
                            $fivestatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1623)->first();

                            return view('event.cert', ['role' => $role, 'flags' => $flags, 'threestars' => $threestars, 'fivestars' => $fivestars, 'appliedfor' => $appliedfor, 'currentflag' => $currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata, 'threedata' => $threedata, 'threestatusdata' => $threestatusdata, 'fivedata' => $fivedata, 'fivestatusdata' => $fivestatusdata]);
                            break;
                        default:

                            $flagdata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1621)->first();
                            $flagstatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1621)->first();
                            $threedata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1622)->first();
                            $threestatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1622)->first();
                            $fivedata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1623)->first();
                            $fivestatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1623)->first();
                            return view('event.cert', ['role' => $role, 'flags' => $flags, 'threestars' => $threestars, 'fivestars' => $fivestars, 'appliedfor' => $appliedfor, 'currentflag' => $currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata, 'threedata' => $threedata, 'threestatusdata' => $threestatusdata, 'fivedata' => $fivedata, 'fivestatusdata' => $fivestatusdata]);
                    }
                } else {

                    $flagdata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1621)->first();
                    $flagstatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1621)->first();
                    $threedata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1622)->first();
                    $threestatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1622)->first();
                    $fivedata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1623)->first();
                    $fivestatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1623)->first();
                    return view('event.cert', ['role' => $role, 'flags' => $flags, 'threestars' => $threestars, 'fivestars' => $fivestars, 'appliedfor' => $appliedfor, 'currentflag' => $currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata, 'threedata' => $threedata, 'threestatusdata' => $threestatusdata, 'fivedata' => $fivedata, 'fivestatusdata' => $fivestatusdata]);
                }
            }

            $flagdata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1621)->first();
            $flagstatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1621)->first();
            $threedata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1622)->first();
            $threestatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1622)->first();
            $fivedata = CertRequest::where('user_id', Auth::user()->id)->where('cat_id', 1623)->first();
            $fivestatusdata = CertStatus::where('user_id', Auth::user()->id)->where('cat_id', 1623)->first();
            return view('event.cert', ['role' => $role, 'flags' => $flags, 'threestars' => $threestars, 'fivestars' => $fivestars, 'appliedfor' => $appliedfor, 'currentflag' => $currentflag, 'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata, 'threedata' => $threedata, 'threestatusdata' => $threestatusdata, 'fivedata' => $fivedata, 'fivestatusdata' => $fivestatusdata]);
        } catch (Exception $e) {

            return abort(404);
        }
    }
    public function index()
    {
        try {
            $userId = Auth::id();
            $roleSlug = Auth::user()->role;

            if (!$roleSlug) {
                return abort(404);
            }

            // Get applied rating
            $appliedfor = Userkey::where('user_id', $userId)->where('key', 'ratingreqid')->value('value');
            $currentflag = $appliedfor ? ($appliedfor + 1) : 1622;

            // Load questions
            $flags = CertQues::where('cert_cats_id', 1621)->orderBy('priority', 'asc')->get();
            $threestars = CertQues::where('cert_cats_id', 1622)->orderBy('priority', 'asc')->get();
            $fivestars = CertQues::where('cert_cats_id', 1623)->orderBy('priority', 'asc')->get();

            // Get role name
            $role = Role::where('slug', $roleSlug)->value('name');

            // Prepare cert request and status data for all categories
            $categories = [
                1621 => 'flag',
                1622 => 'three',
                1623 => 'five'
            ];

            $certData = [];
            foreach ($categories as $catId => $prefix) {
                $certData["{$prefix}data"] = CertRequest::where('user_id', $userId)->where('cat_id', $catId)->first();
                $certData["{$prefix}statusdata"] = CertStatus::where('user_id', $userId)->where('cat_id', $catId)->first();
            }
            return view('event.cert', array_merge([
                'role' => $role,
                'flags' => $flags,
                'threestars' => $threestars,
                'fivestars' => $fivestars,
                'appliedfor' => $appliedfor,
                'currentflag' => $currentflag,
            ], $certData));
        } catch (Exception $e) {
            return abort(404);
        }
    }


    public function schoolCertificate(Request $request)
    {

        $name = Auth::user()->name;
        $city = DB::table('users')
            ->join('usermetas', 'users.id', '=', 'usermetas.user_id')
            ->select(['usermetas.city'])
            ->where('user_id', Auth::user()->id)
            ->first();
        $cities = current($city);

        //return view('certificate',['name' => $name ,'cities' => $cities]);
        $flat_rating_status = DB::table('wp_star_rating_status')->where('user_id', Auth::user()->id)->where('cat_id', '1621')->first(['created']);

        $pdf = PDF::loadView('certificate', ['name' => $name, 'cities' => $cities, 'flat_rating_status' => $flat_rating_status]);
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl' => ['allow_self_signed' => TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE,]])
        );
        return $pdf->stream($name . ".pdf");
    }


    public function myChampionCertificate(Request $request)
    {
        $email = Auth::user()->email;
        $cham_name = Champion::where('email', $email)->where('status', '1')->first()->name;
        $cert_end_date = date('d/m/Y', strtotime('-1 day', strtotime("+12 Months")));
        //$pdf = PDF::loadView('champion-certificate',['name' => ucwords($cham_name), 'cert_end_date'=>$cert_end_date])->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
        //return $pdf->stream($cham_name.".pdf");
        $pdf = PDF::loadView('champion-certificate', ['name' => ucwords($cham_name), 'cert_end_date' => $cert_end_date])->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');

        $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl' => ['allow_self_signed' => TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE,]])
        );

        return $pdf->stream($cham_name . ".pdf");
    }

    public function myAmbassadorCertificate(Request $request)
    {
        $email = Auth::user()->email;
        $amb_name = Ambassador::where('email', $email)->where('status', '1')->first()->name;
        $cert_end_date = date('d/m/Y', strtotime('-1 day', strtotime("+12 Months")));

        $pdf = PDF::loadView('ambassador-certificate', ['name' => ucwords($amb_name), 'cert_end_date' => $cert_end_date])->setPaper('DEFAULT_PDF_PAPER_SIZE', 'landscape');
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create(['ssl' => ['allow_self_signed' => TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE,]])
        );

        return $pdf->stream($amb_name . ".pdf");

        //return $pdf->stream($amb_name.".pdf");
    }
}
