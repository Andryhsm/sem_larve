<?php

namespace App\Service;


use App\Interfaces\NewsletterSubscriptionInterface;
use ZfrMailChimp\Client\MailChimpClient;

class MailchimpService implements NewsletterSubscriptionInterface
{
	protected $client = '';
	protected $mailchimp_key = '';
	protected $mailchimp_list_id = '';

	public function __construct()
	{
		$this->mailchimp_key = config('services.mailchimp.MAILCHIMP_API_KEY');
		$this->mailchimp_list_id = config('services.mailchimp.MAILCHIMP_LIST_ID');
		$this->client = new MailChimpClient(config('services.mailchimp.MAILCHIMP_API_KEY'));
	}

	public function subscribe($subscriptionInfo = [])
	{
		return $this->client->subscribe(['id' => $this->mailchimp_list_id,
			'email' => ['email' => $subscriptionInfo['email_address'],]]);
	}

	public function unSubscribe($subscriptionInfo = [])
	{
		$this->client->unsubscribe(['id' => $this->mailchimp_list_id,
			'email' => ['email' => $subscriptionInfo['email_address'],]]);
	}

	public function getUserStatus($email = '')
	{
		return $this->client->getListMembersInfo(['id' => $this->mailchimp_list_id,
			'emails' => [['email' => $email]]
		]);
	}
}