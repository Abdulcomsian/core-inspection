<?php

namespace App\Http\Controllers;

use PDF;
use Exception;
use Illuminate\Http\Request;
use App\Models\IdentityModel;
use App\Models\ServiceReview;
use App\Mail\ApprovalStatusMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VendorApprovalNotification;
use PHPUnit\Framework\MockObject\Builder\Identity;
use App\Models\{Service, User, Disbursement, Appointment, Transaction, Address, AppointmentSchedule, Qualification, Biograpy, ServiceCategory, Country, City, County};

class AdminController extends Controller
{
    public function index()
    {
        try {
            $serviceCategories = ServiceCategory::all();
            $countServiceProviders = User::role('vendor_user')->count();
            $serviceBooked = Appointment::count();

            $sumServiceBookedPrice = Disbursement::sum('commission_amount');
            return view('admin.index', compact(
                'serviceCategories',
                'countServiceProviders',
                'serviceBooked',
                'sumServiceBookedPrice'
            ));
        } catch (\Exception $exception) {
            toastr()->error('Something went wrong, try again');
            return back();
        }
    }

    public function ServiceProvider()
    {
        $roles = DB::table('roles')->get();
        $approvedVendors = User::role('vendor_user')->latest()->paginate('10');
        return view("admin.service-providers", compact('approvedVendors', 'roles'));
    }
    public function UserAccounts()
    {
        $userAccounts = User::role('user')->get();
        $roles = DB::table('roles')->get();

        return view("admin.user-account", compact('userAccounts', 'roles'));
    }
    public function AdminAccounts()
    {
        $adminAccounts = User::role('admin')->get();
        $roles = DB::table('roles')->get();
        return view("admin.admin-accounts", compact('adminAccounts', 'roles'));
    }

    // public function Approvals()
    // {
    //     $unapprovedVendors = User::role('vendor_user')->whereIn('is_approved', [0, 2])->get();
    //     return view("admin.approve-services", compact('unapprovedVendors'));
    // }

    public function onBoardingApprovals()
    {
        $unapprovedonBoardings = User::role('vendor_user')->whereIn('profile_approved_status', ['0', '2'])->get();
        return view("admin.approve-onboarding", compact('unapprovedonBoardings'));
    }

    public function serviceApprovals()
    {
        $unapprovedoServiceRequests = Service::whereIn('status', ['0', '2'])->latest()->paginate('10');
        return view("admin.approve-service-req", compact('unapprovedoServiceRequests'));
    }

    public function onBoardingVendorProfile($id, $service_id = null)
    {
        $qualifications = Qualification::where('user_id', $id)->get();
        $companyAddress = Address::with('country', 'city', 'town')->where('user_id', $id)->first();
        $biography = Biograpy::where('user_id', $id)->first();
        $providerDetails = User::where('id', $id)->first();
        $appointmentSchedule = AppointmentSchedule::where('user_id', $id)->first();
        $services = Service::where('user_id', $id)->get();
        $identity = IdentityModel::where('user_id', $id)->first();

        $serviceIds = $services->pluck('id')->toArray();

        $unapprovedoServiceRequest = Service::where('id', $service_id)->whereIn('status', ['0', '2'])->first();

        return view("admin.service-provider-onboarding-details")->with([
            'qualifications' => $qualifications,
            'biography' => $biography,
            'companyAddress' => $companyAddress,
            'providerDetails' => $providerDetails,
            'appointmentSchedule' => $appointmentSchedule,
            'services' => $services,
            'identity' => $identity,
            'unapprovedoServiceRequest' => $unapprovedoServiceRequest
        ]);
    }

    public function VenderDetails()
    {
        return view("admin.venderDetails");
    }
    public function Transactions()
    {
        return view("admin.all-transactions");
    }
    public function Dispute()
    {
        return view("admin.dispute-transactions");
    }
    public function Dashboard()
    {
        return view("admin.index");
    }


    // public function Appointments(Request $request)
    // {
    //     $serviceCategories = ServiceCategory::all();
    //     $allAppointments = Appointment::with('disbursementDetails', 'collectionDetails', 'serviceDetails', 'serviceDetails.serviceCategory', 'user', 'serviceProvider');
    //     if (isset($request->disability)) {
    //         $disabilityType = $request->disability;
    //         $allAppointments = $allAppointments->whereHas('serviceDetails.serviceCategory', function ($query) use ($disabilityType) {
    //             $query->where('id', $disabilityType);
    //         });
    //     }
    //     if (isset($request->service_type)) {
    //         $serviceType = $request->service_type;
    //         if ($serviceType == 'Ongoing') {
    //             $allAppointments = $allAppointments->whereHas('disbursementDetails', function ($query) use ($serviceType) {
    //                 $query->where('status', '!=', 2);
    //             });
    //         } elseif ($serviceType == 'Completed') {
    //             $allAppointments = $allAppointments->whereHas('disbursementDetails', function ($query) use ($serviceType) {
    //                 $query->where('status', '=', 2);
    //             });
    //         }
    //     }
    //     if (isset($request->total_services)) {
    //         $allAppointments = $allAppointments->limit($request->total_services);
    //     }
    //     $allAppointments = $allAppointments->get();

    //     if (isset($request->download_pdf)) {
    //         $pdf = PDF::loadView('admin.pdf.services', compact('allAppointments'));

    //         return $pdf->download('services-report.pdf');
    //     } else {
    //         return view("admin.appointments", compact('allAppointments', 'serviceCategories'));
    //     }
    //     // dd($allTransactions);
    // }

    public function Appointments(Request $request)
    {
        if ($request->ajax()) {
            $allAppointments = Appointment::with('serviceDetails', 'serviceDetails.serviceCategory', 'user', 'serviceProvider');

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
                    return '<a href="' . route('admin.appointmentDetails', ['id' => $appointment->id]) . '" class="link-success fs-23 Edit-Button" title="View Details"><i class="las la-eye"></i></a>';
                })
                ->rawColumns(['status', 'appointmentStatus', 'action'])
                ->make(true);
        }

        $serviceCategories = ServiceCategory::all();
        return view("admin.appointments", compact('serviceCategories'));
    }

    public function Interviews()
    {
        return view("admin.interviews");
    }

    public function getVendorDetails($id)
    {
        $vendorDetails = User::where('id', $id)->first();
        return response()->json([
            "status" => true,
            "vendorDetails" => $vendorDetails
        ]);
    }
    public function updateVendor(Request $request)
    {
        if ($request->submit_type == 'accept') {
            $approval_status = 1;
        } elseif ($request->submit_type == 'reject') {
            $approval_status = 2;
        }
        $userDetails = User::find($request->user_id);
        $updateVendor = User::where('id', $request->user_id)->first();
        $updateVendor->is_approved  = $approval_status;
        if ($updateVendor->save()) {
            Notification::route('mail', $userDetails->email)->notify(new VendorApprovalNotification($userDetails, $request->submit_type));
            toastr('Vendor Updated');
            return redirect()->back();
        }
    }

    public function appointmentDetails($id)
    {
        $appointmentDetails = Appointment::with('disbursementDetails', 'collectionDetails', 'serviceDetails', 'serviceDetails.serviceCategory', 'user', 'serviceProvider')->find($id);
        $qualifications = Qualification::where('user_id', $appointmentDetails->vendor_id)->get();
        $biography = Biograpy::where('user_id', $appointmentDetails->vendor_id)->first();
        $providerDetails = User::where('id', $appointmentDetails->vendor_id)->first();
        $appointmentSchedule = AppointmentSchedule::where('user_id', $appointmentDetails->vendor_id)->first();
        $companyAddress = Address::with('country', 'city', 'town')->where('user_id', $appointmentDetails->vendor_id)->first();
        return view("admin.appointment-details", compact('companyAddress', 'appointmentSchedule', 'providerDetails', 'biography', 'qualifications', 'appointmentDetails'));
    }

    public function appointmentCommision()
    {
        $allAppointments = Appointment::with('disbursementDetails', 'collectionDetails', 'serviceDetails', 'serviceDetails.serviceCategory', 'user', 'serviceProvider')->get();
        return view("admin.appointments-commision", compact('allAppointments'));
    }

    public function providerServices()
    {
        $allServices = Service::with('serviceCategory', 'providerDetails')->where('status', '1')->get();
        return view('admin.provider-services', compact('allServices'));
    }
    public function getService($id)
    {
        $serviceDetaills = Service::find($id);
        return response()->json([
            "status" => true,
            "serviceDetaills" => $serviceDetaills
        ]);
    }
    public function setPrice(Request $request)
    {
        $setServicePirce = Service::find($request->service_id);
        $setServicePirce->price = $request->service_price;
        if ($setServicePirce->save()) {
            toastr('Service price set successfully');
            return redirect()->back();
        }
    }
    public function serviceProviderDetail(Request $request)
    {
        $id = $request->id;
        $qualifications = Qualification::where('user_id', $id)->get();
        $companyAddress = Address::with('country', 'city', 'town')->where('user_id', $id)->first();
        $biography = Biograpy::where('user_id', $id)->first();
        $providerDetails = User::where('id', $id)->first();
        $appointmentSchedule = AppointmentSchedule::where('user_id', $id)->first();
        $services = Service::where('user_id', $id)->where('status', '1')->get();

        $serviceIds = $services->pluck('id')->toArray();

        $allReviews = ServiceReview::whereIn('service_id', $serviceIds)->paginate(5);

        return view("admin.service-provider-details")->with([
            'qualifications' => $qualifications,
            'biography' => $biography,
            'companyAddress' => $companyAddress,
            'providerDetails' => $providerDetails,
            'appointmentSchedule' => $appointmentSchedule,
            'services' => $services,
            'allReviews' => $allReviews,
        ]);
    }

    public function updateApprovalStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'approvalStatus' => 'numeric|required',
            'providerId' => 'numeric|required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => implode(", ", $validator->errors()->all())]);
        }
        try {
            $approvalStatus = $request->approvalStatus;
            $providerId = $request->providerId;
            $user = User::where('id', $providerId)->first();
            if ($approvalStatus == 1) {
                $user->is_approved = 1;
                $user->save();
            } elseif ($approvalStatus == 2) {
                $user->is_approved = 2;
                $user->save();
            } else {
                $user->is_approved = 0;
                $user->save();
            }
            toastr('Account Updated Successfully');
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }

    public function approveRequest($id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->status = '1';
            $service->update();
            return response()->json([
                'success' => true,
                'message' => 'Service approved successfully.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to approve service. ' . $e->getMessage()
            ], 500);
        }
    }

    public function rejectRequest($id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->status = '2';
            $service->update();

            return response()->json([
                'success' => true,
                'message' => 'Service rejected successfully.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reject service. ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateonBoardingStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'approvalStatus' => 'numeric|required',
            'providerId' => 'numeric|required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => implode(", ", $validator->errors()->all())]);
        }
        try {
            $approvalStatus = $request->approvalStatus;
            $providerId = $request->providerId;
            $user = User::where('id', $providerId)->first();
            if ($approvalStatus == 1) {
                $user->profile_approved_status = '1'; //approved
                $user->save();
            } elseif ($approvalStatus == 2) {
                $user->profile_approved_status = '2'; //rejected
                $user->save();
            } else {
                $user->profile_approved_status = '0'; //pending
                $user->save();
            }

            $note = $request->note;

            Mail::to($user->email)->send(new ApprovalStatusMail($user, $approvalStatus, $note));

            toastr()->success('Account Updated Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function locations()
    {
        $countries = Country::all();
        $cities = City::all();
        return view('admin.location')->with(['countries' => $countries, 'cities' => $cities]);
    }

    public function addCountry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'string|required',
            'phone_code' => 'required|numeric',
            'country_code' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => implode(", ", $validator->errors()->all())]);
        }

        try {
            $country = Country::where('country_name', $request->country)->first();

            if (!$country) {
                Country::create(['country_name' => $request->country, 'phone_code' => $request->phone_code, 'country_code' => $request->country_code]);
                $countries = Country::all();
                $html = view('ajax.country', ['countries' => $countries])->render();
                return response()->json(['status' => true, 'html' => $html]);
            } else {
                return response()->json(['status' => false, 'error' => 'Country already added']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }

    public function addCity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'countryId' => 'numeric|required',
            'city' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => implode(", ", $validator->errors()->all())]);
        }

        try {
            $city = City::where('name', $request->city)->where('country_id', $request->countryId)->first();
            if (!$city) {
                City::create(['country_id' => $request->countryId, 'name' => $request->city]);
                return response()->json(['status' => true, 'msg' => 'City added successfully']);
            } else {
                return response()->json(['status' => false, 'error' => 'City already added']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }

    public function addTown(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cityId' => 'numeric|required',
            'town' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => implode(", ", $validator->errors()->all())]);
        }

        try {
            $town = County::where('name', $request->town)->where('city_id', $request->cityId)->first();
            if (!$town) {
                County::create(['city_id' => $request->cityId, 'name' => $request->town]);
                return response()->json(['status' => true, 'msg' => 'Town added successfully']);
            } else {
                return response()->json(['status' => false, 'error' => 'Town already added']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }
    public function downloadServicesPdf(Request $request)
    {
        $show = Disneyplus::find($id);
        $pdf = PDF::loadView('pdf', compact('show'));

        return $pdf->download('disney.pdf');
    }
}
