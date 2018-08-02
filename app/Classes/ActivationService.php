<?php
namespace App\Classes;

use Mail;
use App\UserActivation;
use App\Mail\UserActivationEmail;
use App\User;

class ActivationService{
	protected $resendAfter = 24;
	protected $userActivation;

	public function __construct(UserActivation $userActivation){
		$this->userActivation = $userActivation;
	}

	public function sendActivationMail($user){
		if ($user->active || !$this->shouldSend($user)) {
			return;
		}
		$token = $this->userActivation->createActivation($user);
		$user->activation_link = url('/user/activation/'.$token);
		$mailable = new UserActivationEmail($user);
		Mail::to($user->email)->send($mailable);
	}

	public function activateUser($token){
		$activation = $this->userActivation->getActivationByToken($token);
		if ($activation === null) {
			return null;
		}
		$user = User::find($activation->user_id);
		$user->active = true;
		$user->save();
		$this->userActivation->deleteActivation($token);
		return $user;
	}

	private function shouldSend($user){
		$activation = $this->userActivation->getActivation($user);
		return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
	}
}