<?php

namespace App\Http\Controllers;

use App\Domain\Services\EmailService;
use App\Http\Requests\MailSendRequest;
use App\Http\Requests\MailStoreRequest;
use Illuminate\Http\RedirectResponse;

class EmailController extends Controller
{

    private EmailService $emailService;

    public function __construct(EmailService $emailService){
        $this->emailService = $emailService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $emails = $this->emailService->getEmails();
        return view('email.index', [
            'emails' => $emails
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('email.create');
    }

    /**
     * @param MailStoreRequest $request
     * @return RedirectResponse
     */
    public function store(MailStoreRequest $request)
    {
        $email_address = $request->get('email_address');
        $result = $this->emailService->storeEmail($email_address);

        if($result){
            return redirect()->route('email.index')->with('status', '登録しました!');
        } else {
            return redirect()->route('email.index')->with('error', '登録に失敗しました!');
        }

    }

    /**
     * @param MailSendRequest $request
     * @return RedirectResponse
     */
    public function send(MailSendRequest $request)
    {
        $emailIds = $request->get('mail_send_ids');
        $message = $request->get('mail_send_message');

        $result = $this->emailService->sendMail($emailIds, $message);
        if($result){
            return redirect()->route('email.index')->with('status', '送信しました!');
        }else{
            return redirect()->route('email.index')->with('error', '送信に失敗しました!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $result = $this->emailService->deleteEmail($id);
        if($result){
            return redirect()->route('email.index')->with('status', '削除しました!');
        } else {
            return redirect()->route('email.index')->with('error', '削除に失敗しました!');
        }

    }
}
