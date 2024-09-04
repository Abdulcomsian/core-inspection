<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Chatify\Facades\ChatifyMessenger as Chatify;
use App\Models\{Appointment, ServiceReview, Chat, Qualification, ServiceCategory, Service, Transaction, Biograpy,  Address, Country, City, County, AppointmentSchedule, IdentityModel};

class VendorController extends Controller
{
    public function index()
    {
        try {
            //Related to transactions
            $serviceCategories = ServiceCategory::all();
            $services = Service::where('user_id', Auth::id())->get();

            return view('vendor-user.index', compact('serviceCategories', 'services'));
        } catch (\Exception $exception) {
            toastr()->error('Something went wrong, try again');
            return back();
        }
    }

    public function Profile()
    {
        $biography = Biograpy::where('user_id', auth()->user()->id)->first();
        $companyAddress = Address::with('country', 'city', 'town')
            ->where('user_id', auth()->user()->id)
            ->first();
        $services = Service::where('user_id', auth()->user()->id)->get();

        $vendorServices = Service::where('user_id', auth()->user()->id)
            ->where('status', '1')
            ->get();

        $serviceIds = $services->pluck('id')->toArray();
        $allReviews = ServiceReview::whereIn('service_id', $serviceIds)->paginate(5);
        $serviceCategories = ServiceCategory::all();

        $initialPercentage = 50;
        $fields = [
            'years_of_experience',
            'nin_number',
            'languages',
            'detail_bio'
        ];
        $filledFields = 0;
        foreach ($fields as $field) {
            if (isset($biography->$field) && !empty($biography->$field)) {
                $filledFields++;
            }
        }
        $additionalPercentage = ($filledFields / count($fields)) * 50;
        $completionPercentage = $initialPercentage + $additionalPercentage;

        $qualifications = Qualification::where('user_id', auth()->user()->id)->get();
        $identity = IdentityModel::where('user_id', auth()->user()->id)->first();
        $companyAddress = Address::with('country', 'city', 'town')->where('user_id', auth()->user()->id)->first();
        $country = Country::where('country_name', 'like', '%Uganda%')->first();
        $cities = City::where('country_id', $country->id)->get();
        if ($companyAddress !== null) {
            $towns = County::where('city_id', $companyAddress->city->id)->get();
        }
        $appointmentSchedule = AppointmentSchedule::where('user_id', auth()->user()->id)->first();
        return view("vendor-user.profile")->with([
            'qualifications' => $qualifications,
            'identity' => $identity,
            'companyAddress' => $companyAddress,
            'country' => $country,
            'cities' => $cities,
            'appointmentSchedule' => $appointmentSchedule,
            'towns' => $towns ?? '',
            'biography' => $biography,
            'completionPercentage' => $completionPercentage,
            'allReviews' => $allReviews,
            'serviceCategories' => $serviceCategories,
            'services' => $vendorServices
        ]);
    }

    public function OnBoarding()
    {
        $biography = Biograpy::where('user_id', auth()->user()->id)->first();
        $qualifications = Qualification::where('user_id', auth()->user()->id)->get();
        $identity = IdentityModel::where('user_id', auth()->user()->id)->first();
        $companyAddress = Address::with('country', 'city', 'town')->where('user_id', auth()->user()->id)->first();
        $country = Country::where('country_name', 'like', '%Uganda%')->first();
        $cities = $country ? City::where('country_id', $country->id)->get() : collect();
        $towns = $companyAddress && $companyAddress->city ? County::where('city_id', $companyAddress->city->id)->get() : collect();
        $appointmentSchedule = AppointmentSchedule::where('user_id', auth()->user()->id)->first();
        $serviceCategories = Service::where('user_id', auth()->user()->id)->where('status', '1')->get();

        $totalPercentage = 0;
        $sectionCount = 5;

        $bioFields = ['languages', 'detail_bio'];
        $bioFilledFields = 0;

        foreach ($bioFields as $field) {
            if (isset($biography->$field) && !empty($biography->$field)) {
                $bioFilledFields++;
            }
        }

        $bioCompletion = ($bioFilledFields / count($bioFields)) * 100;
        $totalPercentage += $bioCompletion / $sectionCount;

        $qualCompletion = $qualifications->isNotEmpty() ? 100 : 0;
        $totalPercentage += $qualCompletion / $sectionCount;

        $identityCompletion = $identity ? 100 : 0;
        $totalPercentage += $identityCompletion / $sectionCount;

        $addressCompletion = $companyAddress ? 100 : 0;
        $totalPercentage += $addressCompletion / $sectionCount;

        $appointmentCompletion = $appointmentSchedule ? 100 : 0;
        $totalPercentage += $appointmentCompletion / $sectionCount;

        return view("vendor-user.onboarding")->with([
            'qualifications' => $qualifications,
            'identity' => $identity,
            'companyAddress' => $companyAddress,
            'country' => $country,
            'cities' => $cities,
            'appointmentSchedule' => $appointmentSchedule,
            'towns' => $towns,
            'biography' => $biography,
            'completionPercentage' => $totalPercentage,
            'serviceCategories' => $serviceCategories
        ]);
    }


    public function deleteQualification(Request $request)
    {
        try {
            $qualification_id = $request->qualification_id;
            $qualification = Qualification::find($qualification_id);

            if ($qualification) {
                $filePath = public_path('uploads/' . $qualification->image);

                Log::info('Deleting file at path: ' . $filePath);

                if (file_exists($filePath) && !is_dir($filePath)) {
                    unlink($filePath);
                } else {
                    Log::warning('File does not exist or is a directory: ' . $filePath);
                }

                $qualification->delete();

                return response()->json(['status' => true, 'msg' => "Qualification Deleted Successfully"]);
            } else {
                return response()->json(['status' => false, 'msg' => "Qualification not found"]);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting qualification: ' . $e->getMessage());
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }


    public function ManageServices()
    {
        $serviceCategories = ServiceCategory::all();
        $services = Service::where('user_id', Auth::id())->get();
        return view('vendor-user.manage-services', compact('serviceCategories', 'services'));
    }

    public function Dashboard()
    {
        $allAppointments = Appointment::with('collectionDetails', 'serviceDetails', 'serviceDetails.serviceCategory', 'user', 'serviceProvider')->where('vendor_id', \Auth::id())->get();
        $countAppointment = Appointment::where('vendor_id', Auth::id())->count();
        $countServices = Service::where('user_id', Auth::id())->count();
        $countAppointmentRequests = Appointment::where('vendor_id', Auth::id())->count();
        $serviceCategories = Service::where('user_id', auth()->user()->id)->where('status', '1')->get();
        return view('vendor-user.dashboard', compact('countAppointment', 'countServices', 'serviceCategories', 'countAppointmentRequests', 'allAppointments'));
    }
    public function Payments()
    {
        return view('vendor-user.payments');
    }
    public function Bookings()
    {
        return view('vendor-user.bookings');
    }
    public function Tasks()
    {
        return view('vendor-user.tasks');
    }

    public function Wallet()
    {
        $vendorId = auth()->user()->id;

        $appointments = Appointment::where('vendor_id', $vendorId)
            ->where('status', '0')
            ->with('disbursementDetails', 'serviceDetails.serviceCategory')
            ->get()
            ->map(function ($appointment) {
                $appointment->balance_after_commission = $appointment->purchase_amount * 0.95;
                return $appointment;
            });

        $totalBalance = $appointments->sum('purchase_amount');
        $onHold = $appointments->filter(function ($appointment) {
            return !$appointment->disbursementDetails;
        })->sum('purchase_amount');
        $amountReceived = $appointments->filter(function ($appointment) {
            return $appointment->disbursementDetails;
        })->sum('balance_after_commission');

        return view('vendor-user.wallet', compact('appointments', 'totalBalance', 'onHold', 'amountReceived'));
    }

    public function Appointments(Request $request)
    {
        if ($request->ajax()) {
            $allAppointments = Appointment::with('serviceDetails', 'serviceDetails.serviceCategory', 'user', 'serviceProvider')
                ->where('vendor_id', Auth::id());

            // Filter by service category
            if ($request->filled('service_category')) {
                $allAppointments->whereHas('serviceDetails.serviceCategory', function ($query) use ($request) {
                    $query->where('id', $request->service_category);
                });
            }

            // Filter by service type
            if ($request->filled('service_type')) {
                $serviceType = $request->service_type;
                if ($serviceType == '0') { // Pending
                    $allAppointments->whereNull('appointment_status');
                } elseif ($serviceType == '1') { // Approved
                    $allAppointments->where('appointment_status', '1');
                }
            }

            // Full-text search across multiple fields
            if ($request->filled('search_input')) {
                $searchInput = $request->search_input;
                $allAppointments->where(function ($query) use ($searchInput) {
                    $query->whereHas('serviceProvider', function ($query) use ($searchInput) {
                        $query->where('first_name', 'like', "%{$searchInput}%")
                            ->orWhere('last_name', 'like', "%{$searchInput}%");
                    })
                        ->orWhereHas('serviceDetails.serviceCategory', function ($query) use ($searchInput) {
                            $query->where('name', 'like', "%{$searchInput}%");
                        })
                        ->orWhere('location', 'like', "%{$searchInput}%"); // Ensure location is included
                });
            }

            return DataTables::of($allAppointments)
                ->addColumn('serviceProvider', function ($appointment) {
                    return $appointment->serviceProvider->first_name . ' ' . $appointment->serviceProvider->last_name;
                })
                ->addColumn('date', function ($appointment) {
                    return date('d/m/Y', strtotime($appointment->start_date)) . '-' . date('d/m/Y', strtotime($appointment->end_date));
                })
                ->addColumn('time', function ($appointment) {
                    return date('h:i A', strtotime($appointment->start_time)) . '-' . date('h:i A', strtotime($appointment->end_time));
                })
                ->addColumn('serviceCategory', function ($appointment) {
                    return $appointment->serviceDetails->serviceCategory->name ?? '';
                })
                ->addColumn('status', function ($appointment) {
                    if (isset($appointment->disbursementDetails)) {
                        if ($appointment->disbursementDetails->status == 2) {
                            return '<span class="badge bg-success">Admin Approved & Withdrawn</span>';
                        } elseif ($appointment->disbursementDetails->status == 1) {
                            return '<span class="badge bg-success">User Approved</span>';
                        } else {
                            return '<span class="badge bg-success">Provider Requested</span>';
                        }
                    } elseif ($appointment->status == '0') {
                        return '<span class="badge bg-success">Payment Initiated</span>';
                    } else {
                        return '<span class="badge bg-warning">Pending</span>';
                    }
                })
                ->addColumn('appointmentStatus', function ($appointment) {
                    if ($appointment->appointment_status == 1) {
                        return '<span class="badge bg-success">Approved</span>';
                    } elseif ($appointment->appointment_status == 2) {
                        return '<span class="badge bg-danger">Rejected</span>';
                    } else {
                        return '<span class="badge bg-info">Pending</span>';
                    }
                })
                ->addColumn('amount', function ($appointment) {
                    return '$' . ($appointment->serviceDetails->serviceCategory->price ?? '');
                })
                ->addColumn('action', function ($appointment) {
                    return '<a href="' . route('vendor.appointmentDetails', ['id' => $appointment->id, 'user_id' => $appointment->user_id]) . '" class="link-success fs-23 Edit-Button" title="View Details"><i class="las la-eye"></i></a>';
                })
                ->rawColumns(['status', 'appointmentStatus', 'action'])
                ->make(true);
        }

        $serviceCategories = ServiceCategory::all();
        return view("vendor-user.appointments", compact('serviceCategories'));
    }

    public function appointmentDetails($id, $user_id)
    {
        $appointmentDetails = Appointment::with('disbursementDetails', 'collectionDetails', 'serviceDetails', 'serviceDetails.serviceCategory', 'user', 'serviceProvider')->find($id);
        $chats = Chat::with('userDetails')->where('appointment_id', $id)->get();
        $messenger_color = Auth::user()->messenger_color;

        return view("vendor-user.appointment-details", compact('appointmentDetails', 'chats'))
            ->with([
                'id' => $user_id,
                'messengerColor' => $messenger_color ? $messenger_color : Chatify::getFallbackColor(),
                'dark_mode' => Auth::user()->dark_mode < 1 ? 'light' : 'dark',
            ]);
    }


    public function EditProfile()
    {
        return view('vendor-user.edit-profile');
    }

    public function getQualificationRow(Request $request)
    {
        $html = view('components.add-qualification-row')->render();
        return response()->json(['status' => true, 'html' => $html]);
    }

    public function addBiography(Request $request)
    {
        $request->validate([
            'yoe' => 'required|integer|min:0',
            'detail_biography' => 'required|string',
            'languages' => 'required|array',
            'languages.*' => 'string|max:255',
        ]);
        Biograpy::updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                'user_id' => auth()->user()->id,
                'job_title' => $request->job ?? '',
                'organization' => $request->company ?? '',
                'years_of_experience' => $request->yoe ?? '',
                'detail_bio' => $request->detail_biography ?? '',
                'nin_number' => $request->nin_number ?? '',
                'languages' => json_encode($request->languages) ?? ''
            ]
        );

        return response()->json(['status' => true, 'msg' => 'Biography updated successfully']);
    }

    public function addServiceType(Request $request)
    {
        $request->validate([
            'service_type' => 'required',
        ]);
        Biograpy::updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                'user_id' => auth()->user()->id,
                'service_type' => $request->service_type
            ]
        );

        return response()->json(['status' => true, 'msg' => 'Service type updated successfully']);
    }

    public function addAppointmentSchedule(Request $request)
    {
        AppointmentSchedule::updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                'user_id' => auth()->user()->id,
                'from' => $request->from,
                'to' => $request->to,
                'days' => $request->days
            ]
        );

        return response()->json(['status' => true, 'msg' => 'Appointment Schedule updated successfully']);
    }

    public function addCompanyContactDetails(Request $request)
    {
        $validatedData = $request->validate([
            'phone_no' => 'nullable|string',
            'national_id_number' => 'required|string',
            'national_id_image' => $request->hasFile('national_id_image') ? 'required|image' : ''
        ]);

        $userId = auth()->id();

        $user = User::findOrFail($userId);
        $user->phone = $validatedData['phone_no'] ?? $user->phone;
        $user->save();

        $identity = IdentityModel::where('user_id', $userId)->first();

        if ($identity) {
            $identity->national_id_number = $validatedData['national_id_number'];

            if ($request->hasFile('national_id_image')) {
                if ($identity->national_id_image) {
                    Storage::disk('public')->delete($identity->national_id_image);
                }

                $imageName = 'cnic_' . time() . '.' . $request->file('national_id_image')->getClientOriginalExtension();
                $imagePath = $request->file('national_id_image')->storeAs('cnic_images', $imageName, 'public');
                $identity->national_id_image = $imagePath;
            }

            $identity->save();
        } else {
            if ($request->hasFile('national_id_image')) {
                $imageName = 'cnic_' . time() . '.' . $request->file('national_id_image')->getClientOriginalExtension();
                $imagePath = $request->file('national_id_image')->storeAs('cnic_images', $imageName, 'public');
            } else {
                $imagePath = null;
            }

            $identity = IdentityModel::create([
                'user_id' => $userId,
                'national_id_number' => $validatedData['national_id_number'],
                'national_id_image' => $imagePath,
            ]);
        }

        return response()->json([
            'status' => true,
            'msg' => 'Contact information updated successfully',
        ]);
    }


    public function addCompanyLocation(Request $request)
    {
        Address::updateOrCreate(
            ['user_id' => auth()->user()->id],
            ['user_id' => auth()->user()->id, 'country_id' => $request->country, 'city_id' => $request->city, 'town_id' => $request->town]
        );

        return response()->json(['status' => true, 'msg' => 'Address updated successfully']);
    }

    public function updateQualification(Request $request)
    {
        $validator = Validator::make(json_decode($request->qualifications, true), [
            '*.degreeName' => 'string|required',
            '*.fromDate' => 'date|required',
            '*.toDate' => 'date|required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => implode(", ", $validator->errors()->all())]);
        }

        try {
            $qualifications = json_decode($request->qualifications);
            $previousDegreeIds = [];
            foreach ($qualifications as $qualification) {
                if ($qualification->qualificationId) {
                    $previousDegreeIds[] = $qualification->qualificationId;
                }
            }

            if (count($previousDegreeIds) > 0) {
                Qualification::whereNotIn('id', $previousDegreeIds)
                    ->where('user_id', auth()->user()->id)
                    ->delete();
            }

            foreach ($qualifications as $index => $qualification) {
                if ($qualification->qualificationId) {
                    $thisQualification = Qualification::where('id', $qualification->qualificationId)->first();
                    $thisQualification->degree = $qualification->degreeName;
                    $thisQualification->from = date('Y-m-d', strtotime($qualification->fromDate));
                    $thisQualification->to = date('Y-m-d', strtotime($qualification->toDate));

                    $uploadDir = public_path('uploads');
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    if ($request->hasFile('qualification_certificate_' . $index)) {
                        $file = $request->file('qualification_certificate_' . $index);
                        $fileName = strtotime(date('Y-m-d H:i:s')) . '-certificate' . $index . '.' . $file->getClientOriginalExtension();
                        $file->move($uploadDir, $fileName);
                        $thisQualification->image = $fileName;
                    }

                    $thisQualification->save();
                } else {
                    $fileName = null;

                    $uploadDir = public_path('uploads');
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    if ($request->hasFile('qualification_certificate_' . $index)) {
                        $file = $request->file('qualification_certificate_' . $index);
                        $fileName = strtotime(date('Y-m-d H:i:s')) . '-certificate' . $index . '.' . $file->getClientOriginalExtension();
                        $file->move($uploadDir, $fileName);
                    }

                    Qualification::create([
                        'degree' => $qualification->degreeName,
                        'from' => date('Y-m-d', strtotime($qualification->fromDate)),
                        'to' => date('Y-m-d', strtotime($qualification->toDate)),
                        'user_id' => auth()->user()->id,
                        'image' => $fileName,
                    ]);
                }
            }

            return response()->json(['status' => true, 'msg' => 'Qualification updated successfully']);
        } catch (\Exception $e) {
            Log::info($e);
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }


    public function getCityTowns(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cityId' => 'numeric|required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => implode(", ", $validator->errors()->all())]);
        }

        try {
            $towns = County::where('city_id', $request->cityId)->get();
            $html = view('ajax.town', ['towns' => $towns])->render();
            return response()->json(['status' => true, 'html' => $html]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }

    public function getCountryCities(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'countryId' => 'numeric|required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => implode(", ", $validator->errors()->all())]);
        }

        try {
            $cities = City::where('country_id', $request->countryId)->get();
            $html = view('ajax.city', ['cities' => $cities])->render();
            return response()->json(['status' => true, 'html' => $html]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }

    public function serviceReviews($id)
    {
        $serviceReviews = ServiceReview::with('userDetails')->where('service_id', $id)->get();
        return view('vendor-user.service-reviews', compact('serviceReviews'));
    }

    public function approveAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->appointment_status = '1';
        $appointment->save();

        return response()->json(['success' => true, 'message' => 'Appointment approved successfully.']);
    }

    public function rejectAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->appointment_status = '2';
        $appointment->save();

        return response()->json(['success' => true, 'message' => 'Appointment rejected successfully.']);
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $fileName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('images'), $fileName);

            $user = User::findOrFail(auth()->user()->id);
            $user->avatar = $fileName;
            $user->save();

            return response()->json(['success' => true, 'message' => 'Avatar uploaded successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to upload avatar']);
    }

    public function updateInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'min:8'],
            'confirm_password' => 'nullable|required_with:password|same:password|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()->toArray()], 422);
        }

        try {
            $user = User::findOrFail(auth()->user()->id);

            $user->update([
                'name' => $request->first_name . ' ' . $request->last_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);

            if ($request->password) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            return response()->json(['status' => true, 'msg' => 'Profile updated successfully']);
        } catch (\Exception $e) {
            Log::error($e);

            return response()->json(['status' => false, 'msg' => 'An error occurred while updating profile. Please try again later.'], 500);
        }
    }

    public function profileSubmit()
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->profile_approved_status = '0';
        $user->save();
        toastr('Profile submitted for approval.');
        return redirect()->back();
    }
}
