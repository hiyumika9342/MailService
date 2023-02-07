<?php

namespace App\Domain\Services;

use App\Domain\Repositories\EmailRepository;
use App\Mail\SendMail;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    /**
     * @var EmailRepository
     */
    private EmailRepository $emailRepository;

    public function __construct(EmailRepository $emailRepository){
        $this->emailRepository = $emailRepository;
    }

    /**
     * @return mixed
     */
    public function getEmails(){
        return $this->emailRepository->paginate(5, true);
    }

    /**
     * @param $email_address
     * @return bool
     */
    public function storeEmail($emailAddress){

        DB::beginTransaction();

        try{
            $data['email_address'] = $emailAddress;
            $this->emailRepository->insert($data);
            DB::commit();
            return true;

        }catch (Exception $e){
            DB::rollBack();
            return false;

        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteEmail($id){

        DB::beginTransaction();

        try{
            $this->emailRepository->delete($id);
            DB::commit();
            return true;
        }catch (Exception $e){
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param $emailIds
     * @param $message
     * @return bool
     */
    public function sendMail($emailIds, $message){
        try{
            $emailAddressList = $this->emailRepository->findMany($emailIds)->pluck("email_address");
            Mail::send(new SendMail($emailAddressList, $message));
            return true;
        } catch (Exception $e){
            return false;
        }

    }
}
