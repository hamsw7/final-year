<?php

namespace Webkul\Member\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Webkul\Member\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Twilio\Rest\Client;
use Twilio\Exceptions\RestException;

class MemberController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $members = Member::where('user_id', auth('admin')->id())->get();
        return view('member::admin.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('member::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
         'email' => 'required|email|max:255|unique:members,email',
            'phone' => 'nullable|string|max:20|unique:members,phone',
            'address' => 'nullable|string|max:255',
        ]);

        $memberData = $validated;
        $memberData['user_id'] = auth('admin')->id(); // Use the appropriate guard
        Member::create($memberData);
        session()->flash('success', 'Member created successfully.');
        return redirect()->route('admin.member.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $member = Member::findOrFail($id);
        return view('member::admin.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(int $id)
    {
        //
        $validated = request()->validate([
            'name' => 'required|string|max:255',
          'email' => 'required|email|max:255|unique:members,email,' . $id,
            'phone' => 'nullable|string|max:20|unique:members,phone,' . $id,
            'address' => 'nullable|string|max:255',
        ]);
        $memberData = $validated;
        Member::find($id)->update($memberData);

        session()->flash('success', 'Member updated successfully.');
        return redirect()->route('admin.member.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $member = Member::findOrFail($id);
        if ($member) {
            $member->delete();
            session()->flash('success', 'Member deleted successfully.');
        } else {
            session()->flash('error', 'Member not found.');
        }
        return redirect()->route('admin.member.index');
    }

    public function indexs()
 {
     // Display the view containing the form.
  return view('member::admin.message');
 }
public function stores(Request $request)
{
    $twilioSid = env('TWILIO_SID');
  $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
  $twilioNumber = env('TWILIO_PHONE_NUMBER');

 $to = $request->phone;
 $messageBody = $request->message;

 try {
     $client = new Client($twilioSid, $twilioAuthToken);
     $client->messages->create($to, [
         'from' => $twilioNumber,
         'body' => $messageBody
     ]);

     session()->flash('success', 'Message sent successfully.');
     return redirect()->route('admin.member.index');

 } catch (RestException $e) {
     $errorMessage = 'Failed to send message: ';

     // Handle specific Twilio error codes
     if ($e->getStatusCode() == 400) {
         if (strpos($e->getMessage(), 'unverified') !== false) {
             $errorMessage = 'Cannot send message: Recipient number (this phone number)is unverified.';
         } elseif (strpos($e->getMessage(), 'invalid') !== false) {
             $errorMessage = 'Invalid phone number format.';
         }
     } else {
         $errorMessage .= $e->getMessage();
     }

     session()->flash('error', $errorMessage);

 } catch (\Exception $e) {
     session()->flash('error', 'An unexpected error occurred: ' . $e->getMessage());
 }

 return redirect()->route('admin.member.send');
}
}
// Compare this snippet from bagisto/packages/Webkul/Member/src/Models/Member.php:
