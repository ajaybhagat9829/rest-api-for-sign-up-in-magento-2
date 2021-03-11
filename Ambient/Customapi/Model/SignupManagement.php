<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types = 1);

namespace Ambient\Customapi\Model;

use Magento\Framework\App\RequestInterface;
use Magento\Customer\Api\AccountManagementInterface;

class SignupManagement implements \Ambient\Customapi\Api\SignupManagementInterface {

    protected $request;
    protected $storemanager;
    protected $customerInterfaceFactory;
    protected $encryptorInterface;
    protected $customerRepositoryInterface;
    protected $customerFactory;
    protected $customerAccountManagement;

    public function __construct(
    RequestInterface $request, \Magento\Store\Model\StoreManagerInterface $storemanager, \Magento\Customer\Api\Data\CustomerInterfaceFactory $customerInterfaceFactory, \Magento\Framework\Encryption\EncryptorInterface $encryptorInterface, \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface, \Magento\Customer\Model\CustomerFactory $customerFactory, AccountManagementInterface $customerAccountManagement
    ) {

        $this->request = $request;
        $this->storemanager = $storemanager;
        $this->customerInterfaceFactory = $customerInterfaceFactory;
        $this->encryptorInterface = $encryptorInterface;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->customerFactory = $customerFactory;
        $this->customerAccountManagement = $customerAccountManagement;
    }

    /**
     * {@inheritdoc}
     */
    public function postSignup() {
        try {
            /** @var \Magento\Customer\Api\Data\CustomerInterface $customer */
            $data = [];
            $mobile = $this->request->getParam('Mobile_number');
            $websiteId = '1';
            $email = $mobile . "@" . $_SERVER['HTTP_HOST'];
            $customer = $this->customerFactory->create();
            $isEmailNotExists = $this->customerAccountManagement->isEmailAvailable($email, $websiteId);
            if ($isEmailNotExists) {
                $customer->setStoreId(0);
                $customer->setWebsiteId(1);
                $customer->setEmail($email);
                $customer->setFirstname('Tester');
                $customer->setLastname('Tester');
                $customer->setPassword('tester@123');
                $customer->save();
                $data['status : '] = 'true';
                $data['message : '] = 'Success';
                //$data['email']   = $customer->getEmail();
            } else {
                $customer->setWebsiteId(1);
                $customer->loadByEmail($email);
                $data['respone'] = 'false';
                $data['message'] = 'Customer already exists';
                $data['email'] = $customer->getEmail();
            }

            header('device_type: iOS/Android');
            echo json_encode($data);
            
        } catch (\Exception $e) {
            echo $e;
            die("sdfdfsdf");
        }
    }
    
   

}
