<?php

namespace App\Http\Controllers;

use App\Mail\BookingMail;
use Illuminate\Http\Request;

use App\Models\{
    Disbursement as DisbursementModal,
    Collection as CollectionModel,
    ServiceReview,
    Appointment,
    Chat,
    User,
    Service,
    ServiceCategory,
    Transaction,
    Country,
    City,
    Qualification,
    Address,
    AppointmentSchedule,
    Biograpy,
    County
};
use Bmatovu\MtnMomo\Products\Disbursement;
use Bmatovu\MtnMomo\Products\Collection;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use Illuminate\Validation\Rule;
use App\Rules\CollectionRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        try {
            //Related to transactions
            $transactions_today = 0;
            $transactions_weekly = 0;
            $transactions_monthly = 0;
            $transactions_yearly = 0;

            //Related to users
            $users_today = 0;
            $users_weekly = 0;
            $users_monthly = 0;
            $users_yearly = 0;

            //Companies
            $total_companies = 0;
            $total_users = 0;
            $total_packages = 0;
            $total_transactions = 0;

            return view('user.index', compact(
                'transactions_today',
                'transactions_weekly',
                'transactions_monthly',
                'transactions_yearly',
                'users_today',
                'users_weekly',
                'users_monthly',
                'users_yearly',
                'total_companies',
                'total_users',
                'total_packages',
                'total_transactions'

            ));
        } catch (\Exception $exception) {
            toastr()->error('Something went wrong, try again');
            return back();
        }
    }
    public function Details()
    {
        return view("user.serviceDetails");
    }
    public function Payments()
    {
        return view("user.payments");
    }

    public function Profile($id)
    {
        $providerServices = Service::where('user_id', $id)->where('status', '1')->pluck('service_category_id')->toArray();
        $services = Service::where('user_id', $id)->get();

        $serviceIds = $services->pluck('id')->toArray();

        $allReviews = ServiceReview::whereIn('service_id', $serviceIds)->paginate(5);

        $serviceCategories = ServiceCategory::whereIn('id', $providerServices)->get();
        $providerDetails = User::find($id);
        $qualifications = Qualification::where('user_id', $id)->get();
        $companyAddress = Address::with('country', 'city', 'town')->where('user_id', $id)->first();
        $country = Country::where('country_name', 'like', '%Uganda%')->first();
        $cities = City::where('country_id', $country->id)->get();
        $appointmentSchedule = AppointmentSchedule::where('user_id', $id)->first();
        $biography = Biograpy::where('user_id', $id)->first();

        return view("user.profile", compact('biography', 'serviceCategories', 'providerDetails', 'qualifications', 'companyAddress', 'appointmentSchedule', 'country', 'cities', 'services', 'allReviews'));
    }


    public function makeAppointment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_category' => 'required',
        ]);

        if ($validator->fails()) {
            toastr($validator->errors()->first(), 'error');
            return redirect()->back();
        }
        $serviceDetails = Service::with('serviceCategory')->where(['user_id' => $request->vendor_id, 'service_category_id' => $request->service_category])->first();
        $servicePrice = $serviceDetails->serviceCategory->price;
        if (getUserWalletBalance() < $servicePrice) {
            toastr('You have insuffient balance. Kindly add balance to your wallet', 'warning');
            return redirect()->back();
        }

        if ($serviceDetails->serviceCategory->price)
            $appointmentArray = [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'location' => $request->location,
                'purchase_amount' => $serviceDetails->serviceCategory->price,
                'service_id' => $serviceDetails->id,
                'user_id' => Auth::id(),
                'vendor_id' => $request->vendor_id,
            ];

        $appointment = Appointment::create($appointmentArray);

        $appointment->load('user', 'serviceProvider', 'serviceDetails');
        $serviceProviderEmail = User::findOrFail($request->vendor_id);
        Mail::to($serviceProviderEmail)->send(new BookingMail($appointment));

        if ($appointment) {
            toastr('Appointment made successfully');
            return redirect()->route('user.appointmentDetails', ['id' => $appointment->id, 'vendor_id' => $request->vendor_id]);
        }
    }

    public function Transactions()
    {
        return view("user.orderDetails");
    }

    public function Dashboard()
    {
        $countAppointment = Appointment::where('user_id', Auth::id())->count();
        $countServiceProviders = User::role('vendor_user')->count();
        $countServiceCategories = ServiceCategory::count();
        $walletAmount = Transaction::where('user_id', Auth::id())->sum('amount');
        $allAppointments = Appointment::with('collectionDetails', 'serviceDetails', 'serviceDetails.serviceCategory', 'user', 'serviceProvider')->where('user_id', \Auth::id())->get();
        return view("user.dashboard", compact('walletAmount', 'countServiceCategories', 'countAppointment', 'countServiceProviders', 'allAppointments'));
    }

    public function editProfile()

    {
        try {
            $user = User::findOrFail(Auth::id());
            return view('user.edit_profile', compact('user'));
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('error', 'SomeThing Went Wrong!');
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = User::findOrFail(Auth::user()->id);

            // Validate the input data
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'phone' => 'required|string|max:20',
                'gender' => 'required|string|in:0,1',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'nullable|string|min:8',
            ]);

            // Update user details
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->gender = $request->input('gender');

            // Update password if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            // Handle avatar upload
            if ($request->has('avatar')) {
                $avatar = $request->file('avatar');
                $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
                $avatarPath = public_path('/images/');
                $avatar->move($avatarPath, $avatarName);
                $user->avatar = $avatarName;
            }

            $user->save();

            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (Exception $e) {
            dd($e);
            Log::error($e);
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function getCountryCities(Request $request)
    {
        $countryId = $request->country_id;
        $cities = City::where('country_id', $countryId)->get();
        return response()->json(['cities' => $cities]);
    }

    public function ServiceProviders(Request $request)
    {
        $serviceCategories = ServiceCategory::all();

        $country = Country::where('country_name', 'Like', '%Uganda%')->first();
        $cities = City::where('country_id', $country->id)->get();

        $countryId = $request->country;
        $cityId = $request->city;
        $townId = $request->town;
        $serviceCategoryId = $request->service_category;

        $town = null;
        if (!empty($townId)) {
            $town = County::find($townId);
        }

        $query = User::whereHas('roles', function ($query) {
            $query->where('name', 'vendor_user');
        })->where('profile_approved_status', '1');

        if (!empty($serviceCategoryId)) {
            $query->whereHas('services', function ($query) use ($serviceCategoryId) {
                $query->whereIn('service_category_id', (array) $serviceCategoryId)->where('status', '1');
            });
        } else {
            $query->whereHas('services', function ($query) {
                $query->where('status', '1');
            });
        }

        if (!empty($countryId)) {
            $query->whereHas('address', function ($query) use ($countryId) {
                $query->where('country_id', $countryId);
            });
        }

        if (!empty($cityId)) {
            $query->whereHas('address', function ($query) use ($cityId) {
                $query->where('city_id', $cityId);
            });
        }

        if (!empty($townId)) {
            $query->whereHas('address', function ($query) use ($townId) {
                $query->where('town_id', $townId);
            });
        }

        $serviceProviders = $query->get();

        return view("user.service-providers", compact('serviceProviders', 'serviceCategories', 'country', 'cities', 'town'));
    }


    // public function Appointments(Request $request)
    // {
    //     $allAppointments = Appointment::with('serviceDetails', 'serviceDetails.serviceCategory', 'user', 'serviceProvider')->where('user_id', \Auth::id());
    //     $serviceCategories = ServiceCategory::all();
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
    //         return view("user.appointments", compact('allAppointments', 'serviceCategories'));
    //     }
    // }

    public function Appointments(Request $request)
    {
        if ($request->ajax()) {
            $allAppointments = Appointment::with('serviceDetails', 'serviceDetails.serviceCategory', 'user', 'serviceProvider')
                ->where('user_id', Auth::id());

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
                    return '<a href="' . route('user.appointmentDetails', ['id' => $appointment->id, 'vendor_id' => $appointment->serviceProvider->id]) . '" class="link-success fs-23 Edit-Button" title="View Details"><i class="las la-eye"></i></a>';
                })
                ->rawColumns(['status', 'appointmentStatus', 'action'])
                ->make(true);
        }

        $serviceCategories = ServiceCategory::all();
        return view("user.appointments", compact('serviceCategories'));
    }


    // public function searchAppointment(Request $request)
    // {
    //     $query = Appointment::query();

    //     if ($request->filled('search_input')) {
    //         $searchInput = $request->search_input;
    //         $query->where(function ($q) use ($searchInput) {
    //             $q->where('location', 'like', '%' . $searchInput . '%')
    //                 ->orWhereHas('user', function ($q) use ($searchInput) {
    //                     $q->where('first_name', 'like', '%' . $searchInput . '%')
    //                         ->orWhere('last_name', 'like', '%' . $searchInput . '%');
    //                 })
    //                 ->orWhereHas('serviceDetails.serviceCategory', function ($q) use ($searchInput) {
    //                     $q->where('name', 'like', '%' . $searchInput . '%');
    //                 })
    //                 ->orWhere('appointment_status', 'like', '%' . $searchInput . '%')
    //                 ->orWhere('status', 'like', '%' . $searchInput . '%')
    //                 ->orWhere('purchase_amount', 'like', '%' . $searchInput . '%')
    //                 ->orWhere('start_date', 'like', '%' . $searchInput . '%')
    //                 ->orWhere('end_date', 'like', '%' . $searchInput . '%')
    //                 ->orWhere('start_time', 'like', '%' . $searchInput . '%')
    //                 ->orWhere('end_time', 'like', '%' . $searchInput . '%');
    //         });
    //     }

    //     if ($request->filled('service_category')) {
    //         $query->whereHas('serviceDetails.serviceCategory', function ($q) use ($request) {
    //             $q->where('id', $request->service_category);
    //         });
    //     }

    //     if ($request->filled('service_type')) {
    //         $query->where('appointment_status', $request->service_type);
    //     }

    //     $allAppointments = $query->with(['serviceDetails.serviceCategory', 'user', 'serviceProvider'])->get();

    //     return view('user.appointments', compact('allAppointments'))->render();
    // }


    public function appointmentDetails($id, $vendor_id)
    {
        $appointmentDetails = Appointment::with([
            'disbursementDetails',
            'collectionDetails',
            'serviceDetails',
            'serviceDetails.serviceCategory',
            'user',
            'serviceProvider',
            'serviceProvider.identity',
            'serviceProvider.biography'
        ])->find($id);

        $chats = Chat::with('userDetails')->where('appointment_id', $id)->get();
        $companyAddress = Address::with('country', 'city', 'town')->where('user_id', $appointmentDetails->vendor_id)->first();

        $messenger_color = Auth::user()->messenger_color;
        return view("user.appointment-details", compact('companyAddress', 'appointmentDetails', 'chats'))
            ->with([
                'id' => $vendor_id,
                'messengerColor' => $messenger_color ? $messenger_color : Chatify::getFallbackColor(),
                'dark_mode' => Auth::user()->dark_mode < 1 ? 'light' : 'dark',
            ]);
    }



    public function Services()
    {
        $serviceCategories = ServiceCategory::all();
        return view("user.services", compact('serviceCategories'));
    }
    public function providingServices($id)
    {
        $serviceCategories = ServiceCategory::all();
        $services = Service::where('service_category_id', $id)->get();
        return view('user.providing-services', compact('serviceCategories', 'services'));
    }
    public function serviceDetails(string $id)
    {
        $serviceDetails = Service::find($id);
        return response()->json([
            'status' => true,
            'serviceDetails' => $serviceDetails
        ]);
    }
    public function Wallet()
    {
        return view("user.wallet");
    }
    public function updateUser(Request $request)
    {
        if (isset($request->user_id)) {
            $userDetails = User::find($request->user_id);
            $userDetails->first_name = $request->first_name;
            $userDetails->last_name = $request->last_name;
            $userDetails->is_approved  = $request->is_approved;
            // $userDetails->email  = $request->email;
            if (isset($request->role)) {
                \DB::table('model_has_roles')->where('model_id', $request->user_id)->update(['role_id' => $request->role]);
            }
            if ($userDetails->save()) {
                toastr('Data Saved Successfully');
                return redirect()->back();
            }
        } else {
            toastr('Data Failed to Save', 'error');
            return redirect()->back();
        }
    }

    public function deleteUser(Request $request)
    {
        if (isset($request->user_id)) {
            $userDetails = User::find($request->user_id);
            if ($userDetails->delete()) {
                toastr('Data Deleted Successfully');
                return redirect()->back();
            }
        } else {
            toastr('Data Failed to Delete', 'error');
            return redirect()->back();
        }
    }

    public function vendorServiceDetails($vendorId, $serviceCategory)
    {
        $serviceDetails = Service::with('serviceCategory')->where('user_id', $vendorId)->where('service_category_id', $serviceCategory)->first();
        return response()->json([
            'status' => true,
            'serviceDetails' => $serviceDetails
        ]);
    }

    public function submitReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => ['required', function ($attribute, $value, $fail) {
                $userReview = ServiceReview::where(function ($query) use ($value) {
                    $query->where('user_id', Auth::id());
                    $query->where('service_id', $value);
                })->exists();
                if ($userReview) {
                    $fail('Review already exists');
                }
            }],
        ]);
        if ($validator->fails()) {
            toastr($validator->errors()->first(), 'error');
            return redirect()->back();
        }
        $createReview = new ServiceReview;
        $createReview->ratings = $request->rating;
        $createReview->description = $request->description;
        $createReview->appointment_id = $request->appointment_id;
        $createReview->user_id = Auth::id();
        $createReview->service_id = $request->service_id;
        if ($createReview->save()) {
            toastr('Review submitted successfully');
            return redirect()->back();
        }
    }

    public function addBalance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mtn_number' => 'required|numeric|digits_between:8,10',
            'amount' => 'required',
        ]);
        if ($validator->fails()) {
            $errorMessage = '';
            foreach ($validator->errors()->all() as $error) {
                $errorMessage = $errorMessage . $error . "\n";
            }
            toastr($errorMessage, 'error');
            return redirect()->back();
        }

        $collection = new Collection();
        $referenceId = $collection->requestToPay('yourTransactionId', $request->mtn_number, $request->amount);
        $transaction = $collection->getTransactionStatus($referenceId);
        if (isset($referenceId)) {
            $transaction =
                [
                    'transaction_type' => 'Collection',
                    'transaction_status' => $transaction['status'],
                    'amount' => $request->amount,
                    'mtn_number' => $request->mtn_number,
                    'user_id' => Auth::id(),
                    'reference_id' => $referenceId,
                ];
            if (Transaction::create($transaction)) {
                toastr('Balance added successfully');
                return redirect()->back();
            }
        }
    }

    public function transactionHistory()
    {
        $userAppointments = Appointment::where('user_id', auth()->id())->where('status', '0')->with('serviceDetails')->get();

        $totalSpentOnAppointments = $userAppointments->sum('purchase_amount');

        $otherTransactions = Transaction::where('user_id', auth()->id())->get();

        $totalFromOtherTransactions = $otherTransactions->sum('amount');

        $remainingBalance = abs($totalSpentOnAppointments - $totalFromOtherTransactions);

        $transactions = $userAppointments->merge($otherTransactions);

        return view('user.transaction-history', [
            'transactions' => $transactions,
            'remainingBalance' => $remainingBalance,
            'userAppointments' => $userAppointments,
            'otherTransactions' => $otherTransactions
        ]);
    }
}
